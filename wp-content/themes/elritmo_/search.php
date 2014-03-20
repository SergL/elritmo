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
						
						<h1 class="title">Найдено в афишах:</h1>
								
						<?php $buffer_query=$query_string; ?>
						
						<?php query_posts("post_status=future&order=ASC&".$buffer_query); ?>  
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
								<h2 class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>						
								<p>				
									<strong><?php echo maxsite_the_russian_time(the_time('j F Y')); ?></strong>&nbsp;&nbsp;<?php the_tags( ' Теги: ', ', ', '' ); ?>
								</p> 
						<?php endwhile; else: ?><p>Ближайшие события с таким тегом отсутствуют</p><?php endif; ?>
					
					<?php endif; ?>
				
					<h2 class="title">Найдено в статьях и прошедших событиях:</h2>
				
					<?php query_posts($buffer_query); ?>  
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
							<p>				
								<STRONG class="arcive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать полностью: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></STRONG><br>						
								<?php echo maxsite_the_russian_time(the_time('j F Y')); ?>&nbsp;&nbsp;<?php the_tags( ' Теги: ', ', ', '' ); ?> 
							</p> 
	
					<?php endwhile; else: echo("<p>".__("Других записей с тегом не найдено","invest")."</p>"); endif; ?>
					

				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>	

			</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
