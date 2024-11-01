<?php 
/*
Plugin Name: Lead Generation Plugin
Plugin URI: http://www.sandigital.net/rsimplepl_plugin/
Description: Really Simple WordPress Lead Capture Plugin. While editing post, you can add form with this plugin to capture information.  
Version: 1.2
Author: SANDIGITAL, LLC.
Author URI: http://www.sandigital.net/rsimplepl_plugin/
*/


class LeadGeneration{
	//define vars
	var $pluginName;

	var $pluginPath;
	var $pluginURL;
	var $menuSlug;
	var $pluginScriptURL;
	var $pluginStyleURL;
	var $menuTitle;
	var $capability;
	var $table_name;
	function LeadGeneration(){
		//init vars
		$this->pluginName 			= 'leadGeneration';
		$this->menuSlug 			='leadGeneration';
		$this->pluginPath 			= plugin_dir_path(__FILE__);
		$this->pluginURL 			= plugin_dir_url(__FILE__);
		$this->pluginScriptURL = plugin_dir_url(__FILE__).'js/';
		$this->pluginStyleURL = plugin_dir_url(__FILE__).'css/';
		$this->menuTitle = 'Lead Generation';
		$this->capability 			= 'publish_posts';
		//init
		add_action('init', array(&$this,'init'));

		add_action('wp_ajax_lead_generation_inserdb', array(&$this,'insertDb'));
		add_action('wp_ajax_lead_generation_inserProCode', array(&$this,'insertProCode'));
		
		$this->createDatabaseTable();
		
		//admin
		add_action('admin_menu', array(&$this,'adminMenu'));
		add_action('admin_enqueue_scripts', array(&$this,'adminEnqueueScripts'));
		
		//$this->insertNewRecord('$name' ,'$lastname' ,'$city','$state','$zip','$phone','$fax','$email','$company','$roleOfComp',21,'$website','$freeForm');
	}
	
	function insertProCode() {
		include_once 'insertProCode.php';
		ajax_lead_generation_insertProCode();
		die();
	}
	
	function insertDb() {
		include_once 'insertDB.php';
		ajax_lead_generation_insertDB();
		die();
	}
	
	function insertNewRecord($name ,$lastname ,$city,$state,$zip,$phone,$fax,$email,$company,$roleOfComp,$numOfEmp,$website,$freeForm) {
		global $wpdb;
		$this->table_name = $wpdb->prefix . "eesirik_lead_generation";
		$wpdb->insert( $this->table_name, array(  'name' => $name , 'lastname' => $lastname, 'city' =>$city, 'state' =>$state, 'zip' =>$zip, 'phone' =>$phone, 'fax' =>$fax , 'email' => $email, 'company' =>$company , 'roleOfComp' =>$roleOfComp , 'numOfEmp' =>$numOfEmp ,'website' =>$website,'freeForm' =>$freeForm ) );
	}
	

	function createDatabaseTable() {
		global $wpdb;

		$this->table_name = $wpdb->prefix . "eesirik_lead_generation";
		//if table does not exist
		if($wpdb->get_var("show tables like '$this->table_name'") != $this->table_name) {
			
			$sql = "CREATE TABLE " . $this->table_name . " (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					name VARCHAR(55) ,
					lastname VARCHAR(55) ,
					city VARCHAR(55) ,
					state VARCHAR(55) ,
					zip VARCHAR(55) ,
					phone VARCHAR(55) ,
					fax VARCHAR(55) ,
					email VARCHAR(55) ,
					company VARCHAR(55) ,
					roleOfComp VARCHAR(55) ,
					numOfEmp mediumint(9),
					website VARCHAR(100) ,
					freeForm VARCHAR(350),
					UNIQUE KEY id (id)
					);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);

		}//if

	}
	//init
	function init(){


		//register style
		wp_register_style('bootstrapStyle', $this->pluginStyleURL.'bootstrap.min.css');
		wp_register_style('leadGenStyle', $this->pluginStyleURL.'style.css');
		wp_register_style('jgrowlStyle', $this->pluginURL.'jGrowl-master/jquery.jgrowl.css');

		//register script
		wp_register_script('bootstrap', $this->pluginScriptURL.'bootstrap.min.js');
		wp_register_script('button', $this->pluginScriptURL.'button.js');
		wp_register_script('jgrowl', $this->pluginURL.'jGrowl-master/jquery.jgrowl.js');

		$this->wptuts_buttons();
	}

	function wptuts_buttons() {

		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins",  array(&$this,'add_youtube_tinymce_plugin'));
			add_filter('mce_buttons', array(&$this,'register_youtube_button'));
		}
		
		// init process for button control
		add_filter( 'tiny_mce_version',array(&$this,'my_refresh_mce') );

		
		add_shortcode('leadGenEditorShortCode', array(&$this,'addEditorShortCode'));
	}
	
	// add the shortcode handler for YouTube videos
	function addEditorShortCode($atts, $content = null) {
		
		include_once ('shortcode.php');
		//print $output; // debug
		
		
		//$filestring = (include_once ) ;
		
		$this->loadScript();
		$shortcode = new LeadGenerationShortCode($atts);
		$output = $shortcode->generate();
		
		return $output;
		//return $filestring;
	}
	
	function my_refresh_mce($ver) {
		$ver += 3;
		return $ver;
	}
	

	function register_youtube_button($buttons) {
		array_push($buttons, "|", "youryoutube");
		return $buttons;
	}


	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function add_youtube_tinymce_plugin($plugin_array) {
		include_once 'editorButton.php';
		$plugin_array['youryoutube'] = $this->pluginScriptURL.'/editor_plugin.js';
		return $plugin_array;
	}
	
	
	
	function adminMenu(){
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		
		
		add_menu_page($this->pluginName, $this->menuTitle, $this->capability, $this->menuSlug, array(&$this, 'adminPage'),  $this->pluginURL.'img/lead_generation_mini.gif', null);
		//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );

	}

	function adminPage(){
		//include template
		include($this->pluginPath.'admin.php');
	}

	function adminEnqueueScripts($hook){

		if($hook=='toplevel_page_'.$this->menuSlug){
			//include style
			$this->loadScript();				
		}
	}
	
	function loadScript()  {
		wp_enqueue_style('bootstrapStyle');
		wp_enqueue_style('leadGenStyle');
		wp_enqueue_style('jgrowlStyle');
		
		//include script
		wp_enqueue_script('bootstrap');
		wp_enqueue_script('button');
		wp_enqueue_script('jgrowl');
		
	}
		

}

$leadGen = new LeadGeneration();
?>