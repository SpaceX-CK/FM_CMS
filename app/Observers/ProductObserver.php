<?php

namespace App\Observers;

use App\Helpers\Misc;
use App\Models\Product;

class ProductObserver
{
    public function creating(Product $product)
    {
        // slug
        $product->slug = Misc::instance()->generateSlug($product->product_name, Product::class);
        
        // sqeuence
        if (is_null($product->sequence)) {
            $product->sequence = 1;
            return;
        }
        // $lowerPriorityCategories = Product::where('sequence', '>=', $product->sequence)
        //     ->get();

        // foreach ($lowerPriorityCategories as $lowerPriorityProduct) {
        //     $lowerPriorityProduct->sequence++;
        //     $lowerPriorityProduct->saveQuietly();
        // }
    }
    public function updating(Product $product)
    {
        // slug
        if ( $product->getOriginal('product_name') != $product->product_name) {
            $product->slug = Misc::instance()->generateSlug($product->product_name, Product::class);
        }

        // sqeuence
        // if ($product->isClean('sequence')) {
        //     return;
        // }

        // if (is_null($product->sequence)) {
        //     $product->sequence = Product::max('sequence');
        // }

        // if ($product->getOriginal('sequence') > $product->sequence) {
        //     $positionRange = [
        //         $product->sequence, $product->getOriginal('sequence')
        //     ];
        // } else {
        //     $positionRange = [
        //         $product->getOriginal('sequence'), $product->sequence
        //     ];
        // }

        // $lowerPriorityCategories = Product::where('id', '!=', $product->id)
        //     ->whereBetween('sequence', $positionRange)
        //     ->get();

        // foreach ($lowerPriorityCategories as $lowerPriorityProduct) {
        //     if ($product->getOriginal('sequence') < $product->sequence) {
        //         $lowerPriorityProduct->sequence--;
        //     } else {
        //         $lowerPriorityProduct->sequence++;
        //     }
        //     $lowerPriorityProduct->saveQuietly();
        // }
    }
}
