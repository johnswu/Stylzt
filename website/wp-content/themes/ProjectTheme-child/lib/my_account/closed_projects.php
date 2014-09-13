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

function ProjectTheme_my_account_closed_projects_area_function()
{
		global $current_user, $wpdb, $wp_query;
		get_currentuserinfo();
		$uid = $current_user->ID;
		
?>
</div>
<!-- end navbar-collapse -->
</div>
<!-- end navbar -->
</div>
<!-- end col -->
<div class="col-md-9 content item">
  <div class="page">
    <article>
      <div class="page-header">
        <h1>
          <?php _e("My Closed Projects",'ProjectTheme'); ?>
        </h1>
      </div>
      <!-- end page-header -->
                
                <?php
				global $wp_query;
				$query_vars = $wp_query->query_vars;
				$post_per_page = 5;				
				
				query_posts( "meta_key=closed&meta_value=1&post_type=project&order=DESC&orderby=id&author=".$uid.
				"&posts_per_page=".$post_per_page."&paged=".$query_vars['paged'] );

				if(have_posts()) :
					_e("<table class='table table-alternative table-hover'>");
					_e("<thead><tr><th></th><th>Project Name</th><th>Category</th><th>Posted By</th><th>Time Remaining</th></tr></thead>");
					while ( have_posts() ) : the_post();
						projectTheme_get_post_table();
					endwhile;
					_e("</table>");
				
				if(function_exists('wp_pagenavi')):
				wp_pagenavi(); endif;
				
				 else:
				
				_e("There are no projects yet.",'ProjectTheme');
				
				endif;
				
				wp_reset_query();
				
				?>


      <div style="clear:both;"></div>
    </article>
  </div>
</div>
<?php

}
	
?>