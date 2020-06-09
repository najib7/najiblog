<div class="card comments mt-5">

    <div class="comments-header">
        Comments ({{ $post->comments->count() }})
    </div>

    <div class="card-body" id="comments">

        @auth {{-- add new comment --}}
        <div class="comment-wrap">
            <div class="comment-avatar">
                <img src="{{ blog_profile_image(Auth::user()->profile->image) }}" alt="" width="50">
            </div>
            <div class="comment-form">
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <textarea id="textarea-comment" name="comment" class="form-control" placeholder="Add comment..." rows="5"></textarea>
                    @error('comment')
                    <span class="d-inline-block py-3 text-danger">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-primary mb-5">Add comment</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        @else 
        <div class="alert alert-warning mb-4 p-2 border-0" role="alert">
            <i class="fas fa-exclamation-circle"></i> You must be <a href="{{ route('login') }}" class="text-primary">logged</a> in to comment
        </div>
        @endauth
        
        @if($post->comments->isNotEmpty())
            @foreach ($post->comments as $comment)
            <div class="comment-wrap">
                <div class="comment-avatar">
                    <img src="{{ blog_profile_image($comment->user->profile->image) }}" alt="{{ $comment->user->username }}">
                </div>
                <div class="comment">
                    <div class="comment-header text-muted">
                        <span class="mr-3"><i class="far fa-user"></i> <a class="text-muted" href="{{ route('profile.show', $comment->user) }}">{{ $comment->user->username }}</a></span>
                        <span class="mr-3"><i class="far fa-clock"></i> {{ $comment->created_at->format('d-m-Y') }}</span>
                        <span class="float-right badge badge-primary font-weight-normal">{{ comment_user_badge($post->user, $comment->user) }}</span>
                    </div>
                    <div class="comment-content">
                        {{ $comment->comment }}
                    </div>
                    @auth
                    <div class="comment-actions">
                        @can('edit-comment', $comment)
                            <a href="#" data-toggle="modal" data-target="#formModal" data-comment="{{ $comment }}" class="edit-comment">edit</a>
                        @endcan
                        @can('destroy-comment', $comment)
                            <a href="#" class="btn-delete">delete</a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endcan
                    </div>
                    @endauth
                </div>
            </div>
            @endforeach
        @else
            <div class="alert alert-info text-center no-comments" role="alert">
                <i class="fas fa-exclamation-circle"></i> No comments for this post
            </div>
        @endif

    </div>

    
</div>


<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-comment">
                    <div class="form-group">
                        <textarea class="form-control" id="comment" rows="5" name="comment" placeholder="Comment..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit-comment">Edit</button>
            </div>
        </div>
    </div>
</div>