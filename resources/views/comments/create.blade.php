{{-- create and view comments in posts --}}
<div class="comment-post" @error('comment') id='comment-error' @enderror>
    @auth
    <div class="add-comment">
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="comment">Comment(s) - {{ $post->comments->count() }}</label>
                <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" rows="3"
                    name="comment"></textarea>
                @error('comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="btn btn-primary">comment</button>
        </form>
    </div>
    @endauth

    @guest
    <div class="alert alert-info" role="alert">
        You must be logged in to comment
    </div>
    @endguest
    {{-- dislay comments --}}
    <div class="comments">
        @if($comments->isEmpty())
        <div class="alert alert-dark mt-4" role="alert">
            No comments for this post !
        </div>
        @endif
        @foreach ($comments as $c)
        <div class="comment">
            <div class="comment-header">
                <div class="author">{{ $c->user->name }} | <small>{{ $c->created_at->format('d-m-Y - H:i') }}</small></div>
                <span>

                </span>
            </div>

            <div class="comment-body">
                {{ $c->comment }}
            </div>

            <div class="btn-comment">
                @can('destroy-comment', $c)
                <form action="{{ route('comments.destroy', $c) }}" class="d-inline-block" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="reset-button btn-delete"><i class="fas fa-trash-alt fa-lg fa-fw"></i></button>
                </form>
                @endcan
                @can('edit-comment', $c)
                <a href="{{ route('comments.edit', $c) }}" class="btn-edit"><i class="fas fa-edit fa-lg fa-fw"></i></a>
                @endcan
                <a href="" class="btn-report"><i class="fas fa-ban fa-lg fa-fw"></i></a>
            </div>
        </div>
        @endforeach
    </div>
</div>
