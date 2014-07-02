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
              <form class="navbar-form" role="search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" value="" />
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="fa fa-search"></span></button>
                  </span>
                </div><!-- end input group -->
              </form><!-- end navbar-form -->
              <ul class="nav navbar-nav filter-portfolio">
                <li class="title">Work</li>
                <li class="active"><a href="#none" data-filter="*">All</a> <span>(123)</span></li>
                <li><a href="#none" data-filter=".film">Film</a> <span>(9)</span></li>
                <li><a href="#none" data-filter=".music">Music</a> <span>(22)</span></li>
                <li><a href="#none" data-filter=".art">Art</a> <span>(7)</span></li>
                <li><a href="#none" data-filter=".social">Social</a> <span>(49)</span></li>
              </ul>
              <ul class="nav navbar-nav nav-social hidden-sm hidden-xs">
                <li class="title">Social</li>
                <li><a href="#none">Twitter</a></li>
                <li><a href="#none">Facebook</a></li>
                <li><a href="#none">LinkedIn</a></li>
                <li><a href="#none">Dribbble</a></li>
              </ul>
            </div><!-- end navbar-collapse -->
          </div><!-- end navbar -->
        </div><!-- end col -->
        <div class="col-md-9 content">
          <div class="portfolio-wrapper">
            <div class="card film art">
              <a href="event-item.php" class="thumb">
                <img src="/ssw/images/header.jpg" alt="" title="" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="event-item.php">Seattle Startup Weekend</a></h2>
                <p>Seattle will be hosting truly a unique event kicking off on May 16th. Startup Weekend and 9Mile Labs are coming together to host one of the world's first B2B Startup Weekend!</p>
                <p><a href="event-item.php">Read More</a></p>
              </div><!-- end card-body -->
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><a href="#none">Film</a></li>
                  <li><a href="#none">Art</a></li>
                </ul>
              </div><!-- end card-footer -->
            </div><!-- end card -->
			<!--
            <div class="card music social">
              <a href="portfolio-item.html" class="thumb">
                <img src="img/sample/elephants-dream/sample-elephants-1.jpg" alt="" title="" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="portfolio-item.html">Elephants Dream</a></h2>
                <p>Elephants Dream is the world’s first open movie, made entirely with open source graphics software such as Blender , and with all production ...</p>
                <p><a href="portfolio-item.html">Read More</a></p>
              </div>
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><a href="#none">Music</a></li>
                  <li><a href="#none">Social</a></li>
                </ul>
              </div>
            </div>
            <div class="card film social">
              <a href="portfolio-item.html" class="thumb">
                <img src="img/sample/big-buck-bunny/sample-bunny-1.png" alt="" title="" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="portfolio-item.html">Big Buck Bunny</a></h2>
                <p>A comedy about a fat rabbit taking revenge on three irritating rodents. The film - in the fastest imaginable 3D computer animation - almost seems...</p>
                <p><a href="portfolio-item.html">Read More</a></p>
              </div>
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><a href="#none">Film</a></li>
                  <li><a href="#none">Social</a></li>
                </ul>
              </div>
            </div>
            <div class="card film art">
              <a href="portfolio-item.html" class="thumb">
                <img src="img/sample/sintel/sample-sintel-2.jpg" alt="" title="" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="portfolio-item.html">Sintel Review</a></h2>
                <p>The cinema where Sintel screens has digital 4k projection, I’m working with them getting this formatted right and delivered. Would be a real ...</p>
                <p><a href="portfolio-item.html">Read More</a></p>
              </div>
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><a href="#none">Film</a></li>
                  <li><a href="#none">Art</a></li>
                </ul>
              </div>
            </div>
            <div class="card film social">
              <a href="portfolio-item.html" class="thumb">
                <img src="img/sample/big-buck-bunny/sample-bunny-3.png" alt="" title="" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="portfolio-item.html">Big Buck Bunny In CG Magazine From China</a></h2>
                <p>A comedy about a fat rabbit taking revenge on three irritating rodents. The film - in the fastest imaginable 3D computer animation - almost seems...</p>
                <p><a href="portfolio-item.html">Read More</a></p>
              </div>
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><a href="#none">Film</a></li>
                  <li><a href="#none">Social</a></li>
                </ul>
              </div>
            </div>
            <div class="card music social">
              <a href="portfolio-item.html" class="thumb">
                <img src="img/sample/elephants-dream/sample-elephants-2.jpg" alt="" title="" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="portfolio-item.html">Singapore, CGOverdrive And 3dsense</a></h2>
                <p>Elephants Dream is the world’s first open movie, made entirely with open source graphics software such as Blender , and with all production ...</p>
                <p><a href="portfolio-item.html">Read More</a></p>
              </div>
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><a href="#none">Music</a></li>
                  <li><a href="#none">Social</a></li>
                </ul>
              </div>
            </div>
            <div class="card film art">
              <a href="portfolio-item.html" class="thumb">
                <img src="img/sample/sintel/sample-sintel-3.jpg" alt="" title="" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="portfolio-item.html">Sintel at Seattle International Film Festival</a></h2>
                <p>The cinema where Sintel screens has digital 4k projection, I’m working with them getting this formatted right and delivered. Would be a real ...</p>
                <p><a href="portfolio-item.html">Read More</a></p>
              </div>
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><a href="#none">Film</a></li>
                  <li><a href="#none">Art</a></li>
                </ul>
              </div>
            </div>
            <div class="card film social">
              <a href="portfolio-item.html" class="thumb">
                <img src="img/sample/big-buck-bunny/sample-bunny-2.png" alt="" title="" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="portfolio-item.html">Studio Harddisk Online</a></h2>
                <p>A comedy about a fat rabbit taking revenge on three irritating rodents. The film - in the fastest imaginable 3D computer animation - almost seems...</p>
                <p><a href="portfolio-item.html">Read More</a></p>
              </div>
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><a href="#none">Film</a></li>
                  <li><a href="#none">Social</a></li>
                </ul>
              </div>
            </div>
			-->
          </div>
          <div class="pagination-wrapper">
            <ul class="pagination">
              <li class="disabled"><span>Prev</span></li>
              <li class="active"><a href="#none">1</a></li>
              <li><a href="#none">2</a></li>
              <li><a href="#none">3</a></li>
              <li><a href="#none">4</a></li>
              <li><a href="#none">5</a></li>
              <li><a href="#none">Next</a></li>
            </ul>
          </div><!-- end pagination-wrapper -->
        </div><!-- end col -->
      </div><!-- end row -->
    </div><!-- end wrapper -->
    
    <footer class="hidden-xs">
      <p class="pull-left">&copy; Copyright 2014. Rebound.</p>
      <p class="pull-right"><a href="#none">Rebound</a> by Pukeko Design Studio. <a href="documentation.html">Documentation</a>.</p>
    </footer>
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/rebound.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.isotope.min.js"></script>
    <script type="text/javascript">
      
      $(document).ready(function() {
        
        $('.dropdown-toggle').dropdown();
        
        var $container = $('.portfolio-wrapper');
        
        $container.imagesLoaded( function(){
          $container.isotope({
            itemSelector : '.card',
            layoutMode : 'fitRows'
          });
        });
        
        // Needed functions
        var getColWidth = function() {
          var width,
          windowWidth = $(window).width();
          if( windowWidth <= 480 ) {
            width = Math.floor( $container.width() );
          } else if( windowWidth <= 768 ) {
            width = Math.floor( $container.width() );
          } else {
            width = Math.floor( 250 );
          }
          return width;
        }

        function setWidths() {
          var colWidth = getColWidth();
          $container.children().css({ width: colWidth });
        }

    
        $(window).smartresize(function() {
          setWidths();
          $container.isotope({
            masonry: {
              columnWidth: getColWidth()
            }
          });
        });
        
        $('.filter-portfolio li a').click(function(){
          $('.filter-portfolio li.active').removeClass('active');
          $(this).parent('li').addClass('active');
          var selector = $(this).attr('data-filter');
          $container.isotope({
            filter: selector,
            masonry: {  }
          });
          return false;
        });
        // update columnWidth on window resize
        $(window).smartresize(function(){
          $container.isotope({
            // update columnWidth to a percentage of container width
            masonry: {  }
          });
        });
        
      });
      
    </script>

  </body>
</html>
