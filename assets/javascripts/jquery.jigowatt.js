jQuery(document).ready(function(){

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Comment or uncomment the result you want.
	// Currently, shake on error is enabled.
	// When a field is left blank, jQuery will shake the form

	/* Begin config */

	//	var shake = "Yes";
		var shake = "No";

	/* End config */


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////// Do not touch below /////////////////////////////////////////

	$('#message').hide();

	// Add validation parts
	$('#input[type=text], #input[type=number],#input[type=date], #input[type=password], #input[type=url], #input[type=tel], #select, #textarea').each(function(){
		$(this).after('<mark class="validate"></mark>');
	});

	// Validate as you type
	$('#name,#email, #comments, #subject,#horario,#fecha,#actividad,#time,#tipoevento,#jerarquia,#idref,#idzonaref0,#ubicacioneditorial,#nombreeditorial').focusout(function() {
		if (!$(this).val())
			$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
		else
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
	});
	$('#dni').focusout(function() {
		if (!$(this).val() || !isDni($(this).val()))
			$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
		else
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
	});
	$('#codigo').focusout(function() {
		if (!$(this).val() || !iscodigo($(this).val()))
			$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
		else
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
	});
	$('#number').focusout(function() {
		if (!$(this).val() || !isNumeric($(this).val()))
			$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
		else
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
	});
        $('#cap').focusout(function() {
		if (!$(this).val() || !isCap($(this).val()))
			$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
		else
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
	});
        $('#email').focusout(function() {
		if (!$(this).val() || !isEmail($(this).val()))
			$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
		else
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
	});
        $('#time').focusout(function() {
		if (!$(this).val() )
			$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
		else
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
	});
	$('#website').focusout(function() {
		var web = $(this).val();
		if (web && web.indexOf("://") == -1) {
			//$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
			$(this).val('http://' + web);
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
		} else if (web)
			$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
		else
			$(this).removeClass('error').parent().find('mark').removeClass('error').removeClass('valid');
	});

	$('#verify').focusout(function() {
		var verify = $(this).val();
		var verify_box = $(this);
		if (!verify)
			$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
		else {

			// Test verification code via ajax
			$.ajax({
				type: 'POST',
				url: 'classes/ajax_check.php',
				data: { verify: verify },
				async: false,
				success: function( data ) {
					if (data=='success') {
						$(verify_box).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
					} else {
						$(verify_box).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
					}
				}
			});

		}
	});

	$('#submit').click(function() {
		$("#message").slideUp(200,function() {
			$('#message').hide();

			// Kick in Validation
			$('#name, #subject, #phone, #comments, #website, #verify, #dni,#horario,#fecha,#actividad,#time,#tipoevento,#jerarquia,#idref,#idzonaref0,#ubicacioneditorial,#nombreeditorial').triggerHandler("focusout");

			if ($('#contact mark.error').size()>0) {
				if(shake == "Yes") {
					$('#contact').effect('shake', { times:2 }, 75, function(){
						$('#contact input.error:first, #contact textarea.error:first').focus();
					});
				} else $('#contact input.error:first, #contact textarea.error:first').focus();

				return false;
			}

		});
	});

	$('#contactform').submit(function(){

		if ($('#contact mark.error').size()>0) {
			if(shake == "Yes") {
			$('#contact').effect('shake', { times:2 }, 75);
			}
			return false;
		}

		var action = $(this).attr('action');

 		$('#submit')
			.after('<img src="assets/img/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, $('#contactform').serialize(),
			function(data){
				$('#message').html( data );
				$('#message').slideDown();
				$('#contactform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#contactform #submit').removeAttr('disabled');
				if(data.match('success') != null) $('#contactform').slideUp('slow');

			}
		);

		return false;

	});

	function isDni(dni) {

		var pattern = new RegExp(/^[0-9]{8}?$/i);

		return pattern.test(dni);
	}
	function iscodigo(codigo) {

		var pattern = new RegExp(/^[0-9]{9}[a-zA-Z]{1}?$/i);

		return pattern.test(codigo);
	}
        function isCap(numero) {

		var pattern = new RegExp(/^[0-9]{1,2}?$/i);

		return pattern.test(numero);
	}
        function isEmail(emailAddress) {

		var pattern = new RegExp(/^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+?$/i);

		return pattern.test(emailAddress);
	}
	function isNumeric(input) {
    	return (input - 0) == input && input.length > 0;
	}

});