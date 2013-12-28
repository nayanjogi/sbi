<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<?php 
	
	if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
	<!--<div style="float:left;width:150px;">
			<ul class="clearfix">
				<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-251" id="menu-item-251"><a href="http://sbi.webdimensions.co.in/national-pension-system-government/">Govt. Employees</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-250" id="menu-item-250"><a href="http://sbi.webdimensions.co.in/national-pension-system-citizens/">Citizens</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-252" id="menu-item-252"><a href="http://sbi.webdimensions.co.in/national-pension-system-architecture/">Corporates</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-120 current_page_item menu-item-122" id="menu-item-122"><a href="http://sbi.webdimensions.co.in/nps-lite/">NPS Lite</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-123 last" id="menu-item-123"><a href="http://sbi.webdimensions.co.in/nps-tier-ii/">NPS Tier II</a></li>
			</ul>
		</div>-->