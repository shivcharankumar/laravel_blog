@extends('layouts.auth')

@section('title', 'Update Profile | Admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/multipal-dropdown.css') }}">
@endsection

@section('content')

    <div class="content-wrappercreat">
        <div class="content">
            <!-- Masked Input -->
            <div class="card card-default">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

             @if (Session::has('alert-success'))
                    <div class="alert alert-success dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success</strong>{{ Session::get('alert-success') }}
                </div>
                @endif
                <div class="card-header">
                    <h2>Update Profile</h2>
                    <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-input-musk" role="button"
                        aria-expanded="false" aria-controls="collapse-input-musk"> </a>
                </div>
                <form action="{{ route('auth.profile.store') }}"method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name',$user ? $user->name:'') }}" class="form-control"
                            placeholder="Name">
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email',$user ? $user->email:'') }}" class="form-control"
                            placeholder="Email">
                    </div>
                    <div class="form-group mb-2">
                        <label>Password</label>
                        <input type="password" name="password" value="" class="form-control"
                            placeholder="Password">
                    </div>
                    <div class="form-group mb-2">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" value=""
                            class="form-control" placeholder="Confirm_Password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
