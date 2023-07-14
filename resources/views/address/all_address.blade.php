@extends('sidebar.sidebar')
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
                    <a href="/user_address" class="btn btn-secondary float-end" title="User Address">
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
                                        <td>                  
                                        @foreach($cities as $city)
                                            @if ($country->id==$city->country_id)
                                            {{$city->city_name}}
                                            <br>
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
                                                <br>
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
<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>User Addresses</h2>
        </div>
        <div class="card-body">
@foreach($user_addresses as $index => $user_address)
    @if ($user_address->user_id == auth()->id())
        @foreach($countries as $country)
            @if ($user_address->country_id == $country->id)
                {{$country->country_name}},
                @foreach($cities as $city)
                    @if ($user_address->city_id == $city->id)
                        {{$city->city_name}},
                        @foreach($districts as $district)
                            @if ($user_address->district_id == $district->id)
                                {{$district->district_name}},
                                {{$user_address->user_address}}
                                <br>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
@endforeach
</div>
</div>
</div>
@endsection