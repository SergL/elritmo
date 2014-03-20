<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
get_header(); 
?>


			<div class="text-part">
			

					<H1 class="title"><?php echo single_cat_title('', false); ?></H1>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
						
						<table>
							<tr>
								<td valign="top">	
									<?php			
										global $wpdb;
										$gallery_id=get_post_meta($post->ID,'NextGenGalleryID',true);
										
										$picture = $wpdb->get_results("SELECT * FROM `wp_ngg_gallery`, `wp_ngg_pictures` WHERE ((galleryid=$gallery_id) AND (gid=$gallery_id) )LIMIT 1");
									
										$return  = "<a href='".get_permalink()."'><img src=\"";
										$return .= get_bloginfo('url');
										$return .= "/{$picture[0]->path}/{$picture[0]->filename}\" width=\"270\" title=\"{$picture[0]->description}\" alt=\"{$picture[0]->description}\" /></a>";
										echo $return;
										
									?>						
								</td>
								<td valign="top">									
												
										<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
										
										<p><STRONG>Дата:</STRONG> <?php echo maxsite_the_russian_time(the_time('j F Y')); ?><br/>
										<strong>Рубрика:</strong> <?php the_category(', '); ?><br/>
										<strong>Метки:</strong>
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
