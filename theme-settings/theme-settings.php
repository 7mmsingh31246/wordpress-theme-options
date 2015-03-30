<?php
class theme_settings{
	public $themename;
	public $prefix;
	public $plugin_url;
	public $template_url;
	public function __construct(){
		
		$this->prefix = '_esp_';
		$this->txtdomain = '_esp_';
		$this->plugin_url = $this->get_plugin_url();
		$this->themename = __( 'Theme Settings' );
		$this->template_url = get_template_directory_uri();
		
		add_action( 'init', array($this,'init') );
		
	    if (is_admin()) {
			add_action( 'admin_init', array($this,'admin_init') );
			add_action( 'admin_menu',  array($this,'add_settings_page') );			
			add_action( 'wp_ajax_theme_options_ajax', array($this,'theme_options_admin_ajax') );
			add_action( 'wp_ajax_nopriv_theme_options_ajax',  array($this,'theme_options_admin_ajax')  );
			add_action( 'wp_ajax_theme_options_set_ajax', array($this,'theme_options_set_ajax') );
			add_action( 'wp_ajax_nopriv_theme_options_set_ajax',  array($this,'theme_options_set_ajax')  );
			add_action( 'wp_ajax_theme_fieldsetset_ajax', array($this,'theme_fieldsetset_ajax') );
			add_action( 'wp_ajax_nopriv_theme_fieldsetset_ajax',  array($this,'theme_fieldsetset_ajax')  );
		}
    }	
	/*---------------------------------------------------
	register settings
	----------------------------------------------------*/
	public function admin_init(){ 
		wp_enqueue_script('media-upload');
		wp_enqueue_style("theme_settings_style", $this->plugin_url."/css/admin.css", false, "1.0", "all");
		wp_enqueue_script("theme_settings_script",$this->plugin_url."/js/admin.js", false, "1.0");
		wp_enqueue_script("theme_settings_admin_ajax",$this->plugin_url."/js/admin-ajax.js", false, "1.0");
		wp_enqueue_script("theme_settings_admin_upload",$this->plugin_url."/js/admin-upload.js", false, "1.0");
	}
	/*---------------------------------------------------
	add settings page to menu
	----------------------------------------------------*/
	public function add_settings_page() {
		add_menu_page( $this->themename , $this->themename , 'manage_options', 'settings',  array($this,'theme_settings_page'),'',59);
		add_submenu_page( 'settings' , 'Manage Fields', 'Manage Fields', 'manage_options', 'manage-fields',array($this,'manage_fields') );
		add_submenu_page( 'settings' , 'Manage Fieldset', 'Manage Fieldset', 'manage_options', 'manage-fieldset',array($this,'manage_fieldset') );
	}
	/*---------------------------------------------------
	Theme Panel Output
	----------------------------------------------------*/
	public function theme_settings_page() {
		
		$$prefix = $this->prefix;
		$themename = $this->themename;
		$theme_options = $this->get_theme_options(); 
		
	  	include dirname(__FILE__). '/admin-display.php'; 
	}
	public function theme_options_set_ajax() {
		check_ajax_referer( 'theme_options_nonce', 'security' );
		$theme_options = $_POST['theme_options_set'];
		$output = update_option( 'theme_options_set' , $theme_options ); 	
		$p = get_option( 'theme_options_set',false);
		pr($p);
		die;
	}
	public function get_plugin_url() {
		$dirpath = dirname(__FILE__);
		$dirpath = str_replace('\\','/',$dirpath);
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		$dir = str_replace($rootpath , '' , $dirpath );
		$host = $_SERVER['HTTP_HOST'];
		$port = $_SERVER['SERVER_PORT'];
		$protocol = $port==443?'https://':'http://';
		$plugin_url = $protocol . $host . '/' .  $dir; 
		return $plugin_url;
	}
	public function init() {
		$prefix = $this->prefix;
		$theme_options = get_option( 'theme_options' , array() );
		foreach($theme_options as $key => $value){	
			$newkey = str_replace($prefix,'',$key);		
			$GLOBALS['theme_options'][$newkey] = $value;  
		}		
	}
	public function manage_fieldset() {
		include dirname(__FILE__). '/manage-fieldset.php'; 
	}
	public function get_theme_fieldset() {
		$theme_options = array(); 
		include ( dirname(__FILE__) . "/options.php"); 
		$theme_fieldset = get_option( 'theme_fieldset' , $theme_options ); 	
		return $theme_fieldset;
	}
	
	public function get_theme_fieldset_names() {
		$fieldset_names = array('select_group'=>'Select Group'); 
		$theme_fieldset = $this->get_theme_fieldset(); 	
		foreach($theme_fieldset as $value){
			$fieldset_names[$value['id']]=$value['name'];
		} 
		return $fieldset_names;
	}
	
	public function theme_fieldsetset_ajax() {
		check_ajax_referer( 'theme_options_nonce', 'security' );
		$theme_fieldset = $_POST['theme_fieldset'];
		$output = update_option( 'theme_fieldset' , $theme_fieldset ); 	
		$p = get_option( 'theme_fieldset',false);
		pr($p);
		die;
	}
	
	public function manage_fields() {
		include dirname(__FILE__). '/manage-fields.php'; 
	}
	public function field_types() {
		$fieldtypes = array('text'=>"Text",'textarea'=>"Textarea",'editor'=>"Text editor",'upload'=>"Upload",'radio'=>"Radio",'checkbox'=>"Checkbox",'multicheck'=>"Multicheck",'select'=>"Select");
		return $fieldtypes;
	}
	public function get_options_fields() {
		$theme_options = array(); 
		$options_set = array();
		include ( dirname(__FILE__) . "/options.php"); 
		foreach($theme_options as $key => $fieldset){
			$sec = $fieldset['id'];
			foreach($fieldset['options'] as $o){ 
				$n = $o;
				$n['fieldset']=$sec;
				$options_set[] = $n;
			}
		}
		$theme_options_set = get_option( 'theme_options_set' , $options_set ); 	 
		return $theme_options_set;
	}
	public function get_theme_options() {  
		$prefix = $this->prefix;
		$theme_options = array(); 
		include dirname(__FILE__). '/options.php'; 
		return $theme_options;
	}
	public function theme_options_admin_ajax() {
		check_ajax_referer( 'theme_options_nonce', 'security' );
		$theme_options = $_POST['theme_options'];
		$output = update_option( 'theme_options' , $theme_options ); 	
		echo $output;
		die;
	}
}
$theme_settings = new theme_settings();