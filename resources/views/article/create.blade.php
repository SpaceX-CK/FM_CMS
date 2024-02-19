@extends('layouts.app')
@section('content')
@section('style')
<style>
  .select2-container{
    flex: 0 0 50%;
    max-width: 100%;
  }
  .select2-selection{
    padding: 0.375rem 0.75rem !important;
  }
</style>
@endsection
<div class="container-fluid p-4">
  <div class="card card-radius">

    <div class="card-header" style="border: none;">
      <div class="row">
        <div class="col col-md-6">
          <h3 class="mb-0 ">Create Article</h3>
        </div>
      </div>
    </div>

    <form id="article-create-form" action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label>Title*</label>
            <input type="text" name="title" value="{{old('title')}}" class="form-control">
            @error('title')
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
          <label>Sub Title*</label>
            <input type="text" name="sub" value="{{old('sub')}}" class="form-control">
            @error('sub')
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
          <label>Suggested Product*</label>
          <select name="product[]"  class="select2 form-control" multiple="multiple">
            @foreach($product as $products)
            <option value="{{$products->id}}" {{old('product') == $products->id ?'selected':""}} > {{$products->product_name}}</option>
            @endforeach
          </select>
            @error('product')
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
                            <label for="category_image">Thumbnail </label>
                            <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                <div class="input-group row ml-0 d-flex align-items-center">
                                    <div class="custom-file my-2">
                                        <input type="file" name="thumbnail" class="edit-shop custom-file-input @error('category_image') is-invalid @enderror" onchange=changeFile(this)>
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
          </div>
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
          <label>Thumbnail Title*</label>
            <input type="text" name="thumbnail_title" value="{{old('thumbnail_title')}}" class="form-control">
            @error('sub')
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
            <div class="form-group">
              <label>Content*</label>
              <textarea class="form-control @error('content') is-invalid @enderror" id="contents" name="content" rows="3" data-href="{{route('article-editor')}}">{{old('content')}}</textarea>
              @error('content')
              <div class="text-danger">
                <small>
                  {{ $message }}
                </small>
              </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="col-md-3 p-0 m-0 pt-4">
          <button id="article-create-btn" class="btn btn-primary" type="submit" style="width:100%">Submit</button>
        </div>
        </div>
    </form>

  </div>
</div>
@endsection

@section('js')
<script>
  $(document).on("change", ".upload-img", function(e) {
    $('.fa-trash-alt').show();
  });
  $(document).on("click", ".fa-trash-alt", function(e) {
    $('[name=thumbnail]').val(null);
    $('.fa-trash-alt').hide();
  });
  
  var href = $('#contents').data('href');

  $(document).ready(function() {
        $('.select2').select2({
        theme:"classic",
        multiple: true,
        allowClear: true,
        placeholder: $(this).data("placeholder"),
        maximumSelectionLength: 4,
    });
    $('.fa-trash-alt').hide();
    });

    tinymce.init({
    selector: 'textarea#contents', // Replace this CSS selector to match the placeholder element for TinyMCE
    branding: false,
        plugins: 'lists table image',
        statusbar: false,
        toolbar: 'undo redo | blocks | bold italic alignleft aligncenter alignright | indent outdent bullist numlist | table image',
        file_picker_types: 'image',
        image_class_list: [{
            title: 'img-responsive',
            value: 'img-fluid'
        }, ],
        image_title: true,
        image_description: false,
        image_uploadtab: false,
        object_resizing : 'img',
        images_upload_url: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', href);
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
               json = JSON.parse(xhr.responseText);

               if (!json || typeof json.location != 'string') {
                   failure('Invalid JSON: ' + xhr.responseText);
                   return;
               }
               success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       },
        /* and here's our custom image picker*/
        file_picker_callback: (cb, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.addEventListener('change', (e) => {
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                   
                    const id = 'blobid' + (new Date()).getTime();
                    const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    const base64 = reader.result.split(',')[1];
                    const blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                });
                reader.readAsDataURL(file);
            });

            input.click();
        },
  });
</script>
@endsection