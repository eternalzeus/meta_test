@extends('layout.layout_sidebar')
@section('content')
{{ Breadcrumbs::render('new_city') }}
<div class="card-body">
    <form action="/new_city/{{$country->id}}" method="POST" id="upload_form">
        @csrf
        <h2> Add new city for {{$country->country_name}} </h2> 
        <br>
        <div class="mb-3">
            <h6>City</h6>
            <input type="text" class="form-control" name="new_city" placeholder="New City">
        </div>
        <div class="mb-3">
            <h6>District</h6>
            <input type="text" class="form-control" name="new_district" placeholder="New District">
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection