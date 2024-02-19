<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\Models\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Shop extends Model
{
    use HasFactory, SoftDeletes, HasMedia;
    protected $table = 'shops';
    protected $primaryKey = 'id';
    protected $fillable = ['shop_name'];
    
    public function products()
    {
        // return $this->belongsToMany('App\Models\Product','product_id')->withPivot('shop_url');
        return $this->belongsToMany(Product::class, 'product_shop', 'shop_id', 'product_id', 'id','id')->withPivot('shop_url');

    }
}
