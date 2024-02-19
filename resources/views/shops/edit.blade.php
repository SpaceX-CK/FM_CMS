<div class="modal fade" id="shopEditModal" tabindex="-1" role="dialog" aria-labelledby="shopEditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0 py-3 text-center">Edit Shops</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container p-4">
                <div class="text-center card">
                    <div class="card-body">
                        <form action="" method="post" class="text-left" enctype="multipart/form-data" id="shop-edit-form">
                            {!! csrf_field() !!}
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shop_name">Shop Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="shop_name" value="{{ old('shop_name') }}" id="edit_shop_name" required="required" class="form-control @error('shop_name') is-invalid @enderror">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shop_image">Shop Image: </label>
                                    <div class="file-input-show mb-3" role="form" id="dynamic-file">
                                        <div class="input-group row ml-0 d-flex align-items-center">
                                            <div class="custom-file my-2">
                                                <input type="file" name="shop_image" class="edit-shop custom-file-input @error('shop_image') is-invalid @enderror" onchange=changeFile(this)>
                                                <label class="custom-file-label" for="inputGroupFile" id="edit_shop_img_file_name" aria-describedby="inputGroupFileAddon" disabled>Choose image</label>
                                                <span class="remove-file-btn" onclick=clearInput(this) style="display: none;">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </span>
                                            </div>
                                            <div class="input-group-append ml-1 trash-button">
                                                <span class="input-group-btn">

                                                    <a data-href="{{ route('shops.delete-image') }}" onclick="passRoute(this)" data-id="" data-target="#shop-delete-modal" data-toggle="modal" class="delete_shop_img">
                                                        <button class="btn btn-danger delete_shop_img">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
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

                                        <div class="border rounded-lg text-center p-1" style="position:relative">
                                            <i id="loadIcon" class="fas fa-spinner fa-pulse" style="position: absolute; top: 30%; right: 50%; z-index:1"></i>
                                            <img src="{{asset('images/nopreview.png')}}" id="edit_shop_img" data-img="{{asset('images/nopreview.png')}}" style="max-height:180px; z-index:10;" class="img-fluid img-sequence" id="preview" />
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
@include('component.delete' , [ 'dataTarget' => "shop-delete-modal" , 'modalType' => 'shop image'] )
<script>
    // laravel ajax delete confirm
    // $('.delete_shop_img').on('click', function(e) {
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     var url = $(this).data('url');
    //     // var token = @json(csrf_token());
    //     var form = $(this).parent();

    //     let targetItem = $(this).closest('.file-input-show');
    //     let confirm = window.confirm("Are you sure you want to delete?");
    // if (confirm) {
    //     var data = {
    //         "media_id": id,
    //     };
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: data,
    //         success: function(result) {
    //             if (result.status) {
    //                 console.log(result);
    //                 $('.trash-button').hide();
    //                 $('#edit_shop_img_file_name').text('Choose image');
    //                 targetItem.find('img').attr('src', '{{asset('images/nopreview.png')}}');
    //             }
    //         },
    //         error: function(error) {
    //             console.log(error);
    //         }
    //     });
    //     return true;
    // } else {
    //     e.preventDefault();
    //     return false;
    // }
    // });
</script>