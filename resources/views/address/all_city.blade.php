@extends('sidebar.sidebar')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>All Cities</h2>
                </div>
                <div class="card-body">
                    <a href="/new_city" class="btn btn-success" title="New City">
                        <i class="fa fa-plus" aria-hidden="true"></i> New City
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
                                            <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($cities as $city)
                                            @if ($country->id==$city->country_id)
                                                    <a href="/edit_city/{{$city->id}}" title="Edit City"><button class="btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                    <a href="" title="View City"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View</button></a>
                                                    <form method="POST" action="/delete_city/{{$city->id}}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete City" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                    </form>
                                                    <br>
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
@endsection