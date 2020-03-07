@extends('layouts.dashboard.master')


@section('title', 'Categories')

@section('dashboard-body')

<div class="container-fluid">
    @include('_alert')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary float-left">All Categories</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created_at</th>
                            <th>Last Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->description }}</td>
                            <td>{{ $cat->created_at->format('d/m/Y-h:i') }}</td>
                            <td>{{ $cat->created_at == $cat->updated_at ? 'Never' : $cat->updated_at->format('d/m/Y-h:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('categories.edit', $cat) }}"><i class="fas fa-user-edit btn-edit"></i></a>
                                <a href="#"><i class="fas fa-trash btn-delete"></i></a>

                                <form action="{{ route('categories.destroy', $cat) }}" class="d-inline-block" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
