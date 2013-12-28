<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<!--<div id="container" class="one-column">
			<div id="content" role="main">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>
	</article>-->
<?php
get_header(); ?>

		<div id="container" class="one-column">
		 <?php
		$postid = get_the_ID();
		 if ( is_front_page() || $postid =='127' || $postid =='125' ) { ?>

		<?php
		echo '<div id="content" style="float: left; width: auto;" role="main">';

			}else
			{
			?>
			<div id="side-bar-menu" class="side-bar-menu" style="float: left; width: 211px;">

		</div>

			 <?php

				echo '<div id="content" style="float: left; width: 779px;" role="main">';
			}
           ?>
			<?php

//$mmm = wp_get_nav_menus( array('orderby' => 'name') );echo "<pre>";print_r($mmm);exit;

			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
		$postid = get_the_ID();
			 the_content();
//			if($postid == 165)
//			{
//				include('nav_list.php');
//			}else if($postid == 162)
//			{
//				include('nav_latest.php');
//			}else{
//			 	the_content();
//			}
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
