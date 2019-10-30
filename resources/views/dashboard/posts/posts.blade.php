@extends('layouts.dashboard.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Posts</h1>
    {{-- <p class="mb-4">Users information</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        @include('_alert')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">all posts</h6>
            {{-- <span class="float-right">
                <a href="{{ route('dashboard.users.create') }}"><i class="far fa-plus-square fa-lg green"></i></a>
            </span> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Created_at</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Nbr comments</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->created_at->format('d-m-Y') }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->comments->count() }}</td>
                            <td class="text-center">
                                <a href="{{ route('posts.show', $post) }}"><i class="fas fa-eye green"></i></a>
                                <a href="{{ route('posts.edit', $post) }}"><i class="fas fa-user-edit blue"></i></a>
                                <form action="{{ route('posts.destroy', $post) }}" class="d-inline-block" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="reset-button" onclick="return confirm('Are you sure?')"><i class="fas fa-trash red"></i></button>
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
<!-- /.container-fluid -->
@endsection
