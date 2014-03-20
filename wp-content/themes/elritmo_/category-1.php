<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
get_header(); 
?>
			<div class="text-part">
				
			<?php $page = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
			<?php if ($page==1) : ?>	
			
				<strong class="title"><!--<span class="arrow">→ </span>-->Грядущие события</strong>				
				<?php query_posts('post_status=future&order=ASC&&numberposts=50'); ?>  
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
						<h2 class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>						
						<p>				
							<strong><?php echo maxsite_the_russian_time(the_time('j F Y')); ?></strong>&nbsp;&nbsp;
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
				<?php endwhile;  
				else: ?><p>No future events scheduled.</p>  
				<?php endif; ?>
				
			<?php endif; ?>
				


				<strong class="title">Прошедшие события</strong>
								
				<?php query_posts($query_string); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
						
						
						
						
						<p>				
							<STRONG class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></STRONG><br>						
							<?php echo maxsite_the_russian_time(the_time('j F Y')); ?>&nbsp;&nbsp;
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
						

						
							<?php// the_excerpt(__('(Еще...)','invest')); ?>
							<!--<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>">Подробнее...</a></p>	-->

						

				<?php endwhile; else: echo("<p>".__("Прошедших событий нет","invest").".</p>"); endif; ?>

				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>	
				



												<?php /*
												ec3_get_events(
												   4,                                      // limit
												   '%DATE% число: <a href="%LINK%">%TITLE%</a>', // template_event
												   '',                                     // template_day
												   'j',                                    // date_format
												   '<h3>%MONTH%</h3>'                              // template_month
												); */
												?>	

												<?php				
													/*global $wpdb;	
											
													$dbq="SELECT * FROM wp_posts, wp_ec3_schedule WHERE wp_posts.ID = wp_ec3_schedule.post_id AND wp_ec3_schedule.start<CURRENT_TIMESTAMP and wp_posts.post_status = 'publish' order by wp_ec3_schedule.post_id ASC";
													$events_info = $wpdb->get_results($dbq);
													
													$i=0;
													while ($events_info[$i])
													{
														echo $events_info[$i]->post_title;
														echo $events_info[$i]->start;
														echo "<br>";
														$i++;
													}		*/	
												?>	
			
				</div><!-- end DIV text part -->
												
												
<?php get_sidebar(); ?>
<?php get_footer(); ?>
												