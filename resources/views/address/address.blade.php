@extends('layout.layout_sidebar')
@section('content')
{{ Breadcrumbs::render('address') }}
<div class="container mt-4">
    <div class="row justify-content-center">
    <div class="col-md-12">
        <h2>User Address</h2>
        <br>
        {{-- <form action method="POST"> --}}
            {{-- @csrf --}}
            <div class="form-group mb-3">
                <select id="country-dd" class="form-control">
                <option value="">Select Country</option>
                @foreach($counteries as $data)
                    <option value="{{$data->id}}">{{$data->country_name}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <select id="city-dd" class="form-control"></select>
            </div>
            <div class="form-group mb-3">
                <select id="district-dd" class="form-control"></select>
            </div>
            
        {{-- </form> --}}
    </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
    $('#country-dd').change(function(event) {
        var idCountry = this.value;
        $('#city-dd').html('');

        $.ajax({
        url: "/fetch-city",
        type: 'POST',
        dataType: 'json',
        data: {country_id: idCountry,_token:"{{ csrf_token() }}"},
        success:function(response){
            $('#city-dd').html('<option value="">Select city</option>');
            $.each(response.cities,function(index, val){
            $('#city-dd').append('<option value="'+val.id+'"> '+val.city_name+' </option>')
            });
            $('#district-dd').html('<option value="">Select district</option>');
        }
        })
    });
    $('#city-dd').change(function(event) {
        var idCity  = this.value;
        $('#district-dd').html('');
        $.ajax({
        url: "/fetch-district",
        type: 'POST',
        dataType: 'json',
        data: {city_id: idCity ,_token:"{{ csrf_token() }}"},
        success:function(response){
            $('#district-dd').html('<option value="">Select district</option>');
            $.each(response.districts,function(index, val){
            $('#district-dd').append('<option value="'+val.id+'"> '+val.district_name+' </option>')
            });
        }
        })
    });
    });
</script>
@endsection