<?php
get_header();
?>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="<?php echo get_template_directory_uri();  ?>/images/techspacelogo.png" class="img-responsive md-avatar size-2" alt="COP">
    </div>

<div class="login-form">
<?php
$args = array(
    'redirect' => home_url(), 
   ) 
;?>
<?php wp_login_form( $args ); ?>
</div>
   <!-- Remind Passowrd -->
    <div id="formFooter">
    	 <?php $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0; 
if ( $login === "failed" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
} elseif ( $login === "empty" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
} elseif ( $login === "false" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
}
?>
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>