<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Follow Me Website</title>
    <link rel="icon" href="images/favicon.png" sizes="32x32" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

    <div class="overlay">
    </div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">

            
            <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('images/'. ( (isset($setting_array['logo_image']))  ? 'uploads/'.$setting_array['logo_image'] : 'homepage/logo.png'))  }}" class="nav-logo"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="mobile-nav collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active">
                        <div class="dropdown show">

                            <button class="navbar-toggler navicon-location" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-times" aria-hidden="true" style="color: white"></i>
                            </button>

                            <a id="nav-product-dropdown" class="btn" href="{{ route('getCategories') }}" role="button">

                                Products
                            </a>
                            <div id="nav-product-menu" class="theme-color dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach($categories as $category)
                                <a class="dropdown-item" href="{{ route('getCategory',[$category->slug] ) }}">{{ $category->category_name }}</a>
                            @endforeach
                                <!-- <a class="dropdown-item" href="">Anti-Bacterial</a>
                                <a class="dropdown-item" href="">Anti-Bacterial Kids</a>
                                <a class="dropdown-item" href="">Green Tea</a>
                                <a class="dropdown-item" href="">Nature's Path</a> -->
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('getcontact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('getarticle') }}">Article</a>
                    </li>

                    <li class="nav-item active d-block d-lg-none">
                        <div class="dropdown show">
                            <a id="nav-lang-dropdown" class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Language
                            </a>
                            <div id="nav-lang-menu" class="theme-color dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">ENG</a>

                            </div>
                        </div>
                    </li>
                    <li class="nav-item social-icons-header d-block d-lg-none">
                        @php 
                        if(isset($setting_array['facebook']) ){ 
                            $facebook = $setting_array['facebook'];     
                        }
                        else{
                            $facebook = "";
                        }
                        if(isset($setting_array['instagram']) ){ 
                            $instagram = $setting_array['instagram'];                            
                        }
                        else{
                            $instagram = "";
                        }
                        @endphp
                        <a target="_blank" href="{{ $facebook }}" class="mob-header-icons"><i class="fa fa-facebook-f"></i></a>
                        <a target="_blank" href="{{ $instagram }}" class="mob-header-icons"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto d-none d-lg-inline-flex">

                    <li class="nav-item social-icons-header">
                        <a target="_blank" href="{{ $facebook }}"><i class="fa fa-facebook-f"></i></a>
                    </li>

                    <li class="nav-item social-icons-header">
                        <a target="_blank" href="{{ $instagram }}"><i class="fa fa-instagram"></i></a>
                    </li>

                    <li class="nav-item active">
                        <div class="dropdown show">
                            <a id="nav-lang-dropdown" class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Language
                            </a>
                            <div id="nav-lang-menu" class="theme-color dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">ENG</a>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <section id="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <span class="footer-connect">Connect with us</span>
                    <a target="_blank" href="{{ $facebook }}"><i class="fa fa-facebook-f footer-icons"></i></a>
                    <a target="_blank" href="{{ $instagram }}"><i class="fa fa-instagram footer-icons"></i></a>
                    <span class="footer-terms"><a href="{{ route('getTermOfUse' )}}">Terms & Conditions</a> | <a href="{{ route('getPrivacyPolicy') }}">Privacy Policy</a></span>
                </div>
                <div class="col-6 footer-cr">
                    Copyright © Follow Me. All Rights Reserved.
                </div>
            </div>
        </div>

    </section>

    <!--Javascripts-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(document).scrollTop() > 0) {
                    $('nav').addClass('scrolled-nav');
                } else {
                    $('nav').removeClass('scrolled-nav');
                }
            });

            $('.navbar-toggler').on('click', function() {
                if ($('.mobile-nav').hasClass('show')) {
                    $('.overlay').removeClass('active-mobile-nav');
                    $('.navbar').removeClass('navbar-mobile-transparency');
                    $('.navbar img').removeClass('navbar-logo-opacity')
                } else {
                    $('.overlay').addClass('active-mobile-nav');
                    $('.navbar').addClass('navbar-mobile-transparency');
                    $('.navbar img').addClass('navbar-logo-opacity')
                }
            })
        })
    </script>

</body>

</html>