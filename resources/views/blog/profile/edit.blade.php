@extends('layouts.blog.main')


@section('content')
<div class="card">
    <div class="card-header">
        Edit {{ $user->username }}
    </div>

    <div class="card-body">
        <form action="{{ route('profile.update', $user) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First name</label>
                    <input name="first_name" type="text" value="{{ old('first_name') ?? $user->profile->first_name }}"
                        class="form-control {{ validation_class($errors->has('first_name')) }}" id="first_name" placeholder="First name">
                    @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="last_name">Last name</label>
                    <input name="last_name" type="text" value="{{ old('last_name') ?? $user->profile->last_name }}"
                        class="form-control {{ validation_class($errors->has('last_name')) }}" id="last_name" placeholder="Last name">
                    @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input name="username" type="text" value="{{ old('username') ?? $user->username }}"
                        class="form-control {{ validation_class($errors->has('username')) }}" id="username" placeholder="Username">
                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input name="email" type="text" value="{{ old('email') ?? $user->email }}"
                        class="form-control {{ validation_class($errors->has('email')) }}" id="email" placeholder="Email">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="country">Country</label>
                    <select class="form-control {{ validation_class($errors->has('country')) }}" id="country" name="country">
                        @foreach (config('blog.country_list') as $country)
                        <option value="{{ $country }}"
                            {{ old('country') == $country || ($user->profile->country == $country && !old('country')) ? 'selected' : '' }}>
                            {{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="phone">Phone</label>
                    <input name="phone" type="text" value="{{ old('phone') ?? $user->profile->phone }}"
                        class="form-control {{ validation_class($errors->has('phone')) }}" id="phone" placeholder="Phone">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="date_of_birth">Date of birth</label>
                    <input name="date_of_birth" type="date" value="@if(old('date_of_birth')){{ old('date_of_birth') }}@elseif($user->profile->date_of_birth){{ $user->profile->date_of_birth->format('Y-m-d')}}@endif"
                        class="form-control {{ validation_class($errors->has('date_of_birth')) }}" id="date_of_birth">
                    @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about" id="about" cols="30" rows="4" class="form-control"
                    placeholder="about you">{{ old('about') ?? $user->profile->about }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <input type="file" name="profile_image" class="custom-file-input {{ validation_class($errors->has('profile_image')) }}"
                            id="profile_image">
                        <label class="custom-file-label" for="profile_image">Choose image...</label>
                        @error('profile_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="gender">Gender</label>
                    <select class="form-control {{ validation_class($errors->has('gender')) }}" id="gender" name="gender">
                        <option value="male" {{ old('gender') === 'male' || ($user->profile->gender === 'male') ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' || ($user->profile->gender === 'female') ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            @role('admin')
            <div class="form-row danger-color text-white p-4 text-center">
                <div class="form-group offset-md-4 col-md-4">
                    <label for="role">Role</label>
                    <select class="form-control {{ validation_class($errors->has('role')) }}" id="role" name="role">
                        <option>Select role</option>
                        @foreach (Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{ $role->name }}" {{ $user->getRoleNames()->first() === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role') <div class="invalid-feedback text-white">{{ $message }}</div> @enderror
                </div>
            </div>
            @endrole

            <div class="form-row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary d-block w-100 m-0 mt-4 shadow-none">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection