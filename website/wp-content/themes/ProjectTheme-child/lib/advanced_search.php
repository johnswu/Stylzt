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

	function projectTheme_posts_where2( $where ) {

			global $wpdb, $term;	
			$term = trim($term);
			$term1 = explode(" ",$term);
			$xl = '';
			
			foreach($term1 as $tt)
			{
				$xl .= " AND ({$wpdb->posts}.post_title LIKE '%$tt%' OR {$wpdb->posts}.post_content LIKE '%$tt%')";
				
			}
					
			$where .= " AND (1=1 $xl )";
	
		return $where;
	}
	

	function projectTheme_posts_join2($join) {
		global $wp_query, $wpdb;
 
		$join .= " LEFT JOIN (
				SELECT post_id, meta_value as featured_due
				FROM $wpdb->postmeta
				WHERE meta_key =  'featured' ) AS DD
				ON $wpdb->posts.ID = DD.post_id ";
		
		$meta_key = $_GET['meta_key'];
		
		if(!empty($meta_key))
		{		
				$join .= " LEFT JOIN (
				SELECT post_id, meta_value as meta_key_due
				FROM $wpdb->postmeta
				WHERE meta_key =  '$meta_key' ) AS BB
				ON $wpdb->posts.ID = BB.post_id ";		
		}
 		
		return $join;
	}

//------------------------------------------------------

	function projectTheme_posts_orderby( $orderby )
	{
		global $wpdb; $meta_key = $_GET['meta_key'];
		$order = $_GET['order'];
		
		
		if(!empty($meta_key))
		{
			$bbs = "meta_key_due+0 $order ,";	
		}
		
		$orderby = " featured_due+0 desc , ".$bbs." $wpdb->posts.post_date desc ";
		
		//--------------------------------------
		
		if($_GET['orderby'] == "title")
		{
			$orderby = " featured_due+0 desc , $wpdb->posts.post_title ".$_GET['order']." ";	
		}
		
		
		return $orderby;
	}

 
