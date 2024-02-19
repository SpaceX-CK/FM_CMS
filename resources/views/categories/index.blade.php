@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">

    @if (session('message'))
    <div class="alert alert-success col-md-8 mb-4" style="margin:auto;" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">
                    <h3 class="mb-0 ">Category</h3>
                </div>
                <div class="col col-md-6 d-flex justify-content-end">
                    <a href="{{ route('categories.create') }}">
                        <button type="button" class="btn btn-outline-primary mb-3 add-product" data-toggle="modal" data-target="#productCreateModal"><i class="fa-solid fa-plus mx-1"></i>Add New Category</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="branch-tb" data-href={{route('categories.index')}}>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Sequence</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse ($categories as $category)
                        <tr>
                            <td scope=" row"></td>
                        <td scope="row">{{ $category->category_name }}</td>
                        <td scope="row">{{ $category->category_description }}</td>
                        <td scope="row">{{ $category->sequence }}</td>
                        <td scope="row">
                            <img src="{{ $category->category_image_full_path }}" style="max-width:150px; max-height:150px" alt="">
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-block btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu ">
                                    <a href="categories/{{ $category->slug }}/edit">
                                        <button type="button" class="dropdown-item " data-toggle="modal">Edit</button>
                                    </a>

                                    <a data-href="{{ route('categories.destroy', $category->id) }}" onclick="passRoute(this)" data-target="#category-delete-modal" data-toggle="modal">
                                        <button type="button" class="dropdown-item ">Delete</button>
                                    </a>
                                    <!-- <form method="post" action="{{url('categories').'/'.$category->id }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button class="dropdown-item show_confirm" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                                            </form> -->
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
    @include('component.delete' , [ 'dataTarget' => "category-delete-modal" , 'modalType' => 'category' ] )



    <script>
        $(function() {

            var t = $("#branch-tb").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "ordering": true,
                order: [
                    [3, 'asc']
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