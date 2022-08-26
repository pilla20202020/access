$('#country_id').on('change', function(e) {
    e.preventDefault();
    var country_id = $(this).val();
    var body = "";
    $.ajax({
        type: 'POST',
        url: provincesByCountryId,
        data: {
            _token: $("meta[name='csrf-token']").attr('content'),
            country_id: country_id,
        },
        success: function(response) {
            // if(typeof(response) != "object"){
            //     response = JSON.parse(response);
            // }
            $('#province_id').html('');
            $('#district_id').html('');
            body = '<option value="" selected disabled>Select Province</option>';
            if (response.states) {
                $.each(response.states, function(key, state) {
                    body += "<option value='" + state['id'] + "'>" + state['state_name'] + "</option>";
                });
                $('#province_id').html(body);
            }
        }
    })
})


$('#province_id').on('change', function(e) {
    e.preventDefault();
    var state_id = $(this).val();
    var body = "";
    $.ajax({
        type: 'POST',
        url: districtByProvinceId,
        data: {
            _token: $("meta[name='csrf-token']").attr('content'),
            state_id: state_id,
        },
        success: function(response) {
            $('#district_id').html('');
            body = '<option value="" selected disabled>Select District</option>';
            if (response.districts) {
                console.log(response.districts);
                $.each(response.districts, function(key, district) {
                    body += "<option value='" + district['id'] + "'>" + district['district_name'] + "</option>";
                });
                $('#district_id').html(body);
            }
        }
    })
})
