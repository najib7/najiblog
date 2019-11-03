<div class="slider mb-4">
    <div id="home-slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#home-slider" data-slide-to="0" class="active"></li>
            <li data-target="#home-slider" data-slide-to="1"></li>
            <li data-target="#home-slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach(App\Post::orderBy('id', 'desc')->take(3)->get() as $slider_post )
            <div class="carousel-item @if($loop->index == 0) active @endif">
                <img src="{{ url('storage/images/' . $slider_post->image) }}" class="d-block w-100" alt="..." height="400px">
                <div class="carousel-caption">
                    <h5><a href="{{ route('posts.show', $slider_post) }}">{{ $slider_post->title }}</a></h5>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#home-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#home-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
