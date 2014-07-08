<?php
/*
Template Name: Stylzt Page Template
*/
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php wp_title(  ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rebound - Responsive Portfolio Theme for Twitter Bootstrap. Responsive HTML5, CSS3 and jQuery.">
    <meta name="author" content="Pukeko Design Studio">
    
    <!-- Le styles -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!--[if IE 7]>
      <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" />
	<?php wp_enqueue_script("jquery"); ?>
	<?php
		wp_head();
	?>	
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="js/respond.src.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/sample/logo-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/sample/logo-114.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/sample/logo-72.png">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/img/sample/logo-57.png">
                                   <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/sample/logo.png">
    
  </head>

  <body>
    <div class="wrapper">
      <div class="row">
        <div class="col-md-3 sidebar">
          <div class="navbar" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#rebound-navbar-collapse"><span class="fa fa-bars"></span> Menu</button>
              <a href="/" class="navbar-brand"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" style="width:223px;" /></a>
              <p class="brand-text">The Simple and Trusted Way to Book Photoshoots</p>
            </div><!-- end navbar-header -->
            <div class="collapse navbar-collapse" id="rebound-navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo get_permalink(get_option('ProjectTheme_advanced_search_page_id')); ?>"><?php _e('Project Search','ProjectTheme'); ?></a></li>
                <li><a href="<?php echo get_permalink(get_option('ProjectTheme_provider_search_page_id')); ?>"><?php _e('Provider Search','ProjectTheme'); ?></a></li>
                <li><a href="<?php echo projectTheme_post_new_link(); ?>"><?php echo __("Post New",'ProjectTheme'); ?></a></li>
	<?php if(get_option('projectTheme_enable_blog') == "yes") { ?>
                <li><a href="<?php echo projectTheme_blog_link(); ?>"><?php echo __("Blog",'ProjectTheme'); ?></a></li>
	<?php } ?>
              </ul>
            </div><!-- end navbar-collapse -->
          </div><!-- end navbar -->
        </div><!-- end col -->
        <div class="col-md-9 content">
          <div class="portfolio-wrapper">
		  
	<div id="content" >
