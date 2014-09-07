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


	function projectTheme_posts_join3($join) {
		global $wp_query, $wpdb;
 
		$join .= " LEFT JOIN (
				SELECT post_id, meta_value as featured_due
				FROM $wpdb->postmeta
				WHERE meta_key =  'featured' ) AS DD
				ON $wpdb->posts.ID = DD.post_id ";

 
		return $join;
	}

//------------------------------------------------------

	function projectTheme_posts_orderby3( $orderby )
	{
		global $wpdb;
		$orderby = " featured_due+0 desc, $wpdb->posts.post_date desc ";
		return $orderby;
	}

	if(isset($_GET['pj'])) $pj = $_GET['pj'];
	else $pj = 1;
	$nrpostsPage = 12;	

	add_filter('posts_join', 	'projectTheme_posts_join3');
	add_filter('posts_orderby', 'projectTheme_posts_orderby3' );

global $query_string;
	
$closed = array(
		'key' => 'closed',
		'value' => "0",
		//'type' => 'numeric',
		'compare' => '='
);
	
$prs_string_qu = wp_parse_args($query_string);
$prs_string_qu['meta_query'] = array($closed);
$prs_string_qu['meta_key'] = 'featured';
$prs_string_qu['orderby'] = 'meta_value';
$prs_string_qu['order'] = 'DESC';
$prs_string_qu['paged'] = $pj;
$prs_string_qu['posts_per_page'] = $nrpostsPage;
		
query_posts($prs_string_qu);

global $wp_query; 
$nrposts = $wp_query->found_posts;
$totalPages = ceil($nrposts / $nrpostsPage);
$pagess = $totalPages;
 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
			
//======================================================

	get_header( 'leftbar' );
	
	$ProjectTheme_adv_code_cat_page_above_content = stripslashes(get_option('ProjectTheme_adv_code_cat_page_above_content'));
		if(!empty($ProjectTheme_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $ProjectTheme_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;
	

?>


<div class="page_heading_me">
	<div class="page_heading_me_inner">
    <div class="main-pg-title">
    	<div class="mm_inn"><?php
						if(empty($term_title)) echo __("All Posted Projects",'ProjectTheme');
						else { echo "<h2>" . sprintf( __("Latest Posted Projects in %s",'ProjectTheme'), $term_title) . "</h2>";
						
						?>
                        <!--
                        <a href="<?php bloginfo('siteurl'); ?>/?feed=rss&<?php echo get_query_var( 'taxonomy' ); ?>=<?php echo get_query_var( 'term' ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/rss_icon.png" 
                    border="0" width="19" height="19" alt="rss icon" /></a>
                        -->
                        <?php
						
						}
					?></div>
                    
        
<?php 

		/*
		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3_breadcrumb breadcrumb-wrap">';	
		    bcn_display();
			echo '</div>';
		}
		*/
?>	            
                    
    </div>


		<?php // projectTheme_get_the_search_box() ?>            
                    
    </div>
</div>
  


<?php // projecttheme_search_box_thing() ?>

<!-- ########## -->

<div id="main_wrapper">
		<div id="main" class="wrapper"><div class="padd10">




<div id="content">
 


<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<?php ProjectTheme_get_post(); ?>

<?php  
 		endwhile; 
		
		
		// if(function_exists('wp_pagenavi')):
		// wp_pagenavi(); endif;
		
	// implementing custom page navigation	
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
			echo '<li><a href="?pj='.$start_me.'">|<</a></li>';
			echo '<li><a href="?pj='.$previous_pg.'"><<</a></li>';
		} else {
			echo '<li class="disabled"><a href="">|<</a></li>';
			echo '<li class="disabled"><a href=""><<</a></li>';
		}
		
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pj) {
				echo '<li class="active"><a id="activees" href="#">'.$i.'</a></li>';
			} else {
				
			 
				echo '<li><a href="?pj='.$i.'">'.$i.'</a></li>';
			}
		}
		
	
	
 
		
		$next_pg = $pjsk+1;
		
						
		if($page < $totalPages) {
			echo '<li><a href="?pj='.$next_pg.'">>></a></li>';
			echo '<li><a href="?pj='.$end_me.'">>|</a></li>';
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


</div>


<div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
</div>



</div>
</div>
</div>

<?php

	get_footer( 'leftbar' );

?>