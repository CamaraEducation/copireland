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
$tax_terms = get_terms( 'pathway', 'orderby=id');
//var_dump($tax_terms);
foreach ( $tax_terms as $term ) {

?>
    
    <a href="activities/?a=<?php echo $term->name; ?>" class="tabbednavlink" role="button" > <?php echo $term->name; ?> </a>

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
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mr-2">
                        <div class="col-md-12 box1 mb-3">

            <img src="<?php echo get_template_directory_uri();  ?>/images/steam.png" class="img-responsive"  alt="COP">
Introduction to STEAM Diital Youth Work
                        </div>

                        <div class="col box2 mr-2">
                            RESOURCE <br>

            <img src="<?php echo get_template_directory_uri();  ?>/images/resource.png" class="img-responsive"  alt="COP" >
Logic Models
                        </div>
                        <div class="col box3">
                            Activity <br>
            <img src="<?php echo get_template_directory_uri();  ?>/images/activity.png" class="img-responsive"  alt="COP">
Start with low-tech activities 

                        </div>
                    </div>
                </div>

                <div class="col-md-4 box4">
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

                </div>

            </div>


            <div class="row">
                <p class="textdiv1">Have you trained in the NYCI STEAM in Youth Work Maker Project? <a href="" class="textdiv11">Access further resource here ></a></p>
            </div>
        </div>
    </section>

    <!-- Second Div -->
    <section>
        <div class="container">
                    <hs2 class="btitle">Steam Activities</hs2>
                </div>
            <hr>
        
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mr-2">
                        

<?php
//echo sprintf($currentPathway);

function getactivity($maxNumb, $pathway){
/*
    $args = array(

  'numberposts' => $maxNumb,
  'post_type'   => 'activity'
);
 */

$args=array(
            'post_type' => 'activity',
            
'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'pathway',
                'field' => 'name',
                'terms' => array($pathway)
            ),
            
        ),

            'numberposts' =>$maxNumb, // to show all posts in this taxonomy, could also use 'numberposts' => -1 instead
          );




$lastposts = get_posts( $args );
return $lastposts;
}

//show latest psots
$maxPosts = 6;
$totalPosts = count(getactivity($maxPosts,$currentPathway));
If($totalPosts %2 != 0){
$newMax = $totalPosts-1;
$lastposts=getactivity($newMax,$currentPathway);
}else {
    $lastposts=getactivity($maxPosts,$currentPathway);

}

$count=0;
if ( $lastposts ) {
    
    foreach ( $lastposts as $post ) :

             //echo $count;   
?>
                        <div class="col box5 mr-2">
                
        <h2><a href="<?php the_permalink(); ?>"><?php echo $post->post_title;//echo get_post_meta($post->ID, 'Duration', true); ?></a></h2>
                        </div>


<?php
        
                
                 $count++;
    if($count % 2 == 0) echo '</div> <div class="row mr-2">';
    endforeach; 
    wp_reset_postdata();
}

?>          
                    <!--    
                        <div class="col box5">
aa
                        </div>
                    </div>
                        <div class="row mr-2">
                        

                        <div class="col box5 mr-2">
bb
                        </div>
                        <div class="col box5">

                        </div>
                        -->
                    </div>
                </div>

                <div class="col-md-4 box51">
<span class="border border-primary"> 
<img src="<?php echo get_template_directory_uri();  ?>/images/communityContri.png" class="img-responsive" with="10px"  alt="COP">
</span>
                </div>

            </div>

        </div>
    </section>


<!-- Third Div -->
    <section>
        <div class="container">
            <h22 class="btitle">Advanced Program Plans</h22>
            <hr>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mr-2">
                        

                        <div class="col-sm-6 box6">

                        </div>
                        <div class="col-sm-6 box6a">

                        </div>
                    </div>
                </div>

                <div class="col-md-4 box61">
                    
                </div>

            </div>

        </div>
    </section>
    <!-- End of Third Div -->
<div class="container">
<hr>
</div>





<?php get_footer();?>