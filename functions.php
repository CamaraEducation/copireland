<?php






function irelandcop_script_enqueue() {
	//css styles
	wp_enqueue_style('customstyle',get_template_directory_uri().'/css/irelandcop.css',array(),'1.0.0','all');
	wp_enqueue_style('custombootstrap',get_template_directory_uri().'/css/bootstrap.css',array(),'1.0.0','all');

		wp_enqueue_style('customfont',get_template_directory_uri().'/css/font.css',array(),'1.0.0','all');
    wp_enqueue_style('customfont2',get_template_directory_uri().'/css/irelandcop_2.css',array(),'1.0.0','all');
    
		
		//Javascript
		wp_enqueue_script('customjs',get_template_directory_uri().'/js/irelandcop.js',array(),'1.0.0',true);
			wp_enqueue_script('customjs_bootstrap',get_template_directory_uri().'/js/bootstrap.js',array(),'1.0.0',true);
			wp_enqueue_script('customjs_jquery',get_template_directory_uri().'/js/jquery-3.2.1.min.js',array(),'1.0.0',true);

}

add_filter( 'query_vars', 'addnew_query_vars', 10, 1 );
function addnew_query_vars($vars)
{   
    $vars[] = 'var1'; // var1 is the name of variable you want to add       
    return $vars;
}


function irelandcop_theme_setup(){
add_theme_support('menus');
register_nav_menu('primary','Primary Header Navigation');
}

add_action('wp_enqueue_scripts','irelandcop_script_enqueue');
add_action('init','irelandcop_theme_setup');


/* Main redirection of the default login page */
function redirect_login_page() {
  $login_page  = home_url( '/login/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']);
 
  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_page);
    exit;
  }
}
add_action('init','redirect_login_page');

