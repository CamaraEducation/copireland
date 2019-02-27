<?php
/**
*@package Techspace
*/
get_template_part( 'content', 'profile' );

get_header(); ?>

<?php
    // require_once(dirname(__FILE__) . '/wp-config.php');
    // $wp->init();
    // $wp->parse_request();
    // $wp->query_posts();
    // $wp->register_globals();
    // $wp->send_headers();

    // echo site_url();
    echo  "yared prifle";
?>
	<!-- section -->
  <?php  echo do_shortcode( '[ultimatemember form_id="9"]' ); ?>

<?php get_footer(); ?>