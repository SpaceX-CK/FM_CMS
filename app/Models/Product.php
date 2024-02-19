<?php

namespace App\Models;

use App\Traits\Models\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Observers\ProductObserver;
use App\Models\Shop;

class Product extends Model
{
    use HasFactory , SoftDeletes , HasMedia;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['product_name','product_type','product_description','image','product_weight','sequence','recommend','slug','category_id'];
    
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function articles()
    {
        return $this->belongsTo(Article::class);
    }

    public function shops()
    {
          //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(Shop::class, 'product_shop', 'product_id','shop_id', 'id','id')->withPivot('shop_url');
        // return $this->belongsToMany('App\Models\Shop','shop_id')->withPivot('shop_url');
    }


    protected static function boot()
    {
        parent::boot();
        Product::observe(ProductObserver::class);
    }
}
