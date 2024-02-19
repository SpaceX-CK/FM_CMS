@extends('live-pages.layouts.live')

@section('content')


<section id="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="breadcrumbs">
          <li><a href="{{ route('index') }}">Home</a></li> <span><i class="fa fa-caret-right"></i></span>
          <li>About Us</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="about" >
  <div class="container">
    <div class="row">
      <div class="col-12  col-sm-9 col-md-7 col-lg-5">
        <h1 class="text-green">A Dedication To Continous Improvement</h1>
        <p>At Tohtonku, we draw inspiration from the Japanese principle of continuous improvement at every step of our
          evolution. Inspired by the gifts of nature and the advances of Japanese technology in beauty and wellness,
          we constantly strive to bring you our best. Only by giving you the best, can you then look your best - from
          head to toe.</p>
        <p>Browse through our wide range of products, there is bound to be something that suits your most exact needs
          perfectly.</p>
      </div>
    </div>
  </div>
</section>

@endsection