<?php

namespace App\Support\Services;
use App\Models\Shop;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductShop;
use Illuminate\Support\Facades\DB;
use App\Support\Services\BaseService;

class ProductService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Product::class);
    }
    public function save()
    {
        DB::transaction(function () {
            $this->model->product_title = $this->request->get('product_title');
            $this->model->product_name = $this->request->get('product_name');
            // $this->model->product_type = $this->request->get('product_type');
            $this->model->product_description = $this->request->get('product_description');
            $this->model->sequence = $this->request->get('sequence');
            $this->model->category_id = $this->request->get('category_id');
            $this->model->recommend = json_encode($this->request->get('recommend'));
            $this->model->product_size = json_encode($this->request->get('product_size'));
            
            if ($this->model->isDirty()) {
                $this->model->save();
            }
            if ($this->request->has('product_image')) {
                $this->model->toSingleMediaCollection(
                    $this->request->file('product_image'),
                    public_path('storage/' . str_replace('{id}', $this->model->id, Media::PRODUCT_IMAGE_PATH)),
                    Media::COLLECTION_PRODUCT,
                    false
                );
            }
            if ($this->request->has('product_home_image')) {
                $this->model->toSingleMediaCollection(
                    $this->request->file('product_home_image'),
                    public_path('storage/' . str_replace('{id}', $this->model->id, Media::PRODUCT_HOME_IMAGE_PATH)),
                    Media::COLLECTION_PRODUCT_HOME,
                    false
                );
            }
            
            if($this->request->has('shoplist')){
                $this->model->shops()->detach();
                foreach($this->request->shoplist as $shop){
                $ps = ProductShop::firstOrNew(['product_id'=>$this->model->id,'shop_id'=>$shop]);
                    $ps->shop_id = $shop;
                    $ps->product_id = $this->model->id;
                    $ps->shop_url = $this->request->shop_url[$shop];
                    if($ps->isDirty()){
                        $ps->save();
                    }
                }
            }else{
                $this->model->shops()->detach();
            }
            
            if($this->request->has('product_content')){
                $this->model->toMediaCollectionSort(
                    $this->request->file('product_content'),
                    public_path('storage/' . str_replace('{id}',$this->model->id, Media::PRODUCTS_IMAGE_PATH)),
                    Media::COLLECTION_PRODUCTS,
                    false,
                    ($this->request->get('order_column'))
                );
            }
            if($this->request->has('product_content_mobile')){
                $this->model->toMediaCollectionSort(
                    $this->request->file('product_content_mobile'),
                    public_path('storage/' . str_replace('{id}',$this->model->id, Media::PRODUCTS_MOBILE_IMAGE_PATH)),
                    Media::COLLECTION_PRODUCTS_MOBILE,
                    false,
                    ($this->request->get('order_column_mobile'))
                );
            }

            if ($this->request->has('order_column_update')){
                foreach($this->request->order_column_update as $key=>$value){
                    $mediaUpdate = Media::where('id', $key)
                        ->where('collection_name', Media::COLLECTION_PRODUCTS)
                        ->first();
                    $mediaUpdate->order_column = $value;
                    if($mediaUpdate->isDirty()){
                        $mediaUpdate->save();
                    }
                }
            }
            if ($this->request->has('order_column_mobile_update')){
                foreach($this->request->order_column_mobile_update as $key=>$value){
                    $mediaUpdate = Media::where('id', $key)
                        ->where('collection_name', Media::COLLECTION_PRODUCTS_MOBILE)
                        ->first();
                    $mediaUpdate->order_column = $value;
                    if($mediaUpdate->isDirty()){
                        $mediaUpdate->save();
                    }
                }
            }
        });
        return $this;

    }

}