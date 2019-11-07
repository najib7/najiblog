@extends('layouts.master')


@section('content')


<div class="posts-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <div class="post">
                <div class="post-header">
                    <h3 class="post-title">{{ $post->title }}</h3>
                    <div class="post-meta">
                        <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                        <span><i class="fas fa-clock"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                        <span><i class="fas fa-layer-group"></i> {{ $post->category->name }}</span>
                        <span><i class="fas fa-comments"></i> {{ $post->comments->count() }}</span>
                    </div>
                </div>

                <article>
                    <img src="{{ asset('storage/images/'. $post->image)  }}" alt="{{ $post->title }}" class="post-image">
                    <pre>{{ $post->body }}</pre>

                    @role('admin|author')
                    <div class="text-center">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                        {{-- <a href="" class="btn btn-success btn-sm">Approve</a> --}}
                        <form action="{{ route('posts.destroy', $post) }}" class="d-inline-block" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                    @endrole
                </article>

                {{-- comments --}}
                @include('comments.display')
            </div>
        </div>

        <div class="col-lg-4">
            @include('partial._sidbar')
        </div>
    </div>
</div>

@endsection
