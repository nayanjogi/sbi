<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	<!--</div>

	<div id="footer" role="contentinfo">
		<div id="colophon">
-->
<?php 
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

			<!--<div id="site-info">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div>

			<div id="site-generator">
				<?php do_action( 'twentyten_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyten' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyten' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s.', 'twentyten' ), 'WordPress' ); ?></a>
			</div>

		</div>
	</div>

</div>-->
</section>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
	<!--<footer>
    	<div class="clearfix footer">
    	<span class="copyright">&copy; SBI Pension Funds Pvt. Ltd. 2013. All rights reserved.</span>
        <div class="footer-menu">
		<a href="#">Home</a>    |    <a href="#">About us</a>    |    <a href="#">National Pension System</a>    |    <a href="#">Subscribers Gallery</a>    |   <a href="#">NPS Links</a>    |    <a href="#">Useful Links</a>     |    <a href="#">Contact us</a>
        </div>
    </div>
    </footer>-->
</div>
</section>
</body>
</html>
<?php exit; ?>