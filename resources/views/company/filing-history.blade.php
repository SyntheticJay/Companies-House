@extends('layouts.app')
@section('title', 'View Filing History')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="content">
                <h1 class="content-title font-size-24">
                    Filing History
                </h1>
                <div class="my-20">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Pages</th>
                                <th scope="col">Type</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($filingHistory->count() == 0)
                                <tr>
                                    <td colspan="6" class="text-center">No filing history found.</td>
                                </tr>
                            @else
                                @foreach ($filingHistory as $item)
                                    <tr>
                                        <td>{{ $item->get('category') }}</td>
                                        <td>{{ $item->get('date') }}</td>
                                        <td>{{ $item->get('action_date') }}</td>
                                        <td>{{ $item->get('description') }}</td>
                                        <td>{{ $item->get('pages') }}</td>
                                        <td>{{ $item->get('type') }}</td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-dark btn-sm">
                                                <i class="fa fa-eye fa-fw"></i>
                                            </a>
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
