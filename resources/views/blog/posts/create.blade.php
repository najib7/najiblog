@extends('layouts.blog.main')

@php
    $categories = App\Categorie::get();
@endphp

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/j178udjugf6u5msnggdp3fzi9xzq8rmgs0lj4qevfugy5so1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            toolbar: "insertfile a11ycheck undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image tinydrive",
        });
    </script>
@endpush

@section('content')
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                placeholder="Title" name="title" value="{{ old('title') }}">
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <textarea id="mytextarea" class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="20">
                {{ old('body') }}
            </textarea>
            @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <select class="form-control @error('cat_id') is-invalid @enderror" name="cat_id">
                <option>Select category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @if(old('cat_id') == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('cat_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label form-control @error('image') is-invalid @enderror" for="image">Choose
                Image</label>
            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <img src="/img/select-image.svg" class="w-100 my-4" alt="test" id="out-image">

        <button class="btn btn-primary btn-block" type="submit">Save</button>
    </form>
@endsection