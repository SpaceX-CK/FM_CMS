<?php

namespace App\Support\Services;

use App\Models\Media;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use App\Support\Services\BaseService;

class ShopService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Shop::class);
    }
    public function save()
    {
        DB::transaction(function () {
            $this->model->shop_name = $this->request->get('shop_name');
            if ($this->model->isDirty()) {
                $this->model->save();
            }
            if ($this->request->has('shop_image')) {
                $this->model->toSingleMediaCollection(
                    $this->request->file('shop_image'),
                    public_path('storage/' . str_replace('{id}', $this->model->id, Media::SHOP_IMAGE_PATH)),
                    Media::COLLECTION_SHOP,
                    false
                );
            }
        });
        return $this;

    }

}