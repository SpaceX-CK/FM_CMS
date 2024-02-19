@extends('layouts.app')

@section('content')
<div class="container-container p-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">
                    <h3 class="mb-0 ">Shops</h3>
                </div>
                <div class="col col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-primary mb-3" class="btn btn-primary" data-toggle="modal" data-target="#shopCreateModal"><i class="fa-solid fa-plus mx-1"></i>Add New Shop</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="shop-tb">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Shop Name</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($shops) > 0)
                        @foreach ($shops as $shop)
                        <tr>
                            <td scope="row"></td>
                            <td scope="row" class="shop-name">{{ $shop->shop_name }}</td>
                            <!-- <td scope="row">{{ $shop->shop_name }}</td> -->
                            <td scope="row" class="shop-img">
                                <img src="{{ $shop->shop_image_full_path }}" style="max-width:150px; max-height:150px" alt="">

                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-block btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Action
                                    </button>
                                    <div class="dropdown-menu ">
                                        <button type="button" class="dropdown-item edit_modal" href="javascript:void(0)" data-route="{{  route('shops.update', [$shop->id]) }}" data-url="{{ route('shops.show', $shop->id) }}">Edit</button>
                                        <a data-href="{{route('shops.destroy', $shop->id)}}" onclick="passRoute(this)" data-target="#shop-delete-modal" data-toggle="modal" >
                                            <button type="button" class="dropdown-item ">Delete</button>
                                        </a>
                                        <!-- <form method="post" action="{{ route('shops.destroy', [$shop->id] ) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button class="dropdown-item show_confirm" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                                        </form> -->
                                    </div>
                                </div>

                            </td>
                        </tr>

                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-center">No data found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
@include('shops.create')
@include('shops.edit')
@include('component.delete' , [  'dataTarget' => "shop-delete-modal"  , 'modalType' => 'shop']  )


{{--@include('shops.edit',[]) --}}

<script>
 
    $(function() {

        $(document).on("click", ".edit_modal", function(e) {
            // let shopName =  $(this).closest("tr").find(".shop-name").text();
            // let shopImg =  $(this).closest("tr").find(".shop-img").find("img").attr("src");
            $('#shopEditModal').modal('show');
            var userURL = $(this).data('url');
            var updateRoute = $(this).data('route');
            $('#edit_shop_img_file_name').text('Choose image');
            $('#edit_shop_img').attr('src', '');
            $('#loadIcon').show();
            
            $.get(userURL, function(data) {
                //   $('#userShowModal').modal('show');
                $('#loadIcon').hide();
                $('#shop-edit-form').attr('action', updateRoute );
                $('#edit_shop_name').val(data.shop_name);
                $('#edit_shop_img').attr('src', data.shop_image);
                $('#edit_shop_img_file_name').text(data.file_name);
                $('#edit_shop_img_file_name').siblings('.remove-file-btn').hide();
                if(data.file_name== ''){
                    $('.trash-button').hide();
                    $('#edit_shop_img_file_name').text('Choose image');
                }
                else{
                    $('.delete_shop_img').data('id', data.media_id);
                    $('.trash-button').show();
                }
            })
        });
    });
    
    

    $(function() {

        var t = $("#shop-tb").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "ordering": true,
            order: [
                [1, 'asc']
            ],
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0,
            }, ],
        });

        t.on('order.dt search.dt', function() {
            let i = 1;

            t.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
    });

    $(document).on("click", '#delete-category', function(e) {
        var href = $(this).data('href');
        $('#category-delete-form').attr('action', href)
    });
</script>
@endsection