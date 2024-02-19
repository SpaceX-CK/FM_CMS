@extends('live-pages.layouts.live')
@section('content')
<section id="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <ul class="breadcrumbs">
            <li><a href="{{ route('index') }}">Home</a></li> <span><i class="fa fa-caret-right"></i></span>
            <li>Article</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="article-covers">
    <div class="container">
      <h1 class="text-green">ARTICLE</h1>
      <div class="row">
      @forelse($article as $articles)
        <div class="col-12 col-md-4 col-lg-4 col-xl-4 article-div">
          <a href="{{route('getarticles', $articles->slug)}}">
            <div class="card">
              <img src="{{$articles->articleImage?$articles->article_image_full_path:asset('images/nopreview.png')}}" class="card-img-top">
            <div class="card-footer">
              {{$articles->thumbnail_title}}
            </div>
            </div>
          </a>
        </div>
      @empty
        <div class="col-12 col-md-6 col-xl-4">
          <p>There are currently no articles available.</p>
        </div>
      @endforelse
      </div>
    </div>
  </section>

@endsection