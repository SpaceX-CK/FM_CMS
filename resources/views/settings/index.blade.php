@extends('layouts.app')

@section('content')

<div class="containe-fluid p-4">



    <div class="card card-radius">
        <div class="card-header" style="border: none;">
            <div class="row">
                <div class="col col-md-6">
                    <h3 class="mb-0 ">Settings</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="post" class="text-left" enctype="multipart/form-data">
                {!! csrf_field() !!}
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook">Facebook: </label>
                            <input type="text" min="1" name="facebook" value="{{$setting_array['facebook'] ?? ''}}" id="facebook"  class="form-control @error('facebook') is-invalid @enderror">
                            @error('facebook')
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instagram">Instagram: </label>
                            <input type="text" min="1" name="instagram" value="{{$setting_array['instagram'] ?? ''}}" id="instagram"  class="form-control @error('instagram') is-invalid @enderror">
                            @error('instagram')
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

                    @php
                    if( $imgLogo != 'null' ){
                        
                    $media_id = array_keys($imgLogo)[0];
                    $filename = array_values($imgLogo)[0];
                    }
                    else{
                    $media_id = null;
                    $filename = null;
                    }
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="logo_image">Logo Image: </label>
                            <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                <div class="input-group row ml-0 d-flex align-items-center">
                                    <div class="custom-file my-2">
                                        <input type="file" name="logo_image" class="custom-file-input" onchange=changeFile(this)>
                                        <label class="custom-file-label" id="edit_product_img_file_name" for="inputGroupFile" aria-describedby="inputGroupFileAddon">{{ $filename ?? 'Choose image' }}</label>
                                        <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </span>
                                    </div>
                                    <div class="input-group-append ml-1 trash-button">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger delete-item" data-url="{{ route('settings.delete-image') }}" data-id="{{ $media_id }}" data-imgtype="single" type="button">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                @error('logo_image')
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

                </div>
                <div class="col-md-3 pt-4">
                    <button id="create-product" class="btn btn-primary" type="submit" style="width:100%">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
      // AJAX
    // laravel ajax delete confirm
    $('.delete-item').on('click', function(e) {
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
                        console.log(result);
                       
                            $('#edit_product_img_file_name').text('Choose file');
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