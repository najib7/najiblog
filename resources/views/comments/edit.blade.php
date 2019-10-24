@extends('layouts.master')

@section('content')

<div class="container">
    <div class="card">
        <div class="row">
            <div class="col-md-8 m-auto py-4">
                <form action="{{ route('comments.update', $comment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="comment">Edit comment</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" rows="3"
                            name="comment">{{ old('comment') ?? $comment->comment }}</textarea>
                        @error('comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    {{-- <input type="hidden" name="post_id" value="{{ $post->id }}"> --}}
                    <button type="submit" class="btn btn-primary">edit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
