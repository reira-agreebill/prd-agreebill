<?php

namespace App\Models;

use App\Notifications\MailResetStorePasswordNotification;
use App\StoreSetting;
use Illuminate\Foundation\Auth\User as Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
class Store extends Model implements JWTSubject
{
    use Notifiable;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetStorePasswordNotification($token));
    }
    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public static function getStoreByViewId($id){
        return Store::all()->where('view_id',$id)->first();
    }
    public function getSettings(){
        return $this->hasOne(StoreSetting::class);
    }
    public function getCoupons(){
        return $this->hasMany(Coupon::class);
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
