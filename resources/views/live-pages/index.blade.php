@extends('live-pages.layouts.live')

@section('content')

<section id="home-parallax">
  <!-- <img src="../images/homepage/ab-banner.png" class="w-100 h-auto d-none d-md-block">
  <img src="../images/homepage/ab-mobile.jpg" class="w-100 h-auto d-block d-md-none"> -->
  @php
  if(!isset($home_array['banner_desktop'])){
  $home_array['banner_desktop']= null;
  }
  if(!isset($home_array['banner_mobile'])){
  $home_array['banner_mobile']= null;
  }
  @endphp
  <img src="{{ asset('images/'.($home_array['banner_desktop'] ? 'uploads/'.$home_array['banner_desktop'] : 'nopreview.png') ) }}" class="w-100 h-auto d-none d-md-block">
  <img src="{{ asset('images/'.($home_array['banner_mobile'] ? 'uploads/'.$home_array['banner_mobile'] : 'nopreview.png') ) }}" class="w-100 h-auto d-block d-md-none">
</section>

<section id="home-greentea" class="text-center">
  <div class="greentea-wrapper">
    <h2 class="text-light-green">About Follow Me</h2>
    <p>At Tohtonku, we draw inspiration from the Japanese principle of continuous improvement at every step of our
      evolution. Inspired by the gifts of nature and the advances of Japanese technology in beauty and wellness, we
      constantly strive to bring you our best. Only by giving you the best, can you then look your best - from head to
      toe. Browse through our wide range of products, there is bound to be something that suits your most exact needs
      perfectly.</p>
  </div>
</section>

<section id="home-infused">
  <h1>{{ $home_array['title'] }}</h1>
  <div class="infused-wrapper">
    <div class="row">
    @if($products != null)
    @foreach($products as $product)
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card home-product-card h-100">
          @if($product->productHomeImage != null)
          <img src="{{ $product->product_home_image_full_path }}" class="infused-bottles">
          @else
          <img src="{{ $product->product_image_full_path }}" class="infused-bottles">
          @endif
          <h4 class="text-green text-center m-b-0">
            <strong>FOLLOW ME<br>{{ $product->product_title }}</strong>
          </h4>
          <p>{{ $product->category->category_description }}</p>
          <a href="{{ route('getCategory', [$product->category->slug] ) }}" class="infused-btn">Find Out More</a>
        </div>
      </div>
      @endforeach
      @endif

      <!-- <div class="col-12 col-sm-6 col-lg-3">
        <div class="card home-product-card h-100">
          <img src="images/homepage/greentea-product.png" class="infused-bottles">
          <h4 class="text-green text-center m-b-0">
            <strong>FOLLOW ME<br>Green Tea</strong>
          </h4>
          <p>Prevents hair fall and deodorises scalp for healthier hair.</p>
          <a href="gt-individual.html" class="infused-btn">Find Out More</a>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card home-product-card h-100">
          <img src="images/homepage/antibacterial-product.png" class="infused-bottles">
          <h4 class="text-green text-center m-b-0">
            <strong>FOLLOW ME<br>Anti-Bacterial</strong>
          </h4>
          <p>Daily protection for healthy and fresher skin for you and your family.</p>
          <a href="ab-individual.html" class="infused-btn">Find Out More</a>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card home-product-card h-100">
          <img src="images/homepage/antibacterial-kids-product.png" class="infused-bottles">
          <h4 class="text-green text-center m-b-0">
            <strong>FOLLOW ME<br>Anti-Bacterial KIDS</strong>
          </h4>
          <p>Anti-Bacterial protection formulated for kids' delicate skin.</p>
          <a href="abk-individual.html" class="infused-btn">Find Out More</a>
        </div>
      </div> -->

    </div>
  </div>
</section>

@endsection