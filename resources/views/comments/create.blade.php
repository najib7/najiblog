{{-- create and view comments in posts --}}
<div class="comment-post" @error('comment') id='comment-error' @enderror>
    <div class="container">
        <div class="card p-4 mb-5">
            <div class="row">
                <div class="col-md-8 m-auto">
                    @auth
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
                        <div class="card bg-light mt-4">
                            <div class="card-header">
                                {{ $c->user->name }}
                                <div class="float-right">
                                    <small>{{ \Carbon\Carbon::parse($c->created_at)->format('d-m-Y - H:i') }}</small>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $c->comment }}</p>
                                <p class="card-text">
                                    @can('destroy-comment', $c)
                                    <form action="{{ route('comments.destroy', $c) }}" class="d-inline-block" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                    </form>
                                    @endcan
                                    @can('edit-comment', $c)
                                    <a href="{{ route('comments.edit', $c) }}" class="btn btn-primary btn-sm">edit</a>
                                    @endcan
                                    <button href="" class="btn btn-secondary btn-sm">report</button>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
