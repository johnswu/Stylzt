<?php
/***************************************************************************
*
*	ProjectTheme - copyright (c) - sitemile.com
*	The only project theme for wordpress on the world wide web.
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/products/wordpress-project-freelancer-theme/
*	since v1.2.5.3
*
***************************************************************************/


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?> >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/ico/favicon.ico">

    <title>	
		<?php wp_title(  ); ?>
	</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap-social.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>
	<?php
		wp_head();
	?>	

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/carousel.css" rel="stylesheet">
     <script type="text/javascript">
		
		var $ = jQuery;
		
	function suggest(inputString){
	
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#big-search').addClass('load');
			$.post("<?php bloginfo('siteurl'); ?>/?autosuggest=1", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#big-search').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#big-search').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}
	
	</script>
    

    <?php do_action('ProjectTheme_before_head_tag_closes'); ?>
	</head>
	<body <?php body_class(); ?> >
	<?php do_action('ProjectTheme_after_body_tag_open'); ?>
	
    <div class="navbar-wrapper">
      <div class="container">
        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" style="padding:6px;" href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" /></a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo get_permalink(get_option('ProjectTheme_advanced_search_page_id')); ?>"><?php _e('Project Search','ProjectTheme'); ?></a></li>
                <li><a href="<?php echo get_permalink(get_option('ProjectTheme_provider_search_page_id')); ?>"><?php _e('Provider Search','ProjectTheme'); ?></a></li>
                <li><a href="<?php echo projectTheme_post_new_link(); ?>"><?php echo __("Post New",'ProjectTheme'); ?></a></li>
	<?php if(get_option('projectTheme_enable_blog') == "yes") { ?>
                <li><a href="<?php echo projectTheme_blog_link(); ?>"><?php echo __("Blog",'ProjectTheme'); ?></a></li>
	<?php } ?>
	<?php
		if(is_user_logged_in())
		{
			global $current_user;
			get_currentuserinfo();
			$u = $current_user;
	?>
                <li class="dropdown">
                  <a href="<?php echo projectTheme_my_account_link(); ?>" class="dropdown-toggle" data-toggle="dropdown">WELCOME, <?php echo $u->user_login; ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo wp_logout_url(); ?>"><?php echo __("Log Out",'ProjectTheme'); ?></a></li>
                    <li><a href="<?php echo projectTheme_my_account_link(); ?>"><?php echo __("MyAccount",'ProjectTheme'); ?></a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
	<?php
		}
		else
		{							
	?>
							
				<li><a href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register"><?php echo __("Register",'ProjectTheme'); ?></a></li>
				<li><a href="<?php bloginfo('siteurl') ?>/wp-login.php"><?php echo __("Log In",'ProjectTheme'); ?></a></li>
	<?php } ?>	
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

	<div class="row">
        <div class="col-lg-12">
