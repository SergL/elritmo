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
			
				<h1 class="title"><!--<span class="arrow">→ </span>-->Афиша: сальса-вечеринки Украины, фестивали, мастер-классы и др.</h1>				

				<?php $flag = 0; ?>
				<?php query_posts('posts_per_page=-1&post_status=future,publish&cat=1&order=asc&numberposts=50000&orderby=date'); ?>  
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
						<?php // echo "$post->post_date <br/>"; ?>
						<?php if (($post->post_date) > (date('Y-m-d h:m:s'))) {?><?php $flag = 1; ?>
						<h3 class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>						
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
						<?php } ?>
				<?php endwhile;  
				else: ?>
				<?php endif; ?>
				
				<?php if ($flag == 0) {echo "<p>Ближайших событий пока нет</p>";} ?>
				
			<?php endif; ?>
				


				<h2 class="title">Прошедшие события</h2>
								
				<?php query_posts($query_string); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
						
						
						
						<?php if (($post->post_date) <= (date('Y-m-d h:m:s'))) {?>
						<p>				
							<strong class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br/>						
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
						<?php } ?>

						
							<?php// the_excerpt(__('(Еще...)','invest')); ?>
							<!--<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>">Подробнее...</a></p>	-->

						

				<?php endwhile; else: echo("<p>".__("Прошедших событий нет","invest").".</p>"); endif; ?>

				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>	
				

				</div><!-- end DIV text part -->
												
												
<?php get_sidebar(); ?>
<?php get_footer(); ?>
												