@extends('layouts.master')

@section('content')
<div class="container">
    @if (session('success-login'))
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success" role="alert">
                {{ session('success-login') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card"> {{-- posts--}}
                @foreach ($posts as $post)
                <div>{{ $post->title }}</div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
        <div class="col-md-4">
            <div class="card">
                sidbar
            </div>
        </div>
    </div>
</div>
@endsection
