@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">
                    <h3 class="mb-0 ">Product</h3>
                </div>
                <div class="col col-md-6 d-flex justify-content-end">
                    <a href="{{route('products.create')}}">
                        <button type="button" class="btn btn-outline-primary mb-3 add-product"><i class="fa-solid fa-plus mx-1"></i>Add New Product</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="branch-tb">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sequence</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td scope="row"></td>
                            <td scope="row">{{ $product->product_name }}</td>
                            <td scope="row">{{ $product->product_title }}</td>
                            <td scope="row">{{ $product->category->category_name}}</td>
                            <td scope="row">{{ $product->sequence }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-block btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Action
                                    </button>
                                    <div class="dropdown-menu ">
                                        <a href="{{ route('products.edit', $product->slug ) }}">
                                            <button type="button" class="dropdown-item " data-toggle="modal">Edit</button>
                                        </a>

                                        <a data-href="{{ route('products.destroy', $product->id) }}" onclick="passRoute(this)" data-target="#product-delete-modal" data-toggle="modal">
                                            <button type="button" class="dropdown-item ">Delete</button>
                                        </a>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No data found.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('component.delete' , [ 'dataTarget' => "product-delete-modal" , 'modalType' => 'product' ] )


<script>
    $(function() {
        var t = $("#branch-tb").DataTable({
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
</script>
@endsection