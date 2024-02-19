<?php

namespace App\Support\Services;

use Illuminate\Http\Request;
use App\Traits\Support\HasActivityLog;

abstract class BaseService
{
    protected $model, $request, $action;

    public function __construct(string $model)
    {
        $this->model = new $model;
    }

    public function withModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function withRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    public function getModel()
    {
        $this->model->refresh();

        return $this->model;
    }

    public function withPara($para)
    {
        $this->para = $para;
        return $this;
    }
}
