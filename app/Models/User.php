<?php

namespace App\Models;

use \Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser
{
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function userProducts()
    {
        return $this->hasMany(UserProduct::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'user_products')
            ->withPivot('amount');
    }
}
