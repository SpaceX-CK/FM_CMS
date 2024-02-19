@extends('live-pages.layouts.live')

@section('content')

<section id="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="breadcrumbs">
          <li><a href="{{ route('index') }}">Home</a></li>
          <span><i class="fa fa-caret-right"></i></span> <a href="{{ route('getCategories') }}">
            <li>Products</li>
          </a>
          <span><i class="fa fa-caret-right"></i></span><a href="{{ route('getCategory',[$category->slug] ) }}">
            <li>{{ $category->category_name }}</li>
          </a>
          <span><i class="fa fa-caret-right"></i></span>
          <li>FOLLOW ME {{$product->product_title }} {{ $product->product_name }} </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="info-page">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">
        <div class="row">
          <div class="col-12 col-lg-5">
            <img src="{{ $product->product_image_full_path }}" class="w-100 h-auto">
          </div>
          <div class="col-12 col-lg-7">
            <h1 class="text-green">
              FOLLOW ME
              <br />
              {{ $product->product_title }}
              <br />
              <span class="product-text text-neon-green">
                {{ $product->product_name }}

              </span>
            </h1>
            <div class="text-neon-green">{!! $product->product_description !!}</div>

            @php
            $productSize = json_decode($product->product_size);
            @endphp

            @if ( $productSize != null)
            <div id="product-weight-tags">
              <div class="row align-items-center">
                @foreach($productSize as $size)
                <div class="col-2">
                  <span class="weight-tag">{{ $size }}</span>
                </div>
                @endforeach

                <div class="col-12 col-xxl-5">
                  <p class="mini-package text-neon-green">*Some packsizes may only be available in selected retail
                    stores.</p>
                </div>
              </div>
            </div>
            @endif

            @if ($product->shops != null)
            <div id="product-ecommerce">
              <div class="row align-items-center">
                <div class="col-lg-12 col-xl-4 ecom-shopbtn">
                  <a href="#" class="product-shop-btn">SHOP NOW</a>
                </div>
                <div class="col-lg-12 col-xl-8">
                  @foreach ($product->shops as $shop)
                  <a href="{{ $shop->pivot->shop_url }}"><img src="{{ $shop->shop_image_full_path }}" alt="{{ $shop->shop_name }}" class="ecom-icons"></a>
                  @endforeach
                  <!-- <a href="https://shopee.com.my/followme_my?v=ffd&smtt=0.0.3"><img src="images/products/shopee.png" class="ecom-icons"></a>
                    <a href="https://s.lazada.com.my/s.0s0tM "><img src="images/products/lazada.png" class="ecom-icons"></a>
                    <a href="https://eshop.tesco.com.my/groceries/en-GB/search?query=Follow%20Me "><img src="images/products/tesco.png" class="ecom-icons"></a>
                    <a href="https://www.hermo.my/brand/980-follow-me/page-1 "><img src="images/products/hermo.png" class="ecom-icons"></a> -->
                </div>
              </div>
            </div>
            @endif

            @if (json_decode($product->recommend) != null)
            <div id="product-recommendation">
              <h6 class="text-green">You may also like...</h6>
              <div class="row">
                @foreach ($products as $item)
                <div class="col-3 gap_override-product-upsell">
                  <a href="family-protection.html">
                    <div class="card">
                      <img src="{{ $item->product_image_full_path }}" class="w-100 h-auto">
                    </div>
                    <p class="upsell-paragraph text-green">{{ $item->product_name }} </p>
                  </a>
                </div>
                @endforeach
                <!-- <div class="col-3 gap_override-product-upsell">
                    <a href="whitening.html">
                      <div class="card">
                        <img src="images/products/antibacterial-protection/whitening.png" class="w-100 h-auto">
                      </div>
                      <p class="upsell-paragraph text-green">Whitening</p>
                    </a>
                  </div>
                  <div class="col-3 gap_override-product-upsell">
                    <a href="beauty-moisturising.html">
                      <div class="card">
                        <img src="images/products/antibacterial-protection/beauty-moisture.png" class="w-100 h-auto">
                      </div>
                      <p class="upsell-paragraph text-green">Beauty Moisturising</p>
                    </a>
                  </div>
                  <div class="col-3 gap_override-product-upsell">
                    <a href="natural-fresh.html">
                      <div class="card">
                        <img src="images/products/antibacterial-protection/natural-fresh.png" class="w-100 h-auto">
                      </div>
                      <p class="upsell-paragraph text-green">Natural Fresh</p>
                    </a>
                  </div> -->
              </div>
            </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@if ($product->product_images_full_path != null && $product->product_mobile_images_full_path != null)

<section class="info-full pb-0">
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <!-- desktop -->
      @foreach ($product->productImages as $imageData)
      <img src="{{$imageData->full_file_path}}" class="w-100 h-auto d-none d-md-block">
      @endforeach

      <!-- mobile -->
      @foreach ($product->productMobileImages as $imageDataMobile)
      <img src="{{$imageDataMobile->full_file_path}}" class="w-100 h-auto d-block d-md-none">
      @endforeach

    </div>
  </div>
</section>
@endif

<!-- show only desktop img as both desktop and mobile -->
@if ($product->product_images_full_path != null && $product->product_mobile_images_full_path == null)
<section class="info-full pb-0">
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <!-- desktop -->
      @foreach ($product->productImages as $imageData)
      <img src="{{$imageData->full_file_path}}" class="w-100 h-auto ">
      @endforeach

    </div>
  </div>
</section>
@endif
<!-- <section class="info-full">
    <div class="container-fluid p-0">
      <div class="row no-gutters">
        <img src="images/products/abckids/bursting-melon/bursting-melon-en-2.png" class="w-100 h-auto">
      </div>
    </div>
  </section> -->


<!-- <section class="info-full">
    <div class="container-fluid p-0">
      <div class="row no-gutters">
        <img src="images/products/abckids/bursting-melon/bursting-melon-en-3.png" class="w-100 h-auto">
      </div>
    </div>
  </section>

  <section class="info-full">
    <div class="container-fluid p-0">
      <div class="row no-gutters">
        <img src="images/products/abckids/bursting-melon/bursting-melon-en-4.png" class="w-100 h-auto">
      </div>
    </div>
  </section>


  <section class="info-full">
    <div class="container-fluid p-0">
      <div class="row no-gutters">
        <img src="images/products/abckids/bursting-melon/bursting-melon-en-5.png" class="w-100 h-auto">
      </div>
    </div>
  </section> -->



@endsection