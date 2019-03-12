<?php get_header();?>
<?php
function getPostTerms($id,$tax){
$term_list = wp_get_post_terms($id, $tax, array("fields" => "all"));
foreach($term_list as $term_single) {
return $term_single->name; //do something here
}
}
?>
  <section class="hero">
		<div style="background-color:#3ECCCB;width:100%;margin:0px;">


			
		
<img src="<?php echo get_template_directory_uri();  ?>/images/activities.png" class="img-responsive"  alt="COP">
<p> ACTIVIITES </p>

</div>
</section>


<?php 

if($_GET['a']){
	$currentPathway=$_GET['a'];
}
?>

<!--- PTHWAY NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<!-- Tabs -->
	<div class="container">
		<div class="row">
			<div class="steamtabbednav">
				<div class="tabbednavlinks">
					
			
<?php
$tax_terms = get_terms( 'pathway', 'orderby=id');
//var_dump($tax_terms);
foreach ( $tax_terms as $term ) {

?>
	
	<a href="activities/?a=<?php echo $term->slug; ?>" class="tabbednavlink" role="button"> <?php echo $term->name; ?> </a>
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
			<h2 class="btitle">Filter By </h2>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="btn-group">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Subject</button>
					</div>

					<div class="btn-group">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Level</button>
					</div>

					<div class="btn-group">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tags</button>
					</div>
				</div>

				<div class="col-md-3">
					<div class="row">
						<input type="text" class="searchbox searchbox-text" placeholder="Search">
					</div>
				</div>
			</div>
		</div>
	</section>


<?php // Output all Taxonomies names with their respective items
$topics = get_terms('topic');
foreach( $topics as $topic ):
?>            
<div class="container">              
    <h3><?php echo $topic->name; // Print the term name ?> Activities </h3> 

			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link active" href="#">Beginner</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Intermidiate & Advanced</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">New</a>
				</li>
			</ul>
			   
     </div>
<div class="container">
				<hr>
    <div class="card-deck">
      <?php                         
          $posts = get_posts(array(
            'post_type' => 'activity',
            
'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'pathway',
                'field' => 'name',
                'terms' => array( $currentPathway )
            ),
            array(
                'taxonomy' => 'topic',
                'field' => 'name',
                'terms' => $topic->name
            )
        ),

            'numberposts' => 4, // to show all posts in this taxonomy, could also use 'numberposts' => -1 instead
          ));
          foreach($posts as $post): // begin cycle through posts of this taxonmy
            setup_postdata($post); //set up post data for use in the loop (enables the_title(), etc without specifying a post ID)
      ?>        
          
	<div class="card">
						<img class="card-img-top cardback" src="<?php the_field('featured_image'); ?>"  width="279" height="129" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-small"><?php echo getPostTerms($post->ID,'pathway'); ?> </h5>
							<h5 class="card-big"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<a href="" class="card-tag"><?php echo getPostTerms($post->ID,'tool'); ?></a>
							<?php echo getPostTerms($post->ID,'level'); ?>
						</div>
					</div>

        <?php endforeach; ?>
    </div>
    </div>                                    
<?php endforeach; ?>



<div class="container">
<hr>
</div>






<?php get_footer();?>