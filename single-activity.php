<?php get_header();?>

<?php
function getPostTerms($id,$tax){
$term_list = wp_get_post_terms($id, $tax, array("fields" => "all"));
foreach($term_list as $term_single) {
return $term_single->name; //do something here
}
}
?>
    

        <div class="container">
            Dashboard > STEAM > Maker > STEAM Racers
        
        </div>


        <?php while ( have_posts() ) : the_post(); ?>
}

<div class="container">
            
            <h2 class="btitle"><?php echo the_title();?></h2>
            <hr>
        </div>

<?php echo getPostTerms($post->ID,'activity_level'); ?> <br>
<?php echo get_post_meta($post->ID, 'Duration', true); ?> <br>
<?php echo getPostTerms($post->ID,'activity_agerange'); ?> <br>

<?php

?>

<?php the_content(); ?>


<?php endwhile; // end of the loop. ?>

<hr>






<?php get_footer();?>