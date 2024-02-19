<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Support\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $category = Category::where('id', '2')->firstOrFail();
        // $products = $category->products;
        return view('products.index')->with(['products'=>Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $pro = Product::find(11)->load('shops');
        // $pro = Shop::find(11)->load('product');

        // $pro = Product::get()->load('images');
        // $pro = Product::find(1)->images->get(0)->full_file_path;
        // $pro = Product::find(1)->getImageFullPathAttribute();
        // getImageFullPathAttribute()
        // dd($pro);
        // $pro = Product::get()->load('images');

        
        $categories = Category::select('id', 'category_name')->get();
        $products = Product::get();
        $shops = Shop::get();
        return view('products.create',compact('categories','products','shops'));
    }


    public function store(ProductRequest $request, ProductService $service)
    {
        try {
            $service->withRequest($request)->save();
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (\Exception $ex) {
        //dd($ex->getMessage());
            $this->returnException($ex);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Product could not be created');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {

    // }
    public function edit($slug)
    {
        $categories = Category::select('id', 'category_name')->get();
        $product = Product:: where('slug', $slug)->firstOrFail();
        // dd($slug);
        $productlist = Product::get();
        $shops = Shop::all();
        $selectedShop=$product->shops->pluck('id')->toArray();
    //    dd($product->shops);


        foreach($product->shops as $shop){
            $url[] = $shop->pivot->shop_url;
        }
        $selectedUrl = [];
        for($i = 0; $i < count($selectedShop); $i++){
            $selectedUrl[$selectedShop[$i]] = $url[$i];
        }

    // dd($selectedUrl);
        return view('products.edit',compact('product','productlist','shops','categories','selectedShop','selectedUrl'));
    }


    public function update(ProductRequest $request, ProductService $service, Product $product)
    {
        try {
            $service->withModel($product)->withRequest($request)->save();
            return redirect()->route('products.index')->with('success', 'product updated successfully');
        } catch (\Exception $ex) {
            // dd($ex->getMessage());
            $this->returnException($ex);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Product could not be created');
    }


    public function destroy(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                if($product->productImage){
                    $media = Media::where('collection_name', 'product')
                    ->where('mediable_id', $product->id)->first();
                    $media->delete();
                }
                if($product->productImages){
                    $media = Media::where('collection_name', 'products')
                    ->where('mediable_id', $product->id)->get();
                    $media->each(function($item){
                        $item->delete();
                    });
                }
                $product->delete();
                if($product->shops){
                    // $product->shops->get()->each(function ($shop) {
                    //     $shop->pivot->delete();
                    // });
                    $product->shops()->sync([]);
                }

            });
            return redirect()->route('products.index')->with('success', 'Category deleted successfully ');
        } catch (\Exception $ex) {
            $this->returnException($ex);
        }
        return redirect()->route('products.index')
            ->with('error', 'Something went wrong!' . $ex->getMessage());
    }

    public function deleteImage(Request $request){
        try{
            $media = Media::find($request->get('media_id'));
            $fname = $media->file_name;
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