@extends('layouts.app')
@section('title', 'View Accounts')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="content">
                    <h1 class="content-title font-size-24">
                        Accounts
                    </h1>
                    <div class="my-20">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col m-5">
                                        <h3 class="font-size-12">Last Accounts</h3>
                                        @php ($lastAccounts = $accounts->get('last_accounts'))
                                        <table class="table">
                                            <tr>
                                                <td>Overdue</td>
                                                <td>{{ $lastAccounts->get('overdue') ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Due On</td>
                                                <td>{{ $lastAccounts->get('due_on') ?? 'Unknown' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Made Up To</td>
                                                <td>{{ $lastAccounts->get('made_up_to') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td>{{ $lastAccounts->get('type') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Period Start On</td>
                                                <td>{{ $lastAccounts->get('period_start_on') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Period End On</td>
                                                <td>{{ $lastAccounts->get('period_end_on') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col m-5">
                                        <h3 class="font-size-12">Next Accounts</h3>
                                        @php ($nextAccounts = $accounts->get('next_accounts'))
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Overdue</td>
                                                    <td>{{ $nextAccounts->get('overdue') ? 'Yes' : 'No' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Due On</td>
                                                    <td>{{ $nextAccounts->get('due_on') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Period Start On</td>
                                                    <td>{{ $nextAccounts->get('period_start_on') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Period End On</td>
                                                    <td>{{ $nextAccounts->get('period_end_on') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col m-5">
                                        <h3 class="font-size-12">Confirmation Statement</h3>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Overdue</td>
                                                    <td>{{ $confirmation->get('overdue') ? 'Yes' : 'No' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Next Due</td>
                                                    <td>{{ $confirmation->get('next_due') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Last Made Up To</td>
                                                    <td>{{ $confirmation->get('last_made_up_to') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Next Made Up To</td>
                                                    <td>{{ $confirmation->get('next_made_up_to') }}</td>
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
