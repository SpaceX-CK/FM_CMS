<?php

namespace App\Support\Services;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Support\Services\BaseService;

class CategoryService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }
    public function save()
    {
        DB::transaction(function () {
            $this->model->category_name = $this->request->get('category_name');
            $this->model->category_description = $this->request->get('category_description');
            $this->model->sequence = $this->request->get('sequence');

            if ($this->model->isDirty()) {
                // dd($this->model);
                $this->model->save();
            }
            if ($this->request->has('category_image')) {
                $this->model->toSingleMediaCollection(
                    $this->request->file('category_image'),
                    public_path('storage/' . str_replace('{id}', $this->model->id, Media::CATEGORY_IMAGE_PATH)),
                    Media::COLLECTION_CATEGORY,
                    false
                );
            }
            if ($this->request->has('category_image_mobile')) {
                $this->model->toSingleMediaCollection(
                    $this->request->file('category_image_mobile'),
                    public_path('storage/' . str_replace('{id}', $this->model->id, Media::CATEGORY_MOBILE_IMAGE_PATH)),
                    Media::COLLECTION_CATEGORY_MOBILE,
                    false
                );
            }
        });
        return $this;

    }

}