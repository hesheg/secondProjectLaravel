<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
      'contact_name',
      'contact_phone',
      'comment',
      'user_id',
      'address'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('amount');
    }

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
