@extends('layouts.auth.main')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-5">{{ config('app.name') }}</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card border-primary">
                        <div class="card-header">
                            <h3 class="mb-0 my-2">Register</h3>
                        </div>
                        <div class="card-body">
                            <form class="form {{ $errors->any() ? 'is-invalid' : '' }}" method="POST" action="{{ route('register') }}"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-6"> {{-- first name --}}
                                        <input name="first_name" type="text" class="form-control {{ validation_class($errors->has('first_name')) }}"
                                            id="first_name" placeholder="first name" value="{{ old('first_name') }}" required autofocus>
                                        @error('first_name') <span class="invalid-feedback"> {{ $message }} </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6"> {{-- last name --}}
                                        <input name="last_name" type="text" class="form-control {{ validation_class($errors->has('last_name')) }}"
                                            id="last_name" placeholder="last name" value="{{ old('last_name') }}" required>
                                        @error('last_name') <span class="invalid-feedback"> {{ $message }} </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="username">Username</label> {{-- username --}}
                                        <input name="username" type="text" class="form-control {{ validation_class($errors->has('username')) }}"
                                            id="username" placeholder="username" value="{{ old('username') }}" required>
                                        @error('username') <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="email">email</label> {{-- email --}}
                                        <input name="email" type="email" class="form-control {{ validation_class($errors->has('email')) }}" id="email"
                                            placeholder="email@exemple.com" value="{{ old('email') }}" required>
                                        @error('email') <span class="invalid-feedback"> {{ $message }} </span> @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="password">Password</label>
                                        <input id="password" placeholder="password" type="password"
                                            class="form-control {{ validation_class($errors->has('password')) }}" name="password" required>
                                        @error('password') <span class="invalid-feedback" role="alert"> {{ $message }}
                                        </span> @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="password-confirm">Verify</label>
                                        <input id="password-confirm" placeholder="confirm password" type="password"
                                            class="form-control {{ validation_class($errors->has('password')) }}" name="password_confirmation"
                                            required>
                                    </div>

                                    <div class="form-group col-6"> {{-- gender --}}
                                        <label for="gender">Gender</label>
                                        <select class="form-control {{ validation_class($errors->has('gender')) }}" id="gender" name="gender">
                                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group col-6"> {{-- country --}}
                                        <label for="country">Country</label>
                                        <select class="form-control {{ validation_class($errors->has('country')) }}" id="country" name="country">
                                            @foreach (config('blog.country_list') as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group col-12"> {{-- choose profile image --}}
                                        <div class="custom-file my-3">
                                            <input type="file" name="profile_image"
                                                class="custom-file-input {{ validation_class($errors->has('profile_image')) }}" id="profile_image"
                                                required>
                                            <label class="custom-file-label" for="profile_image">Choose image...</label>
                                            @error('profile_image') <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary m-0 shadow-none mt-3">Register</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->
@endsection

@push('scripts')
<script>
    window.addEventListener('load', function() {
            $.ajax({
                url: "http://ip-api.com/json",
                type: 'GET',
                crossDomain: true,
                dataType: 'jsonp',
                success: function(response) {
                    // console.log("My country is: " + json.country);

                    $('#country > option').each(function() {
                        if(response.country == $(this).val()) {
                            $(this).attr('selected', 'selected')
                            return
                        }
                    })
                }
            })
        })
</script>
@endpush