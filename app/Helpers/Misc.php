<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Helpers\Status;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Misc
{
    public static function instance()
    {
        return new self();
    }
    public function generateSlug(string $name, string $class): string
    {
        // slugify the name
        $slug = Str::slug($name);
        $count = $class::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        return $slug;
    }

}