@extends('layouts.master')


@section('content')

<div class="edit-post">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Title" name="title" value="{{ old('title') ?? $post->title }}">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="body">Post Content</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" rows="20"
                            placeholder="Content" name="body">{{ old('body') ?? $post->body }}</textarea>
                        @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="cat_id">
                            <option>Select category</option>
                            @foreach(App\Categorie::get() as $cat)
                            <option value="{{ $cat->id }}" @if($cat->id == $post->cat_id) selected @endif>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label form-control @error('image') is-invalid @enderror"
                            for="image">Choose Image</label>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-success my-4">Edit</button>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
