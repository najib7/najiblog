@extends('layouts.master')

@section('content')

<div class="posts">
    <div class="container">
       @include('_alert')

        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-4 my-3">
                <div class="card h-100">
                    <img src="{{ url('storage/images/'. $post->image)  }}" class="card-img-top" alt="{{ $post->title }}">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                        <p class="card-text"><small class="text-muted">{{ Str::limit($post->body, 50) }}</small></p>
                        <p class="card-text">{{ $post->category->name  }} - {{ $post->created_at->format('d-m-Y') }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ $post->user->name }} </small>
                        <div class="float-right">
                            @role('admin|author')
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
                            <form action="{{ route('posts.destroy', $post) }}" class="d-inline-block" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                            @endrole
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-success btn-sm"><i class="fas fa-external-link-square-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- pagination links -->
        <div class="pagination pt-4">
            <div class="row">
                <div class="col-md-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
