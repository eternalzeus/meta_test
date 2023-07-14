@extends('sidebar.sidebar')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>All Districts</h2>
                </div>
                <div class="card-body">
                    <a href="/new_district" class="btn btn-success" title="New Address">
                        <i class="fa fa-plus" aria-hidden="true"></i> New District
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
                                    <th>Action</th>                                               
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
                                                    <a href="/edit_district/{{$district->id}}" title="Edit Post"><button class="btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                    <a href="" title="View Post"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View</button></a>
                                                    <form method="POST" action="/delete_district/{{$district->id}}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Post" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                    </form>
                                                        <br>
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