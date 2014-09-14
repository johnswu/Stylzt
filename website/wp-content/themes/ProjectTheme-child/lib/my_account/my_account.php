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


function ProjectTheme_my_account_area_main_function()
{
	
				
				global $current_user, $wp_query;
				get_currentuserinfo();
				
				$uid = $current_user->ID;
	
        
	
?>
            </div><!-- end navbar-collapse -->
          </div><!-- end navbar -->
        </div><!-- end col -->
        <div class="col-md-9 content item">
			<div class="page">
				<article>
				  <div class="page-header">
					<h1><?php echo __("MyAccount",'ProjectTheme'); ?></h1>
				  </div><!-- end page-header -->
        
        <?php
			
			if(isset($_GET['prj_not_approved']))
			{
				
				$psts = get_post($_GET['prj_not_approved']);		
		?>
        
        <p>
        <?php echo sprintf(__('Your payment was received for the item: <b>%s</b> but your project needs to be approved. 
		You will be notified when your project will be approved and live on our website','ProjectTheme'), $psts->post_title ); ?>
        </p>
        
        	<?php
			}
			
				if(ProjectTheme_is_user_business($uid)):
			
			
			?>

		<h2>My Hiring</h2>
		
		<h3><?php _e("My Latest Posted Projects", "ProjectTheme"); ?></h3>
            	
                 <?php
							
			 
				global $wp_query;
				$query_vars = $wp_query->query_vars;
				$post_per_page = 5;				

					
				$closed = array(
						'key' => 'closed',
						'value' => "0",
						'compare' => '='
					);	
					
				$paid = array(
						'key' => 'paid',
						'value' => "1",
						'compare' => '='
					);		
				
				$args = array('post_type' => 'project', 'author' => $uid, 'order' => 'DESC', 'orderby' => 'date', 'posts_per_page' => $post_per_page,
				'paged' => 1, 'meta_query' => array($paid, $closed), 'post_status' =>array('draft','publish') );
				
				query_posts($args);
				
			//	query_posts( "meta_key=closed&meta_value=0&post_status=publish,draft&post_type=project&order=DESC&orderby=date&author=".$uid.
			//	"&posts_per_page=".$post_per_page."&paged=".$query_vars['paged'] );

				if(have_posts()) :
				
				_e("<table class='table table-alternative table-hover'>");
				_e("<thead><tr><th></th><th>Project Name</th><th>Category</th><th>Posted By</th><th>Time Remaining</th></tr></thead>");
				while ( have_posts() ) : the_post();
					projectTheme_get_post_table();
				endwhile;
				_e("</table>");
				
				//if(function_exists('wp_pagenavi')):
				//wp_pagenavi(); endif;
				
				 else:
				
				_e("<p>There are no projects yet.</p>",'ProjectTheme');
				
				endif;
				
				wp_reset_query();

				
				?>
          <div style="clear:both;"></div> 
<!--           
          <h3><?php _e("My Unpublished &amp; Unpaid Projects",'ProjectTheme'); ?></h3>
				<?php

				query_posts( "post_status=draft&meta_key=paid&meta_value=0&post_type=project&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );
				
				if(have_posts()) :
				_e("<table class='table table-alternative table-hover'>");
				_e("<thead><tr><th></th><th>Project Name</th><th>Category</th><th>Posted By</th><th>Time Remaining</th></tr></thead>");
				while ( have_posts() ) : the_post();
					projectTheme_get_post_table(array('unpaid'));
				endwhile; 
				_e("</table>");
				
				else:
				
				_e("<p>There are no projects yet.</p>",'ProjectTheme');
				
				endif;
				
				wp_reset_query();
				
				?>
			
          <div style="clear:both;"></div> 
-->            
		  <h3><?php _e("My Latest Closed Projects",'ProjectTheme'); ?></h3>
		  
				<?php

				query_posts( "meta_key=closed&meta_value=1&post_type=project&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );

				if(have_posts()) :
				_e("<table class='table table-alternative table-hover'>");
				_e("<thead><tr><th></th><th>Project Name</th><th>Category</th><th>Posted By</th><th>Time Remaining</th></tr></thead>");
				while ( have_posts() ) : the_post();
					projectTheme_get_post_table();
				endwhile; 
				_e("</table>");
				
				else:
				
				_e("<p>There are no projects yet.</p>",'ProjectTheme');
				
				endif;
				wp_reset_query();
				
				?>

          <div style="clear:both;"></div> 
		
		<h2>My Work</h2>
		
        <?php endif; ?>
        
        <?php if(ProjectTheme_is_user_provider($uid)): ?>	
            
		  <h3><?php _e("Outstanding Projects",'ProjectTheme'); ?></h3>

			<?php
				
				global $wp_query;
				$query_vars = $wp_query->query_vars;
				$post_per_page = 3;				
				
		
				$outstanding = array(
						'key' => 'outstanding',
						'value' => "1",
						'compare' => '='
					);
					
				$winner = array(
						'key' => 'winner',
						'value' => $uid,
						'compare' => '='
					);		
				
				$args = array('post_type' => 'project', 'order' => 'DESC', 'orderby' => 'date', 'posts_per_page' => $post_per_page,
				'paged' => 1, 'meta_query' => array($outstanding, $winner));
				
				
				query_posts( $args  );

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					projectTheme_get_post_outstanding_project();
					//projectTheme_get_post();
				endwhile; else:
				
				_e("<p>There are no projects yet.</p>",'ProjectTheme');
				
				endif;
				wp_reset_query();
				
				?>

          <div style="clear:both;"></div> 
		  
          <h3><?php _e("My Latest Bids",'ProjectTheme'); ?></h3>
			
				<?php

				query_posts( "meta_key=bid&meta_value=".$uid."&post_type=project&order=DESC&orderby=id&posts_per_page=3" );

				if(have_posts()) :
					_e("<table class='table table-alternative table-hover'>");
					_e("<thead><tr><th></th><th>Project Name</th><th>Category</th><th>Posted By</th><th>Time Remaining</th></tr></thead>");
					while ( have_posts() ) : the_post();
						// projectTheme_get_post();
						projectTheme_get_post_table();
					endwhile; 
					_e("</table>");
					
				else:
				
					_e("<p>There are no projects yet.</p>",'ProjectTheme');
				
				endif;
				wp_reset_query();
				
				?>

          <div style="clear:both;"></div> 
        
        <?php endif; ?>   
                				
            </article>
		  </div>
        </div>
        
    
	
<?php	
} 


?>