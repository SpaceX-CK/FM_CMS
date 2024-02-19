@extends('live-pages.layouts.live')

@section('content')
<section id="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="breadcrumbs">
          <li><a href="{{ route('index') }}">Home</a></li> <span><i class="fa fa-caret-right"></i></span>
          <li><a href="{{route('getarticle')}}">Article</a></li> <span><i class="fa fa-caret-right"></i></span>
          <li>{{$article->thumbnail_title}}</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="article-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-11 col-xxl-10">
        <div class="row justify-content-center">
          <div class="col-12 col-xl-3 gap_override-article-page">
            <h2 class="text-green"><strong>{{$article->title}}</strong></h2>
            <hr />
            <p class="text-neon-green">{{$article->subtitle}}</p>
          </div>
          <div class="col-12 col-xl-9 description">
            {!!$article->content!!}
            <div class="col-12 col-xl-5 explore" style="padding-left: 0;">
              <h3 class="text-green my-5 "><strong>Explore Products:</strong></h3>
            </div>
            <div class="row">
              @foreach($products as $product)
              <div class="col-6 col-md-3 bacterial-article-gap">
                <a href="{{ route('getCategories',['$product->category->slug']) }}">
                  <div class="card article-upsell-product">
                    <img src="{{ $product->product_image_full_path }}" class="w-100 h-auto">
                    <p>FOLLOW ME <br /> {{$product->product_name}}</p>
                    <p class="text-neon-green">{{$product->product_type}}</p>
                  </div>
                </a>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection