<?php 
	
	add_action('admin_menu', 'vjshop_admin_actions');
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');	
   

function vjshop_admin_actions()
{
	add_menu_page("NAV Product", "NAV", "edit_posts", "nav_list", "nav_admin", null, null);
	add_submenu_page( "nav_list", "OEMPA Probes", "Add NAV", "edit_posts", "nav_add", "nav_add_admin" ); 
	//add_submenu_page( "nav_list", "Partner Code", "Partner Code", "edit_posts", "partner", "partner_admin" ); 
	//add_submenu_page( "nav_list", "Orders", "Orders", "edit_posts", "order", "order_admin" ); 
//	add_submenu_page( "nav_list", "Email Template", "Email Template", "edit_posts", "email_template", "email_template_admin" ); 
	
}		
function my_admin_scripts() 
{
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', WP_PLUGIN_URL.'/my-script.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}		 
function my_admin_styles() 
{
	wp_enqueue_style('thickbox');
}


function nav_admin()
{
	showVjMessage();
	include("nav_list.php");
} 
function nav_add_admin()
{
	showVjMessage();
	include("nav_add_admin.php");
}

?>