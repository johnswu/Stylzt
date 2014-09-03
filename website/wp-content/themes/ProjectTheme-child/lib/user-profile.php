<?php

	global $wpdb,$wp_rewrite,$wp_query;
	$username = $wp_query->query_vars['post_author'];
	$uid = $username;
	$paged = $wp_query->query_vars['paged'];

	$user = get_userdata($uid);
	$username = $user->user_login;

	function sitemile_filter_ttl($title){return __("User Profile",'ProjectTheme')." - ";}
	add_filter( 'wp_title', 'sitemile_filter_ttl', 10, 3 );	
	
get_header( 'leftbar' );
?>

          <div class="page">
            <article>
              <div class="page-header">
                <div id="portfolio-carousel" class="carousel slide" data-ride="carousel">
				
				  <?php

						$args = array(
						'order'          => 'ASC',
						'orderby'        => 'post_date',
						'post_type'      => 'attachment',
						'author'    => $uid,
						'meta_key' 		=> 'is_portfolio',
						'meta_value' 	=> '1',
						'post_mime_type' => 'image',
						'numberposts'    => -1,
						); $i = 0;
						
						$attachments = get_posts($args);
						$count = 0;
						$active = 'active';

						if ($attachments) {
							if(sizeof($attachments) > 1) {
								echo '<ol class="carousel-indicators">';
								foreach ($attachments as $attachment) {
									echo '<li data-target="#portfolio-carousel" data-slide-to="'.$count.'" class="'.$active.'"></li>';
									$active = '';
								}
								echo '</ol>';
							}
						
							
						?>
						
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
						
						<?php
							$active = 'active';
							foreach ($attachments as $attachment) {
								$url = wp_get_attachment_url($attachment->ID);
								echo '<div class="item '.$active.' portfolioSlide" style="background-image:url(\''.ProjectTheme_generate_thumb($url, -1,600).'\');">&nbsp;</div>';
								$active = '';
							}
						?>
                  </div>
				  
						<?php
						} else {
							echo '<div class="carousel-inner">';
							echo '<div class="item '.$active.' portfolioSlide" style="background-image:url(\''.ProjectTheme_generate_thumb('defaultheader.png', -1,600).'\');">&nbsp;</div>';
							echo '</div>';
						}
						
						if ($attachments) {
							if(sizeof($attachments) > 1) {
						?>
                  <!-- Controls -->
                  <a class="left carousel-control" href="#portfolio-carousel" data-slide="prev">
                    <span class="fa fa-chevron-left"></span>
                  </a>
                  <a class="right carousel-control" href="#portfolio-carousel" data-slide="next">
                    <span class="fa fa-chevron-right"></span>
                  </a>
						<?php
							}
						}
						?>
                </div><!-- end carousel -->
                <h1><?php echo html_entity_decode($username); ?></h1>
              </div><!-- end page-header -->
              <div class="row">
                <div class="col-md-4" style="text-align:center;">
                  <ul class="list-unstyled post-meta">
                    <li><img class="imgImg" width="200" height="113" src="<?php echo ProjectTheme_get_avatar($uid,200,113); ?>" /></li>
					<li><?php 
						  $pr = get_user_meta($uid, 'per_hour', true);
						  if(empty($pr)) 
						  {
							$pr = __('not defined','ProjectTheme');
						  } else {
							$pr = ProjectTheme_get_show_price($pr);
						  }
						  
						  echo sprintf(__('Hourly Rate: %s','ProjectTheme'), $pr); ?></li>
                    <li><a href="<?php echo ProjectTheme_get_priv_mess_page_url('send', '', '&uid='.$uid) ?>" class="btn btn-default">Contact Me</a></li>
                  </ul><!-- end post-meta -->
                </div><!-- end col -->
                <div class="col-md-8">
                  <div class="post-content">
                    <p>
					<?php
                        $info = get_user_meta($uid, 'user_description', true);
                        if(empty($info)) _e("No personal info defined.",'ProjectTheme');
                        else echo $info;
                    ?>
					</p>
				  </div>
				</div>
				<div class="col-md-12">
                    <?php
						$arrms = ProjectTheme_get_user_fields_values($uid);
						
						if(count($arrms) > 0) 
							for($i=0;$i<count($arrms);$i++)
							{
					?>
					<h3><?php echo $arrms[$i]['field_name'];?></h3>
					<p><?php echo $arrms[$i]['field_value'];?></p>

					<?php } ?>
					</ul>
					<h3><?php _e("Portfolio Pictures",'ProjectTheme'); ?></h3>
					<ul class="portfolioPicturesList">
					<?php
					/*
						$args = array(
						'order'          => 'ASC',
						'orderby'        => 'post_date',
						'post_type'      => 'attachment',
						'author'    => $uid,
						'meta_key' 		=> 'is_portfolio',
						'meta_value' 	=> '1',
						'post_mime_type' => 'image',
						'numberposts'    => -1,
						); $i = 0;
						
						$attachments = get_posts($args);

						if ($attachments) {
					*/
							foreach ($attachments as $attachment) {
							$url = wp_get_attachment_url($attachment->ID);
							
								echo '<li><div class="div_div"  id="image_ss'.$attachment->ID.'"> <a href="'.ProjectTheme_generate_thumb($url, -1,600).'" rel="image_gal1"><img width="120" class="image_class" height="120" src="' .
								ProjectTheme_generate_thumb($url, 120, 120). '" /></a>
								 
								</div></li>';
						  
							}
					/*
						}
					*/
					?>
					</ul>
					<h3><?php _e("User Latest Posted Projects",'ProjectTheme'); ?></h3>
					<?php

						$closed = array(
										'key' => 'closed',
										'value' => '0',
										'compare' => '='
									);	
						
						$nrpostsPage = 8;
						$args = array( 'author' => $uid , 'meta_query' => array($closed)  ,'posts_per_page' => $nrpostsPage, 'paged' => $paged, 'post_type' => 'project', 'order' => "DESC" , 'orderby'=>"date");
						$the_query = new WP_Query( $args );
							
						// The Loop
						if($the_query->have_posts()):
						while ( $the_query->have_posts() ) : $the_query->the_post();
							projectTheme_get_post();
						endwhile;
						
						if(function_exists('wp_pagenavi'))
							wp_pagenavi( array( 'query' => $the_query ) );
					?>

					<?php                                
						else:
						
						echo __('No projects posted.','ProjectTheme');
						
						endif;
						// Reset Post Data
						wp_reset_postdata();
										 
					?>
					<div style="clear:both;"></div>
					<h3><?php _e("User Latest Won Projects",'ProjectTheme'); ?></h3>
					<?php
						
						$nrpostsPage = 8;
						$args = array( 'meta_key' => 'winner', 'meta_value' => $uid ,'posts_per_page' => $nrpostsPage, 'paged' => $paged, 'post_type' => 'project', 'order' => "DESC" , 'orderby'=>"date");
						$the_query = new WP_Query( $args );
						
						// The Loop
						
						if($the_query->have_posts()):
						while ( $the_query->have_posts() ) : $the_query->the_post();							
							projectTheme_get_post();
						endwhile;
						
						if(function_exists('wp_pagenavi'))
						wp_pagenavi( array( 'query' => $the_query ) );
					?>

					<?php                                
						else:
						
						echo __('No projects posted.','ProjectTheme');
						
						endif;
						// Reset Post Data
						wp_reset_postdata();
					?>
					<div style="clear:both;"></div>
					<h3><?php _e("User Latest Feedback",'ProjectTheme'); ?></h3>
					<span class="sml_ltrs"> [<a href="<?php bloginfo('siteurl'); ?>?p_action=user_feedback&post_author=<?php echo $uid; ?>"><?php _e('See All Feedback','ProjectTheme'); ?></a>]</span>
					<?php
					
						global $wpdb;
						$query = "select * from ".$wpdb->prefix."project_ratings where touser='$uid' AND awarded='1' order by id desc limit 5";
						$r = $wpdb->get_results($query);
						
						if(count($r) > 0)
						{
							echo '<table width="100%">';
								echo '<tr>';
									echo '<th>&nbsp;</th>';	
									echo '<th><b>'.__('Project Title','ProjectTheme').'</b></th>';								
									echo '<th><b>'.__('From User','ProjectTheme').'</b></th>';	
									echo '<th><b>'.__('Aquired on','ProjectTheme').'</b></th>';								
									echo '<th><b>'.__('Price','ProjectTheme').'</b></th>';
									echo '<th><b>'.__('Rating','ProjectTheme').'</b></th>';
									
								
								echo '</tr>';	
							
							
							foreach($r as $row)
							{
								$post = $row->pid;
								$post = get_post($post);
								$bid = projectTheme_get_winner_bid($row->pid);
								$user = get_userdata($row->fromuser);
								echo '<tr>';
									
									echo '<th><img class="img_class" src="'.ProjectTheme_get_first_post_image($row->pid, 42, 42).'" 
									alt="'.$post->post_title.'" width="42" /></th>';	
									echo '<th><a href="'.get_permalink($row->pid).'">'.$post->post_title.'</a></th>';
									echo '<th><a href="'.ProjectTheme_get_user_profile_link($user->user_login).'">'.$user->user_login.'</a></th>';								
									echo '<th>'.date('d-M-Y H:i:s',get_post_meta($row->pid,'closed_date',true)).'</th>';								
									echo '<th>'.projectTheme_get_show_price($bid->bid).'</th>';
									echo '<th>'.ProjectTheme_get_project_stars(floor($row->grade/2)).' ('.floor($row->grade/2).'/5)</th>';
									
								
								echo '</tr>';
								echo '<tr>';
								echo '<th></th>';
								echo '<th colspan="5"><b>'.__('Comment','ProjectTheme').':</b> '.$row->comment.'</th>'	;						
								echo '</tr>';
								
								echo '<tr><th colspan="6"><hr color="#eee" /></th></tr>';
								
							}
							
							echo '</table>';
						}
						else
						{
							_e("<p>There are no reviews to be awarded.</p>","ProjectTheme");	
						}
					?>
                  </div><!-- end col -->
                </div><!-- end row -->
              </div><!-- end post-content -->
            </article>
          </div><!-- end post -->

<?php

	get_footer('leftbar');
	
?>
