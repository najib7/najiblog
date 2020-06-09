@php

foreach (config('blog.pin_posts') as $key => $value) {
    $silderPosts[] = App\Post::find($value);
}

@endphp

<div class="container mb-5 d-none d-md-block d-lg-block z-depth-1">
    <div id="carousel" class="carousel slide" data-ride="carousel" style="height: 400px">
        <ol class="carousel-indicators">
            @foreach ($silderPosts as $post)
            <li data-target="#carousel" data-slide-to="{{ $loop->index }}" class="@if($loop->index === 0) active @endif"></li>
            @endforeach
        </ol>
        <div class="carousel-inner h-100">
            @foreach ($silderPosts as $post)
            <div class="carousel-item view overlay h-100 @if($loop->index == 0) active @endif">
                <img class="d-block w-100 h-100" src="{{ url('storage/images/' . $post->image) }}" alt="First
                    slide">
                <a href="{{ route('posts.show', $post) }}">
                    <div class="mask waves-effect waves-light rgba-white-slight"></div>
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="carousel-title">{{ $post->title }}</h5>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span aria-hidden="true"><i class="fas fa-arrow-circle-left fa-2x"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span aria-hidden="true"><i class="fas fa-arrow-circle-right fa-2x"></i></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>