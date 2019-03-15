<?php get_header();?>



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

<section class="my-5">
        <div class="container">
            <h2 class="headtitle"><?php echo $currentPathway;?> Starter Kit</h2>
            <hr>
        </div>



<div class="container">
            <div class="row my-3">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div class="card" style="background-color: #ffffff; border-radius: 10px;height: 168px;">
                                <div class="card-header border-0 py-3 d-flex align-items-center my-3" style="background-color: #ffffff;">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/steam.png"" class="rounded-circle align-self-start mr-3" width="100" height="100">
                                    <div>
                                        <!-- <h4 class="card-title mb-0">Card title</h4> -->
                                        <h6 class="intro-steam">Introduction to <?php echo $currentPathway;?> Digital Youth Work</h6>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="card" style="background-color: #3ECCCB; border-radius: 10px;height: 168px;">
                                <div class="card-header border-0 py-3 d-flex align-items-center my-3" style="background-color: #3ECCCB;">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/resource.png" class="rounded-circle align-self-start mr-3">
                                    <div>
                                        <h4 class="intro-title mb-0">Resource</h4>
                                        <h6 class="intro-steam">Logic Models</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 my-2">
                            <div class="card" style="background-color: #fff; border-radius: 10px;height: 168px;">
                                <div class="card-header border-0 py-3 d-flex align-items-center my-3" style="background-color: #ffffff;">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/resource.png"" class="rounded-circle align-self-start mr-3">
                                    <div>
                                        <h4 class="intro-title mb-0" style="color:#9AA5B1;">Activity</h4>
                                        <h6 class="intro-steam">Start with low-tech activities</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php
function getRoles($theRole){
// Get all users with role Project Officers.
$user_query_po = new WP_User_Query( array( 'role' => $theRole) );
                    // Get the total number of users for the current query. I use (int) only for sanitize.
                    $users_count_po = (int) $user_query_po->get_total();
                    // Echo a string and the value
                    $string = $users_count_po ;
                    return $string;                   
}
?>

    <div class="col-md-4 my-3">
                    <div class="card" style="background-color: #E6EEF3;opacity: 0.78;border: 1px solid #CACCCE;box-sizing: border-box;border-radius: 4px;">
                        <div class="card-body">
                            <p class="meet-company-title">Meet the Community</p>
                            <p class="meet-company-text"><?php echo getRoles("um_project-officers");?> &nbsp;  &nbsp; Project Officers <a href="#" class="badge badge-primary">officer</a></p>





                            <p class="meet-company-text"><?php echo getRoles("um_cluster-coordinators");?> &nbsp;  &nbsp; Cluster Coordinators <a href="#" class="badge badge-success">cluster</a></p>
                            <p class="meet-company-text"><?php echo getRoles("um_digital-youth-work-experts");?> &nbsp;  &nbsp; Digital Youth Work Experts <a href="#" class="badge badge-info">expert</a></p>
                            <p class="meet-company-text"><?php echo getRoles("um_community-contributors");?> &nbsp;  &nbsp; Community Contributors <a href="#" class="badge badge-warning">contributor</a></p>
                            <div class="my-4">
                                <button type="button" class="btn btn-outline-warning my-2" style="border: 1px solid #EE603B;box-sizing: border-box;/* Drop Shadow */box-shadow: 0px 5px 15px rgba(25, 70, 93, 0.05);border-radius: 100px; color:#EE603B">Take to an Expert</button>
                                <img src="<?php echo get_avatar_url($current_user->ID); ?>" class="rounded-circle z-depth-0 md-avatar" alt="avatar image"> 
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="container">
            <p class="text-ask">Have you trained in the NYCISTEAM in Youth Work Maker Project? <a href="#" class="text-ask-link">Access further Resources Here ></a></p>
        </div>
    </div>

</section>


<section class="my-5">
    <div class="container">
        <h2 class="headtitle"><?php echo $currentPathway;?> Activities</h2>
        <hr>
    </div>

    <div class="container">
        <div class="row my-3">
            <div class="col-md-8">
                <div class="row">
                   
<?php
//echo sprintf($currentPathway);


function gettermImage($pathwayName){
 $term = get_term_by('name',$pathwayName, 'pathway'); 
 //var_dump($term);
 $name = $term->icon_image;
$imagePath = get_field('icon_image', $term->taxonomy.'_'.$term->term_id);
return $imagePath;
}


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

                    <div class="col-md-6 my-2">

                        <div class="card" style="background: #FFFFFF;box-shadow: 0px 3px 5px rgba(25, 70, 93, 0.05);border-radius: 10px;">
                            <div class="card-header border-0 py-3 d-flex align-items-center my-3" style="background-color: #ffffff;">
                                <img src="<?php echo gettermImage($currentPathway); ?>" class="rounded-circle align-self-start mr-3" width="50" height="50">
                                <div>
                                    <h6 class="intro-steam"><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
        
                
                 $count++;
    if($count % 2 == 0) echo '</div> <div class="row">';
    endforeach; 
    wp_reset_postdata();
}

?>  

                </div>
            </div>

            <div class="col-md-4 my-2">
                <div class="card" style="background-color: #E6EEF3;opacity: 0.78;border: 1px solid #CACCCE;box-sizing: border-box;border-radius: 4px;">
                    <div class="card-body">
                        <h3 class="text-on-card toc-text">Community Contributor</h3>
                        <p class="cc-title">Create an activity guide</p>
                        <p class="cc-text">Become a Community Contributor</p>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-5">
    <div class="container">
        <h2 class="headtitle">Advanced Programme Plans</h2>
        <hr>
    </div>

    <div class="container">
        <div class="row my-3">
            <div class="col-md-8">
                <div class="row no-gutters">
                    <div class="col-md-5 my-2">
                        <div class="card appbox1">
                            <div class="">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/bluebox.svg" class="rounded-circle mx-auto d-block my-2">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 my-2">
                        <div class="card appbox2">
                            <div class="card-header border-0 py-3 d-flex align-items-center my-3" style="background: #fff;">
                                
                                <div>
                                    <h4 class="intro-title mb-0" style="color:#9AA5B1;"> <?php echo $currentPathway; ?></h4>
                                    <h6 class="intro-steam">8 Week Activity Programme Plan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-2">
                <div class="card" style="background-color: #E6EEF3;opacity: 0.78;border: 1px solid #CACCCE;box-sizing: border-box;border-radius: 4px; height: 200px;">
                    <div class="card-body">
                        <h3 class="text-on-app toc-text-app">new</h3>
                        <p class="apptext1">CountDown</p>
                        <p class="apptext2">March 2019</p>
                        <hr>
                        <p class="apptext3">New Advanced Pathways</p>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<?php get_footer();?>