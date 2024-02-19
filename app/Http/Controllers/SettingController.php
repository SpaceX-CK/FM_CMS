<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Support\Services\SettingService;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings= Setting::get();
        $setting_array = [];
        foreach ($settings as $setting) {
            $setting_array[$setting->setting_keys] = $setting->setting_values;
        }
        // dd($setting_array);
        $logo = Setting::where('setting_keys','logo_image')->first();
        if ($logo){
            $imgLogo[$logo->id] =$logo->setting_values;
        }
        else{
            $imgLogo= 'null';
        }

        return view('settings.index', compact('setting_array','imgLogo'));
    }

    public function update(SettingRequest $request, SettingService $service, Setting $setting)
    {
        //
        // dd($request->all());
        try {
            $service->withModel($setting)->withRequest($request)->save();
            return redirect()->route('settings.index')->with('success', 'Setting updated successfully');
        } catch (\Exception $ex) {
            $this->returnException($ex);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Something went wrong!'.$ex->getMessage());
    }

    public function deleteImage(Request $request){
        try{
            $media = Setting::find($request->get('media_id'));
            $fname = $media->setting_values;
            $media->delete();
            $result=[
                'status'=>true,
                'file_name'=>$fname,
                'message'=>'Image '. $fname . ' deleted successfully'
                
            ];
        }catch(\Exception | \Error $ex){
            $result=[
                'status'=>false,
                'file_name'=>$fname,
                'message'=>$ex->getMessage()
            ];
        }
        return response()->json($result);
    }
    public function returnException($ex)
    {
        $result = array(
            'status'    => 400,
            'message'   => $ex->getMessage(),
        );
        return response()->json($result);
    }

}
