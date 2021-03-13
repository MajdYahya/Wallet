@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Registered users details </div>

                    <div class="card-body table-responsive py-5">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Birthdate</th>
                                    <th scope="col">Total expences</th>
                                    <th scope="col">Total income</th>
                                    <th scope="col">Registration date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td> {{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td> + {{ $user->phone_code . $user->phone }}</td>
                                        <td>{{ $user->birthday }}</td>
                                        <td>{{ $user->expanses_transactions_count }}</td>
                                        <td>{{ $user->income_transactions_count }}</td>
                                        <td>{{ $user->created_at }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
