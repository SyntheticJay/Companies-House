@extends('layouts.app')
@section('title', 'Login')

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
                Login
            </h2>
           <div class="card-body">
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required />
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="col m-auto">
                            <a href="{{ route('register') }}">Not a user? Register here</a>
                        </div>
                    </div>
                </form>
           </div>
        </div>
    </div>
@endsection
