@extends('layouts.master')

@section('content')
    @if (session('success-login'))
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success" role="alert">
                {{ session('success-login') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            {{-- @include('partial._slider') --}}
            {{-- home page posts --}}
            <div class="posts">
                <div class="row">
                    @if($posts->isEmpty())
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            no posts !!!
                        </div>
                    </div>
                    @endif
                    @foreach ($posts as $post)
                    <div class="col-md-6">
                        <div class="post-outer mb-4">

                            <div class="post-image">
                                <a href="{{ route('posts.show', $post) }}"><img src="{{ url('storage/images/' . $post->image) }}" alt="{{ $post->title }}" class="w-100 h-100"></a>
                            </div>

                            <div class="post-info">
                                <h3 class="post-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>
                                <div class="meta-post">
                                    <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                                    <span><i class="fas fa-clock"></i> {{ $post->created_at->format('d-m-Y') }}</span>
                                    <span><i class="fas fa-comments"></i> {{ $post->comments->count() }}</span>
                                </div>
                                <div class="post-snip">
                                    {{ Str::limit($post->body, 100) }}
                                </div>
                            </div>

                            <span class="post-cat">
                                {{ $post->category->name }}
                            </span>
                            @role('admin|author')
                            <div class="manag-post">
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm"><i
                                    class="far fa-edit"></i></a>
                                <form action="{{ route('posts.destroy', $post) }}" class="d-inline-block"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')"><i
                                            class="far fa-trash-alt"></i></button>
                                </form>
                            </div>
                            @endrole
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center">{{ $posts->links() }}</div>
        </div>
        <div class="col-lg-4">
            @include('partial._sidbar')
        </div>
    </div>
@endsection
