@php
    $categories = App\Categorie::all();
    $comments = App\Comment::orderBy('id', 'desc')->take(config('blog.latest_comments'))->get();
@endphp

<aside class="col-md-4 blog-sidebar">
    <div class="card widget all-categories">
        <div class="card-header">
            All categories
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($categories as $category)
                <li class="list-group-item">
                    <a href="{{ route('categories.show', $category) }}">
                        {{ $category->name }}
                        <span class="badge float-right">{{ $category->posts->count() }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="my-5"></div>

    <div class="card widget latest-comments">
        <div class="card-header">
            Latest comments
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($comments as $comment)
                <li class="list-group-item position-relative">
                    {{ Str::limit($comment->comment, 80) }}
                    <span class="badge position-absolute author">{{ $comment->user->username }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</aside>