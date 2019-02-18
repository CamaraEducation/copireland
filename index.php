<?php get_header();?>


	<section class="hero">
		<div class="col-xs-6 col-centered">
			<span><img src=	"<?php echo get_template_directory_uri();  ?>/images/techspacelogo.png" class="img-responsive" width="125" height="125" alt="COP"></span>
		</div>
		<div class="col-xs-6 col-centered" style="padding-left: 12px;">
			<p class="profile-name">Kerri-ellen Casey</p>
			<p class="work-title">Project Officer @ Camara</p>
		</div>
	</section>
	

<!--- PTHWAY NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">

<a href="" class="btn btn-primary btn-sm" role="button"> STEAM </a>
<a href="" class="btn btn-link btn-sm" role="botton"> Digital Creativity </a>
<a href="" class="btn btn-link btn-sm" role="botton"> Emerging Technologies  </a>
	</nav><!-- End PATH WYA NAGIVATION -->

	<span class="pathway-title"> STEAM </span>
	<hr>

<?php
/**
echo "testingas";

$args = array( 'post_type' => 'activity', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
  the_title();
  echo '<div class="entry-content">';
  the_content();
  echo '</div>';
endwhile;
*/
?>

<?php
/**
* Get posts and group by taxonomy terms.
* @param string $posts Post type to get.
* @param string $terms Taxonomy to group by.
* @param integer $count How many post to show per taxonomy term.
*/

function list_posts_by_term( $posts, $terms, $count = -1 ) {
$tax_terms = get_terms( $terms, 'orderby=name');
foreach ( $tax_terms as $term ) {
echo '<h2>' . $term->name . '</h2> <ul>';

    $args = array(
    'posts_per_page' => $count,
     $terms => $term->slug,
    'post_type' => $posts,
     );
    $tax_terms_posts = get_posts( $args );
    foreach ( $tax_terms_posts as $post ) {
        echo '<li><a href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a></li>';
    }
echo '</ul>';
}
wp_reset_postdata();
}

list_posts_by_term('activity','pathways',3);
?>

<?php

function list_terms($terms, $count = -1 ) {
$tax_terms = get_terms( $terms, 'orderby=name');
foreach ( $tax_terms as $term ) {
echo '<h2>' . $term->name . '</h2> <ul>';
}
}

list_terms('pathways',3);

?>


<?php get_footer();?>