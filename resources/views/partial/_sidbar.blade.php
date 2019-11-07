<div class="widget">
    <div class="widget-header">
        <h3 class="widget-title">Latest Posts</h3>
    </div>
    <div class="widget-content">
        <div class="latest-posts">
            <ul class="list-group">
                @foreach(App\Post::orderBy('id', 'desc')->take(5)->get() as $t_post)
                <li class="list-group-item">
                    <img src="{{ url('storage/images/' . $t_post->image) }}" alt="dqd" class="latest-posts-image">
                    <div class="latest-posts-title">
                        <a href="{{ route('posts.show', $t_post) }}">{{ $t_post->title }}</a>
                    </div>
                    <div class="latest-posts-meta">
                        <i class="fas fa-clock"></i> {{ $t_post->created_at->format('d/m/Y') }}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


<div class="widget">
    <div class="widget-header">
        <h3 class="widget-title">Latest Comments</h3>
    </div>
    <div class="widget-content">
        <div class="latest-comments">
            <ul class="list-group list-group-flush">
                @foreach(App\Comment::orderBy('id', 'desc')->take(5)->get() as $c)
                <li class="list-group-item">
                    <div class="comments">
                        {{ Str::limit($c->comment, 70) }}
                        <span class="badge">{{ $c->user->name }}</span>
                    </div>

                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
