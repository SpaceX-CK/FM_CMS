<?php

namespace App\Models;

use App\Traits\Models\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, SoftDeletes , HasMedia;
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = ['setting_keys', 'setting_values'];
    protected $dates = ['deleted_at'];
}
