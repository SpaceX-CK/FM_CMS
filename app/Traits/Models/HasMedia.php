<?php

namespace App\Traits\Models;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait HasMedia
{
    private $file, $storage, $file_path, $media;

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_IMAGE);
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_IMAGE);
    }
    public function shopImage()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_SHOP);
    }
    public function categoryImage()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_CATEGORY);
    }
    public function categoryMobileImage()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_CATEGORY_MOBILE);
    }
    public function productImage()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_PRODUCT);
    }
    public function productHomeImage()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_PRODUCT_HOME);
    }
    public function productImages(){
        return $this->morphMany(Media::class, 'mediable')
        ->where('collection_name', Media::COLLECTION_PRODUCTS);
    }
    public function productMobileImages(){
        return $this->morphMany(Media::class, 'mediable')
        ->where('collection_name', Media::COLLECTION_PRODUCTS_MOBILE);
    }
    public function articleImage()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_ARTICLE);
    }

    // Functions
    public function toMediaCollection(array $files, string $store_path, string $collection_name = Media::COLLECTION_DEFAULT, bool $resize = true)
    {
        foreach ($files as $file) {
            $existing_media = $this->media()
                ->select('order_column')
                ->where('collection_name', $collection_name)
                ->orderByDesc('order_column')
                ->first();
            $column_order = $existing_media->order_column ?? 0;
            $media = $this->media()
                ->whereHasMorph('mediable', get_called_class(), function ($query) {
                    $query->where('id', $this->id);
                })
                ->firstOrNew([
                    'collection_name' => $collection_name,
                    'order_column' => $column_order + 1
                ]);
            $this->storeMedia($media, $file, $collection_name, $store_path, $resize, $column_order, true);
        }
    }

    public function toMediaCollectionSort(array $files, string $store_path, string $collection_name = Media::COLLECTION_DEFAULT, bool $resize = true, array $column_orders)
    {
        foreach ($files as $key => $file) {
            $existing_media = $this->media()
                ->select('order_column')
                ->where('collection_name', $collection_name)
                ->orderByDesc('order_column')
                ->first();
            $column_order = $column_orders[$key];
            if ($column_order == null) {
                $column_order = $existing_media->order_column ?? 0;
            }
            else {
                $column_order = ((int)$column_order) - 1;
            }

            $media = $this->media()
                ->whereHasMorph('mediable', get_called_class(), function ($query) {
                    $query->where('id', $this->id);
                })
                ->firstOrNew([
                    'collection_name' => $collection_name,
                    'order_column' => $column_order + 1
                ]);
            $this->storeMedia($media, $file, $collection_name, $store_path, $resize, $column_order, true);
        }
    }

    public function toSingleMediaCollection(UploadedFile $file, string $store_path, string $collection_name = 'image', bool $resize = true)
    {
        $media = $this->media()
            ->whereHasMorph('mediable', get_called_class(), function ($query) {
                $query->where('id', $this->id);
            })
            ->firstOrNew([
                'collection_name' => $collection_name
            ]);

        $this->storeMedia($media, $file, $collection_name, $store_path, $resize, 0, true);
    }

    public function createDirectory(string $dir_path)
    {
        $dir_path = rtrim($dir_path, '/');

        if (!File::exists($dir_path)) {
            File::makeDirectory($dir_path, 0755, true);
        }

        return $dir_path;
    }

    public function resizeMedia(UploadedFile $file, int $max_width = 1024, int $max_height = 1024, bool $unique_filename = false)
    {
        $file_name = $unique_filename ? pathinfo($file->hashName(), PATHINFO_FILENAME) : pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_extension = trim($file->getClientOriginalExtension(), '.');

        $file_path = $this->createDirectory(public_path('storage/temp/uploads')) . '/' . $file_name . '.' . $file_extension;

        $img = Image::make($file->path());

        if ($img->height() > $img->width()) {
            $max_width = null;
        } else {
            $max_height = null;
        }

        $img->resize($max_width, $max_height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($file_path);

        return $file_path;
    }

    private function storeMedia(Media $media, UploadedFile $file, string $collection_name, string $store_path, bool $resize = false, int $column_order = 0, bool $unique_filename = false)
    {
        $file_name = $unique_filename ? pathinfo($file->hashName(), PATHINFO_FILENAME) : pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_extension = trim($file->getClientOriginalExtension(), '.');
        $file_size = $file->getSize();
        $file_mime = $file->getMimeType();

        $order_column = $column_order + 1;

        if ($media->exists) {
            $order_column = $media->order_column;
            if (File::exists(public_path($media->file_path))) {
                File::delete(public_path($media->file_path));
            }
        }

        if ($resize) {

            $dimension_name = array_key_exists($collection_name, config('media.dimensions'))
                ? $collection_name : Media::COLLECTION_DEFAULT;

            $dimensions = explode('*', config('media.dimensions.' . $dimension_name));

            $source_file_path = $this->resizeMedia($file, $dimensions[0], $dimensions[1], $unique_filename);
        } else {

            $source_file_path = $this->createDirectory(public_path('storage/temp/uploads')) . '/' . $file_name . '.' . $file_extension;

            $file->storeAs('/temp/uploads', $file_name . '.' . $file_extension, 'public');
        }

        $target_file_path = $this->createDirectory($store_path) . '/' . $file_name . '.' . $file_extension;

        if (File::exists($source_file_path)) {
            File::move($source_file_path, $target_file_path);
        }

        $media->collection_name = $collection_name;
        $media->name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $media->file_name = $file->getClientOriginalName();
        $media->mime_type = $file_mime;
        $media->size_in_bytes = $file_size;
        $media->file_path = str_replace(public_path(), '', $target_file_path);
        $media->order_column = $order_column;
        $media->save();
    }

    public function storage()
    {
        return Storage::disk('public');
    }

    public function getImageFullPathAttribute()
    {
        return $this->image ? $this->image->full_file_path : asset('images/nopreview.png');
    }

    // custom methods
    public function getShopImageFullPathAttribute()
    {
        return $this->shopImage ? $this->shopImage->full_file_path : asset('images/nopreview.png');
    }

    public function getCategoryImageFullPathAttribute()
    {
        return $this->categoryImage ? $this->categoryImage->full_file_path : asset('images/nopreview.png');
    }
    public function getCategoryMobileImageFullPathAttribute()// for mobile category_mobile_image_full_path
    {
        return $this->categoryMobileImage ? $this->categoryMobileImage->full_file_path : asset('images/nopreview.png');
    }
    public function getProductHomeImageFullPathAttribute()// single img
    {
        return $this->productHomeImage ? $this->productHomeImage->full_file_path : asset('images/nopreview.png');
    }

    public function getProductImageFullPathAttribute()// single img
    {
        return $this->productImage ? $this->productImage->full_file_path : asset('images/nopreview.png');
    }
    public function getProductImagesFullPathAttribute()// multi img
    {
        if($this->productImages->count() > 0){
            return $this->productImages;
        }
    }
    public function getProductMobileImagesFullPathAttribute()// multi mobile product_mobile_images_full_path
    {
        if($this->productMobileImages->count() > 0){
            // foreach($this->productMobileImages as $image) {
            //     $imagesMobile[] = $image->full_file_path;
            // }
            // return $imagesMobile ;
            return $this->productMobileImages;
        }
    }
    public function getArticleImageFullPathAttribute()
    {
        return $this->articleImage->full_file_path;
    }
    
    // public function getManyImageArrayAttribute(){
    //     foreach($this->productImages as $image) {
    //         $imgOrder[] = $image->order_column;
    //     }
    //     foreach($this->productImages as $image) {
    //         $imgId[] = $image->id;
    //     }
    //     $imgIdOrder = [];
    //     for($i = 0; $i < count($imgId); $i++){
    //         $imgIdOrder[$imgId[$i]] = $imgOrder[$i];
    //     }
    //     return $imgIdOrder ;
    // }
    // public function getManyImageNameAttribute(){
    //     foreach($this->productimages as $image) {
    //         $images[] = $image->file_name;
    //     }
    //     return $images ;
    // }
}
