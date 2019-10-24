@extends('layouts.master')


@section('content')


<div class="post mb-5">
    <div class="container">
        @if(session('success'))

        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session('success') }}
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

@include('comments.create')

@endsection
