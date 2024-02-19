<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductShop extends Pivot
{
    use HasFactory;
    protected $table = 'product_shop';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id','shop_id','shop_url'];
}
