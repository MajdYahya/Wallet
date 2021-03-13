@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">                                    
                    <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as  $transaction)
                        <tr>
                            <th scope="row">{{ $transaction->id }}</th>
                            <td> {{ $transaction->type }}</td>
                            <td>{{$transaction->amount }}</td>
                            <td>{{$transaction->category->name }}</td>
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
