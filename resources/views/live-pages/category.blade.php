@extends('live-pages.layouts.live')

@section('content')
<section id="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="breadcrumbs">
          <li><a href="{{ route('index') }}">Home</a></li> <span><i class="fa fa-caret-right"></i></span> <a href="{{ route('getCategories') }}">
            <li>Products</li>
          </a> <span><i class="fa fa-caret-right"></i></span>
          <li>{{ $category->category_name }}</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="individual-products">
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <div class="col-12">
        <img src="{{ $category->category_image_full_path }}" class="w-100 h-auto d-none d-md-block">
        <img src="{{ $category->category_mobile_image_full_path }}" class="w-100 h-auto d-block d-md-none">
      </div>
    </div>
  </div>
</section>

<section id="individual-products-showcase">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-11">
        <div class="row">
          @foreach($products as $product)
          <div class="col-6 col-md-4 col-lg-3 mb-3">
            <a href="{{ route('getProduct', [$category->slug,  $product->slug] ) }}">
              <div class="card products-upsell-product">
                <img src="{{ $product->product_image_full_path }}" class="w-100 h-auto">
                <p>FOLLOW ME <br /> {{ $product->product_title }}</p>
                <p class="text-neon-green">{{ $product->product_name }}</p>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

@endsection