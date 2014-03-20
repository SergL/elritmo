<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
?>


			<div class="sidebar-right">
				<strong class="title">Разделы сайта</strong>			
				
				<?php
				$afisha_future_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status='future' and post_type='post'"));
				$afisha_all_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) WHERE $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->term_taxonomy.term_id = 1 AND post_type = 'post' AND post_status = 'publish'");				 
				//echo $afisha_future_count;
				//echo $afisha_all_count;
				?>
				
				<ul class="menu">
					<li><a href="<?php bloginfo("url"); ?>?cat=1" title="Посмотреть все записи в рубрике «Афиша событий»">Афиша событий</a> (<?php echo $afisha_future_count."/".$afisha_all_count; ?>)</li>
					<?php wp_list_categories('title_li=&show_count=true&exclude=1&depth=1'); ?>
				</ul> 		

				<a href="<?php bloginfo('url'); ?>?p=290 #title" class="add-event">Добавить событие</a>
				<a href="<?php bloginfo('url'); ?>?p=290 #link-media" class="add-media">Загрузить отчет</a>
				
				
				<span class="title">Подписаться и поделиться</span>	

				<p class="feed">
					<a href="http://feeds.feedburner.com/Elritmoinfo" class="aligncenter"><img src="http://feeds.feedburner.com/~fc/Elritmoinfo?bg=FFFF66&amp;fg=000000&amp;anim=1&amp;label=listeners" height="26" width="88" alt="Количество подписавшихся на наши новости" class="aligncenter"/></a>
				
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
						
					<?php if (ae_detect_ie()) { ?><br><div  style="text-align:center"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-via="elritmoinfo">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script><br>

					</div> <?php }; ?>
				</p>				
				
				
				<strong class="title">Последние комментарии</strong>				
				<?php get_avatar_recent_comment(); ?>
				
				<!-- tag cloud -->
				<div class="tag-cloud">			
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>				
					<?php endif; ?>					
				</div>	


				<span class="title">Друзья ресурса</span>	 			
				<?php global $sape; echo $sape->return_links() ?>				
				

								


						
				
			</div>
		