@extends('layouts.master')

@section('content')
<div class="home-posts">
    <div class="container">
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
            <div class="col-md-8">
                @include('partial._slider')
                @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="row no-gutters" style="height: 230px">
                        <div class="col-md-4 h-100">
                            <img src="{{ url('storage/images/' . $post->image) }}" class="card-img h-100 w-100"
                                alt="{{ $post->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                                <p class="card-text"><small
                                        class="text-muted">{{ Str::limit($post->body, 100) }}</small>
                                </p>
                                <p class="card-text"><small class="text-muted">{{ $post->user->name }} |
                                        {{ $post->created_at->format('d-m-Y') }} | {{ $post->category->name }}
                                    </small>
                                </p>
                                @role('admin|author')
                                <div class="buttons">
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
                    </div>
                </div>
                @endforeach

                <div class="text-center"><a href="{{ route('posts.index', ['page' => 2]) }}" class="btn btn-info">show more</a></div>
            </div>
            <div class="col-md-4">
                @include('partial._sidbar')
            </div>
        </div>
    </div>
</div>
@endsection
