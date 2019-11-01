@extends('layouts.master')


@section('content')
<div class="profile">
    <div class="container">
        @include('partial._success')
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{ url('img/profile.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title d-inline-block">{{ $user->name }}</h5>
                        <span class="badge badge-{{ $user->hasRole('admin') ? "danger" : "success"}} float-right">{{ $user->getRoleNames()->first() }}</span>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto
                            suscipit.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Email <span class="float-right">{{ $user->email }}</span></li>
                        <li class="list-group-item">Registration Date <span
                                class="float-right">{{ $user->created_at->format('Y/m') }}</li>
                        <li class="list-group-item">Nbr Posts <span class="float-right">{{ $user->posts->count() }}</li>
                        <li class="list-group-item">Nbr Comments <span
                                class="float-right">{{ $user->comments->count() }}</li>
                    </ul>
                    @can('edit-profile', $user)
                    <div class="card-body">
                        <a href="{{ route('profile.edit', $user) }}" class="btn btn-primary d-block mb-2">Edit profile</a>
                        <a href="{{ route('profile.editpassword', $user) }}" class="btn btn-info d-block mb-2">Change Password</a>
                        <form action="{{ route('profile.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary w-100" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
            <div class="col-md-9">
                <div class="card ml-4 p-4">
                    <h5 class="card-title">Latest Posts</h5>
                    @if($posts->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        No posts
                    </div>
                    @else
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Post</th>
                                <th>Created_at</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                                <td>{{ $post->created_at->format('Y/m/d') }}</td>
                                <td class="text-center">{{ $post->comments->count() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    <hr>
                    <h5 class="card-title">Latest Comments</h5>
                    @if($comments->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        No comments
                    </div>
                    @else
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Comment</th>
                                <th>Created_at</th>
                                {{-- <th>Comments</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ $comment->created_at->format('Y/m/d') }}</td>
                                {{-- <td>{{ $post->comments->count() }}</td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
