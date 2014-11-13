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
	
	function projectTheme_colorbox_stuff()
	{	
	
		/* echo '<link media="screen" rel="stylesheet" href="'.get_bloginfo('template_url').'/css/colorbox.css" />';
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>';
		echo '<script src="'.get_bloginfo('template_url').'/js/jquery.colorbox.js"></script>'; */
		
		$get_bidding_panel = 'get_bidding_panel';
		$get_bidding_panel = apply_filters('ProjectTheme_get_bidding_panel_string', $get_bidding_panel) ;
		
?>

<script>

var $ = jQuery;

jQuery(document).ready(function(){
	
	//jQuery("a[rel='image_gal1']").colorbox();
	//jQuery("a[rel='image_gal2']").colorbox();
	
	jQuery('.get_files').click( function () {
		
		var myRel = jQuery(this).attr('rel');
		myRel = myRel.split("_");
		
		jQuery.colorbox({href: "<?php bloginfo('siteurl'); ?>/?get_files_panel=" + myRel[0] +"&uid=" + myRel[1] });
		return false;
	});
	
	
	jQuery("#report-this-link").click( function() {
		
		if(jQuery("#report-this").css('display') == 'none')					
		jQuery("#report-this").show('slow');
		else
		jQuery("#report-this").hide('slow');
		
		return false;
	});
	
	
	jQuery("#contact_seller-link").click( function() {
		
		if(jQuery("#contact-seller").css('display') == 'none')					
		jQuery("#contact-seller").show('slow');
		else
		jQuery("#contact-seller").hide('slow');
		
		return false;
	});
	
});
</script>

<?php
	}
	
	add_action('wp_head','projectTheme_colorbox_stuff');	
	//=============================
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	global $wpdb;


