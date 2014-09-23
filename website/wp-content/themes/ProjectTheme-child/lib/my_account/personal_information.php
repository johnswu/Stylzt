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


function ProjectTheme_my_account_personal_info_function()
{
	
		global $current_user, $wpdb, $wp_query;
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
					<h1><?php _e("Personal Information",'ProjectTheme'); ?></h1>
				  </div><!-- end page-header -->
           <?php
				
				if(isset($_POST['save-info']))
				{
					//if(file_exists('cimy_update_ExtraFields'))
					cimy_update_ExtraFields_new_me();
					
					
					if(!empty($_FILES['avatar']["tmp_name"]))
					{
						$avatar = $_FILES['avatar'];
						
						$tmp_name 	= $avatar["tmp_name"];
        				$name 		= $avatar["name"];
        				
						$upldir = wp_upload_dir();
						$path = $upldir['path'];
						$url  = $upldir['url'];
						
						$name = str_replace(" ","",$name);
						
						if(getimagesize($tmp_name) > 0)
						{
						
							move_uploaded_file($tmp_name, $path."/".$name);
							update_user_meta($uid, 'avatar', $url."/".$name);
						
						}
					}
					
					//---------------------
					
					$wpdb->query("delete from ".$wpdb->prefix."project_email_alerts where uid='$uid' ");
					
					$email_cats = $_POST['email_cats'];
					
					if(count($email_cats) > 0)
					foreach($email_cats as $em)
					{
						$wpdb->query("insert into ".$wpdb->prefix."project_email_alerts (uid,catid) values('$uid','$em') ");						
					}
					
					
					
					//-------------------
					//email_locs
					//****************************************************************************************************
					$ProjectTheme_enable_project_location = get_option('ProjectTheme_enable_project_location');
					if($ProjectTheme_enable_project_location != "no"):
					
					
						$wpdb->query("delete from ".$wpdb->prefix."project_email_alerts_locs where uid='$uid' ");
						
						$email_cats = $_POST['email_locs'];
						
						if(count($email_cats) > 0)
						foreach($email_cats as $em)
						{
							$wpdb->query("insert into ".$wpdb->prefix."project_email_alerts_locs (uid,catid) values('$uid','$em') ");						
						}
					
					endif;
					
					//****************************************************************************************************
					//-------------------
					
					$user_description = trim($_POST['user_description']);
					update_user_meta($uid, 'user_description', $user_description);
					
					
					$per_hour = trim($_POST['per_hour']);
					update_user_meta($uid, 'per_hour', $per_hour);
					
					
					$user_location = trim($_POST['project_location_cat']);
					update_user_meta($uid, 'user_location', $user_location);
					
					$user_city = trim($_POST['user_city']);
					update_user_meta($uid, 'user_city', $user_city);
					
					$personal_info = trim($_POST['paypal_email']);
					update_user_meta($uid, 'paypal_email', $personal_info);
					
					$personal_info = trim($_POST['payza_email']);
					update_user_meta($uid, 'payza_email', $personal_info);
					
					$personal_info = trim($_POST['moneybookers_email']);
					update_user_meta($uid, 'moneybookers_email', $personal_info);
					
					$user_url = trim($_POST['user_url']);
					update_user_meta($uid, 'user_url', $user_url);
					
					do_action('ProjectTheme_pers_info_save_action');
					
					if(isset($_POST['password']) && !empty($_POST['password']))
					{
						$p1 = trim($_POST['password']);
						$p2 = trim($_POST['reppassword']);
						
						if(!empty($p1) && !empty($p2))
						{
						
							if($p1 == $p2)
							{
								global $wpdb;
								$newp = md5($p1);
								$sq = "update ".$wpdb->users." set user_pass='$newp' where ID='$uid'" ;
								$wpdb->query($sq);
								
								$inc = 1;
							}
							else {
							echo '<div class="error">'.__("Password was not updated. Passwords do not match!","ProjectTheme").'</div>'; $xxp = 1; }
						}
						else
						{
							
							echo '<div class="error">'.__("Password was not updated. Passwords do not match!","ProjectTheme").'</div>';	 $xxp = 1;		
						}
					}
					 
					
					
					//---------------------------------------
						
					$arr = $_POST['custom_field_id'];
					for($i=0;$i<count($arr);$i++)
					{
						$ids 	= $arr[$i];
						$value 	= $_POST['custom_field_value_'.$ids];
						
						if(is_array($value))
						{
							delete_user_meta($uid, "custom_field_ID_".$ids);
							
							for($j=0;$j<count($value);$j++) {
								add_user_meta($uid, "custom_field_ID_".$ids, $value[$j]);
								
							}
						}
						else
						update_user_meta($uid, "custom_field_ID_".$ids, $value);
						
					}
					
					//--------------------------------------------
					if($xxp != 1)
					{
						echo '<div class="saved_thing">'.__('Info saved!','ProjectTheme');
						
						if($inc == 1)
						{
						
							echo '<br/>'.__('Your password was changed. Redirecting to login page...','ProjectTheme');
							echo '<meta http-equiv="refresh" content="2; url='.get_bloginfo('url').'/wp-login.php">';
						
						}
						
						echo '</div>';
					}
				}
				$user = get_userdata($uid);
				
				$user_location = get_user_meta($uid, 'user_location',true);
				
				?>
         
            
            
             <form method="post"  enctype="multipart/form-data">
             
        	<h3><?php echo __('Profile Avatar','ProjectTheme'); ?>:</h3>
            <img width="100" height="100" border="0" src="<?php echo ProjectTheme_get_avatar($uid,100,100); ?>" style="float:left;margin-right:30px;" /> 
			<div style="display:inline-block;vertical-align:middle;height:100px;margin-right:30px;">
				<br><br>
				<input type="file" name="avatar" />
				<?php _e('max file size: 1mb. Formats: jpeg, jpg, png, gif' ,'ProjectTheme'); ?>
			</div>
			<input type="submit" name="save-info" class="btn btn-primary" value="<?php _e("Save" ,'ProjectTheme'); ?>" style="vertical-align:middle;" />
			<div style="clear:both;"></div>
			<br/><br/>        
   
        	<h3><?php echo __('Username','ProjectTheme'); ?>:</h3>
        	<input type="text" size="35" value="<?php echo $user->user_login; ?>" disabled="disabled" class="form-control" />
			<br/>

		<?php
			
			$opt = get_option('ProjectTheme_enable_project_location');
			if($opt != 'no'):
		
		?>
        
        	<h3><?php echo __('Location','ProjectTheme'); ?>:</h3>
            <?php	echo ProjectTheme_get_categories("project_location", $user_location , __("Select Location","ProjectTheme"), "form-control"); ?>
			<br/>			
			
        	<h3><?php echo __('City','ProjectTheme'); ?>:</h3>
        	<input type="text" size="35" name="user_city" value="<?php echo get_user_meta($uid, 'user_city', true); ?>" class="form-control" />
			<br/>
			
		<?php endif; ?>
     
            <script>
			
			jQuery(document).ready(function(){
			/*
			tinyMCE.init({
					mode : "specific_textareas",
					theme : "modern", 
					plugins : "autolink, lists, spellchecker, style, layer, table, advhr, advimage, advlink, emotions, iespell, inlinepopups, insertdatetime, preview, media, searchreplace, print, contextmenu, paste, directionality, fullscreen, noneditable, visualchars, nonbreaking, xhtmlxtras, template",
					editor_selector :"tinymce-enabled"
				});
			*/
			});
						
			</script>    

        	<h3><?php echo __('Description','ProjectTheme'); ?>:</h3>
        	<textarea cols="40" rows="5"  name="user_description" class="tinymce-enabled form-control"><?php echo get_usermeta($uid,'user_description',true); ?></textarea>
			<br/>
        
        <?php
		
        $opt = get_option('ProjectTheme_paypal_enable');
		if($opt == "yes"):
					
		?>
        
        	<h3><?php echo __('PayPal Email','ProjectTheme'); ?>:</h3>
        	<input type="text" size="35" name="paypal_email" value="<?php echo get_user_meta($uid, 'paypal_email', true); ?>" class="form-control" />
			<br/>
        
        <?php
		endif;
		
        $opt = get_option('ProjectTheme_moneybookers_enable');
		if($opt == "yes"):
					
		?>
        
        	<h3><?php echo __('Moneybookers Email','ProjectTheme'); ?>:</h3>
        	<input type="text" size="35" name="moneybookers_email" value="<?php echo get_user_meta($uid, 'moneybookers_email', true); ?>" class="form-control" />
			<br/>
        
        <?php
		endif;
		
        $opt = get_option('ProjectTheme_alertpay_enable');
		if($opt == "yes"):
					
		?>
        
        	<h3><?php echo __('Payza Email','ProjectTheme'); ?>:</h3>
        	<input type="text" size="35" name="payza_email" value="<?php echo get_user_meta($uid, 'payza_email', true); ?>" class="form-control" />
			<br/>

		<?php endif; ?> 
        
        	<h3><?php echo __('New Password', "ProjectTheme"); ?>:</h3>
        	<input type="password" value="" class="form-control" name="password" size="35" />
			<br/>
        
        
        	<h3><?php echo __('Repeat Password', "ProjectTheme"); ?>:</h3>
        	<input type="password" value="" class="form-control" name="reppassword" size="35"  />
			<br/>
        
        
        <?php do_action('ProjectTheme_pers_info_fields_1'); ?>
        
   <?php
   
   if(function_exists('cimy_extract_ExtraFields'))
   cimy_extract_ExtraFields();
   
   ?>
        
        
        <!-- <h3><?php _e("Other Information",'ProjectTheme'); ?></h3> -->
                
        <?php do_action('ProjectTheme_pers_info_fields_2'); ?>
        
        <?php
		
		
		$user_tp = get_user_meta($uid,'user_tp',true);
		if(empty($user_tp)) $user_tp = 'all';
		
		if($user_tp == "all") 
			$catid = array('all','service_buyer','service_provider');
		else
			$catid = array($user_tp);
		
 		if ( current_user_can( 'manage_options' ) ) {
			$catid = array('all','service_buyer','service_provider');
		}  
		
		
		
		$k = 0;
		$arr = ProjectTheme_get_users_category_fields($catid, $uid);
		$exf = '';
		$subFieldName = '';
		
		for($i=0;$i<count($arr);$i++)
		{
			if ($arr[$i]['field_name'] == 'Demo Reel') {
				$subFieldName = ' (paste YouTube or Vimeo URL)';
			}
		
			$exf .= '';
			$exf .= '<h3>'.$arr[$i]['field_name'].$arr[$i]['id'].$subFieldName.':</h3>';
			$exf .= '<p>'.$arr[$i]['value'].'</p>';
			$exf .= '';
			
			$subFieldName = '';
			$k++;
			
		}	
		
		echo $exf;
		 
		
		if(ProjectTheme_is_user_provider($uid)):
			$k++;
		?>           
                            
        	<h3><?php echo __('Hourly Rate','ProjectTheme'); ?> (<?php echo projectTheme_currency(); ?>):</h3>
             *<?php _e('your estimated hourly rate','ProjectTheme'); ?>
        	<input type="text" size="7" name="per_hour" value="<?php echo get_user_meta($uid, 'per_hour', true); ?>" class="form-control" /> 
			<br/>
        <?php
		endif;
		
			 global $current_user;
	 get_currentuserinfo();
	 $uid = $current_user->ID;
		
			if(ProjectTheme_is_user_provider($uid)):
			  
		?>           
                            
        	<h3><?php echo __('Portfolio Pictures','ProjectTheme'); ?>:</h3>
        	<p>
			
     <?php
	 

	 
	 ?>       
    <script type="text/javascript">
	
	function delete_this(id)
	{
		 jQuery.ajax({
						method: 'get',
						url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_ad_delete_pid='+id,
						dataType : 'text',
						success: function (text) {   jQuery('#image_ss'+id).remove();  }
					 });
		  //alert("a");
	
	}

	
	
	jQuery(function() {
		
		jQuery("#fileUpload4").uploadify({
			height        : 30,
			auto:			true,
			swf           : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.swf',
			uploader      : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploady8.php',
			width         : 180,
			buttonText	: 'Add Portfolio Images',
			fileTypeExts  : '*.jpg;*.jpeg;*.gif;*.png',
			formData    : {'ID':<?php echo 0; ?>,'author':<?php echo $uid; ?>},
			onUploadSuccess : function(file, data, response) {
			
			//alert(data);
			var bar = data.split("|");
			
jQuery('#thumbnails').append('<div class="div_div" id="image_ss'+bar[1]+'" ><img width="70" class="image_class" height="70" src="' + bar[0] + '" />&nbsp;<a class="deleteXimg" href="javascript: void(0)" style="color:#e45f56;" onclick="delete_this('+ bar[1] +')"><i class="fa fa-times-circle fa-lg"></i></a></div>');
}
	
			
			
    	});
		
		
	});
	
	
	</script>
	
    <style type="text/css">
	.div_div
	{
		border: 1px solid #ccc;
		float: left;
		margin-right: 20px;
		margin-top: 10px;
		width: 101px;
	}
	</style>
    
    <div id="fileUpload4" style="width:100%">You have a problem with your javascript</div>
    <div id="thumbnails" style="overflow:hidden;margin-top:20px">
    
    <?php

		$args = array(
		'order'          => 'ASC',
		'orderby'        => 'post_date',
		'post_type'      => 'attachment',
		'author'    => $current_user->ID,
		'meta_key' 			=> 'is_portfolio',
		'meta_value' 		=> '1',
		'post_mime_type' 	=> 'image',
		'numberposts'    	=> -1,
		); $i = 0;
		
		$attachments = get_posts($args);



	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = wp_get_attachment_url($attachment->ID);
		
			echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .
			ProjectTheme_generate_thumb($url, 70, 70). '" />&nbsp;
			<a class="deleteXimg" href="javascript: void(0)" style="color:#e45f56;" onclick="delete_this(\''.$attachment->ID.'\')"><i class="fa fa-times-circle fa-lg"></i></a>
			</div>';
	  
	}
	}


	?>
    
    </div>
            
            
            </p>
        
        <?php
		endif;
		
		if(ProjectTheme_is_user_provider($uid)):
			$k++;
		?>
                    
                        <h3><?php echo __('Emails Alerts','ProjectTheme'); ?>:</h3>
                        <p><div style="border:1px solid #ccc;background:#f2f2f2;padding: 4px 10px;overflow:auto; width:350px; border-radius:5px; height:160px;">
                        
                        <?php
							
							global $wpdb;
							$ss = "select * from ".$wpdb->prefix."project_email_alerts where uid='$uid'";
							$rr = $wpdb->get_results($ss);
							
							$terms = get_terms( 'project_cat', 'parent=0&orderby=name&hide_empty=0' );
							
							foreach($terms as $term):
								
								$chk = (projectTheme_check_list_emails($term->term_id, $rr) == true ? "checked='checked'" : "");
								
								echo '<input type="checkbox" name="email_cats[]" '.$chk.' value="'.$term->term_id.'" /> '.$term->name."<br/>";
								
								$terms2 = get_terms( 'project_cat', 'parent='.$term->term_id.'&orderby=name&hide_empty=0' );
								foreach($terms2 as $term2):
									
								
									$chk = (projectTheme_check_list_emails($term2->term_id, $rr) == 1 ? "checked='checked'" : "");
									echo '&nbsp;&nbsp; &nbsp; <input type="checkbox" name="email_cats[]" '.$chk.' value="'.$term2->term_id.'" /> '.$term2->name."<br/>";
									
									$terms3 = get_terms( 'project_cat', 'parent='.$term2->term_id.'&orderby=name&hide_empty=0' );
									foreach($terms3 as $term3):
										
										$chk = (projectTheme_check_list_emails($term3->term_id, $rr) == 1 ? "checked='checked'" : "");
										echo '&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; <input type="checkbox" '.$chk.' name="email_cats[]" 
										value="'.$term3->term_id.'" /> '.$term3->name."<br/>";
									endforeach;
										
								endforeach;
								
							endforeach;
						
						?>
                        
                        </div>
                        <br/>
                        *<?php _e('you will get an email notification when a project is posted in the selected categories','ProjectTheme'); ?></p>
        
        <?php
		
		$ProjectTheme_enable_project_location = get_option('ProjectTheme_enable_project_location');
		if($ProjectTheme_enable_project_location != "no"):
		
		?>
                        <h3>Location Alerts:</h3>
                        <p><div style="border:1px solid #ccc;background:#f2f2f2;padding: 4px 10px; overflow:auto; width:350px; border-radius:5px; height:160px;">
                        
                        <?php
							
							global $wpdb; 
							$ss = "select * from ".$wpdb->prefix."project_email_alerts_locs where uid='$uid'";
							$rr = $wpdb->get_results($ss);
							
							$terms = get_terms( 'project_location', 'parent=0&orderby=name&hide_empty=0' );
							
							foreach($terms as $term):
								
								$chk = (projectTheme_check_list_emails($term->term_id, $rr) == true ? "checked='checked'" : "");
								
								echo '<input type="checkbox" name="email_locs[]" '.$chk.' value="'.$term->term_id.'" /> '.$term->name."<br/>";
								
								$terms2 = get_terms( 'project_location', 'parent='.$term->term_id.'&orderby=name&hide_empty=0' );
								foreach($terms2 as $term2):
									
								
									$chk = (projectTheme_check_list_emails($term2->term_id, $rr) == 1 ? "checked='checked'" : "");
									echo '&nbsp;&nbsp; &nbsp; <input type="checkbox" name="email_locs[]" '.$chk.' value="'.$term2->term_id.'" /> '.$term2->name."<br/>";
									
									$terms3 = get_terms( 'project_location', 'parent='.$term2->term_id.'&orderby=name&hide_empty=0' );
									foreach($terms3 as $term3):
										
										$chk = (projectTheme_check_list_emails($term3->term_id, $rr) == 1 ? "checked='checked'" : "");
										echo '&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; <input type="checkbox" '.$chk.' name="email_locs[]" 
										value="'.$term3->term_id.'" /> '.$term3->name."<br/>";
									endforeach;
										
								endforeach;
								
							endforeach;
						
						?>
                        
                        </div>
                        <br/>
                        *<?php _e('you will get an email notification when a project is posted in the selected locations','ProjectTheme'); ?></p>
        
        
        <?php endif;  endif; 
		 
		if($k == 0)
		{
			echo '<style>#other_infs_mm, #bk_save_not { display:none; } </style>';	
		}
		
		?>
        
        			
        <h3>&nbsp;</h3> 
		<input type="hidden" value="<?php echo $uid; ?>" name="user_id" />
        <p style="text-align:center;"><input type="submit" name="save-info" class="btn btn-primary" value="<?php _e("Save" ,'ProjectTheme'); ?>" /></p>
                
            
		</form>
        
        </article>
	</div>
</div>
        
    
	
<?php	
} 


?>