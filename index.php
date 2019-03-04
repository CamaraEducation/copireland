<?php get_header();?>


	<section class="hero">

		<?php
if ( is_user_logged_in() ) {
   

?>

		<div class="col-xs-6 col-centered">
			<span>
<?php echo get_avatar($current_user->ID, 64); ?>
</span>
		</div>
		<div class="col-xs-6 col-centered" style="padding-left: 12px;">

			<p class="profile-name"><?php um_fetch_user( get_current_user_id() );
				echo um_user('display_name'); // returns the display name of logged-in user
				?></p>
			<p class="work-title"><?php global $current_user; echo array_shift($current_user->roles); ?> @ Camara</p>

		</div>
		<?php
		} else {
    echo 'Welcome, visitor!';
}
?>
	</section>
	
<!--- PTHWAY NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<!-- Tabs -->
	<div class="container">
		<div class="row">
			<div class="steamtabbednav">
				<div class="tabbednavlinks">
					
			
<?php
$tax_terms = get_terms( 'activity_pathways', 'orderby=id');
//var_dump($tax_terms);
foreach ( $tax_terms as $term ) {

?>
	
	<a href=" <?php echo $term->slug; ?>" class="tabbednavlink" role="button" "<?php echo $currentPathway;?>"> <?php echo $term->name; ?> </a>
<?php
}
?>
	</div>			
			</div>
		</div>
	</div>
	</nav><!-- End PATH WYA NAGIVATION -->

<section>
		<div class="container">
			<h2 class="btitle">STEAM Starter Kit</h2>
			<hr>
		</div>
		
	<?php 
if (have_posts()) {
  while (have_posts()) {
    the_post();
    the_content(); 
  }
} 
?>
	</section>

<hr>






<?php get_footer();?>