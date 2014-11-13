<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - ProjectTheme
*	More Info: http://sitemile.com/p/project
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/	
		
		if(!function_exists('ProjectTheme_do_register_scr')) {
		function ProjectTheme_do_register_scr()
		{
		  global $wpdb, $wp_query, $current_theme_locale_name;
		
		  if (!is_array($wp_query->query_vars))
			$wp_query->query_vars = array();
		
		header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));
		
		session_start();
		  switch( $_REQUEST["action"] ) 
		  {
			
			case 'register':
			  require_once( ABSPATH . WPINC . '/registration-functions.php');
			  
				$user_login = sanitize_user( str_replace(" ","",$_POST['user_login']) );
				$user_email = trim($_POST['user_email']);
			
				$sanitized_user_login = $user_login;
		
				$errors = Project_register_new_user_sitemile($user_login, $user_email);
				
				if (!is_wp_error($errors)) 
				{	
					$ok_reg = 1;						
				}	
					
				
				if ( 1 == $ok_reg ) 
				{//continues after the break; 
		
					get_header('leftbar');
					global $current_theme_locale_name;	
				
		?>
			<!-- START NEW DESIGN -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/login.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.css" />
	<form class="form-signin">
		<h3 class="heading-desc"><?php _e('Registration Complete',$current_theme_locale_name) ?></h3>
		<div class="main">    
			<p>
				<?php printf(__('Username: %s',$current_theme_locale_name), "<strong>" . wp_specialchars($user_login) . "</strong>") ?><br />
				<?php printf(__('Password: %s',$current_theme_locale_name), '<strong>' . __('emailed to you',$current_theme_locale_name) . '</strong>') ?> <br />
				<?php printf(__('E-mail: %s',$current_theme_locale_name), "<strong>" . wp_specialchars($user_email) . "</strong>") ?><br /><br />
				<?php _e("Please check your <strong>Junk Mail</strong> if your account information does not appear within 5 minutes.",$current_theme_locale_name); ?>
			</p>
			<span class="clearfix"></span>    
		</div>
        <div class="login-footer">
			<div class="row">
				<div class="col-xs-6 col-md-6">
					<div class="left-section">
						&nbsp;
					</div>
				</div>
				<div class="col-xs-6 col-md-6 pull-right">
					<a href="wp-login.php" class="btn btn-large btn-danger pull-right"><?php _e('Login', $current_theme_locale_name); ?></a>
				</div>
			</div>
		</div>
	</form>
 			<!-- END NEW DESIGN -->
		<?php
								
				
				get_footer('leftbar');
		
				die();
			break;
			  }//continued from the error check above
		
			default:
			get_header('leftbar');
			
		
				
				?>
			<!-- START NEW DESIGN -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/login.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.css" />
	
	<form class="form-signin" id="registerform" action="<?php echo esc_url( site_url('wp-login.php?action=register', 'login_post') ); ?>" method="post">
		<input type="hidden" name="action" value="register" />	
        <h3 class="heading-desc"><?php _e("Register",$current_theme_locale_name); ?> with <?php echo get_bloginfo('name'); ?></h3>
		
		<?php do_action('register_form'); ?>

        <div class="main">    
			<?php if ( isset($errors) && isset($_POST['action']) ) : ?>
			<div class="error">
				<ul>
				<?php
				foreach($errors as $error) {
				if(count($error) > 0) {
				
				foreach($error as $e) echo "<li>".$e[0]."</li>";
				
				
				}
				}
				?>
				</ul>
			</div>
			<?php endif; ?>
 
			<input type="text" class="form-control" placeholder="<?php _e('Username:',$current_theme_locale_name) ?>" name="user_login" id="user_login" value="<?php echo wp_specialchars(stripslashes($user_login), 1); ?>" autofocus />
			<input type="text" class="form-control" placeholder="<?php _e('E-mail:',$current_theme_locale_name) ?>" name="user_email" id="user_email" value="<?php echo wp_specialchars($user_email); ?>" />
			<p style="margin-bottom:0;"><?php _e('A password will be emailed to you.',$current_theme_locale_name) ?></p>
			
			<span class="clearfix"></span>    
        </div>
        <div class="login-footer">
			<div class="row">
				<?php
				
					$ProjectTheme_enable_2_user_tp = get_option('ProjectTheme_enable_2_user_tp');
					if($ProjectTheme_enable_2_user_tp == "yes"):
					
						$enbl = true;
						$enbl = apply_filters('ProjectTheme_enbl_two_user_types_thing',$enbl);
						
						if($enbl):
				?>                           
				
				<p style="margin-left:30px;">							 
				<label for="register-email"><?php _e('User Type:',$current_theme_locale_name) ?></label><br/>
				<input type="radio" class="do_input" name="user_tp" id="user_tp" value="service_provider" checked="checked" /> <?php _e('Service Provider',$current_theme_locale_name); ?><br/>
				<input type="radio" class="do_input" name="user_tp" id="user_tp" value="business_owner" /> <?php _e('Service Contractor',$current_theme_locale_name); ?><br/>
				</p>
				
				<?php endif; endif; ?>
			
				<div class="col-xs-6 col-md-6">
					<div class="left-section">
						<a href="<?php bloginfo('wpurl'); ?>/wp-login.php"><?php _e('Login',$current_theme_locale_name) ?></a>
					</div>
				</div>
				<div class="col-xs-6 col-md-6 pull-right">
					<button type="submit" name="submits" id="submits" class="btn btn-large btn-danger pull-right"><?php _e('Register',$current_theme_locale_name) ?></button>
				</div>
			</div>
 
        </div>
	</form>

			<!-- END NEW DESIGN -->
                        
		<?php
				
				
	 			  get_footer('leftbar');
		
			  die();
			break;
			case 'disabled':
     
	 			  get_header('leftbar');
				
			
		?>
            <div class="col-lg-12">
				<div class="col-md-offset-2 col-md-4 belowCenterHeader">

					<div class="box_title"><?php _e('Registration Disabled',$current_theme_locale_name) ?></div>
					<div class="box_content">
						<p><?php _e('User registration is currently not allowed.',$current_theme_locale_name) ?><br />
						<a href="<?php echo get_settings('home'); ?>/" title="<?php _e('Go back to the blog',$current_theme_locale_name) ?>"><?php _e('Home',$current_theme_locale_name) ?></a>
						</p>
					</div>
				</div>
			</div>
		<?php
				
				 get_footer('leftbar');
		
			  die();
			break;
		  }
		}


		}

