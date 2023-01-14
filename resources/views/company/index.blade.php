@extends('layouts.app')
@section('title', 'View Company')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9">
                <div class="content">
                    <h1 class="content-title font-size-24">
                        {{ $company->get('company_name') }}
                    </h1>
                    <div class="my-20">
                        @dump($company)
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
