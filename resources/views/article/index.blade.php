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
                    <h3 class="mb-0 ">Article</h3>
                </div>
                <div class="col col-md-6 d-flex justify-content-end">
                    <a href="{{route('article.create')}}">
                        <button type="button" class="btn btn-outline-primary mb-3 add-product"><i class="fa-solid fa-plus mx-1"></i>Add New Article</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="branch-tb"}}>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse ($article as $articles)
                        <tr>
                          
                            <td scope="row"></td>
                            <td scope="row">{{ $articles->title}}</td>
                            <td scope="row">{{ $articles->subtitle}}</td>
                            <td scope="row">{{ $articles->getdateattribute($articles->created_at)}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-block btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Action
                                    </button>
                                    <div class="dropdown-menu ">
                                        <a href="{{route('article.edit', $articles->slug)}}">
                                            <button type="button" class="dropdown-item " data-toggle="modal">Edit</button>
                                        </a>

                                        <a data-href="{{route('article.destroy', $articles->id)}}" data-target="#article-delete-modal" data-toggle="modal" id="delete-category">
                                            <button type="button" class="dropdown-item ">Delete</button>
                                        </a>
                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No data found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('article.delete')
@endsection

@section('js')
<script>
    $(function() {
        var t= $("#branch-tb").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "ordering": true,
            "order": [
                [1, 'asc']
            ],
            columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            },
        ],
        });

        t.on('order.dt search.dt', function () {
        let i = 1;
 
        t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
        });

    $(document).on("click",'#delete-category' ,function(e) {
        var href = $(this).data('href');
        $('#article-delete-form').attr('action',href)
    });

</script>
@endsection