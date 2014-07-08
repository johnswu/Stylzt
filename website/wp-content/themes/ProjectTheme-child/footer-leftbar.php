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
