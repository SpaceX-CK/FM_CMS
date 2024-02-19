<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Support\Services\CategoryService;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        // $c = Category::find(3);
        // dd($c->image_full_path,$c->getImageFullPathAttribute());
        return view('categories.index')->with(['categories'=>Category::all()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryService $service)
 
    {
        
        try {
            $service->withRequest($request)->save();
            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        } catch (\Exception $ex) {
        // dd('catch',$ex->getMessage());
            $this->returnException($ex);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Category could not be created');


    
        // Category::create($formFields);
        // return redirect('/category')->with('message', 'Branch images added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category:: where('slug', $slug)->firstOrFail();
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, CategoryService $service, Category $category)
    {
        try {
            $service->withModel($category)->withRequest($request)->save();
            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        } catch (\Exception $ex) {
            $this->returnException($ex);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category )
    {
        if($category->products->count() > 0){
            return redirect()->back()->with('error', 'Category has products, Cannot Delete');
        } else {
            try {
                DB::transaction(function () use ($category) {
                    if ($category->categoryImage) {
                        $media = Media::where('collection_name', 'category')
                        ->where('mediable_id', $category->id)->first();
                        $media->delete();
                    }
                    $category->delete();
                });
                return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
            } catch (\Exception $ex) {
                $this->returnException($ex);
            }
            return redirect()->route('categories.index')
            ->with('error', 'Something went wrong!' . $ex->getMessage());
        }
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
