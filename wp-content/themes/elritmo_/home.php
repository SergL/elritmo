<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
get_header(); 
?>


			<div class="sidebar-left">
					 
			
				<h1 class="title">Свежие фотографии</h1>
				<?php $last_photo_article = new WP_Query(array('orderby' => 'DESC', 'cat' => 3, 'showposts' => 2)); ?>
				<?php if ($last_photo_article->have_posts()) : ?>
					<?php while ($last_photo_article->have_posts()) : $last_photo_article->the_post(); ?>
							
								<?php			
									global $wpdb;
									$gallery_id=get_post_meta($post->ID,'NextGenGalleryID',true);
									
									$picture = $wpdb->get_results("SELECT * FROM `wp_ngg_gallery`, `wp_ngg_pictures` WHERE ((galleryid=$gallery_id) AND (gid=$gallery_id) )LIMIT 1");
								
									$return  = "<a href='".get_permalink()."'><img src=\"";
									$return .= get_bloginfo('url');
									$return .= "/{$picture[0]->path}/{$picture[0]->filename}\" width=\"270\" title=\"{$picture[0]->description}\" alt=\"{$picture[0]->description}\" /></a>";
									echo $return;
									
								?>
								<P>
								<a href="<?php the_permalink(); ?>" title="Перейти к прочтению: <?php the_title(); ?>"><?php the_title(); ?></a><br>
								<SMALL id="gray"><?php echo maxsite_the_russian_time(the_time('j F Y')); ?> </small>							
								</P>
					<?php endwhile; ?>
				<?php endif; ?>			
				<p><a href="/?cat=3" class="arrow">Все фотографии</a></p>
			
			

			<b class="title">Случаное видео</b>
			<?php 
				$r = new WP_Query(array('showposts' => 5, 'post_status' => 'publish', 'cat' => 4, 'orderby' => 'rand'));
				if ($r->have_posts()) :				
					echo $title;
					while ($r->have_posts()) : $r->the_post(); ?>
					
						<table>
							<tr>
								<td>	
									<?php 							
										if (get_post_meta($post->ID,'YouTubeURL',true)!="") 
										{	
											$youtube_url = get_post_meta($post->ID,'YouTubeURL',true);
											$thumbnail_of_youtube = getinput($youtube_url);					
											echo "<a href='".get_permalink($post->ID)."'><img src='http://i1.ytimg.com/vi/".$thumbnail_of_youtube."/default.jpg'></a>";									
										}
										else 
										{
											echo "(*)";
										};
									?>							
								</td>
								<td>									
									<p>				
										<STRONG class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></STRONG><br>															
									</p> 						
								</td>
							</tr>		
						</table>															
						
					<?php endwhile; 
					wp_reset_query();  // Restore global post data stomped by the_post().
				endif;
			?>
			<p><a href="/?cat=4" class="arrow">Все видео</a></p>
			
			<b class="title">Сальса музыка</b>			
			
			<!--[if !IE]> --> 
			<object type="application/x-shockwave-flash" data="simple_mp3_player.swf" width="280" height="140"> 
			<!-- <![endif]--> 
			<!--[if IE]>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="280" height="140">
			<param name="movie" value="simple_mp3_player.swf" />
			<!--> 
			<param name="movie" value="simple_mp3_player.swf" /> 
			<param name="bgcolor" value="#FFFFFF" />
			<?php 
				$p_playlist="playlist=/wp-content/themes/elritmo/playlist.php";
				$p_width="width=280";
				$p_height="height=140";
				$p_showinfo="showinfo=1";
				$p_showvolume="showvolume=1";
				$p_volume="volume=75";
				$p_volumewidth="volumewidth=40";
				$p_volumeheight="p_volumeheight=8";
				$p_autoplay="autoplay=0";
				$p_loop="loop=1";
				$p_shuffle="shuffle=1";
				$p_showloading="showloading=always";
				$p_loadingcolor="loadingcolor=ffffff";
				$p_showlist="showlist=1";
				$p_showplaylistnumbers="showplaylistnumbers=1";
				$p_playlistcolor="playlistcolor=ffff5a"; //plashka color
				$p_playlistalpha="playlistalpha=20"; //plashka opacity
				$p_showslider="showslider=1";
				$p_sliderwidth="sliderwidth=20";
				$p_sliderheight="sliderheight=6";
				$p_slidercolor1="slidercolor1=000000";
				$p_slidercolor2="slidercolor2=000000";
				$p_sliderovercolor="sliderovercolor=ffffff";
				$p_bgcolor="bgcolor=ffffff";
				$p_bgcolor1="bgcolor1=ff9b00";
				$p_bgcolor2="bgcolor2=fffe62";
				$p_textcolor="textcolor=555555";
				$p_currentmp3color="currentmp3color=ffffff";
				$p_buttonwidth="buttonwidth=21";
				$p_buttoncolor="buttoncolor=000000";
				$p_buttonovercolor="buttonovercolor=ffffff";
				$p_scrollbarcolor="scrollbarcolor=000000";
				$p_scrollbarovercolor="scrollbarovercolor=ffffff";
				// STRING
				$param_string=$p_playlist."&".$p_width."&".$p_height."&".$p_showinfo."&".$p_showvolume."&".$p_volume."&".$p_volumewidth."&".$p_volumeheight."&".$p_autoplay."&".$p_loop."&".$p_shuffle."&".$p_showloading."&".$p_loadingcolor."&".$p_showlist."&".$p_showplaylistnumbers."&".$p_playlistcolor."&".$p_playlistalpha."&".$p_showslider."&".$p_sliderwidth."&".$p_sliderheight."&".$p_slidercolor1."&".$p_slidercolor2."&".$p_sliderovercolor."&".$p_bgcolor."&".$p_bgcolor1."&".$p_bgcolor2."&".$p_textcolor."&".$p_currentmp3color."&".$p_buttonwidth."&".$p_buttoncolor."&".$p_buttonovercolor."&".$p_scrollbarcolor."&".$p_scrollbarovercolor;			
			?>			
			<param name="FlashVars" value="<?php echo $param_string; ?>" /> 
			</object> 
			<!-- <![endif]--> 
		
			</div>
			
			
			
			
			
			<div class="sidebar-left">

			<h2 class="title">Нового на сайте</h2>
				<?php 
					$r = new WP_Query(array('showposts' => 5, 'post_status' => 'publish', 'cat' => -1, 'order' => 'DESC'));
					if ($r->have_posts()) :				
						echo $title;
						while ($r->have_posts()) : $r->the_post(); ?>						 
						
							<p class="prewiev-news"><b><small><?php the_time('j.n.Y') ?></small></b>&nbsp;&nbsp;<small id="gray">Рубрика: <?php the_category(', '); ?></small><br><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a><br>
							
							</p>
							
						<?php endwhile; 
						wp_reset_query();  // Restore global post data stomped by the_post().
					endif;
				?>	
				
			<h2 class="title">Ближайшие события</h2>
				<?php 
					$r = new WP_Query(array('post_status' => 'future', 'cat' => 1, 'order' => 'ASC'));
					if ($r->have_posts()) :				
						echo $title;
						while ($r->have_posts()) : $r->the_post(); ?>						
						
							<p><small><b><?php the_time('j F.') ?></b><span id="gray"><?php the_time(' l S') ?> в <?php the_time() ?></span></small><br><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></p>
							
						<?php endwhile; 
						wp_reset_query();  // Restore global post data stomped by the_post().
					endif;
				?>
				<p><a href="/?cat=1" class="arrow">Все события</a></p>
				
			



				
			</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
