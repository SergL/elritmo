<?php
	/**
	 * @package WordPress
	 * @subpackage classgdz
	 */
get_header();
?>

		<div id="text">
			<strong class="title-pencil">Раздел: <?php the_category(', '); ?></strong>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
				<h1><?php the_title(); ?></h1>
				
				<div class="alignleft" >
					<A HREF="/" class="download aligncenter">Скачать</a></P>					
				</div>
				
				
				<?php the_content(__('(more...)','invest')); ?>
				<?php edit_post_link(__('Редактироваь', 'invest'), '<p>', '</p>'); ?>

				<?php endwhile; else: echo("<h2 class='title'><span>".__("Страница не найдена, возможно она находится в стадии разработки","invest").".</span></h2>"); endif; ?>
				
				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>				
		</div>


		
<?php get_sidebar(); ?>
<?php get_footer(); ?>