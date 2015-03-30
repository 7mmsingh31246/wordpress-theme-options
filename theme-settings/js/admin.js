jQuery(document).ready(function($) { 
	var btntoggle = jQuery('.input_title .btn-toggle');
    btntoggle.click(function() {
		var parent = $(this).closest('.input_section');
		var target = parent.find('.input_content');
		var offset = parent.offset();
		var _open = $(parent).hasClass('open');
		if(_open){
			$(parent).addClass('close').removeClass('open');
		}else{
			$(parent).addClass('open').removeClass('close');
		} 
		if(offset){
			$("body,html").animate({scrollTop:offset.top-40},400)
		}
		
    });
	 $('.btn-delete').live('click',function() {
		var input = $(this).data('input');
		$(input).val('');
		$(this).closest('.theme_options_img').empty();
		return false;  
	 });
	 $('.reset-option').live('click',function() {
		var input = $(this).data('input');
		var value = $(this).data('value');
		$(input).val(value);
		return false;  
	 });
	 $('.field-type-select').live('change',function() {	
	 	var row=$(this).closest(".field-row");
		if($(this).val()=='multicheck' || $(this).val()=='select' || $(this).val()=='radio'){
			row.find(".field-options").show();
		}else{
			row.find(".field-options").hide();
		}
	 });
	 $('#add-optionset').live('click',function() {	
	 	 var clone = $("tr.optionset:last").clone();
		 $("#optionset_table").append(clone);
		  $("#optionset_table tr:last input").val('');
		  $("#optionset_table tr:last select").val('');
		  $("#optionset_table tr:last textarea").val('');
	 });
	 $('.delete-option-group').live('click',function() {	
	 	 var row = $(this).closest("tr.optionset").remove();
	 });
	 
	 var fieldsetkey = $("tr.fieldset:last").data('key');
	 $('#add-fieldset').live('click',function() {	
	 	 var clone = $("tr.fieldset:last").clone();
		 clone.find(".form-control").each(function(index, element) {
            oldname = $(this).attr('name');
            newname = oldname.replace('theme_fieldset['+fieldsetkey+']','theme_fieldset['+(fieldsetkey+1)+']');
		  	$(this).val('')
		  	$(this).attr('name',newname); 
        }); 		
		fieldsetkey++;
		 $("#optionset_table").append(clone);
	 });
	 $('.delete-fieldset').live('click',function() {	
	 	 var row = $(this).closest("tr.fieldset").remove();
	 });
});