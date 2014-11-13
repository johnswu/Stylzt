<?php
/*
Template Name: Stylzt Page Template
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>WeddingProposals.us <?php wp_title(  ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WeddingProposals.us - Wedding vendors and jobs">
    <meta name="author" content="Venia Studios">
    
    <!-- Le styles -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!--[if IE 7]>
      <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
    <![endif]-->
	<?php wp_enqueue_script("jquery"); ?>
	<?php

		wp_head();

	?>	
	<!--
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.isotope.min.js"></script>
	-->
	
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" />

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/lib/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />

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
              <a href="/" class="navbar-brand"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/wedding-logo-gray.png" style="width:100%;" /></a>
              <p class="brand-text">Proposals from wedding vendors to you</p>
            </div><!-- end navbar-header -->
            <div class="collapse navbar-collapse" id="rebound-navbar-collapse">
              <ul class="nav navbar-nav" style="margin-bottom:30px;">
				<li class="title">Main Menu</li>
                <li><a href="<?php echo get_permalink(get_option('ProjectTheme_advanced_search_page_id')); ?>"><?php _e('Project Search','ProjectTheme'); ?></a></li>
                <li><a href="<?php echo get_permalink(get_option('ProjectTheme_provider_search_page_id')); ?>"><?php _e('Provider Search','ProjectTheme'); ?></a></li>
                <!--<li><a href="<?php echo projectTheme_post_new_link(); ?>"><?php echo __("Post New",'ProjectTheme'); ?></a></li>-->
	<?php if(get_option('projectTheme_enable_blog') == "yes") { ?>
                <li><a href="<?php echo projectTheme_blog_link(); ?>"><?php echo __("Blog",'ProjectTheme'); ?></a></li>
	<?php } ?>
              </ul>
              <ul class="nav navbar-nav">
	<?php
		if(is_user_logged_in())
		{
			global $current_user;
			get_currentuserinfo();
			$u = $current_user;
	?>			  
			<?php ProjectTheme_get_users_links(); ?>
	<?php
		}
		else
		{							
	?>
							
				<li><a href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register"><?php echo __("Register",'ProjectTheme'); ?></a></li>
				<li><a href="<?php bloginfo('siteurl') ?>/wp-login.php"><?php echo __("Log In",'ProjectTheme'); ?></a></li>
	<?php } ?>					
              </ul>
			  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>			
<?php endwhile; // end of the loop. ?>
		  
          </div>
        </div><!-- end col -->
      </div><!-- end row -->
    </div><!-- end wrapper -->
    
    <footer class="hidden-xs">
      <p class="pull-left">&copy; Copyright 2014. STYLZT.</p>
      <p class="pull-right">
		<a href="/Contact">Contact Us</a>
	  </p>
    </footer>
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	<!--
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/templ.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.fileupload.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.fileupload-fp.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.fileupload-ui.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/lib/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/jquery.uploadify-3.1.js"></script>     
	-->
	
	
    <script type="text/javascript">
      
      jQuery(document).ready(function() {

		// jQuery('.dropdown-toggle').dropdown();
        
        var container = jQuery('.portfolio-wrapper');
        
		/* removing for now, seems to want to use masonry
        container.imagesLoaded( function(){
          container.isotope({
            itemSelector : '.card',
            layoutMode : 'fitRows'
          });
        });
        */
		
        // Needed functions
        var getColWidth = function() {
          var width,
          windowWidth = $(window).width();
          if( windowWidth <= 480 ) {
            width = Math.floor( container.width() );
          } else if( windowWidth <= 768 ) {
            width = Math.floor( container.width() );
          } else {
            width = Math.floor( 250 );
          }
          return width;
        }

        function setWidths() {
          var colWidth = getColWidth();
          container.children().css({ width: colWidth });
        }

    
        jQuery(window).smartresize(function() {
          setWidths();
          container.isotope({
            masonry: {
              columnWidth: getColWidth()
            }
          });
        });
        
        jQuery('.filter-portfolio li a').click(function(){
          jQuery('.filter-portfolio li.active').removeClass('active');
          jQuery(this).parent('li').addClass('active');
          var selector = jQuery(this).attr('data-filter');
          container.isotope({
            filter: selector,
            masonry: {  }
          });
          return false;
        });
        // update columnWidth on window resize
        jQuery(window).smartresize(function(){
          container.isotope({
            // update columnWidth to a percentage of container width
            masonry: {  }
          });
        });
        
		jQuery('textarea[placeholder]').placeholder();
		jQuery('input:text[placeholder]').placeholder(); // classic input[type=text]
		//jQuery('input:email[placeholder]').placeholder(); // email fields input[type=email]
		jQuery('input:password[placeholder]').placeholder();
      });
      
    </script>

  </body>
</html>
