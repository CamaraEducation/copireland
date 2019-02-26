<?php
/**
*@package Techspace
*/

echo  "yared prifle";

get_header(); ?>

echo "profile page";
<?php
    require_once(dirname(__FILE__) . '/wp-config.php');
    $wp->init();
    $wp->parse_request();
    $wp->query_posts();
    $wp->register_globals();
    $wp->send_headers();

    // Your Wordpress Functions here...
    echo site_url();
?>
	<!-- section -->
  <?php  echo do_shortcode( '[ultimatemember form_id="12"]' ); ?>

<?php get_footer(); ?>