@extends('layout.layout_user')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Currency Exchange</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Currency Code</th>
                                    <th>Currency Name</th>
                                    <th>Buy</th>
                                    <th>Transfer</th>
                                    <th>Sell</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($currencies as $key => $currency)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{ $currency['CurrencyCode'] }}</td>
                                        <td>{{ $currency['CurrencyName'] }}</td>
                                        <td>{{ $currency['Buy'] }}</td>
                                        <td>{{ $currency['Transfer'] }}</td>
                                        <td>{{ $currency['Sell'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection