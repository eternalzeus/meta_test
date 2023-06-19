@extends('layout.layout_sidebar')
@section('content')
{{ Breadcrumbs::render('new_country') }}
<div class = "card " >
    <div class="card-header">
      <h3>New Country</h3>
    </div>
    <div class="card-body">
      <form action="/new_country" method="POST" id="upload_form">
          @csrf
          <div class="mb-3">
            <h6>Country</h6>
            <input type="text" class="form-control" name="new_country" placeholder="New Country">
          </div>
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
  </div>
@endsection