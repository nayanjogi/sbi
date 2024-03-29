<?php
/*
Plugin Name: WP Awesome FAQ
Plugin URI: http://h2cweb.net
Description:Accordion based awesome WordPress FAQ.
Version: 1.3
Author: Liton Arefin
Author URI: http://www.h2cweb.net
License: GPL2
http://www.gnu.org/licenses/gpl-2.0.html
*/

//Custom FAQ Post Type
function h2cweb_faq() {
    $labels = array(
        'name'               => _x( 'FAQ', 'post type general name' ),
        'singular_name'      => _x( 'FAQ', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'book' ),
        'add_new_item'       => __( 'Add New FAQ' ),
        'edit_item'          => __( 'Edit FAQ' ),
        'new_item'           => __( 'New FAQ Items' ),
        'all_items'          => __( 'All FAQ\'s' ),
        'view_item'          => __( 'View FAQ' ),
        'search_items'       => __( 'Search FAQ' ),
        'not_found'          => __( 'No FAQ Items found' ),
        'not_found_in_trash' => __( 'No FAQ Items found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'FAQ'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds FAQ specific data',
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'query_var'     => true,
        'rewrite'       => true,
        'capability_type'=> 'post',
        'has_archive'   => true,
        'hierarchical'  => false,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor'),
        'menu_icon' => get_admin_url(). '/images/press-this.png',  // Icon Path
    );

    register_post_type( 'faq', $args );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name'              => _x( 'FAQ Categories', 'taxonomy general name' ),
            'singular_name'     => _x( 'FAQ Category', 'taxonomy singular name' ),
            'search_items'      =>  __( 'Search FAQ Categories' ),
            'all_items'         => __( 'All FAQ Category' ),
            'parent_item'       => __( 'Parent FAQ Category' ),
            'parent_item_colon' => __( 'Parent FAQ Category:' ),
            'edit_item'         => __( 'Edit FAQ Category' ),
            'update_item'       => __( 'Update FAQ Category' ),
            'add_new_item'      => __( 'Add New FAQ Category' ),
            'new_item_name'     => __( 'New FAQ Category Name' ),
            'menu_name'         => __( 'FAQ Category' ),
        );

        register_taxonomy('faq_cat',array('faq'), array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
            'query_var'    => true,
            'rewrite'      => array( 'slug' => 'faq_cat' ),
        ));
}

add_action( 'init', 'h2cweb_faq' );

function h2cweb_scripts(){
     if(!is_admin()){
        wp_register_style('h2cweb-jquery-ui-style',plugins_url('/jquery-ui.css', __FILE__ ));
        wp_enqueue_style('h2cweb-jquery-ui-style');
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_register_script('h2cweb-custom-js', plugins_url('/accordion.js', __FILE__ ), array('jquery-ui-accordion'),true);
        wp_enqueue_script('h2cweb-custom-js');
    }
}
add_action( 'init', 'h2cweb_scripts' );


function h2cweb_accordion_shortcode() {
// Registering the scripts and style


// Getting FAQs from WordPress Awesome FAQ plugin's Custom Post Type questions
$args = array( 'posts_per_page' => 15,  'post_type' => 'faq', 'order'=>"ASC");
$query = new WP_Query( $args );

global $faq;

?>
<div id="accordion">
    <?php if( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post();
        $terms = wp_get_post_terms(get_the_ID(), 'faq_cat' );
        $t = array();
        foreach($terms as $term) $t[] = $term->name;
        echo implode(' ', $t); $t = array();
    ?>

        <h3><a href=""><?php echo get_the_title();?></a></h3><div><?php echo get_the_content();?></div>

    <?php } //end while
} //endif ?>
</div>
<?php
    //Reset the query
wp_reset_query();
wp_reset_postdata();

}
add_shortcode('faq', 'h2cweb_accordion_shortcode');