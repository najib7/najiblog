@extends('layouts.master')


@section('content')
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 my-3">
            <div class="card h-100">
                <img src="{{ asset('storage/images/'. $post->image)  }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                    <p class="card-text">{{ Str::limit($post->body, 70) }}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">{{ $post->user->name }} |
                        {{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</small>
                    <div class="float-right">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm"><i
                                class="far fa-edit"></i></a>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-success btn-sm"><i
                                class="fas fa-external-link-square-alt"></i></a>
                        <form action="{{ route('posts.destroy', $post) }}" class="d-inline-block" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i
                                    class="far fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
