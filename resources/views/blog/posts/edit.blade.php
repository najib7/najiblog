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

    @if(session('success'))
        <script>
            window.addEventListener('load', function() {
                Swal.fire({
                    title: 'Success',
                    icon : 'success',
                    html: `
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary shadow-none text-capitalize">Show Post</a>
                        @role('admin')
                        <a href="{{ route('dashboard.posts') }}" class="btn btn-danger shadow-none text-capitalize">Return to Dashboard</a>
                        @endrole
                    `,
                    showCancelButton: false,
                    showConfirmButton: false
                })
            })
        </script>
    @endif
@endpush

@section('content')
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                placeholder="Title" name="title" value="{{ old('title') ?? $post->title }}">
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <textarea id="mytextarea" class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="20">
                {{ old('body') ?? $post->body }}
            </textarea>
            @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <select class="form-control @error('cat_id') is-invalid @enderror" name="cat_id">
                <option>Select category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @if(old('cat_id') == $category->id || $category->id == $post->cat_id) selected @endif>{{ $category->name }}</option>
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

        <img src="{{ asset('storage/images/'. $post->image) }}" class="w-100 my-4" alt="test" id="out-image">

        <button class="btn default-color-dark white-text btn-block my-4" type="submit">Edit</button>
    </form>
@endsection