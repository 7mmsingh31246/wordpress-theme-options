<?php
$theme_fieldset = $this->get_theme_fieldset();
?>

<div class="wrap options_wrap">
  <h2>
    <?php _e( 'Manage Sections' ) //your admin panel title ?>
  </h2>
  <div id="icon-options-general">
    <?php screen_icon(); ?>
  </div>
  <hr>
  <div class="content_options">
    <form method="post" action="<?php echo admin_url("admin-ajax.php"); ?>">
      <input name="action" type="hidden" value="theme_fieldsetset_ajax" />
      <?php wp_nonce_field( 'theme_options_nonce', 'security' ); ?>
      <?php   
	  	//	$theme_options_fields = get_option( 'theme_options_set' , $theme_options_fields );   
			
			?>
      <div class="input_section">
        <div class="input_title">
          <h3>Set Sections Fields</h3>
          <span class="submit">
         	<a href="<?php echo admin_url('admin.php?page=manage-sections&reset=1');?>" class="button">Reset</a>
          <input name="submit" type="button" class="button-primary ajax-submit" value="Save changes" />
          </span> </div>
        <div class="input_content">
          <table id="optionset_table" class="option_table">
            <tr class="option_input option_text">
              <th class="col first">Section Id</th>
              <th class="col">Section Name</th>
              <th class="col">Icon</th>
              <th class="col">Open</th>
              <th class="col last">Action</th>
            </tr>
            <?php
			foreach ($theme_fieldset as $sectionkey => $section) {    
			?>
            <tr class="option_input field-row fieldset" data-key="<?php echo $sectionkey; ?>">
              <td class="col first">
              <input type="text" name="theme_fieldset[<?php echo $sectionkey; ?>][id]" value="<?php echo $section['id'] ?>"  class="form-control" />
               </td>
              <td class="col"><input type="text" name="theme_fieldset[<?php echo $sectionkey; ?>][name]" value="<?php echo $section['name'] ?>"  class="form-control" /></td>
              <td class="col"><input type="text" name="theme_fieldset[<?php echo $sectionkey; ?>][icon]" value="<?php echo $section['icon'] ?>"  class="form-control" /></td>
              <td class="col"><input type="text" name="theme_fieldset[<?php echo $sectionkey; ?>][open]" value="<?php echo $section['open'] ?>"  class="form-control" /></td> 
              <td class="col last"><input type="button" value="Delete" class="button delete-fieldset" /></td>
            </tr>
            <?php } ?>
          </table>
          
        </div>
      </div>
      <div class="all_options">
        <p class="submit">
        
          <input id="add-fieldset" type="button" class="button add-optionset" value="Add New Field" />
          <?php /*?><input name="action" type="submit" value="Reset" class="button" /><?php */?>
        </p>
      </div>
      <div class="footer-credit">
        <p>This theme was made by Wordpress.</p>
      </div>
    </form>
  </div>
</div>
