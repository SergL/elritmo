<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
get_header(); 
?>


			<div class="text-part">
			

					<strong class="title"><?php echo single_cat_title('', false); ?></strong>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
						
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
											echo "(?)";
										};
									?>							
								</td>
								<td>									
									<p>				
										<STRONG class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></STRONG><br>						
										Добавлено: <?php echo maxsite_the_russian_time(the_time('j F Y')); ?>&nbsp;&nbsp;
											Метки:
											<?php
											$posttags = get_the_tags();
											if ($posttags) 
											{
												foreach($posttags as $tag) 
												{
													echo "<a href='http://elritmo.info/dance/".$tag->slug."' rel='tag nofollow'>";
													echo $tag->name .'</a>'; 
													
													if (!next($posttags)){echo ".";}
													else echo ", ";
													
												}
											}							
											?>
									</p> 						
								</td>
							</tr>		
						</table>
						
						
	

						
							<?php// the_excerpt(__('(Еще...)','invest')); ?>
							<!--<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>">Подробнее...</a></p>	-->

						
				<?php endwhile; else: echo("<h2 class='title'><span>".__("Страница не найдена, возможно она находится в стадии разработки","invest").".</span></h2>"); endif; ?>

				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>	
	
			</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
