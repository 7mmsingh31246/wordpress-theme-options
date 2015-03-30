jQuery(function($) {
	  $('.set_option_image').click(function() {
		var input = $(this).data('input');
		var container = $(this).data('container');
		var send_attachment_bkp = wp.media.editor.send.attachment;
	
		wp.media.editor.send.attachment = function(props, attachment) {
	
			$(input).val(attachment.url);	
			$(container).html('<img src="'+attachment.url+'" /><span class="btn-delete dashicons dashicons-no-alt"></span>');
	
			wp.media.editor.send.attachment = send_attachment_bkp;
		}
	
		wp.media.editor.open();
	
		return false;       
	}); 
});    