/*****************************************************
*
*
******************************************************/	
	
	
	
	
	if(isset($_POST['bid_now_reverse']))
	{
		if(is_user_logged_in()):
		if(isset($_POST['control_id']))
		{
			$pid 		= base64_decode($_POST['control_id']);	
			$post 		= get_post($pid);
			$bid 		= trim($_POST['bid']);	
			$des 		= trim(strip_tags($_POST['description2']));	
			$post 		= get_post($pid);
		
			$tm 		= current_time('timestamp',0);
			$days_done	= trim($_POST['days_done']);
			
			//---------------------
			
			
	
			$projectTheme_enable_custom_bidding = get_option('projectTheme_enable_custom_bidding');
			if($projectTheme_enable_custom_bidding == "yes")
			{
				
				$ProjectTheme_get_project_primary_cat = ProjectTheme_get_project_primary_cat($pid);	
				$projectTheme_theme_bidding_cat_ = get_option('projectTheme_theme_bidding_cat_' . $ProjectTheme_get_project_primary_cat);
				
				if($projectTheme_theme_bidding_cat_ > 0)
				{
					$ProjectTheme_get_credits = ProjectTheme_get_credits($uid);
					$do_not_show = 0;
					$prc = $projectTheme_theme_bidding_cat_;
					
					if(	$ProjectTheme_get_credits < $projectTheme_theme_bidding_cat_) { $do_not_show = 1;	
						$prc = $projectTheme_theme_bidding_cat_;
						
					}
					
					
				}
				
			}
			
			
			//---------------------
			
			$closed = get_post_meta($pid,'closed',true);
			if($closed == "1") { echo 'DEBUG.Project Closed'; exit; }
			
			//---------------------
			
			if(empty($days_done) || !is_numeric($days_done))
			{
				$days_done = 3;	
			}
			
			$query = "select * from ".$wpdb->prefix."project_bids where uid='$uid' AND pid='$pid'";
			$r = $wpdb->get_results($query);
			
			$other_error_to_pace_bid = false;			
			$other_error_to_pace_bid = apply_filters('ProjectTheme_other_error_to_pace_bid', $other_error_to_pace_bid, $pid);
			
			if($other_error_to_pace_bid == true):
				
				$bid_posted = "0";
				$errors = apply_filters('ProjectTheme_post_bid_errors_array', $errors, $pid);
			
			else:
			
				
				if(!is_numeric($bid)):
				
					$bid_posted = "0";
					$errors['numeric_bid_tp'] = __("Your bid must be numeric type. Eg: 9.99",'ProjectTheme');
				
				elseif($uid == $post->post_author):
					
					$bid_posted = "0";
					$errors['not_yours'] = __("Your cannot bid your own projects.",'ProjectTheme');
				
				elseif(count($r) > 0):
					
					$row 	= $r[0];
					$id 	= $row->id;
		
					
					$query 	= "update ".$wpdb->prefix."project_bids set bid='$bid', days_done='$days_done', 
					description='$des',date_made='$tm',uid='$uid' where id='$id'";
					$wpdb->query($query);
					$bid_posted = 1;
					
					 
				else:
			
					$query = "insert into ".$wpdb->prefix."project_bids (days_done,bid,description, uid, pid, date_made) 
					values('$days_done','$bid','$des','$uid','$pid','$tm')";
					$wpdb->query($query);
					$bid_posted = 1;
					
					//**********
					
					if($do_not_show == 0)
					{
						if($prc > 0)
						{
							$pst = get_post($pid); 
							$cr = projectTheme_get_credits($uid);
							projectTheme_update_credits($uid, $cr - $prc);
							
							$reason = sprintf(__('Payment for bidding on project: <a href="%s">%s</a>','ProjectTheme'), get_permalink($pid), $pst->post_title);
							projectTheme_add_history_log('0', $reason, $prc, $uid);	
						}
					}
			
					
					//**********
					
					do_action('ProjectTheme_post_bid_ok_action');
					
					add_post_meta($pid,'bid',$uid);
					
				endif; // endif has bid already

			endif;
		}
		
		
	
	
		if($bid_posted == 1):
			
			ProjectTheme_send_email_when_bid_project_owner($pid, $uid, $bid);
			ProjectTheme_send_email_when_bid_project_bidder($pid, $uid, $bid);
			
			//---------------------
			
			$prm = ProjectTheme_using_permalinks();
			if($prm == true)			
			wp_redirect(get_permalink(get_the_ID()) . "/?bid_posted=1"); 
			else
			{
				wp_redirect(get_permalink(get_the_ID()) . "&bid_posted=1"); 	
			}
			
			exit;
			
		
		endif; //endif bid posted
	
	else:
	
		$pid 		= base64_decode($_POST['control_id']);	
		wp_redirect(get_bloginfo('siteurl')."/wp-login.php");
		$_SESSION['redirect_me_back'] = get_permalink($pid);	
		exit;
		
	endif;
	}
	

	//=============================
	//function Project_change_main_class() { echo "<style> #main { background:url('".get_bloginfo('template_url')."/images/bg1.png')  } </style>"; }
	//add_filter('wp_head', 'Project_change_main_class');
	 
	
	get_header('leftbar');
	global $post;
?>
<?php
	// section to display for a hidden project, user not logged in
	$hide_project_p = get_post_meta($post->ID, 'hide_project', true);
	
	if($hide_project_p == "1" && !is_user_logged_in()):
	?>
    
               <div class="page_heading_me">
                        <div class="page_heading_me_inner">
                            <div class="mm_inn"><?php echo $post->post_title; ?>     </div>
                  	            
                                        
                        </div>
                    
                    </div>
             
	
    
    <div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo sprintf(__("Project \"%s\" is marked hidden.",'ProjectTheme'), $post->post_title); ?></div>
                <div class="box_content">
                <?php echo sprintf(__('The project "%s" was marked as hidden. <a href="%s">Please login</a> to see project details.','ProjectTheme') , $post->post_title, get_bloginfo('siteurl')."/wp-login.php"); ?>
                </div>
    </div>
    </div>   
    
    
    
    </div></div></div>
    
    <?php
	
	get_footer('leftbar');
	exit;
	endif;

