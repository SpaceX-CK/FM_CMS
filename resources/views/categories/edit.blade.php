@extends('layouts.app')

@section('content')

<div class="container-fluid p-4">
    <div class="card card-radius">
        <div class="card-header" style="border: none;">
            <div class="row">
                <div class="col col-md-6">
                    <h3 class="mb-0 ">Edit Category</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update',[$category->id] )}}" method="post" class="text-left" enctype="multipart/form-data">
                {!! csrf_field() !!}
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_name">Category Name: </label>

                            <input type="text" min="1" name="category_name" id="category_name" required="required" class="form-control @error('category_name') is-invalid @enderror" value="{{$category->category_name}}">
                            @error('category_name')
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
                            <label for="category_description">Category Description <span class="text-danger">*</span></label>
                            <input type="text" name="category_description" id="category_description" class="form-control @error('category_description') is-invalid @enderror" value="{{$category->category_description}}" autofocus="autofocus">
                            @error('category_description')
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
                            <label for="sequence">Sort sequence: </label>
                            <input type="number" min="1" name="sequence" id="sequence" class="form-control" value="{{$category->sequence}}">
                            <small class="text-muted">Leaving empty will sort to last.</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @php
                    if($category->categoryImage){
                    $media_id = $category->categoryImage->id;
                    $filename = $category->categoryImage->file_name;
                    }
                    else{
                    $media_id = '';
                    $filename = 'Choose file';
                    }
                    @endphp
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_image">Category Image: </label>
                            <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                <div class="input-group row ml-0 d-flex align-items-center">
                                    <div class="custom-file my-2">
                                        <input type="file" name="category_image" class="custom-file-input @error('category_image') is-invalid @enderror" onchange=changeFile(this)>
                                        <label class="custom-file-label" for="inputGroupFile" id="edit_category_img_file_name" aria-describedby="inputGroupFileAddon" disabled>{{$filename}}</label>
                                        <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </span>
                                    </div>
                                    <div class="input-group-append ml-1 trash-button">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger delete_category_img" data-url="{{route('categories.delete-image')}}" data-id="{{ $media_id }}" type="button">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                @error('category_image')
                                <div class="text-danger">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror

                                <div class="border rounded-lg text-center p-1">
                                    <img src="{{$category->category_image_full_path}}" id="edit_category_img" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    if($category->categoryMobileImage){
                    $media_idMobile = $category->categoryMobileImage->id;
                    $filenameMobile = $category->categoryMobileImage->file_name;
                    }
                    else{
                    $media_idMobile = '';
                    $filenameMobile = 'Choose file';
                    }
                    @endphp
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_image_mobile">Category Image Mobile: </label>
                            <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                <div class="input-group row ml-0 d-flex align-items-center">
                                    <div class="custom-file my-2">
                                        <input type="file" name="category_image_mobile" class="custom-file-input @error('category_image_mobile') is-invalid @enderror" onchange=changeFile(this)>
                                        <label class="custom-file-label" for="inputGroupFile" id="edit_category_img_file_name" aria-describedby="inputGroupFileAddon" disabled>{{ $filenameMobile }}</label>
                                        <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </span>
                                    </div>
                                    <div class="input-group-append ml-1 trash-button">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger delete_category_img" data-url="{{route('categories.delete-image')}}" data-id="{{ $media_idMobile }}" type="button">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                @error('category_image_mobile')
                                <div class="text-danger">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror

                                <div class="border rounded-lg text-center p-1">
                                    <img src="{{ $category->category_mobile_image_full_path }}" id="edit_category_img" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 pt-4">
                        <button id="create-product" class="btn btn-primary" type="submit" style="width:100%">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    //DOM
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
        if ($(e).val() != '') {
            $(e).siblings('.remove-file-btn').show();
        }
    }
    $(document).ready(function() {
        if ($('.delete_category_img').data('id') == '') {
            $('.trash-button').hide();
            $('#edit_category_img_file_name').text('Choose file');
        } else {
            $('.trash-button').show();
        }
    });

    // laravel ajax delete confirm
    $('.delete_category_img').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).data('url');
        // var token = @json(csrf_token());
        var form = $(this).parent();
        var data = {
            "media_id": id,
        };
        let targetItem = $(this).closest('.file-input-show');
        let confirm = window.confirm("Are you sure you want to delete?");
        if (confirm) {
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function(result) {
                    if (result.status) {
                        console.log(result);
                        targetItem.find('.trash-button').hide();
                        targetItem.find('label').text('Choose file');
                        targetItem.find('img').attr('src', "{{asset('images/nopreview.png')}}");
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