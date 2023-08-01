<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Product extends Model {
    use Resizable;

    protected $appends = [
        'is_discounted',
        'slug',
        'final_price',
    ];

    protected $fillable = [
        "name", "price", "discounted_price", "height", "material", 'main_image', 'description'
    ];

    public function getIsDiscountedAttribute() {
        return $this->discounted_price != 0;
    }

    public function getFinalPriceAttribute() {

        $amount = (float)($this->getIsDiscountedAttribute() ? $this->discounted_price : $this->price);

        $color_price = 0;
        if (request()->has('color')) {
            $color = ColorToProduct::query()->where([
                'color_id' => request()->color,
                'product_id' => $this->id
            ])->first();
            if ($color) {
                $color_price = (float)$color->amount;
            }
        }

        return $amount + $color_price;
    }

    public function discountPercent() {
        $percent = (($this->price - $this->discounted_price) / $this->price) * 100;
        if ($percent > 0) {
            return (int)$percent;
        } else {
            return 0;
        }
    }

    public function getSlugAttribute() {
        return str_replace(" ", "_", $this->name);
    }

    public function getRateAttribute() {
        if (!isset($this->attributes['rate'])) {
            return 0;
        }
        return $this->attributes['rate'] != 0 ? $this->attributes['rate'] : 5;
    }

    public function scopefindWithSlug(Builder $builder, $slug) {
        return $builder->where('name', '=', str_replace("_", " ", $slug));
    }

    public function installmentMonthlyPay() {
        if ($this->installment_id == 0) {
            return '';
        }
        $installment = $this->installment;
        $interest = ($installment->darsad / 100) * $this->final_price;
        $price = $this->final_price + $interest;
        return $price / $installment->number_of_month;
    }

    public function installment() {
        return $this->belongsTo(Installment::class);
    }

    public function comments() {
        return $this->hasMany(CommentProduct::class, 'product_id', 'id')->active();
    }

    public function questions() {
        if (auth()->guard('web')->check()) {
            return $this->hasMany(Questions::class, 'product_id', 'id')->where('reply_to', 0)->active();
        } else {
            return $this->hasMany(Questions::class, 'product_id', 'id')->where('reply_to', 0)->active();
        }
    }

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function colors() {
        return $this->hasManyThrough(
            Color::class,
            ColorToProduct::class,
            'product_id',
            'id',
            'id',
            'color_id');
    }

    public function features() {
        return $this->hasManyThrough(
            Feature::class,
            ProductFeature::class,
            'product_id',
            'id',
            'id',
            'feature_id');
    }

    public function samples() {
        return $this->hasMany(Sample::class);
    }

    public function postive_features() {
        return $this->hasManyThrough(
            Feature::class,
            ProductFeature::class,
            'product_id',
            'id',
            'id',
            'feature_id')
            ->where('is_positive', true);
    }

    public function negative_features() {
        return $this->hasManyThrough(
            Feature::class,
            ProductFeature::class,
            'product_id',
            'id',
            'id',
            'feature_id')
            ->where('is_positive', false);
    }

    public function guaranties() {
        return $this->hasManyThrough(
            Guarany::class,
            ProductGuarany::class,
            'product_id',
            'id',
            'id',
            'guarany_id');
    }

    public function categories() {
        return $this->hasManyThrough(
            ProductSubCategory::class,
            ProducToProducttSubCategory::class,
            'product_id',
            'id',
            'id',
            'subcategory_id');
    }

    public function attributes() {
        return $this->hasManyThrough(
            AttributeValue::class,
            ProductToAttributeValue::class,
            'product_id',
            'id',
            'id',
            'attribute_value_id');
    }

    public function top_attributes() {
        return $this->belongsToMany(
            AttributeValue::class,
            ProductTopAttributeValues::class);
    }

    public function relate() {
        return $this->hasManyThrough(
            Product::class,
            Related::class,
            'product_id',
            'id',
            'id',
            'related_id');
    }

}
