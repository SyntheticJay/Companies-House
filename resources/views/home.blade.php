@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="card w-500 h-300">
        <h1 class="card-title">
            <i class="fa fa-home"></i>
            Companies House
        </h1>

        <p class="notice">
            Welcome to the Companies House Registry checker.<br/>
            Please enter a company number to check or utilise the buttons in the navigation bars to expand your options.<br/>
        </p>

        <form method="POST" class="mt-3">
            <div class="row">
                <div class="col mr-1">
                    <div class="form-group">
                        <label for="companyID">Company ID</label>
                        <input type="text" class="form-control" id="companyID" name="companyID" placeholder="Enter Company ID">
                    </div>
                </div>
                <div class="col my-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
@endsection