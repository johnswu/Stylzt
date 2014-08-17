        </div><!-- end col -->
      </div><!-- end row -->
    </div><!-- end wrapper -->
    
    <footer class="hidden-xs">
      <p class="pull-left">&copy; Copyright 2014. STYLZT</p>
    </footer>
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script type="text/javascript">
      
      jQuery(document).ready(function() {
        
        // jQuery('.dropdown-toggle').dropdown();
        
        var container = jQuery('.portfolio-wrapper');
        
        container.imagesLoaded( function(){
          container.isotope({
            itemSelector : '.card',
            layoutMode : 'fitRows'
          });
        });
        
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
        
      });
      
		jQuery('textarea[placeholder]').placeholder();
		jQuery('input:text[placeholder]').placeholder(); // classic input[type=text]
		jQuery('input:email[placeholder]').placeholder(); // email fields input[type=email]
		jQuery('input:password[placeholder]').placeholder();
    </script>

  </body>
</html>
