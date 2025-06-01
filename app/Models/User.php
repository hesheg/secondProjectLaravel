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

    public function UserProducts()
    {
        return $this->hasMany(UserProduct::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, UserProduct::class, 'user_id', 'id', 'id', 'product_id');
    }
}