function ProjectTheme_advanced_search_area_main_function()
{
	
 
	
		if(isset($_GET['pj'])) $pj = $_GET['pj'];
	else $pj = 1;

	if(isset($_GET['order'])) $order = $_GET['order'];
	else $order = "DESC";
	
	if(isset($_GET['orderby'])) $orderby = $_GET['orderby'];
	else $orderby = "date";
	
	if(isset($_GET['meta_key'])) $meta_key = $_GET['meta_key'];
	else $meta_key = "";


	if(!empty($_GET['budgets'])) {
		
	
		$price_q = array(
			'key' => 'budgets',
			'value' => $_GET['budgets'],			
			'compare' => '='
		);
	}
	
	
	if(isset($_GET['featured']))
	{
		$featured = array(
			'key' => 'featured',
			'value' => "1",
			//'type' => 'numeric',
			'compare' => '='
		);	
		
	} 
	
	
	$closed = array(
			'key' => 'closed',
			'value' => "0",
			//'type' => 'numeric',
			'compare' => '='
		);
	

	if(!empty($_GET['project_location_cat'])) $loc = array(
			'taxonomy' => 'project_location',
			'field' => 'slug',
			'terms' => $_GET['project_location_cat']
		
	);
	else $loc = '';
	
	
	 
	
	if(!empty($_GET['project_cat_cat'])) $adsads = array(
			'taxonomy' => 'project_cat',
			'field' => 'slug',
			'terms' => $_GET['project_cat_cat']
		
	);
	else $adsads = '';

	//------------
	

	global $term;
	$term = trim($_GET['term']);
	
	if(isset($_GET['term']))
	{
		add_filter( 'posts_where' , 'projectTheme_posts_where2' );
		
	}
	
	do_action('ProjectTheme_adv_search_before_search');
	
		add_filter('posts_join', 'projectTheme_posts_join2');
	add_filter('posts_orderby', 'projectTheme_posts_orderby' );
	
	//------------
 
//orderby price - meta_value_num

	$nrpostsPage = 12;	
	$nrpostsPage = apply_filters('ProjectTheme_advanced_search_posts_per_page',$nrpostsPage);

	$args = array( 'posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'project', 'order' => $order , 
	'meta_query' => array($price_q, $closed, $featured) ,'meta_key' => $meta_key, 'orderby'=>$orderby,'tax_query' => array($loc, $adsads));
 
	
	$the_query = new WP_Query( $args );
 
	
	$nrposts = $the_query->found_posts;
	$totalPages = ceil($nrposts / $nrpostsPage);
	$pagess = $totalPages;
	
//===============*********=======================
	
?>
			  <div style="clear:both;"></div>
			  <br/>
			  <!-- Start filtering form controls -->
              <form class="navbar-form" role="search" id="searchForm">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" value="" name="term" />
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" name="ref-search" onclick="jQuery('#searchForm').submit();"><span class="fa fa-search"></span></button>
                  </span>
                </div><!-- end input group -->
				<div style="clear:both;"></div>
				<br/>
				<ul class="nav navbar-nav filter-portfolio">
					<!--
					<li class="title">
						<?php _e('Filter Options','ProjectTheme'); ?>
					</li>
					-->
					<li>
						<?php _e('Price',"ProjectTheme"); ?>:<br/>
						<?php echo ProjecTheme_get_budgets_dropdown($_GET['budgets'], 'form-control filterDropDown', 1); ?>
					</li>
					<li>
						<?php _e('Location',"ProjectTheme"); ?>:<br/>
						<?php echo ProjectTheme_get_categories_slug("project_location", $_GET['project_location_cat'],__("Select Location","ProjectTheme"), 'form-control filterDropDown'); ?>
					</li>
					<li>
						<?php _e('Category',"ProjectTheme"); ?>:<br/>
						<?php echo ProjectTheme_get_categories_slug("project_cat", $_GET['project_cat_cat'],__("Select Category","ProjectTheme") , 'form-control filterDropDown'); ?>
					</li>
					<li style="text-align:center;">
						<br/>
						<input type="submit" value="<?php _e("Refine Search","ProjectTheme"); ?>" name="ref-search" class="btn btn-primary" />
					</li>
				</ul>
			  </form>
			  <div style="clear:both;"></div>
				<div style="text-align:center;width:100%;margin-top:15px;">
                    <?php
					
						$ge = 'order='.($_GET['order'] == 'ASC' ? "DESC" : "ASC").'&meta_key=budgets&orderby=meta_value_num';
						foreach($_GET as $key => $value)
						{
							if($key != 'meta_key' && $key != 'orderby' && $key != 'order')
							{
								$ge .= '&'.$key."=".$value;	
							}
						}
					
					//------------------------
						
						$ge2 = 'order='.($_GET['order'] == 'ASC' ? "DESC" : "ASC").'&orderby=title';
						foreach($_GET as $key => $value)
						{
							if( $key != 'orderby' && $key != 'order')
							{
								$ge2 .= '&'.$key."=".$value;	
							}
						}
					//------------------------
						
						$ge3 = 'order='.($_GET['order'] == 'ASC' ? "DESC" : "ASC").'&meta_key=views&orderby=meta_value_num';
						foreach($_GET as $key => $value)
						{
							if($key != 'meta_key' && $key != 'orderby' && $key != 'order')
							{
								$ge3 .= '&'.$key."=".$value;	
							}
						}
					
					
					?>
                    
                    <?php _e("Order by:","ProjectTheme"); 
					
					$ProjectTheme_advanced_search_page_id = get_option('ProjectTheme_advanced_search_page_id');
					if(ProjectTheme_using_permalinks())
					{
						$adv = get_permalink($ProjectTheme_advanced_search_page_id)."?";	
					}
					else
					{
						$adv = get_permalink($ProjectTheme_advanced_search_page_id)."&";
					}
					
					?> 
                    <a href="<?php echo $adv; echo $ge; ?>"><?php _e("Price","ProjectTheme"); ?></a> | 
                    <a href="<?php echo $adv; echo $ge2; ?>"><?php _e("Name","ProjectTheme"); ?></a> | 
                    <a href="<?php echo $adv; echo $ge2; ?>"><?php _e("Visits","ProjectTheme"); ?></a>
				</div>
			  
			  <!-- End filtering form controls -->
            </div><!-- end navbar-collapse -->
          </div><!-- end navbar -->
        </div><!-- end col -->
        <div class="col-md-9 content">
          <div class="portfolio-wrapper">
        	
<?php
	
		
		// The Loop
		
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
			projectTheme_get_post($post, $i);
  
			
		endwhile;
	
	if(isset($_GET['pj'])) $pj = $_GET['pj'];
	else $pj = 1;
	
	$pjsk = $pj;

?>
    

                     
                    <div style="clear:both;"></div>
          <div class="pagination-wrapper">
            <ul class="pagination">
                     <?php
					 	

					$my_page 	= $pj;
					$page 		= $pj;
					
					$batch = 10;
					$nrpostsPage = $nrRes;
					$end = $batch * $nrpostsPage;
					
					if ($end > $pagess) {
						$end = $pagess;
					}
					$start = $end - $nrpostsPage + 1;
					
					if($start < 1) $start = 1;
					
					$links = '';
					
					$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
			
					$start 		= $raport * $batch + 1; 
					$end		= $start + $batch - 1;
					$end_me 	= $end + 1;
					$start_me 	= $start - 1;
					
					if($end > $totalPages) $end = $totalPages;
					if($end_me > $totalPages) $end_me = $totalPages;
					
					if($start_me <= 0) $start_me = 1;
					
					$previous_pg = $page - 1;
					if($previous_pg <= 0) $previous_pg = 1;
					
					$next_pg = $pages_curent + 1;
					if($next_pg > $totalPages) $next_pg = 1;
		
		
		if($my_page > 1)
		{
			echo '<li><a href="'.projectTheme_advanced_search_link_pgs($start_me).'">|<</a></li>';
			echo '<li><a href="'.projectTheme_advanced_search_link_pgs($previous_pg).'"><<</a></li>';
		} else {
			echo '<li class="disabled"><a href="">|<</a></li>';
			echo '<li class="disabled"><a href=""><<</a></li>';
		}
		
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pj) {
				echo '<li class="active"><a id="activees" href="#">'.$i.'</a></li>';
			} else {
				
			 
				echo '<li><a href="'.projectTheme_advanced_search_link_pgs($i).'">'.$i.'</a></li>';
			}
		}
		
	
	
 
		
		$next_pg = $pjsk+1;
		
						
		if($page < $totalPages) {
			echo '<li><a href="'.projectTheme_advanced_search_link_pgs($next_pg).'">>></a></li>';
			echo '<li><a href="'.projectTheme_advanced_search_link_pgs($end_me).'">>|</a></li>';
		} else {
			echo '<li class="disabled"><a href="">>></a></li>';
			echo '<li class="disabled"><a href="">>|</a></li>';
		}
		/*
		if($totalPages > $my_page)
		echo '<li><a href="'.projectTheme_advanced_search_link_pgs($end_me).'">>|</a></li>';
		*/
						
				
					 ?>
            </ul>
          </div><!-- end pagination-wrapper -->
                  <?php  
                                          
     	else:
		
		echo __('No projects posted.',"ProjectTheme");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();

            
					 
		?>


<?php	
	
}

?>