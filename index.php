<?php get_header();?>


	<section class="hero">
		<div class="col-xs-6 col-centered">
			<span><img src=	"<?php echo get_template_directory_uri();  ?>/images/techspacelogo.png" class="img-responsive" width="125" height="125" alt="COP"></span>
		</div>
		<div class="col-xs-6 col-centered" style="padding-left: 12px;">
			<p class="profile-name"><?php um_fetch_user( get_current_user_id() );
				echo um_user('display_name'); // returns the display name of logged-in user
				?></p>
			<p class="work-title"><?php global $current_user; echo array_shift($current_user->roles); ?> @ Camara</p>
		</div>
	</section>
	

<!--- PTHWAY NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<?php
$tax_terms = get_terms( 'pathways', 'orderby=id');
foreach ( $tax_terms as $term ) {
	?>
	<a href="" class="btn btn-link btn-sm" role="button"> <?php echo $term->name; ?> </a>
<?php
}
?>
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
// global $current_user;
// get_currentuserinfo();

// echo get_avatar($current_user->ID, 64);
// ?>
<?php //um_fetch_user( get_current_user_id() );
// echo um_user('display_name'); // returns the display name of logged-in user
?>

<?php
echo "<br>";
// Get all users with role Project Officers.
$user_query_po = new WP_User_Query( array( 'role' => 'um_project-officers' ) );
// Get the total number of users for the current query. I use (int) only for sanitize.
$users_count_po = (int) $user_query_po->get_total();
// Echo a string and the value
$string = $users_count_po .'   Project Officers';
echo $string;
echo "<br>";
//======================================================
// Get all users with role Cluster Coordinators.
$user_query_cc = new WP_User_Query( array( 'role' => 'um_cluster-coordinators' ) );
// Get the total number of users for the current query. I use (int) only for sanitize.
$users_count_cc = (int) $user_query_cc->get_total();
// Echo a string and the value
echo $users_count_cc .'   Cluster Coordinators';
echo "<br>";
//======================================================
// Get all users with role Digital Youth Work Experts.
$user_query_dy = new WP_User_Query( array( 'role' => 'um_digital-youth-work-experts' ) );
// Get the total number of users for the current query. I use (int) only for sanitize.
$users_count_dy = (int) $user_query_dy->get_total();
// Echo a string and the value
echo $users_count_dy .'   Digital Youth Work Experts';
echo "<br>";
//======================================================
// Get all users with role Community Contributors.
$user_query_ccs = new WP_User_Query( array( 'role' => 'um_community-contributors' ) );
// Get the total number of users for the current query. I use (int) only for sanitize.
$users_count_ccs = (int) $user_query_ccs->get_total();
// Echo a string and the value
echo $users_count_ccs .'   Community Contributors';
echo "<br>";
echo "<br>";
//======================================================
/**
*um_community-contributors, um_cluster-coordinators, um_digital-youth-work-experts, C
*/
?>
<?php echo 'Number of posts published by user: ' . $cash = count_user_posts( $current_user->ID ); 
// $cash = count_user_posts( $current_user->ID;
echo "<br>";
if($cash >=0 && $cash <=5){
	echo "1 star";
}
elseif($cash >=6 && $cash <=10){
	echo "2 start";
}
elseif($cash >=11 && $cash <=15){
	echo "3 start";
}
elseif($cash >=16 && $cash <=20){
	echo "4 start";
}
elseif($cash >=21 && $cash <=25) {
	echo "5 start";
}
// else($cash >=26 &&$cash  <=30) {
// 	echo "5 start";
// }
// endif

?>
<?php get_footer();?>