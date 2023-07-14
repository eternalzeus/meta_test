jQuery(document).ready(function() {
    console.log("{{ csrf_token() }}");
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#country_id').change(function(event) {
        var idCountry = this.value;
        var errorCity = 'No city available';
        $.ajax({
            url: "/fetch-city",
            type: 'POST',
            dataType: 'json',
            data: {country_id: idCountry, _token: token},
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
                    console.log(response);
                    $('#error_city').html(errorCity);
                    $('#city_id').html('');
                    $('#district_id').html('');
                }
            }
        })
    });
    $('#city_id').change(function(event) {
        var idCity  = this.value;
        var errorDistrict = 'No district available';
        $('#district_id').html('');
        $.ajax({
            url: "/fetch-district",
            type: 'POST',
            dataType: 'json',
            data: {city_id: idCity, _token:token },
            success:function(response){
                if(response.status == 200){
                    $('#district_id').html('<option value="">Select district</option>');
                    $.each(response.districts,function(index, val){
                    $('#district_id').append('<option value="'+val.id+'"> '+val.district_name+' </option>')
                    });
                }
                else {
                    $('#error_district').html(errorDistrict);
                    $('#district_id').html('');
                }
            }
        })
    });
});