?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <?php

	// start of a normal project page
	$location   		= get_post_meta(get_the_ID(), "Location", true);
	$ending     		= get_post_meta(get_the_ID(), "ending", true);
	$featured     		= get_post_meta(get_the_ID(), "featured", true);
	$private_bids     	= get_post_meta(get_the_ID(), "private_bids", true);
	$closed 	 		= get_post_meta(get_the_ID(), 'closed', true);
				
	
	//---- increase views
	
	$views    	= get_post_meta(get_the_ID(), "views", true);
	$views 		= $views + 1;
	update_post_meta(get_the_ID(), "views", $views);

	

?>

          <div class="page">
            <article>
              <div class="page-header">
                <div id="portfolio-carousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
				  
				<?php
				
					$arr = ProjectTheme_get_post_images(get_the_ID());
					$xx_w = 600;
					$projectTheme_width_of_project_images = get_option('projectTheme_width_of_project_images');
					$active = 'active';
					$count = 0;
					
					if(!empty($projectTheme_width_of_project_images)) $xx_w = $projectTheme_width_of_project_images;
					if(!is_numeric($xx_w)) $xx_w = 600;
					
					if($arr)
					{						
						if(sizeof($arr) > 1) {
							echo '<ol class="carousel-indicators">';
							foreach($arr as $image)
							{
								echo '<li data-target="#portfolio-carousel" data-slide-to="'.$count.'" class="'.$active.'"></li>';
								$active = '';
								$count++;
							}
							echo '</ol>';
						}
						
						$active = 'active';
						
						echo '<div class="carousel-inner">';
						foreach($arr as $image)
						{
							echo '<div class="item '.$active.' portfolioSlide" style="background-image:url(\''.ProjectTheme_generate_thumb($image, -1,600).'\');">&nbsp;</div>';
							$active = '';
						}
						echo '</div>';
						
					} else { 
						echo '<div class="carousel-inner">';
						echo '<div class="item '.$active.' portfolioSlide" style="background-image:url(\''.ProjectTheme_generate_thumb('defaultheader.png', -1,600).'\');">&nbsp;</div>';
						echo '</div>';
					}
						
					if ($count > 1) {
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
				?>
                </div><!-- end carousel -->
                <h1><?php the_title() ?></h1>
				
				<?php
					$ProjectTheme_enable_project_location = get_option('ProjectTheme_enable_project_location');
					if($ProjectTheme_enable_project_location == "yes"):	
						if($location != '') {
				?>
				<p class="lead">
					<?php _e("Address",'ProjectTheme');?>: <?php echo $location; ?>
				</p>
				<?php
						}
				?>
				<?php endif; ?>
				<p class="lead">
					<?php echo __("Location",'ProjectTheme'); ?>: <?php echo get_the_term_list( get_the_ID(), 'project_location', '', ', ', '' ); ?>
				</p>
				<p class="lead">
					<?php echo __("Category",'ProjectTheme'); ?>: <?php echo get_the_term_list( get_the_ID(), 'project_cat', '', ', ', '' ); ?>
				</p>
				<p class="lead">
					<?php echo __("Project Budget",'ProjectTheme'); ?>: <?php echo ProjectTheme_get_budget_name_string_fromID(get_post_meta(get_the_ID(), 'budgets', true)); ?>
				</p>
				
                <?php
				
				$my_arrms = true;
				$my_arrms = apply_filters('ProjectTheme_show_fields_in_sidebar', $my_arrms);
				
				if($my_arrms == true): 
				
					$arrms = ProjectTheme_get_project_fields_values(get_the_ID());
					
					if(count($arrms) > 0) {
						for($i=0;$i<count($arrms);$i++)
						{
							if (trim($arrms[$i]['field_value']) != '<br />') {
					?>
					<p class="lead">
						<?php echo $arrms[$i]['field_name'];?>: <?php echo $arrms[$i]['field_value'];?>
					</p>
					<?php
							}
						}
					}
					
				endif; ?>
				
              </div><!-- end page-header -->
              <div class="row">
                <div class="col-md-4">
                  <ul class="list-unstyled post-meta">
					<li style="text-align:center;">
						<?php _e("Project Posted By",'ProjectTheme'); ?><br/>
						<a class="avatar-posted-by-username" href="<?php bloginfo('siteurl'); ?>/?p_action=user_profile&post_author=<?php echo $post->post_author; ?>">
							<img width="100" height="100" border="0" class="project-single-avatar" src="<?php echo ProjectTheme_get_avatar($post->post_author, 100, 100); ?>" />
						</a><br/>
						<a class="avatar-posted-by-username" href="<?php bloginfo('siteurl'); ?>/?p_action=user_profile&post_author=<?php echo $post->post_author; ?>"><?php the_author() ?></a><br/>
						<a href="<?php echo ProjectTheme_get_user_feedback_link($post->post_author); ?>"><?php echo ProjectTheme_project_get_star_rating2($post->post_author); ?></a>
					</li>
				<?php
				if(ProjectTheme_is_owner_of_post())
				{
					
				?>
					<li style="text-align:center;">
						<a href="<?php echo get_bloginfo('siteurl'); ?>/?p_action=edit_project&pid=<?php the_ID(); ?>" class="btn btn-default"><?php _e("Edit",'ProjectTheme'); ?></a> 
					<!--
					<li style="text-align:center;">
						<a href="<?php echo get_bloginfo('siteurl'); ?>/?p_action=repost_project&pid=<?php the_ID(); ?>" class="btn btn-default"><?php _e("Repost",'ProjectTheme'); ?></a> 
					</li>
					-->&nbsp;
						<a href="<?php echo get_bloginfo('siteurl'); ?>/?p_action=delete_project&pid=<?php the_ID(); ?>" class="btn btn-danger"><?php _e("Delete",'ProjectTheme'); ?></a>
					</li>
			
			<?php } else {?>
			
                    <li style="text-align:center;"><a href="<?php
                            	
								$post = get_post(get_the_ID());
								//if($current_user->ID == $post->post_author)
								//echo '#';
								//else
								echo ProjectTheme_get_priv_mess_page_url('send', '', '&uid='.$post->post_author.'&pid='.get_the_ID());
							
							?>" class="btn btn-default project-owner-contact" rel="<?php the_ID(); ?>"><?php _e('Contact Project Owner','ProjectTheme') ?></a></li>
                    <li style="text-align:center;"><a href="#" class="btn btn-primary post_bid_btn_new" id='submit-proposal-id' rel="<?php the_ID(); ?>"><?php _e('Submit a Proposal','ProjectTheme'); ?></a></li>
				
                <?php } ?>
				
					<li><span class="fa fa-calendar"></span><?php the_time("jS F Y g:i A"); ?></li>
					<li><span class="fa fa-list"></span><?php echo __("Proposals",'ProjectTheme'); ?>: <?php echo projectTheme_number_of_bid(get_the_ID()); ?></li>
					<li><span class="fa fa-usd"></span><?php echo __("Average Bid",'ProjectTheme'); ?>: <?php echo ProjectTheme_average_bid(get_the_ID()); ?></li>
					<li><span class="fa fa-clock-o"></span><?php echo __("Time Left",'ProjectTheme'); ?>: <?php echo ($closed == "0" ? ProjectTheme_prepare_seconds_to_words($ending - current_time('timestamp',0)) 
								: __("Expired/Closed",'ProjectTheme')); ?></li>
                    <!-- <li style="text-align:center;"><a href="#" class="btn btn-primary message_brd_cls" rel="<?php the_ID(); ?>"><?php _e('Project Message Board','ProjectTheme') ?></a></li> -->
                  </ul><!-- end post-meta -->
                </div><!-- end col -->
                <div class="col-md-8">
                  <div class="post-content">
                    <p>
					<?php the_content(); 
						do_action('ProjectTheme_after_description_in_single_proj_page');
					 ?>
					</p>
					<br/>
					<!-- Project Files BEGIN -->
<?php
	
	//---------------------
	// build the exclude list
	$exclude = array();
	
	$args = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'post_parent'    => $pid,
	'meta_key'		 => 'act_dig_file',
	'meta_value'	 => '1',
	'numberposts'    => -1,
	'post_status'    => null,
	);
	$attachments = get_posts($args);
	$ProjectTheme_enable_project_files = get_option('ProjectTheme_enable_project_files');						   
	if($ProjectTheme_enable_project_files != "no" && sizeof($attachments) > 0):
