@extends('layouts.app')
@section('title', 'View Officers')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9">
                <div class="content">
                    <h1 class="content-title font-size-24">
                        Officers
                    </h1>
                    <div class="my-20">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Date of Birth</th>
                                    <th cope="col">Nationality</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($officers->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No officers found for {{ $company->get('company_name') }}
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($officers as $officer)
                                        <tr>
                                            <td>{{ $officer->get('name') }}</td>
                                            <td>{{ $officer->get('officer_role') }}</td>
                                            <td>
                                                @if ($officer->get('date_of_birth') != null)
                                                    {{ $officer->get('date_of_birth')['month'] . '/' . $officer->get('date_of_birth')['year'] }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $officer->get('nationality') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
