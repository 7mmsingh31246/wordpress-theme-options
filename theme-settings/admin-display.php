<?php
$theme_options = $this->get_theme_options();  
$theme_options_fields = get_option( 'theme_options_set',array() ); 
$theme_option_sections = get_option( 'theme_option_sections',array());
$newoptions_group = array();
foreach($theme_options_fields as $o){
	$newoptions_group[$o['section']]['id'] = $theme_option_sections[$o['section']]['id'];
	$newoptions_group[$o['section']]['name'] = $theme_option_sections[$o['section']]['name'];
	$newoptions_group[$o['section']]['icon'] = $theme_option_sections[$o['section']]['icon'];
	$newoptions_group[$o['section']]['open'] = $theme_option_sections[$o['section']]['open'];
	$newoptions_group[$o['section']]['options'][] = $o;
}
//pr($newoptions_group);die;
?>
<div class="wrap options_wrap">
  <h2>
    <?php _e( ' Theme Options' ) //your admin panel title ?>
  </h2>
  <div id="icon-options-general"><?php screen_icon(); ?></div>
  <hr>
  <div class="content_options">
    <form method="post" action="<?php echo admin_url("admin-ajax.php"); ?>"> 
     	<input name="action" type="hidden" value="theme_options_ajax" /> 
		<?php wp_nonce_field( 'theme_options_nonce', 'security' ); ?>
      <?php   
	  	$theme_options_old = get_option( 'theme_options' , array('not found') ); 
		foreach ($newoptions_group as $section) {
			echo '<div class="input_section '.($section['open']?'open':'close').'">';
			echo ' <div class="input_title">';
			echo '<h3>';
			if(!empty($section['icon'])){
				echo '<img src="'. $section['icon'] . '" alt="">';
			}
			echo $section['name'];
			echo '</h3>';
			echo '<span class="btn-toggle"><span alt="f343" class="up dashicons dashicons-arrow-up-alt2"></span><span alt="f347" class="down dashicons dashicons-arrow-down-alt2"></span></span>';
			echo '<span class="submit">';
   			echo '<input name="submit" type="button" class="button-primary ajax-submit" value="Save changes" />';
    		echo '</span>';
    		echo '</div>';
			
			$options = $section['options'];
			echo '<div class="input_content"><table class="input_table">';
			foreach ($options as $theme_option) {  
						$name = $theme_option['name'];	
						$id = $theme_option['id'];	
						$type = $theme_option['type'];	
						$desc = $theme_option['desc'];	
						$options = $theme_option['options'];
						$default = $theme_option['std'];	
						$placeholder = $theme_option['placeholder'];
						 $value = $theme_options_old[$this->prefix.$id];  
						$default_link = ' <button type="button" class="button reset-option" data-input="#_theme_options_' . $id . '" data-value="' . $default . '">Set Default</button>'; 
						if (empty($value)) { 
							//$value = $theme_option['std']; 
						}
				switch ( $theme_option['type'] ) {	 
						case 'text': ?>
      <tr class="option_input option_text">
        <td class="label"><label for="_theme_options_<?php echo $id; ?>"> <?php echo $name; ?></label></td>
      <td class="field"> <input id="_theme_options_<?php echo $id; ?>" type="<?php echo $type; ?>" name="theme_options[<?php echo $id; ?>]" value="<?php echo $value; ?>" class="form-control form-text" placeholder="<?php echo $placeholder; ?>" /><?php echo $default_link; ?>
        <small><?php echo $desc; ?></small>
        <div class="clearfix"></div>
         </td>
      </tr>
      <?php break;
	  case 'upload': ?>
      <tr class="option_input option_text">
        <td class="label"><label class="form-label" for="_theme_options_<?php echo $id; ?>"> <?php echo $name; ?></label></td>
      <td class="field"> <input id="_theme_options_<?php echo $id; ?>" type="text" name="theme_options[<?php echo $id; ?>]" value="<?php echo $value; ?>" class="form-control form-text" /><button class="set_option_image button" data-input="#_theme_options_<?php echo $id; ?>" data-container="#_theme_options_<?php echo $id; ?>_img">Upload</button><?php echo $default_link; ?>
      <div><span id="_theme_options_<?php echo $id; ?>_img" class="theme_options_img">
      <?php if(!empty($value)){ ?>
     <img src="<?php echo $value; ?>" />
     <span data-input="#_theme_options_<?php echo $id; ?>" class="btn-delete dashicons dashicons-no-alt"></span>
      <?php  } ?></span></div>
        <small><?php echo $desc; ?></small>
        <div class="clearfix"></div>
         </td>
      </tr>
      <?php break;
                                             
                        case 'textarea': ?>
      <tr class="option_input option_textarea">
        <td class="label"><label class="form-label" for="_theme_options_<?php echo $id; ?>"><?php echo $name; ?></label></td>
       <td class="field"><textarea id="_theme_options_<?php echo $id; ?>" name="theme_options[<?php echo $id; ?>]" rows="" cols="" class="form-control form-textarea "><?php echo $value; ?></textarea><?php echo $default_link; ?>
        <small><?php echo $desc; ?></small>
        <div class="clearfix"></div></td>
      </tr>
      <?php break;
                                             
                        case 'wysiwyg': ?>
      <tr class="option_input option_editor">
        <td class="label"><label class="form-label" for="_theme_options_<?php echo $id; ?>"><?php echo $name; ?></label></td>
       <td class="field">
       <?php
					$editor_id = '_theme_options_' . $id;
					$content = $value;
					$settings = array( 'media_buttons' => false );
					if(!empty($theme_option['settings'])){
						$settings = $theme_option['settings']; 
					}
					$settings['textarea_name'] =  'theme_options['.$id.']';
					wp_editor( $content, $editor_id, $settings );
	   ?>
       <?php echo $default_link; ?>
        <small><?php echo $desc; ?></small>
        <div class="clearfix"></div></td>
      </tr>
      <?php break;
						                           
						 case 'select': ?>
      <tr class="option_input option_select">
       <td class="label"><label class="form-label" for="_theme_options_<?php echo $id; ?>"><?php echo $name; ?></label></td>
        <td class="field"><select name="theme_options[<?php echo $id; ?>]" id="_theme_options_<?php echo $id; ?>" class="form-control form-select">
          <?php foreach ($options as $option_key => $option_value) {
                                $selected = ($option_key==$value)?"selected=\"selected\"":''; ?>
          <option <?php echo $selected ?> value="<?php echo $option_key; ?>"><?php echo $option_value; ?></option>
          <?php } ?>
        </select><?php echo $default_link; ?>
        <small><?php echo $desc; ?></small>
        <div class="clearfix"></div></td>
      </tr>
      <?php break;
						  
						 case "checkbox": ?>
      <tr class="option_input option_checkbox">
       <td class="label"> <label class="form-label" for="<?php echo $id; ?>"><?php echo $name; ?></label></td>
        <td class="field">
           <?php 
		  	 $checked = ("on"==$value)?"checked=\"checked\"":''; ?>
               <input id="<?php echo $id; ?>" type="checkbox" name="theme_options[<?php echo $id; ?>]" value="on" <?php echo $checked; ?> class="form-checkbox" /> 
        <small><?php echo $desc; ?></small>
        <div class="clearfix"></div></td>
      </tr>
      <?php break;
	  					case "multicheck" : ?>
      <tr class="option_input option_checkbox">
          <td class="label"><label class="form-label"><?php echo $name; ?></label></td>
          <td class="field"><p>
              <?php foreach ($options as $option_key => $option_value) {
                                $checked = ($option_key==$value)?"checked=\"checked\"":''; ?>
              <label for="<?php echo $id.$option_key; ?>"><?php echo $option_value; ?></label>
              <input id="<?php echo $id.$option_key; ?>" type="checkbox" name="theme_options[<?php echo $id; ?>][]" value="<?php echo $option_key; ?>" <?php echo $checked; ?> class="form-checkbox" />
              <?php } ?>
            </p>
            <small><?php echo $desc; ?></small>
            <div class="clearfix"></div></td>
    </tr>
      <?php break;
	  					case "radio" : ?>
      <tr class="option_input option_checkbox">
          <td class="label"><label class="form-label"><?php echo $name; ?></label></td>
          <td class="field"><p>
              <?php foreach ($options as $option_key => $option_value) {
                                $checked = ($option_key==$value)?"checked=\"checked\"":''; ?>
              <label for="<?php echo $id.$option_key; ?>"><?php echo $option_value; ?></label>
              <input id="<?php echo $id.$option_key; ?>" type="radio" name="theme_options[<?php echo $id; ?>]" value="<?php echo $option_key; ?>" <?php echo $checked; ?> class="form-checkbox" />
              <?php } ?>
            </p>
            <small><?php echo $desc; ?></small>
            <div class="clearfix"></div></td>
    </tr>
      <?php break;
				}
			}
			echo '</table></div>';
			echo '</div>';
		}
	?>
      <div class="all_options"> 
        <p class="submit">
          <?php /*?><input name="action" type="submit" value="Reset" class="button" /><?php */?> 
        </p>
      </div>
      <div class="footer-credit">
        <p>This theme was made by Wordpress.</p>
      </div>
    </form>
  </div>
</div>
