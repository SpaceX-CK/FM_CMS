@extends('layouts.app')


@section('content')

<div class="containe-fluid p-4">


    <div class="card card-radius">
        <div class="card-header" style="border: none;">
            <div class="row">
                <div class="col col-md-6">
                    <h3 class="mb-0 ">Home</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('home.update') }}" method="post" class="text-left" enctype="multipart/form-data">
                {!! csrf_field() !!}
                @method('PUT')

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Title: <span class=" text-danger">*</span></label>
                            <input type="text" min="1" name="title" value="{{$home_array['title'] ?? ''}}" id="title" required="required" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                            <div class="text-danger">
                                <small>
                                    {{ $message }}
                                </small>
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="title">List of Recommend Product: <span class=" text-danger">*</span></label>
                        <div class="form-group">
														<select class="form-control select-single w-100" name="recommend[]"  multiple="multiple">
                                @if (count($products) > 0)
																	@foreach( $products as $item)
																	<option value="{{ $item->id }}" 
																		@if ($recommend)
																			{{in_array($item->id, $recommend) ? 'selected' : ''}}	
																		@endif
																	>{{ $item->product_title }} - {{ $item->product_name }} </option>
																	@endforeach
                                @else
                                <option value="" disabled>No product found</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @php
                        if( $bannerDesktop != 'null' ){

                        $media_id = array_keys($bannerDesktop)[0];
                        $filename = array_values($bannerDesktop)[0];
                        }
                        else{
                        $media_id = null;
                        $filename = null;
                        }
                        @endphp
                        <div class="form-group">
                            <label for="logo_image">Banner Image Desktop: </label>
                            <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                <div class="input-group row ml-0 d-flex align-items-center">
                                    <div class="custom-file my-2">
                                        <input type="file" name="banner_desktop" class="custom-file-input" onchange=changeFile(this)>
                                        <label class="custom-file-label" id="edit_product_img_file_name" for="inputGroupFile" aria-describedby="inputGroupFileAddon">{{ $filename ?? 'Choose image' }}</label>
                                        <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </span>
                                    </div>
                                    <div class="input-group-append ml-1 trash-button">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger delete-item" data-url="{{ route('home.delete-image') }}" data-id="{{ $media_id }}" data-imgtype="single" type="button">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                @error('banner_desktop')
                                <div class="text-danger">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                                <small class="text-muted">Recommend size 300x300 </small>
                                <div class="border rounded-lg text-center p-1">
                                    <img src="{{ asset('images/'.($filename ? 'uploads/'.$filename : 'nopreview.png') ) }}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @php
                        if( $bannerMobile != 'null' ){

                        $media_id_mobile = array_keys($bannerMobile)[0];
                        $filename_mobile = array_values($bannerMobile)[0];
                        }
                        else{
                        $media_id_mobile = null;
                        $filename_mobile = null;
                        }
                        @endphp
                        <div class="form-group">
                            <label for="banner_mobile">Banner Image Mobile: </label>
                            <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                <div class="input-group row ml-0 d-flex align-items-center">
                                    <div class="custom-file my-2">
                                        <input type="file" name="banner_mobile" class="custom-file-input" onchange=changeFile(this)>
                                        <label class="custom-file-label" id="edit_product_img_file_name" for="inputGroupFile" aria-describedby="inputGroupFileAddon">{{ $filename ?? 'Choose image' }}</label>
                                        <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </span>
                                    </div>
                                    <div class="input-group-append ml-1 trash-button">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger delete-item" data-url="{{ route('home.delete-image') }}" data-id="{{ $media_id_mobile }}" data-imgtype="single" type="button">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                @error('banner_mobile')
                                <div class="text-danger">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                                <small class="text-muted">Recommend size 300x300 </small>
                                <div class="border rounded-lg text-center p-1">
                                    <img src="{{ asset('images/'.($filename_mobile ? 'uploads/'.$filename_mobile : 'nopreview.png') ) }}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pt-4">
                    <button id="create-product" class="btn btn-primary" type="submit" style="width:100%">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // SELECT2 SETUP
    $(document).ready(function() {
        $('.select-single').select2({
            theme: "classic",
            placeholder: $(this).data("placeholder"),
            maximumSelectionLength: 4,
            // allowClear: true,
            // theme: "bootstrap4",
        });
        //append select2 to each human selected element
        $('.select-single').on("select2:select", function(evt) {
            var element = evt.params.data.element;
            var $element = $(element);
            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });
        //append selected option to select2 from sever side
        const selectedOption = $('.select-single').data('selected-option');
        const options = selectedOption.map(o => {
            const option = new Option(o.text, o.id, true, true);
            `<option value="${o.id}">${o.text}</option>`
            return option;
        });
        $('.select-single').append(...options);
        $('.select-single').trigger('change');
    });

    // AJAX
    // laravel ajax delete confirm
    $('.delete-item').on('click', function(e) {
        e.preventDefault();
        let btn = $(this);
        let id = $(this).data('id');
        let url = $(this).data('url');
        let imgtype = $(this).data('imgtype');

        // current route
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
                        console.log(result);
                        targetItem.find('label').text('Choose file');
                        // $('input[name="product_image"]').attr('disabled', false);
                        targetItem.find('img').attr('src', "{{asset('images/nopreview.png')}}");
                        $(btn).hide(300);
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