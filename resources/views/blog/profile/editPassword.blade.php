@extends('layouts.blog.main')

@section('content')
    <div class="card card-outline-secondary">
        <div class="card-header">
            <h3 class="mb-0">Change Password</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.updatepassword', $user) }}" method="POST" class="form" role="form" novalidate>
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="password">Current Password</label>
                    <input name="password" type="password" class="form-control {{ validation_class($errors->has('password')) }}" id="password" required>
                    @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input name="new_password" type="password" class="form-control {{ validation_class($errors->has('new_password')) }}" id="new_password" required>
                    @error('new_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Verify</label>
                    <input name="new_password_confirmation" type="password" class="form-control" id="password_confirmation" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg float-right">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection