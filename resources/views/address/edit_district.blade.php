@extends('sidebar.sidebar')
@section('content')
{{ Breadcrumbs::render('edit_district') }}
<div class = "card " >
    <div class="card-header">
      <h2>Edit District</h2>
    </div>
    <div class="card-body">
        <form action="/edit_district/{{$district->id}}" method="POST">
            @csrf
            @method('PUT')  
            <div class="mb-3">
            <textarea class="form-control" name="district_name" >{{$district->district_name}}</textarea>
            @error('district_name')
                <span style="color: red;"> {{$message}} </span>
            @enderror
            </div>
            <button class="btn btn-success ">Update</button>  
        </form>
    </div>
</div>

@endsection