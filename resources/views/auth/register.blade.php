@extends('layouts.app')
@section('title', 'Register')

@section('content')
    <div class="container h-500 d-flex justify-content-center align-items-center">
        <div class="card w-400 position-relative">
            <div class="position-absolute top-0 right-0 z-10 p-10">
                <button class="btn btn-square" type="button" onclick="halfmoon.toggleDarkMode()">
                    <i class="fa fa-moon" aria-hidden="true"></i>
                    <span class="sr-only">Toggle dark mode</span>
                </button>
            </div>
            <h2 class="card-title font-size-24">
                Register
            </h2>
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required />
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required />
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required />
                        </div>        
                    </div>
                    <div class="col ml-1">
                        <div class="form-group">
                            <label for="confirm">Confirm Password</label>
                            <input id="confirm" type="password" name="confirm" class="form-control @error('confirm') is-invalid @enderror" required />
                        </div>        
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" />
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <div class="col m-auto">
                        <a href="{{ route('login') }}">Already a user? Log in here</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection