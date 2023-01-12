@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="card w-500 position-relative">
        <div class="position-absolute top-0 right-0 z-10 p-10">
            <button class="btn btn-square" type="button" onclick="halfmoon.toggleDarkMode()">
                <i class="fa fa-moon" aria-hidden="true"></i>
                <span class="sr-only">Toggle dark mode</span>
            </button>
        </div>
        <h1 class="card-title">
            <i class="fa fa-home"></i>
            Companies House
        </h1>
        <p class="notice">
            Welcome to the Companies House Registry checker.<br/>
            Please enter a company number to check or utilise the buttons in the navigation bars to expand your options.<br/>
        </p>
    </div>
@endsection