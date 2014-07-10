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
if(!function_exists('ProjectTheme_display_provider_search_page_disp'))
{
function ProjectTheme_display_provider_search_page_disp()
{
	
?>	
			  <!-- Start filtering form controls -->
              <form class="navbar-form" role="search" id="searchForm" method="get">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search by Username" value="" name="username" />
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" name="ref-search" onclick="$('#searchForm').submit();"><span class="fa fa-search"></span></button>
                  </span>
                </div><!-- end input group -->
				<br/><br/>
				<ul class="nav navbar-nav filter-portfolio">
					<li class="title">
						<?php _e('Filter Options','ProjectTheme'); ?>
					</li>
					<li>
						<?php _e('Rating Over','ProjectTheme'); ?>:<br/>
						<select name="rating_over" class="form-control filterDropDown">
							<option value="0">0 stars</option>
							<option value="1">1 stars</option>
							<option value="2">2 stars</option>
							<option value="3">3 stars</option>
							<option value="4">4 stars</option>
							<option value="5">5 stars</option>
						</select>
					</li>
					<li style="text-align:center;">
						<br/>
						<input type="submit" value="<?php _e('Search','ProjectTheme'); ?>" name="search_provider" class="btn btn-primary" />
					</li>
				</ul>
			  </form>
            </div><!-- end navbar-collapse -->
          </div><!-- end navbar -->
        </div><!-- end col -->
        <div class="col-md-9 content">
          <div class="portfolio-wrapper">
<?php
			
			$ProjectTheme_enable_2_user_tp = get_option('ProjectTheme_enable_2_user_tp');
			
			
			$pg = $_GET['pg'];
			if(empty($pg)) $pg = 1;
			
			$nrRes = 15;
			
			//------------------
			
			$offset = ($pg-1)*$nrRes;
			
			//------------------
			
						if(isset($_GET['username']))
				$args['search'] = "*".trim($_GET['username'])."*";
			
			
			// prepare arguments
			$args['orderby']  = 'display_name';
			$arr_aray = array();
			
			
			
			if(!empty($_GET['rating_over'])) 
			{
				$arr_sbg = 	array(
						// uses compare like WP_Query
						'key' => 'cool_user_rating',
						'value' => $_GET['rating_over'],
						'compare' => '>'
						);
						
				array_push(	$arr_aray, 	$arr_sbg);
			}
			
			if($ProjectTheme_enable_2_user_tp == "yes")
			{
				$arr_sbg = 	array(
						// uses compare like WP_Query
						'key' => 'user_tp',
						'value' => 'service_provider',
						'compare' => '='
						);
						
				array_push(	$arr_aray, 	$arr_sbg);
				
			}
			
			//-----------------------------------------------
			
			$args['meta_query']  	= $arr_aray;
			$args['number'] 		= $nrRes;
			$args['offset'] 		= $offset;
			$args['count_total'] 	= true;
			
			//-----------------------------------------------
			
			$wp_user_query = new WP_User_Query($args);
			// Get the results
			$ttl = $wp_user_query->total_users;
			$nrPages = ceil($ttl / $nrRes);
			
			$authors = $wp_user_query->get_results();
	
			// Check for results
			if (!empty($authors))
			{
				// loop trough each author				
				foreach ($authors as $author)
				{
					// get all the user's data
					$author_info = get_userdata($author->ID);
				?>
            <div class="card film art">
				<a href="<?php echo ProjectTheme_get_user_profile_link($author->ID); ?>" class="thumb">
                <?php
					
					$width 	= 250;
					$height = 250;
					$image_class = "image_class";
					
					
					$width 			= apply_filters("ProjectTheme_regular_proj_img_width", 	$width);
					$height 		= apply_filters("ProjectTheme_regular_proj_img_height", $height);
					$image_class 	= apply_filters("ProjectTheme_regular_proj_img_class", 	$image_class);
					
				?>
                <img alt="<?php echo $author_info->user_login; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="<?php echo $image_class; ?>" 
					src="<?php echo ProjectTheme_get_avatar($author->ID,250,250); ?>" />
                <span class="overlay"><span class="fa fa-search"></span></span>
              </a>
              <div class="card-body">
                <h2><a href="<?php echo ProjectTheme_get_user_profile_link($author->ID); ?>" title="<?php echo $author_info->user_login; ?>">
				<?php echo $author_info->user_login; ?></a></h2>
				<p>
                <?php
					$info = get_user_meta($author->ID, 'user_description', true);
					if(empty($info)) _e("No personal info defined.",'ProjectTheme');
					else echo $info;
                ?>
				</p>
              </div><!-- end card-body -->
              <div class="card-footer">
                <ul class="list-inline filters">
                  <li><?php echo ProjectTheme_project_get_star_rating($author->ID); ?></li>
                </ul>
              </div><!-- end card-footer -->
            </div><!-- end card -->					
				<?php
				}
				
				$totalPages = $nrPages;
				$my_page = $pg;
				$page = $pg;
				
				$batch = 10;
				$nrpostsPage = $nrRes;
				$end = $batch * $nrpostsPage;
				
				if ($end > $pagess) {
					$end = $pagess;
				}
				$start = $end - $nrpostsPage + 1;
				
				if($start < 1) $start = 1;
				
				$links = '';
				
				$raport = ceil($my_page/$batch) - 1; 
				if ($raport < 0) $raport = 0;
		
				$start 		= $raport * $batch + 1; 
				$end		= $start + $batch - 1;
				$end_me 	= $end + 1;
				$start_me 	= $start - 1;
				
				if($end > $totalPages) $end = $totalPages;
				if($end_me > $totalPages) $end_me = $totalPages;
				
				if($start_me <= 0) $start_me = 1;
				

				$previous_pg = $page - 1;
				if($previous_pg <= 0) $previous_pg = 1;
				
				$next_pg = $page + 1;
				if($next_pg > $totalPages) $next_pg = 1;
		
				if($my_page > 1)
				{
					echo '<a href="'.projectTheme_provider_search_link() .'pg='.$previous_pg.'" class="bighi"><< '.__('Previous','ProjectTheme').'</a>';
					echo '<a href="'.projectTheme_provider_search_link() .'pg='.$start_me.'" class="bighi"><<</a>';
				}
				
				for($i=$start;$i<=$end;$i++)
				{
					if($i == $pg)
					echo '<a href="#" class="bighi" id="activees">'.$i.'</a>';
					else
					echo '<a href="'.projectTheme_provider_search_link() .'pg='.$i.'" class="bighi">'.$i.'</a>';	
				}	
				
				if($totalPages > $my_page)
				echo '<a href="'.projectTheme_provider_search_link() .'pg='.$end_me.'" class="bighi">>></a>';
				
				if($page < $totalPages)
				echo '<a href="'.projectTheme_provider_search_link() .'pg='.$next_pg.'" class="bighi">'.__('Next','ProjectTheme').' >></a>';						
					
				echo '</div>';
				
			} else {
				echo 'No authors found';
			}
}}
?>