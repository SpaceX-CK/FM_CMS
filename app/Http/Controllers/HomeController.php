<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\HomeRequest;
use App\Support\Services\HomeService;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homes= Home::get();
        $categories = Category::get();
        $home_array = [];
        foreach ($homes as $home) {
            $home_array[$home->home_keys] = $home->home_values;
        }
        $banner_desktop = Home::where('home_keys','banner_desktop')->first();
        $banner_mobile = Home::where('home_keys','banner_mobile')->first();
        if ($banner_desktop){
            $bannerDesktop[$banner_desktop->id] = $banner_desktop->home_values;
        }
        else{
            $bannerDesktop= 'null';
        }
        if ($banner_mobile){
            $bannerMobile[$banner_mobile->id] = $banner_mobile->home_values;
        }
        else{
            $bannerMobile= 'null';
        }

        $recommend = json_decode($home_array['recommend'], true);
			
				$products = Product::all();
        // $recommendstr = implode(',', json_decode($home_array['recommend']));

        // $selectedValue = Product::whereIn('id', $recommend)->orderByRaw("FIELD(id, $recommendstr)")->get()
        // ->map(function ($product) {
        //     return [
        //         'id' => $product->id,
        //         'text' => $product->product_title .' - '. $product->product_name,
        //     ];
        // })
        //     ->toJson();



        return view('home.index', compact('home_array','categories', 'products', 'bannerDesktop','bannerMobile','recommend'));
        // return view('home.index', compact('home_array','categories','products','bannerDesktop','bannerMobile', 'selectedValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeRequest $request, HomeService $service, Home $home)
    {
        // dd($request->all());
        try {
            $service->withModel($home)->withRequest($request)->save();
            return redirect()->route('home.index')->with('success', 'home data updated successfully');
        } catch (\Exception $ex) {
            $this->returnException($ex);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Something went wrong!'.$ex->getMessage());
    }
    // public function update(Request $request){
    // dd($request->all());

    // }
    public function returnException($ex)
    {
        $result = array(
            'status'    => 400,
            'message'   => $ex->getMessage(),
        );
        return response()->json($result);
    }

    public function deleteImage(Request $request){
        try{
            $media = Home::find($request->get('media_id'));
            $fname = $media->home_values;
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
}
