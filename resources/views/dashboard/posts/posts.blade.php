@extends('layouts.dashboard.master')

@section('title', 'Posts')

@section('dashboard-body')


<div class="container-fluid">
    @include('_alert')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary float-left">All posts</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table  class="table table-bordered display" id="dataTable" cellspacing="0">
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
                                <a href="{{ route('posts.show', $post) }}"><i class="fas fa-eye btn-show"></i></a>
                                <a href="{{ route('posts.edit', $post) }}"><i class="fas fa-user-edit btn-edit"></i></a>
                                <a href="#"><i class="fas fa-trash btn-delete"></i></a>

                                <form action="{{ route('posts.destroy', $post) }}" class="d-inline-block" method="POST">
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
