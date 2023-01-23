@extends('layouts.app')
@section('title', 'View Company')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="content">
                    <h1 class="content-title font-size-24">
                        {{ $company->get('company_name') }} ({{ $company->get('jurisdiction') }})
                    </h1>
                    <div class="my-20">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <h2 class="card-title font-size-12">
                                        SIC Codes
                                    </h2>
                                    <div class="card-body">
                                        <ul>
                                            @foreach ($sicCodes as $code)
                                                <li>{{ $code->sic_code }} - {{ $code->description }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <h2 class="card-title font-size-12">
                                        Registered Office Address
                                    </h2>
                                    <div class="card-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Address Line 1</td>
                                                    <td>{{ $registeredAddress->get('address_line_1') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address Line 2</td>
                                                    <td>{{ $registeredAddress->get('address_line_2') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Locality</td>
                                                    <td>{{ $registeredAddress->get('locality') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Region</td>
                                                    <td>{{ $registeredAddress->get('region') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Postal Code</td>
                                                    <td>{{ $registeredAddress->get('postal_code') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
