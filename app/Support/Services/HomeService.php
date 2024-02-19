<?php

namespace App\Support\Services;

use App\Models\Media;
use App\Models\Home;
use Illuminate\Support\Facades\DB;
use App\Support\Services\BaseService;

class HomeService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Home::class);
    }
    public function save()
    {
        DB::transaction(function () {
            // $this->model->shop_name = $this->request->get('shop_name');
            $datas = $this->request->except(['home_banner','recommend','_token', '_method']); 
        
        
            if ($this->request->has('banner_desktop')) {
                    $file = $this->request->file('banner_desktop');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . 'desk.' . $extension;
                    $file->move(public_path('images/uploads'), $fileName);
                    $datas['banner_desktop'] = $fileName;
            }
            if ($this->request->has('banner_mobile')) {
                $file = $this->request->file('banner_mobile');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . 'mob.' . $extension;
                $file->move(public_path('images/uploads'), $fileName);
                $datas['banner_mobile'] = $fileName;
        }
            if ($this->request->has('recommend')) {
                // dd($this->request->get('recommend'));
                $datas['recommend'] = json_encode($this->request->get('recommend'));
            }
            foreach ($datas as $key => $value) {
                $home = Home::firstOrNew(
                    ['home_keys' =>  $key],
                    ['home_values' => $value]
                );
                $home->home_values = $value;
                if ($home->isDirty()) {
                    $home->save();
                }
            }
         
        });
        return $this;

    }

}