function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );
 
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {

        if ( in_array( 'jsa_contributor', $user->roles ) ) {
            // redirect them to the default place
            $data_login = get_option('axl_jsa_login_wid_setup');

            return get_permalink($data_login[0]);
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

function logout_page() {
  $login_page  = home_url( '/login/' );
  
  wp_redirect( $login_page . "?login=false" );
  exit;
}
add_action('wp_logout','logout_page');

function admin_login_redirect( $redirect_to, $request, $user )
{

global $user;
$steam_page  = home_url( '/steam/' );
if( isset( $user->roles ) && is_array( $user->roles ) ) {
if( in_array( "administrator", $user->roles ) ) {
return $redirect_to;
} else  {
return home_url();
}
}
else
{
return $redirect_to;
}
}

add_filter("login_redirect", "admin_login_redirect", 10, 3);

if (isset($_POST['useridsad'])){
  global$wpdb;
    
  $ui = $_POST['useridsad'];
  $pi = $_POST['postidsad'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $val = $wpdb->get_var( "SELECT satsfaction FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );

   if(empty($val))
   {
    
    $data_array = array(

    'user_id' => $ui,
    'post_id' => $pi,
    'satsfaction' => 1,
    'level' => 0,
    'time' => 0,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(satsfaction = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
            

  $rowResult = $wpdb->insert($table_name, $data_array, $format=NULL);

  if($rowResult == 1){
    echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
    echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($val==1)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction=4 WHERE user_id=$ui && post_id = $pi"));
    if($rowResultt == 1){
      echo json_encode(array('message'=>'$sad', 'status'=>1)) ; 
    }else{
      echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($val>1)
   {
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResulttt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction=1 WHERE user_id=$ui && post_id = $pi"));
    if($rowResulttt == 1){
      echo json_encode(array('message'=>'$sad', 'status'=>1)) ; 
    }else{
      echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }
   }
   exit();
  
  die;

}
if (isset($_POST['useridha'])){
  global$wpdb;
  $ui = $_POST['useridha'];
  $pi = $_POST['postidha'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $val = $wpdb->get_var( "SELECT satsfaction FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );

   if(empty($val))
   {
    
    $data_array = array(

    'user_id' => $ui,
    'post_id' => $pi,
    'satsfaction' => 2,
    'level' => 0,
    'time' => 0,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(satsfaction = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
            

  $rowResult = $wpdb->insert($table_name, $data_array, $format=NULL);

  if($rowResult == 1){
    echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
    echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($val==1 || $val==3 || $val==4)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction=2 WHERE user_id=$ui && post_id = $pi"));
    if($rowResultt == 1){
      echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
      echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($val==2)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction=4 WHERE user_id=$ui && post_id = $pi"));
    if($rowResultt == 1){
      echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
      echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;
}
if (isset($_POST['useridex'])){
  global$wpdb;
  $ui = $_POST['useridex'];
  $pi = $_POST['postidex'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $val = $wpdb->get_var( "SELECT satsfaction FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );

   if(empty($val))
   {
    
    $data_array = array(

    'user_id' => $ui,
    'post_id' => $pi,
    'satsfaction' => 3,
    'level' => 0,
    'time' => 0,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(satsfaction = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
            

  $rowResult = $wpdb->insert($table_name, $data_array, $format=NULL);

  if($rowResult == 1){
    echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
    echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($val==1 || $val==2 || $val==4)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction=3 WHERE user_id=$ui && post_id = $pi"));
    if($rowResultt == 1){
      echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
      echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($val==3)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction=4 WHERE user_id=$ui && post_id = $pi"));
    if($rowResultt == 1){
      echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
      echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;

}
if (isset($_POST['useridbg'])){
  global$wpdb;
  $uib = $_POST['useridbg'];
  $pib = $_POST['postidbg'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uib."' && post_id = '".$pib."'" );
  $valu = $wpdb->get_var( "SELECT level FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uib."' && post_id = '".$pib."'" );

   if(empty($row))
   {
      $level_array = array(

    'user_id' => $uib,
    'post_id' => $pib,
    'satsfaction' => 0,
    'level' => 1,
    'time' => 0,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(level = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
            

  $rowResult = $wpdb->insert($table_name, $level_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu > 1 || $valu == 0)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET level =1 WHERE user_id=$uib && post_id = $pib"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==1)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET level =4 WHERE user_id=$uib && post_id = $pib"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;

}
if (isset($_POST['useridint'])){
  global$wpdb;
  $uib = $_POST['useridint'];
  $pib = $_POST['postidint'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uib."' && post_id = '".$pib."'" );
  $valu = $wpdb->get_var( "SELECT level FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uib."' && post_id = '".$pib."'" );

   if(empty($row))
   {
    
    $data_array = array(

    'user_id' => $uib,
    'post_id' => $pib,
    'satsfaction' => 0,
    'level' => 2,
    'time' => 0,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(level = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $pib " );
            

  $rowResult = $wpdb->insert($table_name, $data_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu==0 || $valu==1 || $valu==3 || $valu==4)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET level =2 WHERE user_id=$uib && post_id = $pib"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==2)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET level =4 WHERE user_id=$uib && post_id = $pib"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;

}
if (isset($_POST['useridad'])){
  global$wpdb;
  $uib = $_POST['useridint'];
  $pib = $_POST['postidint'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uib."' && post_id = '".$pib."'" );
  $valu = $wpdb->get_var( "SELECT level FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uib."' && post_id = '".$pib."'" );

   if(empty($row))
   {
    
    $data_array = array(

    'user_id' => $uib,
    'post_id' => $pib,
    'satsfaction' => 0,
    'level' => 3,
    'time' => 0,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(level = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $pib " );
            

  $rowResult = $wpdb->insert($table_name, $data_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu==0 || $valu==1 || $valu==2 || $valu==4)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET level =3 WHERE user_id=$uib && post_id = $pib"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==3)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET level =4 WHERE user_id=$uib && post_id = $pib"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;
}

if (isset($_POST['useridon'])){
  global$wpdb;
  $uit = $_POST['useridon'];
  $pit = $_POST['postidon'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uit."' && post_id = '".$pit."'" );
  $valu = $wpdb->get_var( "SELECT time FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uit."' && post_id = '".$pit."'" );

   if(empty($row))
   {
      $level_array = array(

    'user_id' => $uit,
    'post_id' => $pit,
    'satsfaction' => 0,
    'level' => 0,
    'time' => 1,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(time = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $pit " );
            

  $rowResult = $wpdb->insert($table_name, $level_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu > 1 || $valu == 0)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET time =1 WHERE user_id=$uit && post_id = $pit"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==1)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET time =4 WHERE user_id=$uit && post_id = $pit"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;

}
if (isset($_POST['useridtw'])){
  global$wpdb;
  $uit = $_POST['useridtw'];
  $pit = $_POST['postidtw'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uit."' && post_id = '".$pit."'" );
  $valu = $wpdb->get_var( "SELECT time FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uit."' && post_id = '".$pit."'" );

   if(empty($row))
   {
      $level_array = array(

    'user_id' => $uit,
    'post_id' => $pit,
    'satsfaction' => 0,
    'level' => 0,
    'time' => 2,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(time = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $pit " );
            

  $rowResult = $wpdb->insert($table_name, $level_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu == 0 || $valu == 1 || $valu == 3 || $valu == 4)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET time =2 WHERE user_id=$uit && post_id = $pit"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==2)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET time =4 WHERE user_id=$uit && post_id = $pit"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;

}
if (isset($_POST['useridth'])){
  global$wpdb;
  $uit = $_POST['useridth'];
  $pit = $_POST['postidth'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uit."' && post_id = '".$pit."'" );
  $valu = $wpdb->get_var( "SELECT time FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uit."' && post_id = '".$pit."'" );

   if(empty($row))
   {
      $level_array = array(

    'user_id' => $uit,
    'post_id' => $pit,
    'satsfaction' => 0,
    'level' => 0,
    'time' => 3,
    'age_group' => 0
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(time = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $pit " );
            

  $rowResult = $wpdb->insert($table_name, $level_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu == 0 || $valu == 1 || $valu == 2 || $valu == 4)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET time =3 WHERE user_id=$uit && post_id = $pit"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==3)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET time =4 WHERE user_id=$uit && post_id = $pit"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;
}
if (isset($_POST['useridan'])){
  global$wpdb;
  $uig = $_POST['useridan'];
  $pig = $_POST['postidan'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uig."' && post_id = '".$pig."'" );
  $valu = $wpdb->get_var( "SELECT age_group FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uig."' && post_id = '".$pig."'" );

   if(empty($row))
   {
      $level_array = array(

    'user_id' => $uig,
    'post_id' => $pig,
    'satsfaction' => 0,
    'level' => 0,
    'time' => 0,
    'age_group' => 1
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(age_group = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $pig " );
            

  $rowResult = $wpdb->insert($table_name, $level_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu > 1 || $valu == 0)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group =1 WHERE user_id=$uig && post_id = $pig"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==1)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group =4 WHERE user_id=$uig && post_id = $pig"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;

}
if (isset($_POST['useridhu'])){
  global$wpdb;
  $uig = $_POST['useridhu'];
  $pig = $_POST['postidhu'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uig."' && post_id = '".$pig."'" );
  $valu = $wpdb->get_var( "SELECT age_group FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uig."' && post_id = '".$pig."'" );

   if(empty($row))
   {
      $level_array = array(

    'user_id' => $uig,
    'post_id' => $pig,
    'satsfaction' => 0,
    'level' => 0,
    'time' => 0,
    'age_group' => 2
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(age_group = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $pig " );
            

  $rowResult = $wpdb->insert($table_name, $level_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu == 0 || $valu == 1 || $valu == 3 || $valu == 4)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group =2 WHERE user_id=$uig && post_id = $pig"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==2)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group =4 WHERE user_id=$uig && post_id = $pig"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;

}
if (isset($_POST['useridso'])){
  global$wpdb;
  $uig = $_POST['useridso'];
  $pig = $_POST['postidso'];

  //$ad = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$ui."' && post_id = '".$pi."'" );
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uig."' && post_id = '".$pig."'" );
  $valu = $wpdb->get_var( "SELECT age_group FROM ".$wpdb->prefix."feedback WHERE user_id = '".$uig."' && post_id = '".$pig."'" );

   if(empty($row))
   {
      $level_array = array(

    'user_id' => $uig,
    'post_id' => $pig,
    'satsfaction' => 0,
    'level' => 0,
    'time' => 0,
    'age_group' => 3
      
    );

  $table_name = 'wp_feedback';
  $sad = $wpdb->get_var( "SELECT sum(age_group = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $pig " );
            

  $rowResult = $wpdb->insert($table_name, $level_array, $format=NULL);

  if($rowResult == 1){
   // echo json_encode(array('message'=>'<h3>Successfull<h3>', 'status'=>1)) ;  
  }else{
   // echo json_encode(array('message'=>'<h3>Not Success<h3>', 'status'=>0)) ;  
  }

   }elseif($valu == 0 || $valu == 1 || $valu == 2 || $valu == 4)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group =3 WHERE user_id=$uig && post_id = $pig"));
    if($rowResultt == 1){
     // echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }elseif($valu==3)
   {
    
    $table_name = 'wp_feedback';

    //$rowResultt = $wpdb->update($table_name, array( 'satsfaction' => 0 ), $format=NULL);
    $rowResultt = $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group =4 WHERE user_id=$uig && post_id = $pig"));
    if($rowResultt == 1){
    //  echo json_encode(array('message'=>'<h3>Updated<h3>', 'status'=>1)) ;  
    }else{
     // echo json_encode(array('message'=>'<h3>Not Updated<h3>', 'status'=>0)) ;  
    }

   }
   exit();
  
  die;
}

///////// If the user is Sad/////////////////
function userDisliked($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT satsfaction FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 1) {
    return true;
  }else{
    return false;
  }
}
function getDislikes($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(satsfaction = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Sad/////////////////
///////// If the user is Happy/////////////////
function userLiked($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT satsfaction FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 2) {
    return true;
  }else{
    return false;
  }
}
function getLikes($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(satsfaction = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Happy/////////////////
///////// If the user is Excited/////////////////
function userExcited($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT satsfaction FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 3) {
    return true;
  }else{
    return false;
  }
}
function getExcites($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(satsfaction = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Excited/////////////////
if (isset($_POST['action'])) {
  $action = $_POST['action'];
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];
  $table_name = 'wp_feedback';
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$user_id."' && post_id = '".$post_id."'" );
  $ml = $wpdb->get_var( "SELECT satsfaction FROM ".$wpdb->prefix."feedback WHERE user_id = '".$user_id."' && post_id = '".$post_id."'" );

  switch ($action) {
    case 'dislike':
      if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 1,
      'level' => 0,
      'taken_time' => 0,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 2 || $ml == 3){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction = 1 WHERE user_id=%d && post_id = %s", $user_id, $post_id ));
        }
         break;
    case 'undislike':
           $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction = 0 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
      break;
    case 'like':
         if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 2,
      'level' => 0,
      'taken_time' => 0,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 1 || $ml == 3){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction = 2 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
        }
         break;
    case 'unlike':
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction = 0 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
        break;
    case 'excited':
          if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 3,
      'level' => 0,
      'taken_time' => 0,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 1 || $ml == 2){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction = 3 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
        }
      break;
    case 'unexcited':
          $wpdb->query($wpdb->prepare("UPDATE $table_name SET satsfaction = 0 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
    default:
      break;
  }
  echo getRating($post_id);
  exit(0);
}
function getRating($id)
{
  global $wpdb;
  $rating = array();
  $sad = $wpdb->get_var( "SELECT sum(satsfaction = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );
  $happy = $wpdb->get_var( "SELECT sum(satsfaction = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );
  $excite = $wpdb->get_var( "SELECT sum(satsfaction = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );

  $rating = [
    'likes' => $happy[0],
    'dislikes' => $sad[0],
    'excites' => $excite[0]
  ];
  return json_encode($rating);
}
////////////////////////////////////////////// END OF SATSFACTION ///////////////////////////////////////////////////////////
////////////////////////////////////////////// LEVEL ///////////////////////////////////////////////////////////
function userBiggner($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT level FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 1) {
    return true;
  }else{
    return false;
  }
}
function getBiggner($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(level = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Sad/////////////////
///////// If the user is Happy/////////////////
function userInter($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT level FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 2) {
    return true;
  }else{
    return false;
  }
}
function getInter($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(level = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Happy/////////////////
///////// If the user is Excited/////////////////
function userAdvance($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT level FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 3) {
    return true;
  }else{
    return false;
  }
}
function getAdvance($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(level = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Excited/////////////////
if (isset($_POST['levelaction'])) {
  $levelaction = $_POST['levelaction'];
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];
  $table_name = 'wp_feedback';
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$user_id."' && post_id = '".$post_id."'" );
  $ml = $wpdb->get_var( "SELECT level FROM ".$wpdb->prefix."feedback WHERE user_id = '".$user_id."' && post_id = '".$post_id."'" );

  switch ($levelaction) {
    case 'biggner':
      if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 1,
      'taken_time' => 0,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 2 || $ml == 3){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET level = 1 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
        }
         break;
    case 'unbiggner':
           $wpdb->query($wpdb->prepare("UPDATE $table_name SET level = 0 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
      break;
    case 'inter':
         if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 2,
      'taken_time' => 0,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 1 || $ml == 3){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET level = 2 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
        }
         break;
    case 'uninter':
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET level = 0 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
        break;
    case 'advance':
          if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 3,
      'taken_time' => 0,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 1 || $ml == 2){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET level = 3 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
        }
      break;
    case 'unadvance':
          $wpdb->query($wpdb->prepare("UPDATE $table_name SET level = 0 WHERE user_id=%d && post_id = %s", $user_id, $post_id));
    default:
      break;
  }

  echo getRatingLevel($post_id);
  exit(0);
}

function getRatingLevel($id)
{
  global $wpdb;
  $rating = array();
  $biggner = $wpdb->get_var( "SELECT sum(level = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );
  $inter = $wpdb->get_var( "SELECT sum(level = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );
  $advance = $wpdb->get_var( "SELECT sum(level = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );

  $rating = [
    'biggners' => $biggner[0],
    'inters' => $inter[0],
    'advances' => $advance[0]
  ];
  return json_encode($rating);
}
//////////////////////////////////////END OF LEVEL/////////////////////////////////////////////
//////////////////////////////////////TIME/////////////////////////////////////////////

function userLessOne($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT taken_time FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 1) {
    return true;
  }else{
    return false;
  }
}
function getLessOne($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(taken_time = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Sad/////////////////
///////// If the user is Happy/////////////////
function userOneToTwo($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT taken_time FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 2) {
    return true;
  }else{
    return false;
  }
}
function getOneToTwo($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(taken_time = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Happy/////////////////
///////// If the user is Excited/////////////////
function userMoreTwo($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT taken_time FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 3) {
    return true;
  }else{
    return false;
  }
}
function getMoreTwo($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(taken_time = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Excited/////////////////
if (isset($_POST['timeaction'])) {
  $timeaction = $_POST['timeaction'];
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];
  $table_name = 'wp_feedback';
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$user_id."' && post_id = '".$post_id."'" );
  $ml = $wpdb->get_var( "SELECT taken_time FROM ".$wpdb->prefix."feedback WHERE user_id = '".$user_id."' && post_id = '".$post_id."'" );

  switch ($timeaction) {
    case 'biggner':
      if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 0,
      'taken_time' => 1,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 2 || $ml == 3){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET taken_time = 1 WHERE user_id=$user_id && post_id = $post_id"));
        }
         break;
    case 'unbiggner':
           $wpdb->query($wpdb->prepare("UPDATE $table_name SET taken_time = 0 WHERE user_id=$user_id && post_id = $post_id"));
      break;
    case 'inter':
         if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 0,
      'taken_time' => 2,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 1 || $ml == 3){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET taken_time = 2 WHERE user_id=$user_id && post_id = $post_id"));
        }
         break;
    case 'uninter':
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET taken_time = 0 WHERE user_id=$user_id && post_id = $post_id"));
        break;
    case 'advance':
          if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 0,
      'taken_time' => 3,
      'age_group' => 0 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 1 || $ml == 2){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET taken_time = 3 WHERE user_id=$user_id && post_id = $post_id"));
        }
      break;
    case 'unadvance':
          $wpdb->query($wpdb->prepare("UPDATE $table_name SET taken_time = 0 WHERE user_id=$user_id && post_id = $post_id"));
    default:
      break;
  }
  echo getRatingTime($post_id);
  exit(0);
}
function getRatingTime($id)
{
  global $wpdb;
  $rating = array();
  $lessone = $wpdb->get_var( "SELECT sum(taken_time = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );
  $onetotwo = $wpdb->get_var( "SELECT sum(taken_time = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );
  $moretwo = $wpdb->get_var( "SELECT sum(taken_time = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );

  $rating = [
    'lessone' => $lessone[0],
    'onetotwo' => $onetotwo[0],
    'moretwo' => $moretwo[0]
  ];
  return json_encode($rating);
}
///////////////////////////////////// END OF TIME ////////////////////////////////////////
/////////////////////////////////////AGE GROUP////////////////////////////////////////

function userBiggnerAge($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT age_group FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 1) {
    return true;
  }else{
    return false;
  }
}
function getBiggnerAge($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(age_group = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Sad/////////////////
///////// If the user is Happy/////////////////
function userInterAge($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT age_group FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 2) {
    return true;
  }else{
    return false;
  }
}
function getInterAge($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(age_group = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Happy/////////////////
///////// If the user is Excited/////////////////
function userAdvanceAge($userid, $postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT age_group FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
  if ($valu == 3) {
    return true;
  }else{
    return false;
  }
}
function getAdvanceAge($postid)
{
  global $wpdb;
  $valu = $wpdb->get_var( "SELECT sum(age_group = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$postid."'" );
  return json_encode($valu, JSON_NUMERIC_CHECK);
}
///////// End of If the user is Excited/////////////////
if (isset($_POST['ageaction'])) {
  $ageaction = $_POST['ageaction'];
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];
  $table_name = 'wp_feedback';
  $row = $wpdb->get_var( "SELECT * FROM ".$wpdb->prefix."feedback WHERE user_id = '".$user_id."' && post_id = '".$post_id."'" );
  $ml = $wpdb->get_var( "SELECT age_group FROM ".$wpdb->prefix."feedback WHERE user_id = '".$user_id."' && post_id = '".$post_id."'" );

  switch ($ageaction) {
    case 'biggner':
      if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 0,
      'taken_time' => 0,
      'age_group' => 1 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 2 || $ml == 3){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group = 1 WHERE user_id=$user_id && post_id = $post_id"));
        }
         break;
    case 'unbiggner':
           $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group = 0 WHERE user_id=$user_id && post_id = $post_id"));
      break;
    case 'inter':
         if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 0,
      'taken_time' => 0,
      'age_group' => 2 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 1 || $ml == 3){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group = 2 WHERE user_id=$user_id && post_id = $post_id"));
        }
         break;
    case 'uninter':
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group = 0 WHERE user_id=$user_id && post_id = $post_id"));
        break;
    case 'advance':
          if (empty($row)){
        $data_array = array(
          'user_id' => $user_id,
      'post_id' => $post_id,
      'satsfaction' => 0,
      'level' => 0,
      'taken_time' => 3,
      'age_group' => 3 );
            $sql=$wpdb->insert($table_name, $data_array, $format=NULL);
        }else if($ml == 0 || $ml == 1 || $ml == 2){
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group = 3 WHERE user_id=$user_id && post_id = $post_id"));
        }
      break;
    case 'unadvance':
          $wpdb->query($wpdb->prepare("UPDATE $table_name SET age_group = 0 WHERE user_id=$user_id && post_id = $post_id"));
    default:
      break;
  }
  echo getRatingAge($post_id);
  exit(0);
}
function getRatingAge($id)
{
  global $wpdb;
  $rating = array();
  $agebiggner = $wpdb->get_var( "SELECT sum(age_group = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );
  $ageinter = $wpdb->get_var( "SELECT sum(age_group = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );
  $ageadvance = $wpdb->get_var( "SELECT sum(age_group = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = '".$id."'" );

  $rating = [
    'agebiggner' => $agebiggner[0],
    'ageinter' => $ageinter[0],
    'ageadvance' => $ageadvance[0]
  ];
  return json_encode($rating);
}