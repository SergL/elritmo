<?php
/**
 * @package WordPress
 * @subpackage WordPress Invest
 */

 	/* Post thumbnails ON*/
	if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 112, 74, false ); // 50 pixels wide by 50 pixels tall, hard crop mode
 	

	
	/* Multisibebar template*/
	if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3>',
	));}
	
	
	
	
// Drop this in functions.php or your theme
if( !is_admin()){
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://code.jquery.com/jquery-latest.js"), false, '1.3.2');
	wp_enqueue_script('jquery');
}	
		

	
	
	//////////////////////////////////////////////////////////
	//   Maded by me                                        //
	//////////////////////////////////////////////////////////
	
	
	//IE detect
	function ae_detect_ie()
	{
		if (isset($_SERVER['HTTP_USER_AGENT']) && 
		(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
			return true;
		else
			return false;
	}

	
	
	
// Нужно для афиши	
add_action( 'edit_post', 'update_post_date', 1 );	
//add_action( 'pre_post_update', 'update_post_date', 1 );	
function update_post_date($post_id) {
	if ( !wp_is_post_revision( $post_id ) ) {
			global $wpdb;		
			$stata = get_post_status($post_id);
			if ($stata!='trash'){
				$wpdb->query("UPDATE $wpdb->posts SET post_status='publish' WHERE ID = ".$post_id."");						
			}
	} 	
}


add_action( 'trashed_post ', 'update_post_status_deleted', 1 );	
function update_post_status_deleted($post_id) {
	global $wpdb;
	$wpdb->query("UPDATE $wpdb->posts SET post_status='trash' WHERE ID = ".$post_id."");						
} 
	
	
	/* For MultiLang*/
	load_theme_textdomain('mantiya', TEMPLATEPATH.'/languages');
	$locale = get_locale();
	$locale_file = TEMPLATEPATH."/languages/$locale.php";
	if (is_readable($locale_file)) require_once($locale_file);
	
	
	/* Function for cross lang - ID`s;   typeof - type of data */
	function lang_id($id,$typeof){
	  if(function_exists('icl_object_id')) {
		return icl_object_id($id,$typeof,true);
	  } else {
		return $id;
	  }
	}
	
	
							function mc_subcats_for_all ($parent_id) 
							{								
								$all_cats_ids = get_all_category_ids(); //получаем id ВСЕХ категорий
								sort( $all_cats_ids);
								foreach ( $all_cats_ids as $cat_id ) 
								{
									$temp = true;
									if (cat_is_ancestor_of($parent_id, $cat_id)) //проверяем, является ли категория с cat_id дочерней по отношению к $parent_id
									{  
										$child_cats_temp[] = $cat_id; //если дочерняя, то добавляем id  во временный массив 
										foreach ( $child_cats_temp as $parent_temp ) //перебираем поэлементно временный массив
										{ 
											if (cat_is_ancestor_of($parent_temp, $cat_id)) //если категория с cat_id является дочерней по отношению к хотя бы одному из элементов временного массива, ставим переключатель в положение ложь
											{
												$temp = false; 
											}
										}
										if ($temp) {
											$child_cats[] = get_cat_name($cat_id);
										}
									}
								}
								sort( $child_cats ); 
									return $child_cats; //возвращаем сортированный массив ID подкатегорий
							}	
	
	

	
	
// Not usign
function insert_gallery($nggallery_id)
{
	global $wpdb;
	
	// Getting gallery path
	$dbq="SELECT * FROM wp_ngg_gallery WHERE gid = ".$nggallery_id;
	$gallery_info = $wpdb->get_results($dbq);
	
	// Get images
    $dbq="SELECT * FROM wp_ngg_pictures WHERE galleryid = ".$nggallery_id;
    $picture = $wpdb->get_results($dbq);
	
	
	// Echo images
	$i=0;
	while ($picture[$i])
	{
		echo "<img src=\"";
		echo get_bloginfo('url');
		echo "/{$gallery_info[0]->path}/thumbs/thumbs_{$picture[$i]->filename}\" width=\"140\" title=\"{$picture[$i]->description}\" alt=\"{$picture[$i]->description}\" />";
		
		$i++;
	}
}
?>
<?php
	// we make a function, so it will easy to applicate
	function getinput($url)
	{
		$regexp= "http:\/\/www\.youtube\.com\/watch\?v=(.*)(.*)";
		if(preg_match_all("/$regexp/siu", $url, $matches))
		return $matches[1][0];
	}
?>
<?php
 function maxsite_str_word($text, $counttext = 10, $sep = ' ') {
     $words = split($sep, $text);
     if ( count($words) > $counttext )
         $text = join($sep, array_slice($words, 0, $counttext));
     return $text;
 }
?>
<?php

////////////////////////////////////////////////////////////////////////////////
// Get Recent Comments With Avatar
////////////////////////////////////////////////////////////////////////////////
function get_avatar_recent_comment() {

	global $wpdb;

	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	comment_type,comment_author_url,
	SUBSTRING(comment_content,1,300) AS com_excerpt
	FROM $wpdb->comments
	LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	$wpdb->posts.ID)
	WHERE comment_approved = '1' AND comment_type = '' AND
	post_password = ''
	ORDER BY comment_date_gmt DESC LIMIT 5";

	$comments = $wpdb->get_results($sql);
	$output = $pre_HTML;
	$gravatar_status = 'on'; /* off if not using */

	foreach ($comments as $comment) {
	$email = $comment->comment_author_email;
	$grav_name = $comment->comment_author;
	$grav_url = "http://www.gravatar.com/avatar/".strtolower(md5($email)). "?r=G"; 
	$ttitle_buffer = $comment->post_title;?>
	<table border="0px" cellpadding="0px" cellspacing="0px" style="clear:both; margin-left:19px; padding-bottom:0px">
		<tr valign="top">
		<?php if($gravatar_status == 'on') { ?>
			<td width="30px">
				<?php echo get_avatar( $email, 32, '' ); ?>
			</td>
		<?php } ?>
			<td width="auto">							
				<p>
					<small id="gray">
						<?php $date_and_time=strip_tags($comment->comment_date_gmt); echo  maxsite_the_russian_time(date("j F Y, в G:i",strtotime($date_and_time)+60*60*2)); ?><br>
					</small> 
					<small id="gray">
						<a href="<?php echo get_permalink($comment->ID); ?>" title="На странице: <?php echo str_replace('"','|',$ttitle_buffer); ?>">
							<?php echo maxsite_str_word($ttitle_buffer,7 ,' ')." (...)"; ?>
						</a>
					</small><br>
						
					<span>
					<small><strong><?php echo strip_tags($comment->comment_author); ?></strong>&nbsp;→</small>										
						<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="На странице: <?php echo $ttitle_buffer; ?>">
							<?php echo strip_tags($comment->com_excerpt); ?>
						</a>
					</span>
				</p>
			</td>
		</tr>
	</table>
<?php
}
}
?>
<?php
/////////////////////////////
/////////////////////////////
/////////////////////////////
/////////////////////////////
/////////////////////////////
/////////////////////////////

$themename = "elritmoinfo";
$shortname = "elritmo";

$options = array (

	array(	"name" => "Настройка админки",
			"type" => "title"),
			
	array(	"type" => "open"),
	
	array(	"name" => "Число пресс-релизов на главной странице",
			"desc" => "",
			"id" => $shortname."_numberof_pressr",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "Число новостей на странице \"О нас\"",
			"desc" => "",
			"id" => $shortname."_numberof_news",
			"std" => "",
			"type" => "text"),
			
	array(	"type" => "close")
	
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">
<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style="background-color:#eef5fb; padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin'); ?>
<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '',
        'after_title' => '',
    ));

?>