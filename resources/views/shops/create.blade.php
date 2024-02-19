<div class="modal fade" id="shopCreateModal" tabindex="-1" role="dialog" aria-labelledby="shopCreateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <h3 class="mb-0 py-3 text-center">New Shops</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container p-4">


                <div class="text-center card">
                    <div class="card-body text-left">
                        <form action="{{ route('shops.store') }}" method="post" class="" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shop_name">Shop Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="shop_name" value="{{ old('shop_name') }}" required="required" class="form-control @error('shop_name') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shop_image">Shop Image: </label>
                                    <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                        <div class="input-group row ml-0">
                                            <div class="custom-file my-2">
                                                <input type="file" name="shop_image" class="custom-file-input @error('shop_image') is-invalid @enderror" onchange=changeFile(this)>
                                                <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">Choose image</label>
                                                <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('shop_image')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                        @enderror

                                        <div class="border rounded-lg text-center p-1">
                                            <img src="{{asset('images/nopreview.png')}}" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px" class="img-fluid img-sequence" id="preview" />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3 pt-4">
                                <button id="update-shop" class="btn btn-primary" type="submit" style="width:100%">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
