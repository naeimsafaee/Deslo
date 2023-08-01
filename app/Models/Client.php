<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed phone
 * @property int|mixed verify_code
 * @property mixed|string username
 * @property mixed|string invite_code
 */
class Client extends Authenticatable{
    use Notifiable;

    protected $appends = ['image'];

    protected $guarded = ['id'];

    public function getImageAttribute(){
        if($this->avatar)
            return $this->avatar;
        else
            return 'clients/April2021/XcXt2dksSHGuTVJ3pKg8.png';

    }

    public function wallet(){
        return $this->hasOne('App\Models\Wallet');
    }

    public function walletTransactions(){
        return $this->hasMany('App\Models\WalletTransaction')->join('transactions', 'transactions.id', '=', 'wallet_transactions.transaction_id')->orderBy('transactions.transaction_date', 'DESC')->select('wallet_transactions.*');
    }

    public function regulate(){
        return $this->hasMany(Regulate::class, 'client_id', 'id');
    }

    public function pickup(){
        return $this->hasMany(Pickup::class, 'client_id', 'id');
    }

    public function comment_album(){
        return $this->hasMany(CommentAlbum::class, 'client_id', 'id');
    }
    public function comments(){
        return $this->hasMany(CommentProduct::class, 'client_id', 'id');
    }

    public function products(){
        return $this->hasMany(OrdersProduct::class, 'client_id', 'id');
    }

    public function files(){
        return $this->hasMany(OrdersFiles::class, 'client_id', 'id');
    }

    public function albums(){
        return $this->hasMany(OrderAlbum::class, 'client_id', 'id');
    }

    public function addresses(){
        return $this->hasMany(Address::class, 'client_id', 'id');
    }

    public function installments(){
        return $this->hasMany(ClientToInstallments::class, 'client_id', 'id')->orderByDesc('time');
    }

    public function favourite(){
        return $this->hasMany(ClientFavorite::class, 'client_id', 'id');
    }
}
