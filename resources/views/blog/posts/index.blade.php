@extends('layouts.blog.main')
{{-- show all posts and specific category posts  --}}

@section('content')

    @if(session('success-login'))
        @push('scripts')
            <script>
                window.addEventListener('load', function() {
                    Swal.fire({
                        position         : 'center',
                        icon             : 'success',
                        title            : '{{ session('success-login') }}',
                        showConfirmButton: false,
                        timer            : 2000
                    })
                })
            </script>
        @endpush
    @endif

    @if(Route::is('categories.show'))
        <div class="alert alert-info py-2 mb-4" role="alert">
            <span><i class="fas fa-th-list fa-fw d-inline-block mr-2"></i>{{ $category->name }}</span>
            <a href="{{ route('posts.index') }}" class="close">
                <span>×</span>
            </a>
        </div>
    @endif
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-6 mb-4 col-sm-12">
                <div class="card h-100 posts position-relative">
                    {{-- post image --}}
                    <div class="view overlay h-50">
                        <img class="card-img-top h-100" src="{{ url('storage/images/' . $post->image) }}"
                            alt="Card image cap">
                        <a href="{{ route('posts.show', $post) }}">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    
                    {{-- text --}}
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>           
                        <p class="card-text">{{  Str::limit(filter_var($post->body,FILTER_SANITIZE_STRING),100) }}</p>            
                    </div>

                    {{-- footer --}}
                    <div class="card-footer text-muted text-center py-2">
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-user"></i> {{ $post->user->username }}</span>
                            <span><i class="fas fa-clock"></i> {{ $post->created_at->format('m-Y') }}</span>
                            <span><i class="fas fa-comments"></i> {{ $post->comments->count() }}</span>
                        </div>
                    </div>

                    {{-- control --}}
                    @role('admin|author')
                    <div class="posts-actions position-absolute">
                        <a href="{{ route('posts.edit', $post) }}"><i class="fas fa-pen-square text-info fa-2x fa-fw"></i></a>
                        <a href="#" class="btn-delete"><i class="fas fa-minus-square text-danger fa-2x fa-fw"></i></a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    @endrole
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{ $posts->links() }}
    </div>
@endsection