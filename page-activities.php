<?php get_header();?>
<?php
function getPostTerms($id,$tax){
$term_list = wp_get_post_terms($id, $tax, array("fields" => "all"));
foreach($term_list as $term_single) {
return $term_single->name; //do something here
}
}
?>
<?php 

if($_GET['a']){
	$currentPathway=$_GET['a'];
}
?>


<!--  Hero Section -->
    <section id="hero">
        <div class="hero-container">

        <?php
if ( is_user_logged_in() ) {
   
?>

            <div class="col-xs-2 col-centered mx-2">
                <span>

                <img src="<?php echo get_avatar_url($current_user->ID); ?>" class="img-responsive" width="125" height="125" alt="COP">
            </span>
            </div>
            <div class="col-xs-6 col-centered">
                <p class="name-user"><?php um_fetch_user( get_current_user_id()); ?></p>
                <p class="txt-pos">
                    <?php  echo array_shift($current_user->roles); ?> @ Camara

                </p>
            </div>
    <?php } else { ?>


            <div class="col-xs-2 col-centered mx-2">
                <span>
            <img src="<?php echo gettermImage($currentPathway); ?>" width="55" height="63"> 

            </span>
            </div>
            <div class="col-xs-6 col-centered">
                <p class="name-user"><?php um_fetch_user( get_current_user_id()); ?></p>
                <p class="txt-pos">
                    <?php echo $currentPathway; ?>  Activities
                </p>
            </div>


<?php } ?>
        </div>
    
    </section>
    <!-- #hero -->




<!-- Start Tab -->
    <section>
        <div class="container-fluid" style="background: #fff;">
            <div class="container">
            <ul class="nav mx-4" id="myTab" role="tablist">
                
<?php
$tax_terms = get_terms( 'pathway', 'orderby=id');
//var_dump($tax_terms);
foreach ( $tax_terms as $term ) {

?>
    <li class="nav-item mx-4 tab-text1">
                    <a class="nav-link <?php echo ($currentPathway == $term->name  ? active : none); ?>" id="home-tab" data-toggle="tab" href="activities/?a=<?php echo $term->name; ?>" role="tab" aria-controls="home" aria-selected="false" style="color: #<?php echo ($currentPathway == $term->name  ? 333333 : none);?>"><?php echo $term->name; ?></a>
                </li>
<?php
}
?>
            </ul>
        </div>
        </div>
    </section>
    <!-- End Tab -->


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

//          var_dump($posts);

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