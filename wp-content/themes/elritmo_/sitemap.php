<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 Template Name: Site MAP
 */
get_header(); 
?>


			<div class="text-part">					
				<h1>Карта сайта</h1>
					<?php blix_archive($show_comment_count=false,$before='<h3>',$after='</h3>',$listclass='postspermonth');?>						
			</div>		

<?php get_sidebar(); ?>
<?php get_footer(); ?>
