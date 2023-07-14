@extends('sidebar.sidebar')
@section('content')
{{ Breadcrumbs::render('edit_city') }}
<div class = "card " >
    <div class="card-header">
      <h2>Edit City</h2>
    </div>
    <div class="card-body">
        <form action="/edit_city/{{$city->id}}" method="POST">
            @csrf
            @method('PUT')  
            <div class="mb-3">
            <textarea class="form-control" name="city_name" >{{$city->city_name}}</textarea>
            @error('city_name')
                <span style="color: red;"> {{$message}} </span>
            @enderror
            </div>
            <button class="btn btn-success ">Update</button>  
        </form>
    </div>
</div>

@endsection