<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Media;
use Mockery\Undefined;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\DB;
use App\Support\Services\ShopService;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shops.index')->with('shops', Shop::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request, ShopService $service)
    {
        try {
            $service->withRequest($request)->save();
            return redirect()->route('shops.index')->with('success', 'Shop created successfully');
        } catch (\Exception $ex) {
        // dd('catch',$ex->getMessage());
            $this->returnException($ex);
        }
        return redirect()
            // ->back()
            ->withInput()
            ->with('error', 'Shop could not be created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        $item = [
            'id' => $shop->id,
            'shop_name' => $shop->shop_name,
            'file_name' => '',
            'shop_image' => $shop->shop_image_full_path,
        ];
        //if have relation or img
        if( $shop->shopImage){
            $item['file_name'] = $shop->shopImage->file_name;
            $item['media_id'] = $shop->shopImage->id;
        }
        return response()->json($item , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        // return view('shops.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, ShopService $service, Shop $shop)
    {
        try {
            $service->withModel($shop)->withRequest($request)->save();
            return redirect()->route('shops.index')->with('success', 'Category updated successfully');
        } catch (\Exception $ex) {
            $this->returnException($ex);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Something went wrong!'.$ex->getMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        try {
            DB::transaction(function () use ($shop) {
                if ($shop->shopImage) {
                    $media = Media::where('collection_name', 'shop')
                    ->where('mediable_id', $shop->id)->first();
                    $media->delete();
                }
                $shop->delete();
            });
            return redirect()
                // ->back()
                // ->withInput()
                // ->withSuccess('success', 'Shop Deleted successfully')
                ->route('shops.index')->with('success', 'Shop deleted successfully ');
        } catch (\Exception $ex) {
            $this->returnException($ex);
        }
        return redirect()->route('shops.index')
            ->with('fail', $ex->getMessage());
    }

    public function returnException($ex)
    {
        $result = array(
            'status'    => 400,
            'message'   => $ex->getMessage(),
        );
        return response()->json($result);
    }
    
    public function deleteImage(Request $request){
        // dd($request->all());
        try{
            $media = Media::find($request->get('media_id'));
            // $fname = $media->file_name;
            $media->delete();
            // $result=[
            //     'status'=>true,
            //     'file_name'=>$fname,
            //     'message'=>'Image '. $fname . ' deleted successfully'
                
            // ];
            return redirect()
            ->route('shops.index')
            ->with('success', 'Shop Image deleted successfully ');
        }catch(\Exception | \Error $ex){
            // $result=[
            //     'status'=>false,
            //     'file_name'=>$fname,
            //     'message'=>$ex->getMessage()
            // ];
            $this->returnException($ex);
        }
        // return response()->json($result);
        return redirect()
        ->route('shops.index')
        ->with('fail', $ex->getMessage());
    }
}
