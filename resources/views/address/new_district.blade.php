@extends('layout.layout_sidebar')
@section('content')
{{ Breadcrumbs::render('new_district') }}
<div class="card-body">
    <form action="/new_district/{{$city->id}}" method="POST" id="upload_form">
        @csrf
        <h2> Add new district for {{$city->city_name}} </h2> 
        <br>
        <div class="mb-3">
            <h6>District</h6>
            <input type="text" class="form-control" name="new_district" placeholder="New District">
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection