<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table ='orders';
    protected $fillable = ['order_id','customer_name','address1','address2','create_date','city','cart_id'];
}
