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
					
						<h1 class="title">Метка "<?php echo single_cat_title('', false); ?>" в афишах:</h1>
								
						<?php $buffer_query=$query_string; ?>
						<?php $flag = 0; ?>
						<?php query_posts("posts_per_page=-1&post_status=future,publish&order=asc&numberposts=50000&orderby=date&".$buffer_query); ?>  
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
							<?php if (($post->post_date) > (date('Y-m-d h:m:s'))) {?>
								<?php $flag = 1; ?>
								<h2 class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>						
								<p>				
									<strong><?php echo maxsite_the_russian_time(the_time('j F Y')); ?></strong>&nbsp;&nbsp;<?php the_tags( ' Метки: ', ', ', '' ); ?>
								</p> 
							<?php } ?>
						<?php endwhile; else: ?><?php endif; ?>
						
						<?php if ($flag == 0) {echo "<p>Ближайшие события с такой меткой отсутствуют</p>";} ?>
					
					<?php endif; ?>
				
					<h2 class="title">Метка "<?php echo single_cat_title('', false); ?>" в статьях и прошедших событиях:</h2>
				
					<?php query_posts($buffer_query); ?>  
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
							<p>				
								<STRONG class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></STRONG><br>						
								<?php echo maxsite_the_russian_time(the_time('j F Y')); ?>&nbsp;&nbsp;<?php the_tags( ' Метки: ', ', ', '' ); ?> 
							</p> 
	
					<?php endwhile; else: echo("<p>".__("Других записей с такой меткой не найдено","invest")."</p>"); endif; ?>
					

				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>	


				
			</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
