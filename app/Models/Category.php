<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Observers\CategoryObserver;
use App\Traits\Models\HasMedia;

class Category extends Model
{
    use HasFactory , SoftDeletes , HasMedia;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['category_name', 'category_description','category_banner','sequence','slug'];
    protected $dates = ['deleted_at'];
    protected static function boot()
    {
        parent::boot();
        Category::observe(CategoryObserver::class);
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id');
    }
}
