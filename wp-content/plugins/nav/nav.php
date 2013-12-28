<?php  
    /* 
    Plugin Name: nav
    */ 
	//add_shortcode('NAVLIST', 'nav_front');
	add_shortcode('VJORDERINFO', 'vj_order_information');
	add_shortcode('VJORDERCONFIRM', 'vj_order_confirmation');
	add_shortcode('VJORDERTHANK', 'vj_order_thank');
	add_shortcode('VJMYACCOUNT', 'vj_my_account');
	
	session_start();
	
	/* session_destroy();
	 print_r($_SESSION);*/
	include('nav-admin.php');
	
	function vj_add_css()  
    {  
		wp_register_style('vjStyleSheets', WP_PLUGIN_URL . '/vjshop/css/style.css');
        wp_enqueue_style( 'vjStyleSheets');
       
	    wp_register_script('vjScript', WP_PLUGIN_URL . '/vjshop/js/valid.js'); 
		wp_enqueue_script('vjScript' );        
      
    }  
    add_action( 'wp_enqueue_scripts', 'vj_add_css' );  
	
	
	
	function nav_front()
	{	
		showVjMessage();
		include(plugin_dir_path('nav-list.php'));	
	}
	function probes_front()
	{
		showVjMessage();
		include('nav-probes.php');	
	}
	include('nav-function.php');	


?>