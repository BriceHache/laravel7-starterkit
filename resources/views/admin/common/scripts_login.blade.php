


<script type="text/javascript">

$(document).ready(function () {
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

    setTimeout(function() {
        $('#notific').remove();
    }, 5000);

});




$(document).on('submit', '.form-validate-level', function(e){

	var error = "";
	$(".number-validate-level").each(function() {
		if(this.value == '' || isNaN(this.value)) {
			$(this).closest(".form-group").addClass('has-error');
			error = "has error";
		}else{
			$(this).closest(".form-group").removeClass('has-error');
		}
	});

	$(".check_reference_id").each(function() {
		if(this.value == '') {
			$("#minmax-error").show();
			error = "has error";
		}else{
			$("#minmax-error").hide();
		}
	});

	if(error=="has error"){
    	return false;
	}
});

//focus form field
$(document).on('keyup', '.number-validate-level', function(e){

	if(this.value == '' || isNaN(this.value)) {
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');
	}

});


//validate form
$(document).on('submit', '.form-validate', function(e){
	var error = "";

    //to validate text field
    $(".field-validate").each(function() {

        if(this.value == '') {
            $(this).closest(".form-group").addClass('has-error');
            //$(this).next(".error-content").removeClass('hidden');
            error = "has error";
        }else{
            $(this).closest(".form-group").removeClass('has-error');
            //$(this).next(".error-content").addClass('hidden');
        }
    });


    $(".required_one").each(function() {
        var checked = $('.required_one:checked').length;
        if(!checked) {
            $(this).closest(".form-group").addClass('has-error');
            error = "has error";
        }else{
            $(this).closest(".form-group").removeClass('has-error');
        }
    });

    $(".number-validate").each(function() {
        if(this.value == '' || isNaN(this.value)) {
            $(this).closest(".form-group").addClass('has-error');
            //$(this).next(".error-content").removeClass('hidden');
            error = "has error";
        }else{
            $(this).closest(".form-group").removeClass('has-error');
            //$(this).next(".error-content").addClass('hidden');
        }
    });

    //
    $(".email-validate").each(function() {
        var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if(this.value != '' && validEmail.test(this.value)) {
            $(this).closest(".form-group").removeClass('has-error');
            //$(this).next(".error-content").addClass('hidden');

        }else{
            $(this).closest(".form-group").addClass('has-error');
            //$(this).next(".error-content").removeClass('hidden');
            error = "has error";
        }
    });

    if(error=="has error"){
        return false;
    }

});

//focus form field
$(document).on('keyup change', '.field-validate', function(e){

	if(this.value == '') {
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');
	}

});

$(document).on('click', '.required_one', function(e){

	var checked = $('.required_one:checked').length;
	if(!checked) {
		$(this).closest(".form-group").addClass('has-error');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
	}

});


//focus form field
$(document).on('keyup', '.number-validate', function(e){

	if(this.value == '' || isNaN(this.value)) {
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');
	}

});

$(document).on('keyup focusout', '.email-validate', function(e){
	var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
	if(this.value != '' && validEmail.test(this.value)) {
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');

	}else{
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
		error = "has error";
	}
});


//show password div
	function validatePasswordForm(){
		var password = document.forms["updateAdminPassword"]["password"].value;
		var re_password = document.forms["updateAdminPassword"]["re_password"].value;
		var err = '';
		if (password == null || password == "" || password.length < 6) {
			  $('#password').closest('.col-sm-10').addClass('has-error');
			  $('#password').focus();
			  err = "@lang('auth.Password must be filled and of more than 6 characters!') \n";
			  $('#password').next('.error-content').html(err).show();
			  return false;
		}else{
			 $('#password').closest('.col-sm-10').removeClass('has-error');
			 $('#password').next('.error-content').hide();

			  if (re_password == null || re_password == '' ) {
					 err  = "@lang('auth.Please re enter password!') \n";
					 document.getElementById("re_password").focus();
					 $('#re_password').parent('.col-sm-10').addClass('has-error');
					 $('#re_password').next('.error-content').html(err).show();
					 return false;
			 }else{
				 if (re_password != password) {
					 err  = "@lang('auth.Both passwords must be matched!') \n";
					 document.getElementById("re_password").focus()
					 $('#re_password').parent('.col-sm-10').addClass('has-error');
					 $('#re_password').next('.error-content').html(err).show();
					return false;
				 }else{
					return true;

				}
			 }
		}
}

$(document).on('click','#change-passowrd', function(){
	if($(this).is(':checked')){
		$('#password').addClass('field-validate');
	}else{
		$('#password').parents('div.form-group').removeClass('has-error');
		$('#password').removeClass('field-validate');
	}
});


// Gestion des  alertes

$("#flash-alert").fadeTo(5000, 500).slideUp(500, function(){
    $("#flash-alert").slideUp(500);
});


</script>
