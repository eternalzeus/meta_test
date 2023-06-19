@extends('layout.layout_sidebar')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>All Addresses</h2>
                </div>
                <div class="card-body">
                    <a href="/new_country" class="btn btn-success" title="New Address">
                        <i class="fa fa-plus" aria-hidden="true"></i> New Country
                    </a>
                    <a href="/user_address" style="float: right" class="btn btn-secondary float-end" title="User Address">
                        <i class="fa fa-plus" aria-hidden="true"></i> User Address
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Country</th>
                                    <th>City</th>                           
                                    <th>District</th>                                               
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($countries as $index => $country)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $country->country_name }}
                                        <a href="/new_city/{{$country->id}}" title="New City"><button class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> New City</button></a></td>
                                    <td>
                                        @foreach($cities as $city)
                                            @if ($country->id==$city->country_id)
                                            {{$city->city_name}}
                                            <a href="/new_district/{{$city->id}}" title="New District"><button class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> New District</button></a>
                                                @foreach ($districts as $district)                                                 
                                                    @if ($district->city_id==$city->id)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($cities as $city)
                                            @if ($country->id==$city->country_id)
                                                 @foreach ($districts as $district)                                                 
                                                    @if ($district->city_id==$city->id)
                                                        {{$district->district_name}}
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
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