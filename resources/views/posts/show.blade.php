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
                @role('admin|author')
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                {{-- <a href="" class="btn btn-success">Approve</a> --}}
                <form action="{{ route('posts.destroy', $post) }}" class="d-inline-block" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                @endrole
            </div>

        </div>
    </div>
</div>

@include('comments.create')

@endsection
