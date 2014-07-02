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

        </div><!-- /.col-lg-1 -->
      </div><!-- /.row -->

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


<?php

	$ProjectTheme_enable_google_analytics = get_option('ProjectTheme_enable_google_analytics');
	if($ProjectTheme_enable_google_analytics == "yes"):		
		echo stripslashes(get_option('ProjectTheme_analytics_code'));	
	endif;
	
	//----------------
	
	$ProjectTheme_enable_other_tracking = get_option('ProjectTheme_enable_other_tracking');
	if($ProjectTheme_enable_other_tracking == "yes"):		
		echo stripslashes(get_option('ProjectTheme_other_tracking_code'));	
	endif;


?>
<?php 	
		wp_footer();
?>
</body>
</html>