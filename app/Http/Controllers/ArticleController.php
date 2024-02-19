<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Support\Services\ArticleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Article::get();
        $counter = 0;
        for ($i = 1; $i <= count($result); $i++) {
            $counter = $i;
        }
        return view('article.index')->with(['article' => Article::get(), 'count' => $counter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::get();
        return view('article.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, ArticleService $service)
    {
        try {
            $service->withRequest($request)->save();
            return redirect()->route('article.index')->with('success', 'Article created successfully');
        } catch (\Exception $ex) {
            $this->returnException($ex);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Article could not be created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::get();
        $article = Article::where('slug', $slug)->first();
        return view('article.edit', compact('product', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article, ArticleService $service)
    {
       
        try {
            $service->withModel($article)->withRequest($request)->save();
            return redirect()->route('article.index')->with('success', 'Article updated successfully');
        } catch (\Exception $ex) {
            $this->returnException($ex);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {
            DB::transaction(function () use ($article) {

                if ($article->articleImage) {
                $image_path = $article->getArticleImageFullPathAttribute();
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                    $article->articleImage()->where('collection_name', 'article')->where('mediable_id', $article->id)->delete();
                }
                $article->delete();
            });
            return redirect()->route('article.index')->with('success', 'Article deleted successfully');
        } catch (\Exception $ex) {
            return redirect()->route('article.index')
            ->with('error', 'Something went wrong!');
        }

    }

    public function deleteImage(Article $article)

    {
        $image_path = $article->getArticleImageFullPathAttribute();
        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $media = Media::where('collection_name', 'article')
            ->where('mediable_id', $article->id)->first();
        $media->delete();
        return back()->with('success', 'Thumbnail Successfuly Delete.');
    }

    public function editor(Request $request)
    {
        $accepted_origins = array("http://localhost", "http://192.168.1.1", "http://example.com");

        /*********************************************
         * Change this line to set the upload folder *
         *********************************************/
        $imageFolder = "public/images";

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // same-origin requests won't set an origin. If the origin is set, it must be valid.
            if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            } else {
                header("HTTP/1.1 403 Origin Denied");
                return;
            }
        }

        // Don't attempt to process the upload on an OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            return;
        }

        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            /*
            If your script needs to receive cookies, set images_upload_credentials : true in
            the configuration and enable the following two headers.
          */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png", "jpeg"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            // Determine the base URL
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
            $baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/";

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
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
