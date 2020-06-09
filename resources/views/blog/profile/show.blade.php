@extends('layouts.blog.main')

@section('content')
<div class="row profile">

    @if(session('success'))
        @push('scripts')
            <script>
                window.addEventListener('load', function() {
                    Swal.fire({
                        position         : 'center',
                        icon             : 'success',
                        title            : 'Your work has been saved',
                        showConfirmButton: false,
                        timer            : 1500
                    })
                })
            </script>
        @endpush
    @endif

    <div class="col-lg-4 mb-5">
        <div class="card profile-sidbar">
            <img class="card-img-top profile-img mt-4" 
            src="{{  blog_profile_image($user->profile->image) }}" alt="Card image cap">
            <div class="card-body">
                <div class="text-center profile-username">
                    <h4 class="card-title mb-1">{{ $user->username }}</h4>
                    <span class="role-badge badge shadow-none text-normal">{{ $user->getRoleNames()->first() }}</span>
                </div>
                <div class="profile-stats my-4">
                    <table class="table">
                        <tr>
                            <td>Registration Date</td>
                            <td>{{ $user->created_at->format('Y/m') }}</td>
                        </tr>
                        <tr>
                            <td>Last Login</td>
                            <td>{{ $user->last_login->format('Y/m/d') }}</td>
                        </tr>
                        <tr>
                            <td>Posts</td>
                            <td>{{ $user->posts->count() }}</td>
                        </tr>
                        <tr>
                            <td>Comments</td>
                            <td>{{ $user->comments->count() }}</td>
                        </tr>
                    </table>
                </div>
                @can('edit-profile', $user)
                <div class="profile-buttons">
                    <a href="{{ route('profile.edit', $user) }}" class="btn btn-primary">Edit profile</a>
                    <a href="{{ route('profile.editpassword', $user) }}" class="btn btn-info">Change Password</a>
                </div>
                @endcan
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <table class="table profile-details">
                    <tbody>
                        <tr>
                            <td>Last Name</td>
                            <td>{{ $user->profile->first_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td>{{ $user->profile->last_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ $user->profile->country ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ $user->profile->gender }}</td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>{{ $user->profile->date_of_birth->age ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $user->profile->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="profile-bio text-italic">{{ $user->profile->about ?? '\'Your bio\'' }}</div>
            </div>
        </div>

        <div class="card overflow-hidden mt-5">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Latest Posts</th>
                            <th>Created_at</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($posts->isNotEmpty())
                        @foreach ($posts as $post)
                        <tr>
                            <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                            <td>{{ $post->created_at->format('Y/m/d') }}</td>
                            <td class="text-center">{{ $post->comments->count() }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">No posts</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card overflow-hidden mt-5">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Latest Comments</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($comments->isNotEmpty())
                        @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->created_at->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="text-center">No comments</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>


@endsection