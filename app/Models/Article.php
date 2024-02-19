<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\ArticleObserver;

class Article extends Model
{
    use HasFactory , SoftDeletes , HasMedia;
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $casts= [
        'product_id'=>'array'
    ];
    protected static function boot()
    {
        parent::boot();
        Article::observe(ArticleObserver::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getDateAttribute($date)
    {
        $newdate= $date->toDateTimeString();
        return $newdate;
    }
}
