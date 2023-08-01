<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use TCG\Voyager\Facades\Voyager;

class VoyagerMetaController extends Controller{

    public function builder($id){
        $meta = Voyager::model('Meta')->findOrFail($id);

        $this->authorize('edit', $meta);

        $isModelTranslatable = false;

        return Voyager::view('vendor.voyager.metas.builder', compact('meta', 'isModelTranslatable'));
    }

    public function delete_menu($menu, $id){
        $item = Voyager::model('Meta')->findOrFail($id);

        $this->authorize('delete', $item);

        $item->deleteAttributeTranslation('title');

        $item->destroy($id);

        return redirect()->route('vendor.voyager.metas.builder', [$menu])->with([
                'message' => __('voyager::menu_builder.successfully_deleted'),
                'alert-type' => 'success',
            ]);
    }

    public function add_item(Request $request){
        $meta = Voyager::model('Meta');

        $this->authorize('add', $meta);

        $data = $this->prepareParameters($request->all());

        unset($data['id']);
        $data['order'] = Voyager::model('Meta')->highestOrderMenuItem();

        // Check if is translatable
        $_isTranslatable = false;

        $menuItem = Voyager::model('Meta')->create($data);

        return redirect()->route('vendor.voyager.metas.builder', [$data['menu_id']])->with([
                'message' => __('voyager::menu_builder.successfully_created'),
                'alert-type' => 'success',
            ]);
    }

    public function update_item(Request $request){
        $id = $request->input('id');
        $data = $this->prepareParameters($request->except(['id']));

        $menuItem = Voyager::model('Meta')->findOrFail($id);

        $this->authorize('edit', $menuItem->menu);

        if(is_bread_translatable($menuItem)){
            $trans = $this->prepareMenuTranslations($data);

            // Save menu translations
            $menuItem->setAttributeTranslations('title', $trans, true);
        }

        $menuItem->update($data);

        return redirect()->route('vendor.voyager.metas.builder', [$menuItem->menu_id])->with([
                'message' => __('voyager::menu_builder.successfully_updated'),
                'alert-type' => 'success',
            ]);
    }

    public function order_item(Request $request){
        $menuItemOrder = json_decode($request->input('order'));

        $this->orderMenu($menuItemOrder, null);
    }

    private function orderMenu(array $menuItems, $parentId){
        foreach($menuItems as $index => $menuItem){
            $item = Voyager::model('Meta')->findOrFail($menuItem->id);
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if(isset($menuItem->children)){
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }

    protected function prepareParameters($parameters){
        switch(Arr::get($parameters, 'type')){
            case 'route':
                $parameters['url'] = null;
                break;
            default:
                $parameters['route'] = null;
                $parameters['parameters'] = '';
                break;
        }

        if(isset($parameters['type'])){
            unset($parameters['type']);
        }

        return $parameters;
    }

    protected function prepareMenuTranslations(&$data){
        $trans = json_decode($data['title_i18n'], true);

        // Set field value with the default locale
        $data['title'] = $trans[config('voyager.multilingual.default', 'en')];

        unset($data['title_i18n']);     // Remove hidden input holding translations
        unset($data['i18n_selector']);  // Remove language selector input radio

        return $trans;
    }
}
