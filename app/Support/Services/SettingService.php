<?php

namespace App\Support\Services;

use App\Models\Media;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Support\Services\BaseService;

class SettingService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Setting::class);
    }
    public function save()
    {
        DB::transaction(function () {
            // $this->model->shop_name = $this->request->get('shop_name');
            $datas = $this->request->except(['logo_image','_token', '_method']); 
        
            // if ($this->model->isDirty()) {
            //     $this->model->save();
            // }
            if ($this->request->has('logo_image')) {
                // $this->model->toSingleMediaCollection(
                //     $this->request->file('logo_image'),
                //     public_path('storage/' . str_replace('{id}', $this->model->id, Media::SETTING_IMAGE_PATH)),
                //     Media::COLLECTION_SETTING ,
                //     false
                // );
                    $file = $this->request->file('logo_image');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . 'logo.' . $extension;
                    $file->move(public_path('images/uploads'), $fileName);
                    $datas['logo_image'] = $fileName;
            }
            foreach ($datas as $key => $value) {
                $setting = Setting::firstOrNew(
                    ['setting_keys' =>  $key],
                    ['setting_values' => $value]
                );
                $setting->setting_values = $value;
                if ($setting->isDirty()) {
                    $setting->save();
                }
            }    
        });
        return $this;

    }

}