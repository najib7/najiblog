@extends('layouts.master')


@section('content')


<div class="show-post mb-5">
    <div class="container">
        @if(session('post-updated'))

        <div class="alert alert-info" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session('post-updated') }}
        </div>

        @endif

        <div class="card">
            <h5 class="card-header">{{ $post->title }}</h5>
            <div class="card-body">
                <img src="{{ asset('storage/images/'. $post->image)  }}" class="img-fluid d-block m-auto" alt="Responsive image">
                <p class="card-text py-2"><pre>{{ $post->body }}</pre></p>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                <a href="" class="btn btn-success">Approve</a>
                <a href="" class="btn btn-danger">Delete</a>
            </div>

        </div>
    </div>
</div>

@endsection
