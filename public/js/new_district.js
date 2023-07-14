$(document).ready(function() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#country_id').change(function(event) {
        console.log(111);
        var idCountry = this.value;
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
                    $('#error_city').html('No city available');
                    $('#city_id').html('');
                }
            }
        })
    });
});