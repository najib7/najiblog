@extends('layouts.master')

@section('content')

<div class="categories">
    <div class="container">
        <!-- if category created successfully -->
        @if(session('success'))

        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session('success') }}
        </div>

        @endif

        <div class="row">
            @foreach($categories as $categorie)
            <div class="col-md-3 my-3">
                <div class="card h-100 text-white border-{{ $color = Arr::random(['primary', 'secondary', 'success', 'danger', 'info', 'dark']) }}">
                    <div class="card-header">
                        <a href="{{ route('categories.show', $categorie) }}" class="text-{{ $color }}">{{ $categorie->name }} </a>
                        <a href="{{ route('categories.show', $categorie) }}">({{ $categorie->posts->count() }})</a>
                    </div>
                    <div class="card-body text-{{ $color }}">
                        {{-- <h5 class="card-title">nbr posts : {{ $categorie->posts->count() }}</h5> --}}
                        <p class="card-text">{{ $categorie->description }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
                        <form action="{{ route('categories.destroy', $categorie) }}" class="d-inline-block" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

{{-- route('posts.show', $post) --}}
