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
 
 	session_start();
	global $current_user, $wp_query;
	$pid 	=  $wp_query->query_vars['pid'];
	
	function ProjectTheme_filter_ttl($title){return __("Delete Project",'ProjectTheme')." - ";}
	add_filter( 'wp_title', 'ProjectTheme_filter_ttl', 10, 3 );	
	
	if(!is_user_logged_in()) { wp_redirect(get_bloginfo('siteurl')."/wp-login.php"); exit; }   
	   
	
	get_currentuserinfo;   

	$post = get_post($pid);

	$uid 	= $current_user->ID;
	$title 	= $post->post_title;
	$cid 	= $current_user->ID;
	
	$winner = get_post_meta($pid, 'winner', true);
	
	if(!empty($winner)) { echo 'Project has a winner, cant be deleted. Sorry!'; exit; }
	if($uid != $post->post_author) { echo 'Not your post. Sorry!'; exit; }

//-------------------------------------

	get_header('leftbar');
?>
			<div class="page">
				<article>
				  <div class="page-header">
					<h1><?php printf(__("Delete Project - %s", "ProjectTheme"), ''); ?></h1>
					<p class="lead"><?php echo (empty($_POST['project_title']) ? 
			($post->post_title == "draft project" ? "" : $post->post_title) : $_POST['project_title']); ?></p>
				  </div><!-- end page-header -->
				  <div class="row">
					<div class="col-md-12">
                
                <?php
				
				if(isset($_POST['are_you_sure']))
				{
					wp_delete_post($pid);
					echo sprintf(__("The project has been deleted. <a href='%s'>Return to your account</a>.",'ProjectTheme'), get_permalink(get_option('ProjectTheme_my_account_page_id')));
				
				}
				else
				{
				?>
                
                    <form method="post" enctype="application/x-www-form-urlencoded">
                    <h3><?php _e("Are you sure you want to delete this project?",'ProjectTheme'); ?></h3><br/>
					<p style="text-align:center;">
						<input type="submit" name="are_you_sure" value="<?php _e("Confirm Deletion",'ProjectTheme'); ?>" class="btn btn-primary" />
					</p>
                    </form>
                  
                 <?php } ?>              
                
                
          </div>
		</div>
      </article>
	</div>
                
<?php get_footer('leftbar'); ?>