<?php

namespace App\Models;

use App\Traits\Models\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model
{
    use HasFactory, SoftDeletes , HasMedia;
    protected $table = 'home';
    protected $primaryKey = 'id';
    protected $fillable = ['home_keys', 'home_values'];
    protected $dates = ['deleted_at'];
}