//===================================================================

if(!function_exists('Project_register_new_user_sitemile')) {
function Project_register_new_user_sitemile( $user_login, $user_email ) {
	$errors = new WP_Error();
	global $current_theme_locale_name;
	$sanitized_user_login = sanitize_user( $user_login );
	$user_email = apply_filters( 'user_registration_email', $user_email );

	// Check the username
	if ( $sanitized_user_login == '' ) {
		$errors->add( 'empty_username', __( '<strong>ERROR</strong>: Please enter a username.', $current_theme_locale_name ) );
	} elseif ( ! validate_username( $user_login ) ) {
		$errors->add( 'invalid_username', __( '<strong>ERROR</strong>: This username is invalid because it uses illegal characters. Please enter a valid username.', $current_theme_locale_name ) );
		$sanitized_user_login = '';
	} elseif ( username_exists( $sanitized_user_login ) ) {
		$errors->add( 'username_exists', __( '<strong>ERROR</strong>: This username is already registered, please choose another one.', $current_theme_locale_name ) );
	}

	// Check the e-mail address 
	if ( $user_email == '' ) {
		$errors->add( 'empty_email', __( '<strong>ERROR</strong>: Please type your e-mail address.', $current_theme_locale_name ) );
	} elseif ( ! is_email( $user_email ) ) {
		$errors->add( 'invalid_email', __( '<strong>ERROR</strong>: The email address isn&#8217;t correct.', $current_theme_locale_name ) );
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		$errors->add( 'email_exists', __( '<strong>ERROR</strong>: This email is already registered, please choose another one.', $current_theme_locale_name ) );
	}

	do_action( 'register_post', $sanitized_user_login, $user_email, $errors );

	$errors = apply_filters( 'registration_errors', $errors, $sanitized_user_login, $user_email );

	if ( $errors->get_error_code() )
		return $errors;
	
	//--------------------
	
	$user_tp = $_POST['user_tp'];
	if(empty($user_tp)) $capa = 'subscriber';
	else $capa = $user_tp;
	
	//--------------------
	
	$user_pass = wp_generate_password( 12, false);
	
	$user_id = wp_create_user( $sanitized_user_login, $user_pass, $user_email, $capa );
	if ( ! $user_id ) {
		$errors->add( 'registerfail', sprintf( __( '<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !', $current_theme_locale_name ), get_option( 'admin_email' ) ) );
		return $errors;
	}
	
	//---------------------
	
	$user = new WP_User($user_id);
	$user->set_role($capa);
	
	//---------------------
	
	update_user_meta( $user_id, 'user_tp', $user_tp );
	
	update_user_option( $user_id, 'default_password_nag', true, true ); //Set up the Password change nag.

	ProjectTheme_new_user_notification($user_id, $user_pass );
	ProjectTheme_new_user_notification_admin($user_id);
	
	return $user_id;
} }

?>