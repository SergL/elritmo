<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
get_header(); 
?>

			<div class="text-part">						
				<h1 class="title">Ошибка</h1>
				<p><strong>Ошибка 404 - Страница не найдена.</strong></p>
				<p><?php echo "<small id='gray' class='gray'>Запрос:".$query_string."</small>"; ?></p>
				
				<?php
					$myrows = $wpdb->get_results( "SELECT id, name FROM mytable" );
				?> 
				
			</div>	

<?php get_sidebar(); ?>
<?php get_footer(); ?>