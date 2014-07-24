<?php

function ProjectTheme_my_account_feedbacks_area_function()
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
          <?php printf(__("Reviews/Feedback %s",'ProjectTheme'), "");?>
        </h1>
      </div>
      <!-- end page-header -->

      <h3><?php _e("Reviews I need to award",'ProjectTheme'); ?></h3>
				
              	<?php
					
					global $wpdb;
					$query = "select * from ".$wpdb->prefix."project_ratings where fromuser='$uid' AND awarded='0'";
					$r = $wpdb->get_results($query);
					
					if(count($r) > 0)
					{
						echo '<table width="100%" class="table table-striped table-hover">';
							echo '<tr>';
								echo '<th>&nbsp;</th>';	
								echo '<th><b>'.__('Project Title','ProjectTheme').'</b></th>';
								echo '<th><b>'.__('To User','ProjectTheme').'</b></th>';									
								echo '<th><b>'.__('Aquired on','ProjectTheme').'</b></th>';								
								echo '<th><b>'.__('Price','ProjectTheme').'</b></th>';
								echo '<th><b>'.__('Options','ProjectTheme').'</b></th>';
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$post 	= $row->pid;
							$post 	= get_post($post);
							$bid 	= projectTheme_get_winner_bid($row->pid);
							$user 	= get_userdata($row->touser);
							
							echo '<tr>';
								
								echo '<td><img class="img_class" width="42" height="42" src="'.ProjectTheme_get_first_post_image($row->pid, 42, 42).'" 
                               alt="'.$post->post_title.'" /></td>';	
								echo '<td><a href="'.get_permalink($row->pid).'">'.$post->post_title.'</a></td>';	
								echo '<td><a href="'.ProjectTheme_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';							
								echo '<td>'.date_i18n('d-M-Y H:i:s',get_post_meta($row->pid,'closed_date',true)).'</td>';								
								echo '<td>'.projectTheme_get_show_price($bid->bid).'</td>';
								echo '<td><a href="'.get_bloginfo('siteurl').'/?p_action=rate_user&rid='.$row->id.'">'.__('Rate User','ProjectTheme').'</a></td>';
							
							echo '</tr>';
							
						}
						
						echo '</table>';
					}
					else
					{
						_e("There are no reviews to be awarded.","ProjectTheme");	
					}
				?>
                
            
            	<h3><?php _e("Reviews I am waiting ",'ProjectTheme'); ?></h3>
				
              	<?php
					
					global $wpdb;
					$query = "select * from ".$wpdb->prefix."project_ratings where touser='$uid' AND awarded='0'";
					$r = $wpdb->get_results($query);
					
					if(count($r) > 0)
					{
						echo '<table width="100%" class="table table-striped table-hover">';
							echo '<tr>';
								echo '<th>&nbsp;</th>';	
								echo '<th><b>'.__('Project Title','ProjectTheme').'</b></th>';								
								echo '<th><b>'.__('From User','ProjectTheme').'</b></th>';	
								echo '<th><b>'.__('Aquired on','ProjectTheme').'</b></th>';								
								echo '<th><b>'.__('Price','ProjectTheme').'</b></th>';
								//echo '<th><b>'.__('Options','ProjectTheme').'</b></th>';
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$post 	= $row->pid;
							$post 	= get_post($post);
							$bid 	= projectTheme_get_winner_bid($row->pid);
							$user 	= get_userdata($row->fromuser);
							echo '<tr>';
								
								echo '<td><img class="img_class" width="42" height="42"  src="'.ProjectTheme_get_first_post_image($row->pid, 42, 42).'" 
                                alt="'.$post->post_title.'" /></td>';	
								echo '<td><a href="'.get_permalink($row->pid).'">'.$post->post_title.'</a></td>';
								echo '<td><a href="'.ProjectTheme_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';								
								echo '<td>'.date_i18n('d-M-Y H:i:s',get_post_meta($row->pid,'closed_date',true)).'</td>';								
								echo '<td>'.projectTheme_get_show_price($bid->bid).'</td>';
								//echo '<th><a href="#">Rate User</a></td>';
							
							echo '</tr>';
							
						}
						
						echo '</table>';
					}
					else
					{
						_e("There are no reviews to be awarded.","ProjectTheme");	
					}
				?>
                
                
            	<h3><?php _e("Reviews I was awarded ",'ProjectTheme'); ?></h3>
				
              	<?php
					
					global $wpdb;
					$query = "select * from ".$wpdb->prefix."project_ratings where touser='$uid' AND awarded='1'";
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
							$post 	= $row->pid;
							$post 	= get_post($post);
							$bid 	= projectTheme_get_winner_bid($row->pid);
							$user 	= get_userdata($row->fromuser);
							
							echo '<tr>';
								
								echo '<td><img width="42" height="42" class="img_class" src="'.ProjectTheme_get_first_post_image($row->pid, 42, 42).'" 
                                alt="'.$post->post_title.'" /></td>';	
								echo '<td><a href="'.get_permalink($row->pid).'">'.$post->post_title.'</a></td>';
								echo '<td><a href="'.ProjectTheme_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';								
								echo '<td>'.date_i18n('d-M-Y H:i:s',get_post_meta($row->pid,'closed_date',true)).'</td>';								
								echo '<td>'.projectTheme_get_show_price($bid->bid).'</td>';
								echo '<td>'.floor($row->grade/2).'/5</td>';
								
							
							echo '</tr>';
							echo '<tr>';
							echo '<td></td>';
							echo '<td colspan="5"><b>'.__('Comment','ProjectTheme').':</b> '.$row->comment.'</td>'	;						
							echo '</tr>';
							
							echo '<tr><td colspan="6"><hr color="#eee" /></td></tr>';
							
						}
						
						echo '</table>';
					}
					else
					{
						_e("There are no reviews to be awarded.","ProjectTheme");	
					}
				?>


    </article>
  </div>
</div>

<?php	
		
}

?>