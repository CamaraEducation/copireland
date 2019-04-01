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


if (isset($_POST['user_id'])){
  global$wpdb;
  $data_array = array(

    'user_id' => $_POST['user_id'],
    'post_id' => $_POST['post_id'],
    'satsfaction' => 1,
    'level' => 1,
    'time' => 1,
    'age_group' => 1
      
  );
  $table_name = 'wp_feedback';

  $rowResult = $wpdb->insert($table_name, $data_array, $format=NULL); 

  if($rowResult == 1){
    echo json_encode(array('message'=>'<h1>Successfull<h1>', 'status'=>1)) ;  
  }else{
    echo json_encode(array('message'=>'<h1>Not Success<h1>', 'status'=>0)) ;  
  }
  die;

}