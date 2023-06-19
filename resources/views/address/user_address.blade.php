@extends('layout.layout_sidebar')
@section('content')
{{ Breadcrumbs::render('user_address') }}
<div class="container mt-4">
    <div class="row justify-content-center">
    <div class="col-md-12">
        <form action="/save_address/{{auth()->id()}}" method="POST">
            @csrf
            <h6>Country</h6>
            <div class="form-group mb-3">
                <select id="country_id" class="form-control" name ="country_id">
                <option value="">Select Country</option>
                @foreach($counteries as $data)
                    <option value="{{$data->id}}">{{$data->country_name}}</option>
                @endforeach
                </select>
                @error('country_id')
                    <span style="color: red;"> {{$message}} </span>
                @enderror
            </div>
            <h6>City</h6>
            <div class="form-group mb-3" >
                <select id="city_id" class="form-control" name ="city_id"></select>
                <div style="color: red;" id = "error_city" ></div>
                @error('city_id')
                    <span style="color: red;"> {{$message}} </span>
                @enderror
            </div>
            <h6>District</h6>
            <div class="form-group mb-3">
                <select id="district_id" class="form-control" name ="district_id"></select>
                <div style="color: red;" id = "error_district" ></div>
                @error('district_id')
                    <span style="color: red;"> {{$message}} </span>
                @enderror
            </div>
            <h6 >Address</h6>
            <input type="text" class="form-control" name="user_address" placeholder="Your Address">
            @error('user_address')
                <span style="color: red;"> {{$message}} </span>
            @enderror
            <br>
            <button class="btn btn-success">Submit</button>
        </form>
    </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#country_id').change(function(event) {
            var idCountry = this.value;
            $.ajax({
                url: "/fetch-city",
                type: 'POST',
                dataType: 'json',
                data: {country_id: idCountry, _token: "{{ csrf_token() }}"},
                success:function(response){
                    if(response.status == 200){
                        console.log(response);
                        $('#city_id').html('<option value="">Select city</option>');
                        $.each(response.cities,function(index, val){
                        $('#city_id').append('<option value="'+val.id+'"> '+val.city_name+' </option>')
                        });
                        $('#district_id').html('<option value="">Select district</option>');
                        $('#error_city').html('');
                    }
                    else {
                        $('#error_city').html('No city available');
                        $('#city_id').html('No city available');
                        $('#district_id').html('No city available');
                    }
                }
            })
        });
        $('#city_id').change(function(event) {
            var idCity  = this.value;
            $('#district_id').html('');
            $.ajax({
                url: "/fetch-district",
                type: 'POST',
                dataType: 'json',
                data: {city_id: idCity, _token:"{{ csrf_token() }}" },
                success:function(response){
                    if(response.status == 200){
                        $('#district_id').html('<option value="">Select district</option>');
                        $.each(response.districts,function(index, val){
                        $('#district_id').append('<option value="'+val.id+'"> '+val.district_name+' </option>')
                        });
                    }
                    else {
                        $('#error_district').html('No district available');
                        $('#district_id').html('No district available');
                    }
                }
            })
        });
    });
</script>
@endsection