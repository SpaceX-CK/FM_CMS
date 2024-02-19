@extends('live-pages.layouts.live')

@section('content')

<section id="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="breadcrumbs">
          <li><a href="{{ route('index') }}">Home</a></li> <span><i class="fa fa-caret-right"></i></span>
          <li>Products</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="main-products">
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <div class="col-12">
        <img src="../images/products/main-product-banner.jpg" class="w-100 h-auto d-none d-md-block">
        <img src="../images/products/main-product-mobile-banner.jpg" class="w-100 h-auto d-block d-md-none">
      </div>
    </div>
  </div>
</section>

<section id="main-products-category">
  <div class="container">
    @foreach($categories as $category)
    <div class="single-products-main">
      <h2 class="text-green">{{ $category->category_name }}</h2>
      <p>{{$category->category_name}}</p>
      <div class="row align-items-center">
        <div class="col-12 col-xl-9 col-xxl-10">
          <div class="row">
            @foreach($category->products->take(4)->sortBy('sequence') as $product)
            <div class="col-6 col-lg-3 product-main-mb">
              <a href="{{ route('getProduct', [$category->slug,  $product->slug] ) }}">

                <div class="card products-upsell-product">
                  <img src="{{ $product->product_image_full_path  }}" class="w-100 h-auto">
                  <p>FOLLOW ME <br /> {{ $product->product_title }}</p>
                  <p class="text-neon-green">{{ $product->product_name}}</p>
                </div>
              </a>
            </div>

            @endforeach
          </div>
        </div>
        <div class="col-12 col-xl-3 col-xxl-2 product-btn-container">
          <a class="products-main-button" href="{{ route('getCategory',[$category->slug]) }}">See More</a>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</section>
@endsection