<?php

namespace App\Support\Services;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Support\Services\BaseService;
use App\Models\Media;

class ArticleService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Article::class);
    }

    public function save()
    {
        DB::transaction(function () {
            $this->model->title = $this->request->get('title');
            $this->model->subtitle = $this->request->get('sub');
            $this->model->content = $this->request->get('content');
            $this->model->thumbnail_title = $this->request->get('thumbnail_title');
            $this->model->product_id = $this->request->get('product');
            
            if ($this->model->isDirty()) {
                $this->model->save(); 
            }

            if ($this->request->has('thumbnail')) {
                $this->model->toSingleMediaCollection(
                    $this->request->file('thumbnail'),
                    public_path('storage/' . str_replace('{id}', $this->model->id, Media::ARTICLE_IMAGE_PATH)),
                    Media::COLLECTION_ARTICLE,
                    false
                );
            }
        });
        return $this;

    }

}