<?php
/*
Template Name: Home
*/
?>
<?php
// redirect for now
header("Location: http://www.stylzt.com/advanced-search/");


get_header();
?>
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
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/header2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Crowdsource your next photo shoot</h1>
              <p>Have talent and crew bid on your creative projects. See their reviews and past work. Stylzt makes it easier than ever to know you're dealing with reliable people.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/header3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Get visibility for your business or career</h1>
              <p>Become a featured partner and get more eyes on your work from people that matter in the industry</p>
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


<?php
get_footer();
?>