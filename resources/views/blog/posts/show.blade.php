@extends('layouts.blog.main')

@section('content')
    <div class="card post">
        <h4 class="post-title">{{ $post->title }}</h4>
        <div class="my-3 text-muted">
            <div class="post-header py-2">
                <div class="post-meta d-inline-block">
                    <span class="mr-4"><i class="far fa-user"></i> {{ $post->user->username }}</span>
                    <span class="mr-4"><i class="far fa-clock"></i> {{ $post->created_at->format('d-m-Y') }}</span>
                    <span class="mr-4"><i class="far fa-comment-dots"></i> {{ $post->comments->count() }}</span>
                </div>

                @role('admin|author')
                <div class="post-control d-inline-block float-right">
                    <a href="{{ route('posts.edit', $post) }}" class="btn-edit">edit</a>
                    <a class="btn-delete"><span>delete</span></a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                @endrole
            </div>
        </div>
                        
        <div class="card-body">
            <img src="{{ asset('storage/images/'. $post->image)  }}" alt="{{ $post->title }}" class="post-image w-100">
            <article class="py-4">
                {!! $post->body !!}
            </article>
        </div>
    </div>

    @include('blog.posts.comments')
@endsection