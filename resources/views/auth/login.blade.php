@extends('layouts.auth.main')

@section('content')
<div class="container py-2">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card border-primary">
                <div class="card-header">
                    <h3 class="mb-0 my-2">Login</h3>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" type="email" value="{{ old('email') }}"
                                    class="form-control {{ validation_class($errors->has('email')) }}" id="email" placeholder="Email" autofocus>
                                @error('email') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input name="password" type="password" class="form-control {{ validation_class($errors->has('password')) }}"
                                    id="password" placeholder="Password">
                                @error('password') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input name="remember" type="checkbox" class="custom-control-input" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mt-4 row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary m-auto d-block">Sign in</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <table class="table table-bordered demo-users-table mt-3">
                <thead class="thead-light">
                    <tr>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="demo-users-body"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.addEventListener('load', function() {
        let users = [
            {
                name: 'admin',
                email: 'admin@lagmah.com',
                password: 'password$$',
                role: 'admin',
            },
            {
                name: 'author',
                email: 'author@lagmah.com',
                password: 'password$$',
                role: 'author',
            },
            {
                name: 'user',
                email: 'user@lagmah.com',
                password: 'password$$',
                role: 'standard',
            },
        ]

        users.forEach((e, index) => {
            $('#demo-users-body').append(`
                <tr>
                    <td>${e.role}</td>
                    <td>${e.email}</td>
                    <td>${e.password}</td>
                    <td class="full-width">
                        <a class="text-danger demo-copy" href="" data-index="${index}">Copy</a>
                    </td>
                </tr>
            `)
        })
        
        $('.demo-copy').on('click', function (event) {
            event.preventDefault()
            const index = $(this).data('index')
            const user = users[index]

            $('#email').val(user.email)
            $('#password').val(user.password)
        })
    })
</script>
@endpush