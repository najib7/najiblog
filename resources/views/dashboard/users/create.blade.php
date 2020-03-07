@extends('layouts.dashboard.master')

@section('title', 'Create new user')

@section('dashboard-body')

<div class="row">
    <div class="col-md-8 m-auto">
        <div class="card p-4">
            <form action="{{ route('dashboard.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name') }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address"
                        value="{{ old('email') }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                        <option>Select role</option>
                        @foreach (Spatie\Permission\Models\Role::all() as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
