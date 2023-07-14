@extends('sidebar.sidebar')
@section('content')
{{ Breadcrumbs::render('new_city') }}
<div class="container mt-4">
    <div class="row justify-content-center">
    <div class="col-md-12">
        <form action="/new_city" method="POST">
            @csrf
            <h6>Country</h6>
            <div class="form-group mb-3">
                <select id="country_id" class="form-control" name ="country_id">
                <option value="">Select Country</option>
                @foreach($countries as $data)
                    <option value="{{$data->id}}">{{$data->country_name}}</option>
                @endforeach
                </select>
                @error('country_id')
                    <span style="color: red;"> {{$message}} </span>
                @enderror
            </div>
            <div class="mb-3">
                <h6>City</h6>
                <input type="text" class="form-control" name="new_city" placeholder="New City">
                @error('city_name')
                <span style="color: red;"> {{$message}} </span>
            @enderror
            </div>
            <button class="btn btn-success">Submit</button>
        </form>
    </div>
    </div>
</div>
@endsection