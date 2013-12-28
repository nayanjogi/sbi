<?php 
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/images/fav_logo.png" type="image/x-icon" />
<link rel="stylesheet" type="text/css" media="all" href="<?php //bloginfo( 'stylesheet_url' ); ?>" />
<link type="text/css" rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/main.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/ddimgtooltip.css" />
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/ddimgtooltip.js"></script>
<link type="text/css" rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/extra_page.css" />
<?php if ( $site_description && ( is_home() || is_front_page() ) ){ ?>  
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/general.js"></script>
<?php }
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
//	if ( is_singular() && get_option( 'thread_comments' ) )
	//	wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	//wp_head();
	//define( 'MYPLUGINNAME_PATH', plugin_dir_path(__FILE__) );
?>
</head>

<body <?php body_class(); ?>>
<section id="page">
<div class="wrapper">
    <header id="header" class="clearfix">
        <div class="clearfix"> <div class="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/logo.png" width="400" height="88" alt="" /></a></div>
        <div class="future-right"><div>Find us on :&nbsp;&nbsp;<a target="_blank" href="https://twitter.com/SBILife"><img src="<?php bloginfo( 'template_url' ); ?>/images/twitter-ico.png" width="22" height="22" alt="Twitter" > Twitter</a>&nbsp;&nbsp;&nbsp;
        <a href="https://www.facebook.com/pages/SBI-Pension-Funds-Pvt-Ltd/134605330024090?id=134605330024090&sk=info" target="_blank" ><img src="<?php bloginfo( 'template_url' ); ?>/images/facebook-ico.png" width="22" height="22" alt="Facebook"  >Facebook</a></div></div></div>
    </header> 
	<nav class="main-menu">
	   <?php  wp_nav_menu( array( 'container_class' => 'clearfix') ); ?>
       <!-- <ul class="clearfix">
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">National Pension System</a></li>
            <li><a href="#">Subscribers Gallery</a></li>
            <li><a href="#">NPS Links</a>
            	<ul class="clearfix">
                	<li><a href="#">PFRDA</a></li>
                    <li><a href="#">CRA</a></li>
                    <li class="last"><a href="#">POP</a></li>
                </ul>
            </li>
            <li><a href="#">Useful Links</a></li>
            <li class="last"><a href="#">Contact us</a></li>
        </ul>-->
    </nav>
<?php if ( $site_description && ( is_home() || is_front_page() ) ){ ?>  
<div><?php echo (do_shortcode("[horizontal-scrolling]")); ?></div>
  <div id="demos" class="homeslider">
        <div class="controls"> <a href="#" id="prev">Prev</a> <a href="#" id="next">Next</a> </div>
       
        <ul id="slideshow" class="pics">
<?php        if ( function_exists( 'useful_banner_manager_banners_rotation' ) ) { useful_banner_manager_banners_rotation( '1', 1, 1000, 290, 'rand' ); } ?>
          <!--  <li><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/banner1.png" width="1000" height="321" alt="" /></a></li>
            <li><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/banner2.png" width="1000" height="321" alt="" /></a></li>
            <li><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/banner1.png" width="1000" height="321" alt="" /></a></li>
            <li><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/banner2.png" width="1000" height="321" alt="" /></a></li>-->
        </ul>
    </div>
<?php } ?>	
    <section class="container">