<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table ='ShoppingCart';
    protected $fillable = ['id','cart_id','product_id','quantity'];
}
