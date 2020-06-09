@extends('layouts.dashboard.main')


@section('title', 'Categories')

{{-- @section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection --}}

@section('dashboard-body')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary float-left">Users informations</h3>
            <span class="float-right">
                <a href="#" class="create-category">
                    <i class="far fa-plus-square fa-lg green"></i> {{-- add new category button --}}
                </a>
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->description }}</td>
                            </td>
                            <td class="text-center">
                                <a href="#"
                                    class="edit-category text-primary"
                                    data-category="{{ $cat }}"
                                >
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="#" class="delete-category text-danger" data-category="{{ $cat }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-category">
                        <div class="form-group">
                            <input type="text" class="form-control" id="cat_name" placeholder="Name" name="name">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="cat_description" rows="4" name="description"
                                placeholder="Description..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit-button"></button>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
