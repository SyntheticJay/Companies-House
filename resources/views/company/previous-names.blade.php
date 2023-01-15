@extends('layouts.app')
@section('title', 'View Previous Names')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9">
                <div class="content">
                    <h1 class="content-title font-size-24">
                        Previous Names
                    </h1>
                    <div class="my-20">
                       <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Ceased On</th>
                                    <th scope="col">Effective On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($previousNames->count() == 0)
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No previous names found for {{ $company->get('company_name') }}
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($previousNames as $previousName)
                                        <tr>
                                            <td>{{ $previousName->get('name') }}</td>
                                            <td>
                                                @if ($previousName->get('ceased_on') != null)
                                                    {{ $previousName->get('ceased_on') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($previousName->get('effective_from') != null)
                                                    {{ $previousName->get('effective_from') }}
                                                @endif
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
