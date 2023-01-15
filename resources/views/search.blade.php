@extends('layouts.app')
@section('title', 'Search')

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card @if (isset($results)) w-full m-5 @else w-500 @endif">
            @if (!isset($results))
                <h2 class="card-title">
                    <span class="card-icon">
                        <i class="fa fa-search fa-fw"></i>
                    <span>
                    Search
                </h2>
                <hr/>
                <form method="POST" class="mt-2" action="{{ route('search.handle') }}">
                    @csrf
                    <label for="query">Query</label>
                    <input name="query" id="query" type="text" class="form-control" placeholder="Company ID or Name" />

                    <button type="submit" class="btn btn-dark mt-1">Search</button>
                </form>
            @else
                <h2 class="card-title">
                    Results for '{{ $query }}'
                </h2>
                <hr/>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Number</th>
                                <th scope="col">Status</th>
                                <th scope="col">SIC</th>
                                <th scope="col">Type</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($results) == 0)
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No Results Found
                                    </td>
                                </tr>
                            @else
                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $result->get('company_name') }}</td>
                                        <td>{{ $result->get('company_number') }}</td>
                                        <td>{{ $result->get('company_status') }}</td>
                                        <td>{{ implode(', ', $result->get('sic_codes')) }}</td>
                                        <td>{{ $result->get('type') }}</td>
                                        <td class="text-right">
                                            <a data-tooltip="View {{ $result->get('company_name') }}" class="btn btn-dark btn-sm" href="{{ route('company', $result->get('company_number')) }}">
                                                <i class="fa fa-eye fa-fw"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
