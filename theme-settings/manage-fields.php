<?php
if($_GET['reset'] && $_GET['reset']==1){	
	delete_option( 'theme_options_set');	
}
$fieldtypes = $this->get_field_types();
$fields = $this->get_options_fields();
?>

<div class="wrap options_wrap">
  <h2>
    <?php _e( 'Manage Options Fields', $this->txtdomain ); ?>
  </h2>
  <div id="icon-options-general">
    <?php screen_icon(); ?>
  </div>
  <hr>
  <div class="content_options">
    <form method="post" action="<?php echo admin_url("admin-ajax.php"); ?>">
      <input name="action" type="hidden" value="theme_options_set_ajax" />
      <?php wp_nonce_field( 'theme_options_nonce', 'security' ); ?>
      <?php     
			?>
      <div class="input_section">
        <div class="input_title">
          <h3><?php _e( 'Set Options Fields', $this->txtdomain ); ?></h3>
          <span class="submit">
         	<a href="<?php echo admin_url('admin.php?page=manage-options&reset=1');?>" class="button">Reset</a>
          <input name="submit" type="button" class="button-primary ajax-submit" value="Save changes" />
          </span> </div>
        <div class="input_content">
          <table id="optionset_table" class="option_table">
            <tr class="option_input option_text">
              <th class="col first"><?php _e( 'Option Group', $this->txtdomain ); ?></th>
              <th class="col"><?php _e( 'Option Id', $this->txtdomain ); ?></th>
              <th class="col"><?php _e( 'Option Name', $this->txtdomain ); ?></th>
              <th class="col col-type"><?php _e( 'Option Type', $this->txtdomain ); ?></th>
              <th class="col"><?php _e( 'Default Value', $this->txtdomain ); ?></th>
              <th class="col"><?php _e( 'Description', $this->txtdomain ); ?></th>
              <th class="col last"><?php _e( 'Action', $this->txtdomain ); ?></th>
            </tr>
            <?php
			foreach ($fields as $optionkey => $field) {    
			?>
            <tr class="option_input field-row optionset">
              <td class="col first">
              <select name="theme_options_set[<?php echo $optionkey; ?>][section]" class="field-section-select">
              <?php
			   foreach($this->get_theme_fieldset_names() as $fieldsetkey => $fieldsetvalue){?>
              <option  value="<?php echo $fieldsetkey ?>" <?php selected( $field['fieldset'] , $fieldsetkey ); ?>><?php echo $fieldsetvalue ?></option>
              <?php } ?>
              </select></td>
              <td class="col"><input type="text" name="theme_options_set[<?php echo $optionkey; ?>][id]" value="<?php echo $field['id'] ?>"  class="form-control" /></td>
              <td class="col"><input type="text" name="theme_options_set[<?php echo $optionkey; ?>][name]" value="<?php echo $field['name'] ?>" class="form-control"  /></td>
              <td class="col col-type">
              <select class="field-type-select" name="theme_options_set[<?php echo $optionkey; ?>][type]">
              <?php foreach($fieldtypes as $fieldtypekey => $fieldtypevalue){?>
              <option  value="<?php echo $fieldtypekey ?>" <?php selected( $field['type'] , $fieldtypekey ); ?>><?php echo $fieldtypevalue ?></option>
              <?php } ?>
              </select>
              </td>
              <td class="col">
              <input type="text" name="theme_options_set[<?php echo $optionkey; ?>][std]" value="<?php echo $fields['std'] ?>" class="form-control" />
              <?php
              	
				if($field['type']=='multicheck' || $field['type']=='select' || $field['type']=='radio'){
					$style = '';
				}else{
					$style = 'style="display:none;"';
				}
			  ?>
              <p class="field-options" <?php echo $style; ?>>
              <textarea name="theme_options_set[<?php echo $optionkey; ?>][options]" class="form-control"><?php echo $fields['options'] ?></textarea>
              </p>
              </td>
              <td class="col"><input type="text" name="theme_options_set[<?php echo $optionkey; ?>][desc]"  value="<?php echo $field['desc'] ?>"class="form-control" /></td> 
              <td class="col last"><input type="button" value="Delete" class="button delete-option-group" /></td>
            </tr>
            <?php } ?>
          </table>
          
        </div>
      </div>
      <div class="all_options">
        <p class="submit">
        
          <input id="add-optionset" type="button" class="button add-optionset" value="Add New Field" />
          <?php /*?><input name="action" type="submit" value="Reset" class="button" /><?php */?>
        </p>
      </div>
      <div class="footer-credit">
        <p>This theme was made by Wordpress.</p>
      </div>
    </form>
  </div>
</div>
