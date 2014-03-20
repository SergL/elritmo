<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
get_header(); 
?>


			<div class="text-part">					
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
						
						<?php the_content(__('(more...)','invest')); ?>
						
						<ul class="links">
						<?php global $wpdb;
						$items = $wpdb->get_results("SELECT * FROM wp_links ORDER BY link_rating DESC, link_id DESC");
						$zyobra=1;
							foreach ( (array) $items as $item ) 
							{
									if (($zyobra % 2)==0) echo "<li>\n";
									else echo "<li id='zebra'>\n"; 							
									
									echo "<div><a href='".$item->link_url."' rel='nofollow' target='_blank'><img src='".$item->link_image."' alt='Перейти: ".$item->link_description."' title='Перейти: ".$item->link_description."'/></a></div>";
									echo "<span><a href='".$item->link_url."'  alt='Перейти: ".$item->link_description."' title='Перейти: ".$item->link_description."' target='_blank'>".$item->link_name."</a></span><br clear='all'>";
									echo "</li>";	
									$zyobra=$zyobra+1;
							}						
						?>
						<ul>												
						
						<?php edit_post_link(__('Редактироваь', 'invest'), '<p>', '</p>'); ?>
		
				<?php endwhile; else: echo("<h2 class='title'><span>".__("Страница не найдена, возможно она находится в стадии разработки","invest").".</span></h2>"); endif; ?>				
				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>	
			</div>		

<?php get_sidebar(); ?>
<?php get_footer(); ?>
