@extends('layouts.master')

@section('content')

<div class="categories">
    @include('_alert')

    <div class="row">
        @foreach($categories as $categorie)
        <div class="col-md-3 my-3">
            <div
                class="card h-100 text-white border-{{ $color = Arr::random(['primary', 'secondary', 'success', 'danger', 'info', 'dark']) }}">
                <div class="card-header">
                    <a href="{{ route('categories.show', $categorie) }}"
                        class="text-{{ $color }}">{{ $categorie->name }} </a>
                    <a href="{{ route('categories.show', $categorie) }}">({{ $categorie->posts->count() }})</a>
                </div>
                <div class="card-body text-{{ $color }}">
                    <p class="card-text">{{ $categorie->description }}</p>
                </div>
                @role('admin')
                <div class="card-footer text-center">
                    <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-primary btn-sm"><i
                            class="far fa-edit"></i></a>
                    <form action="{{ route('categories.destroy', $categorie) }}" class="d-inline-block" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
                @endrole
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
