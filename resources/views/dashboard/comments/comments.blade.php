@extends('layouts.dashboard.main')

@section('title', 'Comments')

@section('dashboard-body')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary float-left">All comments</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Comment</th>
                            <th>User</th>
                            <th>Post</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td width="50%" class="show-comment">{{ $comment->comment }}</td>
                            <td>{{ $comment->user->username }}</td>
                            <td>{{ $comment->post->title }}</td>
                            <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <a href="#" class="btn-delete"><i class="fas fa-trash"></i></a>
                                <form action="{{ route('comments.destroy', $comment) }}" class="d-inline-block" method="POST">
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
