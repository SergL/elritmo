<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
?>
			<div class="sidebar-right">
				<strong class="title">Разделы сайта</strong>			
				
				<?php
				//$afisha_future_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status='future' and post_type='post'"));
				   $afisha_future_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_date>'".date('Y-m-d h:m:s')."' and post_type='post' and post_status = 'publish'");
			  	   $afisha_all_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) WHERE $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->term_taxonomy.term_id = 1 AND post_type = 'post' AND post_status = 'publish'");				 
				//echo $afisha_future_count;
				//echo $afisha_all_count;
				?>
								
				
				<ul class="menu">
					<li><a href="http://elritmo.info/articles/afisha-vecherinok-i-meropriyatij/" title="Посмотреть все записи в рубрике «Афиша событий»">Афиша событий</a> (<?php echo $afisha_future_count."/".$afisha_all_count; ?>)</li>
					<?php wp_list_categories('title_li=&show_count=true&exclude=1&depth=1'); ?>
				</ul> 		

				<a href="<?php bloginfo('url'); ?>?p=290 #title" class="add-event">Добавить событие</a>
				<a href="<?php bloginfo('url'); ?>?p=290 #link-media" class="add-media">Загрузить отчет</a>
				
				
				<span class="title">Подписаться и поделиться</span>	

				<p class="feed">
					<noindex><a href="http://feeds.feedburner.com/Elritmoinfo" class="aligncenter" rel="nofollow"><img src="http://feeds.feedburner.com/~fc/Elritmoinfo?bg=FFFF66&amp;fg=000000&amp;anim=1&amp;label=listeners" height="26" width="88" alt="Количество подписавшихся на наши новости" class="aligncenter"/></a></noindex>
				
					<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
					<script type="text/javascript">
					new Ya.share({
						'element': 'ya_share1',
						'elementStyle': {
							'type': 'button',
							'linkIcon': true,
							'border': false,
							'quickServices': ['yaru', 'vkontakte', 'facebook', 'twitter', 'odnoklassniki', 'lj']
						},
						'popupStyle': {
							'copyPasteField': true
						}
					 });
					</script>
					<span id="ya_share1"></span>
						
					<?php if (ae_detect_ie()) { ?><br/><div  style="text-align:center"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-via="elritmoinfo">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script><br/>

					</div> <?php }; ?>
				</p>				
				

			<h2 class="title">Ближайшие события</h2>
				<?php 
					$r = new WP_Query(array('post_status' => 'publish', 'cat' => 1, 'order' => 'ASC', 'posts_per_page' => '-1'));
					if ($r->have_posts()) :				

						
						echo $title;
						while ($r->have_posts()) : $r->the_post(); ?>											
							<?php if (($post->post_date) > (date('Y-m-d h:m:s'))) {  ?>
								<p><small><b><?php the_time('j F.') ?></b><span class="gray"><?php the_time(' l S') ?> в <?php the_time() ?></span></small><br/><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></p>
							<?php } ?>
						<?php endwhile; 
						wp_reset_query();  // Restore global post data stomped by the_post().
					endif;
				?>
				<p><a href="/?cat=1" class="arrow">Все события</a></p>				
				

				
				<!-- tag cloud -->
				<span class="title">Облако меток</span>				
				<div class="tag-cloud">			
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>				
					<?php endif; ?>
				</div>				
				
				<!--<span class="title">Друзья ресурса</span>	
				<ul class="menu">				
				<?php //global $sape; echo $sape->return_links() ?>	
				</ul>-->
					
				<?php 	
					//if (is_front_page()){
					//	echo "<p>Чтобы оплачивать услуги копирайтера и администрировать сайт, нам пришлось пойти на некоторые жертвы, а именно на продажу рекламных площадок под ссылки наших партнеров. Администрация сальса-портала elritmo.info</p>";
					//}
				?>


						
				
			</div>
		