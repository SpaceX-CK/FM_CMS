@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<div class="container-fluid p-4">
    <div class="card card-radius">
        <div class="card-header" style="border: none;">
            <div class="row">
                <div class="col col-md-6">
                    <h3 class="mb-0 ">Edit Product</h3>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="false">Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="banner-tab" data-toggle="tab" href="#banner" role="tab" aria-controls="banner" aria-selected="false">Banner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shop-tab" data-toggle="tab" href="#shop" role="tab" aria-controls="shop" aria-selected="false">Shops</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home</a>
            </li>
        </ul>
        <div class="text-center">
            <div class="card-body">
                <form action="{{ route('products.update', [$product->id]) }}" method="post" class="" onsubmit="return doSubmit()" enctype="multipart/form-data" id="create-product-form">
                    {!! csrf_field() !!}
                    @method('PUT')
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active text-left" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_title">Title: </label>
                                        <input type="text" name="product_title" id="product_title" value="{{ $product->product_title }}" class="form-control @error('product_title') is-invalid @enderror">
                                        @error('product_title')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Name: <span class="text-danger">*</span></label>
                                        <input type="text" name="product_name" value="{{$product->product_name}}" id="product_name" class="form-control @error('product_name') is-invalid @enderror">

                                        @error('product_name')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class=" form-group">
                                        <label for="category">Category: <span class="text-danger">*</span></label>
                                        <select class="form-control" name="category_id">
                                            @if (count($categories) > 0)

                                            @foreach($categories as $category)
                                            @php
                                            $selected = collect (old('category',$product->category_id == ($category->id) ) )->contains($category->id) ? 'selected' : '';
                                            //$selected = collect (old('category',$product->category_id == ($category->id) ) )->contains($category->id) ? 'selected' : '';

                                            @endphp
                                            <option value="{{ $category->id }}" {{ $selected }}>{{ $category->category_name }}</option>
                                            @endforeach
                                            @else
                                            <option value="">No category found</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sequence">Sort sequence: </label>
                                        <input type="number" value="{{$product->sequence}}" min="1" name="sequence" id="sequence" class="form-control">
                                        <small class="text-muted">Leaving empty sequence default value 1.</small>
                                    </div>
                                </div>
                                @php
                                if($product->productImage){
                                $media_id = $product->productImage->id;
                                $filename = $product->productImage->file_name;
                                }
                                else{
                                $media_id = null;
                                $filename = 'Choose image';
                                }
                                @endphp

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product_image">Product Image: </label>
                                        <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                            <div class="input-group row ml-0 d-flex align-items-center">
                                                <div class="custom-file my-2">
                                                    <input type="file" name="product_image" class="custom-file-input" onchange=changeFile(this)>
                                                    <label class="custom-file-label product-image-lable" id="edit_product_img_file_name" for="inputGroupFile" aria-describedby="inputGroupFileAddon">{{ $filename }}</label>
                                                    <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                                        <i class="fa-regular fa-circle-xmark"></i>
                                                    </span>
                                                </div>
                                                <div class="input-group-append ml-1 trash-button">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger delete-product" data-url="{{ route('products.delete-image') }}" data-id="{{ $media_id }}" data-imgtype="single" type="button">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>

                                            @error('product_image')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror
                                            <small class="text-muted">Recommend size 300x300 </small>
                                            <div class="border rounded-lg text-center p-1">
                                                <img src="{{$product->product_image_full_path}}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                            <div class="form-group row text-left">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product_description">Description: </label>
                                        <textarea type="text" value="{{$product->product_description}}" name="product_description" id="product_description" class="form-control @error('product_description') is-invalid @enderror" rows="3" autofocus="autofocus">{{$product->product_description}}</textarea>
                                        @error('product_description')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="recommend">Recommend Product: </label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control select-two w-100" name="recommend[]" multiple="multiple">
                                                    @forelse($productlist as $listitem)
                                                    <option value="{{ $listitem->id }}" {{collect (old('recommend',json_decode($product->recommend) ) )->contains($listitem->id) ? 'selected' : ''}}> {{$listitem->product_name}}</option>
                                                    @empty
                                                    <option value="" disabled>No product found</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_size">Product Size: </label>
                                        <div class="dynamic-wrap">
                                            <div role="form" id="dynamic" autocomplete="off">
                                                @php
                                                $productSize = json_decode($product->product_size);
                                                @endphp
                                                @if ( $productSize != null)
                                                @forelse($productSize as $size)

                                                <div class="entry input-group my-2">
                                                    <input class="form-control" name="product_size[]" type="text" placeholder="eg. 100ml" value="{{$size}}" />
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger btn-remove" type="button">
                                                            <i class="fa-solid fa-minus"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                @empty
                                                @endforelse
                                                @endif

                                                <div class="entry input-group my-2">
                                                    <input class="form-control" name="product_size[]" type="text" placeholder="eg. 100ml, 100g" />
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-success btn-add" type="button">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="banner" role="tabpanel" aria-labelledby="banner-tab">
                            <div class="form-group row text-left">
                                <div class="col-md-6">
                                    <label for="product_content">Content Image Desktop:
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Leaving empty sequence will sort by ascending order">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                        </a>
                                    </label>
                                    <div class="file-input-group">
                                        @if ( $product->product_images_full_path != null )
                                        @forelse ($product->productImages as $imageData)
                                        <div class="file-input-show mb-3">
                                            <div class="input-group row ml-0" style="gap:8px">
                                                <div class="custom-file col-md-6 my-2">
                                                    <input type="file" class="custom-file-input" disabled onchange=changeFile(this)>
                                                    <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">{{$imageData->file_name}}</label>
                                                </div>
                                                <div class="col-md-6 my-2 mb-5 px-0 d-flex justify-content-between">
                                                    <div class="custom-file w-100 ml-0 ml-md-1">
                                                        <input type="number" min="1" name="order_column_update[{{$imageData->id}}]" class="form-control" id="{{$imageData->id}}" value="{{$imageData->order_column}}" placeholder="Image Sequence Number">
                                                    </div>
                                                    <div class="input-group-append ml-1">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-danger delete-product" data-url="{{route('products.delete-image')}}" data-id="{{$imageData->id}}" data-type="multi" type="button">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border rounded-lg text-center p-1">
                                                <img src="{{$imageData->full_file_path}}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                            </div>
                                        </div>
                                        @empty
                                        @endforelse
                                        @endif

                                        <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                            <div class="input-group row ml-0" style="gap:8px">
                                                <div class="custom-file col-md-6 my-2">
                                                    <input type="file" name="product_content[]" class="custom-file-input" onchange=changeFile(this)>
                                                    <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">Choose image</label>
                                                    <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                                        <i class="fa-regular fa-circle-xmark"></i>
                                                    </span>
                                                </div>
                                                <div class="col-md-6 my-2 mb-5 d-flex px-0 justify-content-between">
                                                    <div class="custom-file w-100 ml-0 ml-md-1">
                                                        <input type="number" min="1" name="order_column[]" class="form-control" placeholder="Image Sequence Number">
                                                    </div>
                                                    <div class="input-group-append ml-1">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success btn-add-file" type="button">
                                                                <i class="fa-solid fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border rounded-lg text-center p-1">
                                                <img src="{{asset('images/nopreview.png')}}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- MOBILE -->
                                <div class="col-md-6">
                                    <label for="product_content_mobile">Content Image Mobile:
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Leaving empty sequence will sort by ascending order">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                        </a>
                                    </label>
                                    <div class="file-input-group">
                                        @if ( $product->product_mobile_images_full_path != null )
                                        @forelse ($product->productMobileImages as $imageDataMobile)
                                        <div class="file-input-show mb-3">
                                            <div class="input-group row ml-0" style="gap:8px">
                                                <div class="custom-file col-md-6 my-2">
                                                    <input type="file" class="custom-file-input" disabled onchange=changeFile(this)>
                                                    <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">{{$imageDataMobile->file_name}}</label>
                                                </div>
                                                <div class="col-md-6 my-2 mb-5 px-0 d-flex justify-content-between">
                                                    <div class="custom-file w-100 ml-0 ml-md-1">
                                                        <input type="number" min="1" name="order_column_mobile_update[{{$imageDataMobile->id}}]" class="form-control" id="{{$imageDataMobile->id}}" value="{{$imageDataMobile->order_column}}" placeholder="Image Sequence Number">
                                                    </div>
                                                    <div class="input-group-append ml-1">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-danger delete-product" data-url="{{route('products.delete-image')}}" data-id="{{$imageDataMobile->id}}" data-type="multi" type="button">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border rounded-lg text-center p-1">
                                                <img src="{{$imageDataMobile->full_file_path}}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                            </div>
                                        </div>
                                        @empty
                                        @endforelse
                                        @endif

                                        <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                            <div class="input-group row ml-0" style="gap:8px">
                                                <div class="custom-file col-md-6 my-2">
                                                    <input type="file" name="product_content_mobile[]" class="custom-file-input" onchange=changeFile(this)>
                                                    <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">Choose image</label>
                                                    <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                                        <i class="fa-regular fa-circle-xmark"></i>
                                                    </span>
                                                </div>
                                                <div class="col-md-6 my-2 mb-5 d-flex px-0 justify-content-between">
                                                    <div class="custom-file w-100 ml-0 ml-md-1">
                                                        <input type="number" min="1" name="order_column_mobile[]" class="form-control" placeholder="Image Sequence Number">
                                                    </div>
                                                    <div class="input-group-append ml-1">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success btn-add-file" type="button">
                                                                <i class="fa-solid fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border rounded-lg text-center p-1">
                                                <img src="{{asset('images/nopreview.png')}}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <small class="text-muted">Leave Content Image Mobile as empty Content Image Desktop will apply for both Mobile and Desktop</small>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade text-left" id="shop" role="tabpanel" aria-labelledby="shop-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="shoplist">Shop available: </label>
                                        <div class=" w-100">
                                            <select class="form-control select-two w-100" id="shoplist" name="shoplist[]" multiple="multiple">
                                                @forelse($shops as $shop)
                                                <option value="{{ $shop->id }}" {{collect (old('shoplist' ,  $selectedShop) )->contains($shop->id) ? 'selected' : ''}}> {{$shop->shop_name}}</option>
                                                @empty
                                                <option value="">No shop found</option>

                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @if (count($shops) > 0)
                                @foreach($shops as $shop)
                                <div class="shop-url-div text-left col-md-6">
                                    <div class="form-group">
                                        <label for="shop_url">{{ $shop->shop_name}} URL: <span class="text-danger">*</span></label>
                                        <img src="{{ $shop->shop_image_full_path}}" style="height:30px" alt="">
                                        <input type="text" id="{{$shop->id}}" name="shop_url[{{$shop->id}}]" value="{{$selectedUrl[$shop->id]??''}}" required class="shop-url form-control @error('shop_url') is-invalid @enderror" disabled>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade text-left" id="home" role="tabpanel" aria-labelledby="shop-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @php
                                        if($product->productHomeImage){
                                        $media_id_home = $product->productHomeImage->id;
                                        $filename_home = $product->productHomeImage->file_name;
                                        }
                                        else{
                                        $media_id_home = null;
                                        $filename_home = 'Choose image';
                                        }
                                        @endphp
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="product_home_image">Product Home Image: </label>
                                                <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                                    <div class="input-group row ml-0 d-flex align-items-center">
                                                        <div class="custom-file my-2">
                                                            <input type="file" name="product_home_image" class="custom-file-input" onchange=changeFile(this)>
                                                            <label class="custom-file-label product-image-lable" for="inputGroupFile" aria-describedby="inputGroupFileAddon">{{ $filename_home }}</label>
                                                            <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                                                <i class="fa-regular fa-circle-xmark"></i>
                                                            </span>
                                                        </div>
                                                        <div class="input-group-append ml-1 trash-button">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-danger delete-product" data-url="{{ route('products.delete-image') }}" data-id="{{ $media_id_home }}" data-imgtype="single" type="button">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    @error('product_home_image')
                                                    <div class="text-danger">
                                                        <small>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                    @enderror

                                                    <div class="border rounded-lg text-center p-1">
                                                        <img src="{{$product->product_home_image_full_path}}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-0 m-0 pt-4">
                        <button id="update-product" class="btn btn-primary" type="submit" style="width:100%">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // SELECT 2 SETUP
    $(document).ready(function() {
        $('.select-two').select2({
            // theme: "bootstrap4",
            theme: "classic",
            multiple: true,
            allowClear: true,
            placeholder: $(this).data("placeholder")
        });
    });

    // DOM 
    // shop URL hide and show 
    $(document).ready(function() {
        $('.shop-url-div').hide();
        if ($('#shoplist').find(':selected').length >= 0) {
            shopfunc();
        }
    })
    $('#shoplist').on('change', function() {
        shopfunc();
    });
    let shopfunc = function() {
        if ($('#shoplist').find(':selected').length >= 0) {
            $('#shoplist').find(':selected').each(function() {
                $('#' + $(this).val()).parent().parent().show();
                $('#' + $(this).val()).attr('disabled', false);
                $('#' + $(this).val()).attr('required', true);
            });
            $('#shoplist').find(':not(:selected)').each(function() {
                $('#' + $(this).val()).parent().parent().hide();
                $('#' + $(this).val()).attr('disabled', true);
            });
        }
    }
    let checkInput = $('.check-input');
    $('.checkbox').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).parent().parent().parent().find('input.check-input').attr('disabled', false);
        } else {
            $(this).parent().parent().parent().find('input.check-input').attr('disabled', true);
        }
    });

    //before submit form clean the input field
    function doSubmit(e) {
        // select name="product_size[]"
        $('input[name="product_size[]"]').each(function() {
            if ($(this).val() == '' || null) {
                // // remove this element
                $(this).parent().remove();
            } else {}
        });
        return true;
        // submit
    };

    //add more form field for product size
    $(function() {
        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();

            var dynaForm = $('.dynamic-wrap #dynamic'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(dynaForm);

            newEntry.find('input').val('');
            dynaForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<i class="fa-solid fa-minus"></i>');
            dynaForm.find('.entry:not(:last) input')
                .attr('required', true);

        }).on('click', '.btn-remove', function(e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });

    //add more form field for product content
    $(function() {
        $(document).on('click', '.btn-add-file', function(e) {
            e.preventDefault();
            let target = $(e.currentTarget);
            var dynaFile = target.closest('.file-input-group'),
                currentEntry = $(this).parents('.file-input-show:first'),
                newEntry = $(currentEntry.clone()).appendTo(dynaFile);
            newEntry.find('input').val('');
            newEntry.find('.custom-file-label').text('Choose images');
            var imgData = newEntry.find('img').data('img')
            newEntry.find('img').attr("src", imgData);
            newEntry.find('.remove-file-btn').hide();

            dynaFile.find('.file-input-show:not(:last) .btn-add-file')
                .removeClass('btn-add-file').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<i class="fa-solid fa-minus"></i>');
        }).on('click', '.btn-remove', function(e) {
            $(this).parents('.file-input-show:first').remove();

            e.preventDefault();
            return false;
        });
    });

    //add image input field preview
    function changeFile(e) {
        var input = $(e)[0];
        bsCustomFileInput.init();
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).closest('.file-input-show').find('.img-sequence').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    //ready 
    $(document).ready(function() {
        let delete_product = $('.delete-product');
        delete_product.each(function() {

            if ($(this).data('id') == '') {
                $(this).closest('.trash-button').hide();
                $(this).closest('.trash-button').siblings('.custom-file').find('label').text('Choose image');
            } else {
                $(this).closest('.trash-button').show();
            }
        });
    });


    // AJAX
    // laravel ajax delete confirm
    $('.delete-product').on('click', function(e) {
        e.preventDefault();
        let btn = $(this);
        let id = $(this).data('id');
        let url = $(this).data('url');
        let imgtype = $(this).data('imgtype');
        let targetItem = $(this).closest('.file-input-show');
        let confirm = window.confirm("Are you sure you want to delete?");

        if (confirm) {
            //data to send
            let data = {
                "media_id": id,
            };
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function(result) {
                    if (result.status) {
                        // console.log(result);
                        if (imgtype == 'single') {
                            $('#edit_product_img_file_name').text('Choose file');
                            // $('input[name="product_image"]').attr('disabled', false);
                            targetItem.find('img').attr('src', "{{asset('images/nopreview.png')}}");
                            $(btn).hide(300);

                        } else {
                            targetItem.hide('300', function() {
                                targetItem.remove();
                            });
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });
</script>
@endsection