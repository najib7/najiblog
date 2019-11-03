<div class="trend-posts mb-4">
    <div class="card">
        <div class="card-header mb-3">
            Latest Posts
        </div>
        @foreach(App\Post::take(5)->get() as $t_post)
        <div class="row mb-3 ml-1">
            <div class="col-4">
                <img src="{{ url('storage/images/' . $t_post->image) }}" alt="dqd" class="h-100 w-100">
            </div>
            <div class="col-8 pl-0">
                <div class="card-title text-truncate"><small><a href="{{ route('posts.show', $t_post) }}">{{ $t_post->title }}</a></small></div>
                <p class="text-muted"><small><i class="fas fa-clock"></i> {{ App\Post::all()->first()->created_at->format('d/m/Y') }}</small></p>
            </div>
        </div>
        @endforeach
    </div>
</div>


<div class="latest-comments">
    <div class="card">
        <div class="card-header">
            Latest Comments
        </div>
        <ul class="list-group list-group-flush">
            @foreach(App\Comment::orderBy('id', 'desc')->take(5)->get() as $c)
            <li class="list-group-item">
                <span class="text-muted">{{ $c->comment }}</span>
                <span class="badge badge-info float-right">{{ $c->user->name }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>
