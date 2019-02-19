<?php get_header();?>


	<section class="hero">
		<div class="col-xs-6 col-centered">
			<span><img src=	"<?php echo get_template_directory_uri();  ?>/images/techspacelogo.png" class="img-responsive" width="125" height="125" alt="COP"></span>
		</div>
		<div class="col-xs-6 col-centered" style="padding-left: 12px;">
			<p class="profile-name">Yared -ellen Casey</p>
			<p class="work-title">Project Officer @ Camara</p>
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

	<span class="pathway-title"> LOGIN PAGE </span>
	<hr>





<?php
/*
function list_terms($terms, $count = -1 ) {
$tax_terms = get_terms( $terms, 'orderby=name');
foreach ( $tax_terms as $term ) {
echo '<h2>' . $term->name . '</h2> <ul>';
}
}

list_terms('pathways',3);
*/
?>


<?php get_footer();?>