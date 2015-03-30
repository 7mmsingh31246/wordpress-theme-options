jQuery(function($) {
	$('.ajax-submit').live('click',function(event) {
					event.preventDefault();
					
					var button = $(this);
					var form = button.closest('form');
					var input_section = button.closest('.input_section');
					$('<span id="ajaxloader" class="ajaxloader">Saving... </span>').insertBefore(button);
					button.attr('disabled','disabled');
					 request = $.ajax({
						type: "POST",
						cache: false,
						url: $(form).attr('action'),
						data: $(form).serialize(),
						timeout: 3000
					});
					// Called on success.
					request.done(function(msg) {
						$("#response-output",form).show().text(msg);
						$("#ajaxloader",form).remove();
						 button.removeAttr('disabled');
					});
					// Called on failure.
					request.fail(function (jqXHR, textStatus, errorThrown){
						  $("#response-output",form).show().text('failed');
						  $("#ajaxloader",form).remove();
						  button.removeAttr('disabled');
						// log the error to the console
						console.error(
							"The following error occurred: " + textStatus, errorThrown
						);
					});
    });
});    