<?php

namespace App\Observers;
use App\Helpers\Misc;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    
    public function creating(Category $category)
    {
        // slug
        $category->slug = Misc::instance()->generateSlug($category->category_name, Category::class);
        
        // sqeuence
        if (is_null($category->sequence)) {
            $category->sequence = Category::max('sequence') + 1;
            return;
        }

        $lowerPriorityCategories = Category::where('sequence', '>=', $category->sequence)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            $lowerPriorityCategory->sequence++;
            $lowerPriorityCategory->saveQuietly();
        }
    }
    public function updating(Category $category)
    {
        $category->slug = Misc::instance()->generateSlug($category->category_name, Category::class);
        if ($category->isClean('sequence')) {
            return;
        }

        if (is_null($category->sequence)) {
            $category->sequence = Category::max('sequence');
        }

        if ($category->getOriginal('sequence') > $category->sequence) {
            $positionRange = [
                $category->sequence, $category->getOriginal('sequence')
            ];
        } else {
            $positionRange = [
                $category->getOriginal('sequence'), $category->sequence
            ];
        }

        $lowerPriorityCategories = Category::where('id', '!=', $category->id)
            ->whereBetween('sequence', $positionRange)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            if ($category->getOriginal('sequence') < $category->sequence) {
                $lowerPriorityCategory->sequence--;
            } else {
                $lowerPriorityCategory->sequence++;
            }
            $lowerPriorityCategory->saveQuietly();
        }
    }

    public function deleted(Category $category)
    {
        $lowerPriorityCategories = Category::where('sequence', '>', $category->sequence)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            $lowerPriorityCategory->sequence--;
            $lowerPriorityCategory->saveQuietly();
        }
    }

}
