@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="cat_name">Categorie name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="cat_name" placeholder="Name" name="name">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="cat_description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="cat_description" rows="4" name="description"></textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>

        </div>
    </div>
</div>

@endsection
