@extends('layouts.app')

@section('content')

<div class="containe-fluid p-4">



    <div class="card card-radius">
        <div class="card-header" style="border: none;">
            <div class="row">
                <div class="col col-md-6">
                    <h3 class="mb-0 ">Create Category</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="post" class="text-left" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_name">Name: <span class=" text-danger">*</span></label>
                            <input type="text" min="1" name="category_name" value="{{ old('category_name') }}" id="category_name" required="required" class="form-control @error('category_name') is-invalid @enderror">
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
                            <label for="category_description">Description: </label>
                            <input type="text" name="category_description" id="category_description" class="form-control @error('category_description') is-invalid @enderror" autofocus="autofocus">
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

                            <input type="number" min="1" name="sequence" id="sequence" class="form-control">
                            <small class="text-muted">Leaving empty will sort to last.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_image">Category Image: </label>
                            <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                <div class="input-group row ml-0 d-flex align-items-center">
                                    <div class="custom-file my-2">
                                        <input type="file" name="category_image" class="edit-shop custom-file-input @error('category_image') is-invalid @enderror" onchange=changeFile(this)>
                                        <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon" disabled>Choose image</label>
                                        <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                            <i class="fa-regular fa-circle-xmark"></i>
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
                                    <img src="{{asset('images/nopreview.png')}}" id="edit_category_img" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_image_mobile">Category Mobile Image: </label>
                            <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                <div class="input-group row ml-0 d-flex align-items-center">
                                    <div class="custom-file my-2">
                                        <input type="file" name="category_image_mobile" class="edit-shop custom-file-input @error('category_image_mobile') is-invalid @enderror" onchange=changeFile(this)>
                                        <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon" disabled>Choose image</label>
                                        <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                            <i class="fa-regular fa-circle-xmark"></i>
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
                                    <img src="{{asset('images/nopreview.png')}}" id="edit_category_img" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
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


@endsection