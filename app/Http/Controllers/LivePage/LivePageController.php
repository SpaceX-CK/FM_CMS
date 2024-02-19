<?php

namespace App\Http\Controllers\LivePage;

use App\Models\Home;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;

class LivePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homes = Home::get();
        $home_array = [];
        foreach ($homes as $home) {
            $home_array[$home->home_keys] = $home->home_values;
        }
        if(isset($home_array['recommend'])){
            $recommend = json_decode($home_array['recommend']) ?? [];
            // $products = Product::whereIn('id', $recommend)->get();
            foreach($recommend as $key => $value){
                $products[$key] = Product::find($value);
            }
            // dd($products);
        }
        else{
            $products = null;
        }
        
        // dd(!isset($home_array['banner_desktop']));
        return view('live-pages.index', compact('home_array','products'));
    }

    public function getAbout()
    {
        return view('live-pages.about');
    }

    public function getTermOfUse(){
        return view('live-pages.terms-of-use');
    }

    public function getPrivacyPolicy(){
        return view('live-pages.privacy-policy');
    }

    public function getCategories()
    {
        $categories = Category::get()->sortBy('sequence');
        return view('live-pages.categories', compact('categories'));
    }

    public function getCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products->sortBy('sequence');
        return view('live-pages.category', compact('products', 'category'));
    }

    public function getProduct($category_slug, $product_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        // $product = $category->products->where('slug', $product_slug)
        //     ->firstOrFail();
        $product =  Product::where('slug', $product_slug)->where('category_id', $category->id)
            ->firstOrFail();
        $recommend = json_decode($product->recommend);
        if ($recommend != null){
            $products = Product::wherein('id', $recommend)->get();
        }
        else{
            $products = null;
        }
        
        return view('live-pages.product', compact('product', 'category', 'products'));
    }

    public function getArticle(Article $article){
        $article=Article::get();
        return view('live-pages.article',compact('article'));
    }

    public function getArticles($slug){
        $article=Article::where('slug', $slug)->firstOrFail();
        $products = Product::whereIn('id', $article->product_id)->get();
        return view('live-pages.component.articles',compact('article','products'));
    }
    public function getContact(){
        return view('live-pages.contact');
    }

    public function email(Request $request){
        Mail::to('followme@tohtonku.com.my')->send(new ContactUs($request));
        return redirect()->route('getcontact')->with('message','Enquiry has successfully submitted.');
    }
}
