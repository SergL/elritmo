<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo 
 */
get_header(); 
?>


			<div class="text-part">				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<span  class="title" id="title"><a href="/" title="Вернуться на главную страницу">Главная</a> <span class="arrow">→</span> <?php the_category(', '); ?></span>
						<h1><?php the_title(); ?></h1>		
						<p>
							<?php if (!in_category(mc_subcats_for_all(14))) :?> 
								<?php if (in_category(1)) : ?><strong>Начало:</strong> <?php echo maxsite_the_russian_time(the_time('j F Y')); ?>, в <?php echo get_the_time(); ?><br>							
								<?php else : ?><strong>Опубликовано:</strong> <?php echo maxsite_the_russian_time(the_time('j F Y')); ?><br>
								<?php endif;?>
								
								
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
							
<?php endif; ?>
						</p>
						

<?php the_content(__('(more...)','invest')); ?>

<!-- Put this div tag to the place, where the Comments block will be -->
<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 10, width: "605", attach: "link"});
</script>
						<?php edit_post_link(__('Редактировать материал', 'elritmo'), '<p>', '</p>'); ?>	





<!-- закоментил стандартныекоментарии < это ?php comments_template( '', true ); ?> -->

				<?php endwhile; else: echo("<h2 class='title'><span>".__("Страница не найдена, возможно она находится в стадии разработки","elritmo").".</span></h2>"); endif; ?>
				
				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>	
			</div>		

<?php get_sidebar(); ?>
<?php get_footer(); ?>
