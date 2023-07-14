@extends('sidebar.sidebar')
@section('content')
{{ Breadcrumbs::render('edit_country') }}
<div class = "card " >
    <div class="card-header">
      <h2>Edit Country</h2>
    </div>
    <div class="card-body">
        <form action="/edit_country/{{$country->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')  
            <div class="mb-3">
            <textarea  class="form-control" name="country_name" >{{$country->country_name}}</textarea>
            @error('country_name')
                <span style="color: red;"> {{$message}} </span>
            @enderror
            </div>
            <button class="btn btn-success ">Update</button>  
        </form>
    </div>
</div>

@endsection