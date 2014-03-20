<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
get_header(); 
?>


			<div class="text-part">
			

					<strong class="title"><?php echo single_cat_title('', false); ?></strong>
					
					<div class="commentlist">
					<strong>Выберите город:</strong>
					<form action="../" style="margin-top:5px;">
					<select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
						<option selected value="<?php echo get_category_link(14); ?>">Все города Украины...</option> 
							 
							<?php 						
							function mc_subcats ($parent_id) 
							{								
								$all_cats_ids = get_all_category_ids(); //получаем id ВСЕХ категорий
								sort( $all_cats_ids);
								foreach ( $all_cats_ids as $cat_id ) 
								{
									$temp = true;
									if (cat_is_ancestor_of($parent_id, $cat_id)) //проверяем, является ли категория с cat_id дочерней по отношению к $parent_id
									{  
										$child_cats_temp[] = $cat_id; //если дочерняя, то добавляем id  во временный массив 
										foreach ( $child_cats_temp as $parent_temp ) //перебираем поэлементно временный массив
										{ 
											if (cat_is_ancestor_of($parent_temp, $cat_id)) //если категория с cat_id является дочерней по отношению к хотя бы одному из элементов временного массива, ставим переключатель в положение ложь
											{
												$temp = false; 
											}
										}
										if ($temp) {
											$child_cats[] = get_cat_name($cat_id);
										}
									}
								}
								sort( $child_cats ); 
									return $child_cats; //возвращаем сортированный массив ID подкатегорий
							}
							
							$city_names = (mc_subcats(14));
							foreach ( $city_names as $city_name )
							{

								echo "<option value='".get_category_link(get_cat_id($city_name))."'>→ $city_name</option>";
							}
						?>
						
					</select>
					</form>
					</div>
					
					<ul class="links">
					<?php $zyobra=1; ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<?php if (($zyobra % 2)==0) echo "<li>\n";
							else echo "<li id='zebra'>\n";?>		

							<div><a href="<?php the_permalink(); ?>" rel="nofollow" alt="Перейти к странице: <?php the_title_attribute(); ?>" title="Перейти к странице: <?php the_title_attribute(); ?>">
							<?php set_post_thumbnail_size( 400, 120, true ); the_post_thumbnail(array(400,120)); ?>		
							</a></div>
							
							<a href="<?php the_permalink(); ?>" alt="Перейти к странице: <?php the_title_attribute(); ?>" title="Перейти к странице: <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br clear="all"/>
							
							<?php $zyobra=$zyobra+1; ?>
					
					<?php endwhile; else: echo("<h2 class='title'><span>".__("Страница не найдена, возможно она находится в стадии разработки","invest").".</span></h2>"); endif; ?>
					</ul>
					
					
				<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>	
	
			</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
