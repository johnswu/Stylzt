<?php
/*
Template Name: Home
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/ico/favicon.ico">

    <title>STYLZT: The simple and trusted way to schedule a photoshoot</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap-social.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
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
              <a class="navbar-brand" style="padding:6px;" href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" /></a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo get_permalink(get_option('ProjectTheme_advanced_search_page_id')); ?>"><?php _e('Project Search','ProjectTheme'); ?></a></li>
                <li><a href="<?php echo get_permalink(get_option('ProjectTheme_provider_search_page_id')); ?>"><?php _e('Provider Search','ProjectTheme'); ?></a></li>
                <li><a href="<?php echo projectTheme_post_new_link(); ?>"><?php echo __("Post New",'ProjectTheme'); ?></a></li>
	<?php if(get_option('projectTheme_enable_blog') == "yes") { ?>
                <li><a href="<?php echo projectTheme_blog_link(); ?>"><?php echo __("Blog",'ProjectTheme'); ?></a></li>
	<?php } ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/header1.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Find paying jobs from reviewed professionals</h1>
              <p>See who you're working with and what they've done. Your payment is held in escrow.</p>
              <p><a class="btn btn-lg btn-primary btn-social btn-facebook" href="/facebook_login.php" role="button"><i class="fa fa-facebook"></i> Sign in with Facebook</a></p>
              <p><a class="btn btn-lg btn-primary btn-social btn-linkedin" href="/linkedin_login.php" role="button"><i class="fa fa-linkedin"></i> Sign in with LinkedIn</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/header2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Crowdsource your next photo shoot</h1>
              <p>Have talent and crew bid on your creative projects. See their reviews and past work. Stylzt makes it easier than ever to know you're dealing with reliable people.</p>
              <p><a class="btn btn-lg btn-primary btn-social btn-facebook" href="/facebook_login.php" role="button"><i class="fa fa-facebook"></i> Sign in with Facebook</a></p>
              <p><a class="btn btn-lg btn-primary btn-social btn-linkedin" href="/linkedin_login.php" role="button"><i class="fa fa-linkedin"></i> Sign in with LinkedIn</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/header3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Get visibility for your business or career</h1>
              <p>Become a featured partner and get more eyes on your work from people that matter in the industry</p>
              <p><a class="btn btn-lg btn-primary btn-social btn-facebook" href="/facebook_login.php" role="button"><i class="fa fa-facebook"></i> Sign in with Facebook</a></p>
              <p><a class="btn btn-lg btn-primary btn-social btn-linkedin" href="/linkedin_login.php" role="button"><i class="fa fa-linkedin"></i> Sign in with LinkedIn</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon04.png" alt="Generic placeholder image">
          <h2>Find Work</h2>
          <p>Ready to put your skills to work? Find the right jobs for you in your area.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon01.png" alt="Generic placeholder image">
          <h2>Find Talent</h2>
          <p>Do you have a project that needs just the right person to make it happen?  Search our reviewed talent pool.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon02.png" alt="Generic placeholder image">
          <h2>Grow Your Business</h2>
          <p>Bring the power of crowdsourcing to your photoshoot. Post the work you need done and have reviewed professionals bid on it.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Interactive Presentations. <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">Enhance user engagement with interactive presentations.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/images/microphone.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/images/wordcloud.JPG" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">Online Conversation <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Drive idea-sharing among users with online communication platform.</p>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Professional Networking <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Provide opportunities for users to connect with user directory.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/images/peoplenetwork.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2014 STYLZT, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/docs.min.js"></script>
  </body>
</html>
