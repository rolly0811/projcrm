
function validate_company(company_name) {
    if(company_name != ""){
		var token = $('#test').val();
        $.ajax({
            method: "POST",
            url: "/check/company",
            data: {company_name: company_name,
				   _token:token}
        })
        .done(function (data) {
			
            var checkresult = $.parseJSON(data); 
            console.log(checkresult.exist);
            if (checkresult.exist == 1) {
                $('#company_validate').html('<span class="badge bg-red"><i class="fa fa-close"></i> Error.</span>');
				$("input[type=submit]").attr('disabled','disabled');
            }
			else{
                $('#company_validate').html('<span class="label label-success"><i class="fa fa-check"></i> Approved</span>');
				$("input[type=submit]").removeAttr('disabled');

            }
        });
    }
}

function validate_manager(manager_id) {
    if(manager_id != ""){
		//var token = $('#test').val();
        $.ajax({
            method: "POST",
            url: "/check/manager",
            data: {manager_id: manager_id}
        })
        .done(function (data) {
			
            var checkresult = $.parseJSON(data); 
            console.log(checkresult.exist);
            if (checkresult.exist == 1) {
                $('#manager_validate').html('<span class="badge bg-red"><i class="fa fa-close"></i> Error.</span>');
				$("input[type=submit]").attr('disabled','disabled');
            }
			else{
                $('#manager_validate').html('<span class="label label-success"><i class="fa fa-check"></i> Approved</span>');
				$("input[type=submit]").removeAttr('disabled');

            }
        });
    }
}


