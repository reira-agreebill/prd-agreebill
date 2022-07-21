<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectedSubscription extends Model
{
    protected $guarded = [];

    public function store($store_id) {
        return Store::all()->where('id','=',$store_id);
    }
}
