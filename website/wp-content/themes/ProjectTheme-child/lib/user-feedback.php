<?php

	global $wpdb,$wp_rewrite,$wp_query;
	$username = $wp_query->query_vars['post_author'];
	$uid = $username;
	$paged = $wp_query->query_vars['paged'];

	$user = get_userdata($uid);
	$username = $user->user_login;

	function sitemile_filter_ttl($title){return __("User Feedback",'ProjectTheme')." - ";}
	add_filter( 'wp_title', 'sitemile_filter_ttl', 10, 3 );	
	
get_header('leftbar');
?>
          <div class="page">
            <article>
              <div class="page-header">
                <h1><?php _e("User Feedback",'ProjectTheme'); ?> - <?php echo $username; ?></h1>
              </div><!-- end page-header -->
                
                <?php
					
					global $wpdb;
					$page_rows = 25;
					
					$pagenum 	= isset($_GET['pagenum']) ? $_GET['pagenum'] : 1;
					$max 		= ' limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 
					
					global $wpdb;
					$query = "select * from ".$wpdb->prefix."project_ratings where touser='$uid' AND awarded='1' order by id desc $max";
					$r = $wpdb->get_results($query);
					
					$query2 = "select count(id) tots from ".$wpdb->prefix."project_ratings where touser='$uid' AND awarded='1' order by id desc";
					$r2 = $wpdb->get_results($query2);
					$total 	= $r2[0]->tots;
				
					$last = ceil($total/$page_rows);
					
					if(count($r) > 0)
					{
						echo '<table width="100%" class="table table-striped table-hover">';
							echo '<tr>';
								echo '<th>&nbsp;</th>';	
								echo '<th>'.__('Project Title','ProjectTheme').'</th>';								
								echo '<th>'.__('From User','ProjectTheme').'</th>';	
								echo '<th>'.__('Aquired on','ProjectTheme').'</th>';								
								echo '<th>'.__('Price','ProjectTheme').'</th>';
								echo '<th>'.__('Rating','ProjectTheme').'</th>';
								
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$post = $row->pid;
							$post = get_post($post);
							$bid = projectTheme_get_winner_bid($row->pid);
							$user = get_userdata($row->fromuser);
							
							$dts = get_post_meta($row->pid,'closed_date',true);
							if(empty($dts)) $dts = current_time('timestamp',0);
							
							echo '<tr>';
								
								echo '<td><img class="img_class" src="'.ProjectTheme_get_first_post_image($row->pid, 42, 42).'" 
                                alt="'.$post->post_title.'" width="42" /></td>';	
								echo '<td><a href="'.get_permalink($row->pid).'">'.$post->post_title.'</a></td>';
								echo '<td><a href="'.ProjectTheme_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';								
								echo '<td>'.date_i18n('d-M-Y H:i:s', $dts).'</td>';								
								echo '<td>'.projectTheme_get_show_price($bid->bid).'</td>';
								echo '<td>'.ProjectTheme_get_project_stars(floor($row->grade/2)).' ('.floor($row->grade/2).'/5)</td>';
								
							
							echo '</tr>';
							echo '<tr>';
							echo '<th></th>';
							echo '<td colspan="5"><b>'.__('Comment','ProjectTheme').':</b> '.$row->comment.'</td>'	;						
							echo '</tr>';
							 
							echo '<tr><td colspan="6"><hr color="#eee" /></td></tr>';
							
						}
						echo '<tr>';
						echo '<th colspan="6">'. ProjectTheme_get_my_pagination_main(get_bloginfo('siteurl') . "/?p_action=user_feedback&post_author=".$uid, $pagenum, 'pagenum', $last ) .'</th>';
						echo '</tr>';
						
						echo '</table>';
					}
					else
					{
						_e("There are no reviews to be awarded.","ProjectTheme");	
					}
				?>
                
                
				<!-- ####### -->
                </article>
                
            </div>

<?php

	//sitemile_after_content(); 
	
	get_footer('leftbar');
	
?>
