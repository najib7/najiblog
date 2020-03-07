@extends('layouts.dashboard.master')

@section('title', 'Users')

@section('dashboard-body')

<div class="container-fluid">
    @include('_alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary float-left">Users informations</h3>
            <span class="float-right">
                <a href="{{ route('dashboard.users.create') }}"><i class="far fa-plus-square fa-lg green"></i></a>
            </span>
        </div>
        <div class="card-body">
            <table class="table table-bordered display" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created_at</th>
                        <th>Gestion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->first() }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td class="text-center">
                            <a href=""><i class="fas fa-eye btn-show"></i></a>
                            <a href="{{ route('dashboard.users.edit', $user) }}"><i class="fas fa-user-edit btn-edit"></i></a>
                            <a href="#"><i class="fas fa-trash btn-delete"></i></a>

                            <form action="{{ route('dashboard.users.destroy', $user) }}" style="display: none;" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
