<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function productinfos()
    {
        return $this->hasMany(Product::class);
    }
    public function productInfo(){
        return $this->hasMany(Product::class)->where('is_active','=',1)->orderBy('name');
    }

}