?>
					<h3><?php _e("Project Files",'ProjectTheme'); ?></h3>
					<p>
						<ul class="other-dets other-dets2">
<?php
		foreach($attachments as $at)
		{
?>
							<li><a href="<?php echo $at->guid; ?>"><?php echo $at->post_title; ?></a></li> 
<?php 	}   ?>		
						</ul>
					</p>
					<br/>
<?php endif; ?>  
					
					<!-- Project Files END -->
										
					<div class="add-this">
					<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
						<a class="addthis_button_compact"></a>
						<a class="addthis_counter addthis_bubble_style"></a>
						</div>
						<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df68b4a2795dcd9"></script>
						<!-- AddThis Button END -->
					</div>	
                  </div><!-- end col -->
                </div><!-- end row -->
				<div class="col-md-12">
					<h3><?php echo __("Map Location",'ProjectTheme'); ?></h3>
					<div id="map" style="width: 100%; height: 300px;border:2px solid #ccc;float:left"></div>
					<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
					<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/mk.js"></script> 
                    <script type="text/javascript"> 
						var geocoder;
						var map;
						function initialize() {
							geocoder = new google.maps.Geocoder();
							var latlng = new google.maps.LatLng(-34.397, 150.644);
							var myOptions = {
								zoom: 13,
								center: latlng,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							}
							map = new google.maps.Map(document.getElementById("map"), myOptions);
						}

						function codeAddress(address) {

							geocoder.geocode( { 'address': address}, function(results, status) {
								if (status == google.maps.GeocoderStatus.OK) {
									map.setCenter(results[0].geometry.location);
									var marker = new MarkerWithLabel({
										position: results[0].geometry.location,
										map: map,
										labelContent: address,
										labelAnchor: new google.maps.Point(22, 0),
										labelClass: "labels", // the CSS class for the label
										labelStyle: {opacity: 1.0}
									});
								} else {
									//alert("Geocode was not successful for the following reason: " + status);
								}
							});
						}

						initialize();

						codeAddress("<?php 

							global $post;
							$pid = $post->ID;

							$terms = wp_get_post_terms($pid,'project_location');
							foreach($terms as $term)
							{
								echo $term->name." ";
							}

							$location = get_post_meta($pid, "Location", true);	
							echo $location;
							
						 ?>");

					</script> 
					
					<!-- BEGIN Proposals List -->
					<div style="clear:both;"></div>
					<br/>
					<h3><?php echo __("Proposals",'ProjectTheme'); ?></h3>
					<?php
					
					if($private_bids == 'yes' or $private_bids == '1' or $private_bids == 1) _e('[project has private proposals]','ProjectTheme');
					
					?>
					<?php
					$ProjectTheme_enable_project_files = get_option('ProjectTheme_enable_project_files');
					$winner = get_post_meta(get_the_ID(), 'winner', true);
					$post = get_post(get_the_ID());
					global $wpdb;
					$pid = get_the_ID();
					
					$bids = "select * from ".$wpdb->prefix."project_bids where pid='$pid' order by id DESC";
					$res  = $wpdb->get_results($bids);
				
					if($post->post_author == $uid) $owner = 1; else $owner = 0;
					
					if(count($res) > 0)
					{
						
						if($private_bids == 'yes' or $private_bids == '1' or $private_bids == 1)
						{
							if ($owner == 1) $show_stuff = 1;
							else if(projectTheme_current_user_has_bid($uid, $res)) $show_stuff = 1;
							else $show_stuff = 0;
						}
						else $show_stuff = 1;
						
						//------------
						
						if($show_stuff == 1):
						
							echo '<table id="my_bids" width="100%" class="table table-striped table-hover">';
							echo '<thead><tr>';
								echo '<th>'.__('Username','ProjectTheme').'</th>';
								echo '<th>'.__('Bid','ProjectTheme').'</th>';
								echo '<th>'.__('Date Made','ProjectTheme').'</th>';
								echo '<th>'.__('Days to Complete','ProjectTheme').'</th>';
								if ($owner == 1): 
									if(empty($winner))
										echo '<th>'.__('Choose Winner','ProjectTheme').'</th>';
									
									if($ProjectTheme_enable_project_files != "no")
									echo '<th>'.__('Bid Files','ProjectTheme').'</th>';
								echo '<th>'.__('Messaging','ProjectTheme').'</th>';
								endif;
								
								if($closed == "1") echo '<th>'.__('Winner','ProjectTheme').'</th>';
								
							echo '</tr></thead><tbody>';
						
						endif;
						
						//-------------
						
						foreach($res as $row)
						{
							
							if ($owner == 1) $show_this_around = 1;
							else
							{
								if($private_bids == 'yes' or $private_bids == '1' or $private_bids == 1)
								{
									if($uid == $row->uid) 	$show_this_around = 1;
									else $show_this_around = 0;
								}
								else
								$show_this_around = 1;
								
							}
							 
							if($show_this_around == 1):
							
							$user = get_userdata($row->uid);
							echo '<tr>';
							echo '<td><a href="'.ProjectTheme_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';
							echo '<td>'.ProjectTheme_get_show_price($row->bid).'</td>';
							echo '<td>'.date("n-d-Y g:i A", $row->date_made).'</td>';
							echo '<td>'. $row->days_done .'</td>';
							if ($owner == 1 ) {
								
								$nr = 7;
								if(empty($winner)) // == 0)
									echo '<td><a href="'.get_bloginfo('siteurl').'/?p_action=choose_winner&pid='.get_the_ID().'&bid='.$row->id.'">'.__('Select','ProjectTheme').'</a></td>';						
								
								if($ProjectTheme_enable_project_files != "no")
								{
									echo '<td>';
									
									if(projecttheme_see_if_project_files_bid(get_the_ID(), $row->uid) == true)
									echo '<a href="#" class="get_files" rel="'.get_the_ID().'_'.$row->uid.'">'.__('Bid Files','ProjectTheme').'</a>';
									else
									_e('None','ProjectTheme');
									
									echo '</td>';
								
								}
								echo '<td><a href="'.ProjectTheme_get_priv_mess_page_url('send', '', '&uid='.$row->uid.'&pid='.get_the_ID()).'">'.__('Send Message','ProjectTheme').'</a></td>';
							}
							else $nr = 4;
							
							if($closed == "1") { 
								if($row->winner == 1) {
									echo '<td>'.__('Yes','ProjectTheme').'</td>'; 
								} else {
									echo '<td>&nbsp;</td>'; 
								}
								$nr = 5;
							}
							
							echo '</tr>';
							
							echo '<tr>';
							echo '<td colspan="'.$nr.'" class="my_td_with_border">'.$row->description.'</td>';
							echo '</tr>';
							endif;
						}
						
						echo '</tbody></table>';
					}
					else {
						echo '<p>';
						_e("No proposals placed yet.",'ProjectTheme');
						echo '</p>';
					}
					?>	
						<!-- END Proposals List -->
				</div>
              </div><!-- end post-content -->
            </article>
          </div><!-- end post -->

		  
	
			
			<!-- ####################### -->
			
<?php endwhile; // end of the loop. ?>



<?php
	get_footer('leftbar');
?>