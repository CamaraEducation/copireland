<?php get_header();?>
<?php
if (have_posts()) {
 while (have_posts()) {
   the_post();
   the_content();
 }
}
?>

<?php 
// add_action( 'loop_start', 'shortcode_before_entry' );
 
// function shortcode_before_entry() {
 
//     if ( ! is_singular( 'post' )  ) {
//         return;
//     }
 
//     echo do_shortcode('[ultimatemember form_id="7"]');
     
// }

//echo do_shortcode( '[ultimatemember form_id="7"]' ); ?>

<?php// add_filter('[ultimatemember form_id="7"]', 'do_shortcode'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php wp_head(); ?>
</head>
<body>
    <?php echo do_shortcode('[ultimatemember form_id="7"]'); ?>
</body>
</html>
<?php get_footer();?>