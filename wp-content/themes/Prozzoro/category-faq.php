<?php get_header();  ?>
<div class="container">

	<h1 class="page-title"><?php single_cat_title( ); ?></h1>
	<?php $category = get_category(get_query_var('cat'),false);?>
	<div class="row">
		<div class="left-menu col-md-4 col-lg-4 col-sm-4 col-xs-12 ">
		<ul>
		<li class="cat-item cat-item-15 <?php echo ($category->cat_ID=='15' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(15) ?>"><?php echo _e('[:ua]Всі [:en]All'); ?></a></li>
		<?php  $list_args =  array(
				 // 'taxonomy'     => 'FAQ', // название таксономии
				  'child_of' => 15,
				  'orderby'      => 'name',  // сортируем по названиям
				  'show_count'   => 0,       // не показываем количество записей
				  'pad_counts'   => 0,       // не показываем количество записей у родителей
				  'hierarchical' => 1,       // древовидное представление
				  'title_li'     => ''  
				 );
		wp_list_categories( $list_args ); ?>
		</ul>
		</div>
		<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 ">
			<?php 
				$cat_list = $category->cat_ID;
				$args = array(
					'cat' => $cat_list,
					'post_type' => 'faq',
					'post_status' => 'publish',
					'orderby' => 'date',
					'order' => 'DESC',					
					'posts_per_page' => -1				
				);
				$wp_query = new WP_Query( $args );

				if ( $wp_query->have_posts() ) {?>

					<?php while ( $wp_query->have_posts() ) {
					$wp_query->the_post(); ?>
					<div class="faq">
					<ul class="faq--list">
						<li>
							<div class="faq--qestion"><a href="#faq-<?php the_ID(); ?>" data-toggle="collapse"><?php the_title(); ?></a></div>
							<div class="faq--answer">	
								<div id="faq-<?php the_ID(); ?>" class="collapse">
									<?php the_content(); ?>
									<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('share-sidebar'); ?>
									<div class="up"><a href="#faq-<?php the_ID(); ?>" data-toggle="collapse"><i class="sprite sprite-arrow-up"></i></a></div>
									<div class="clearfix"></div>
									<hr />
								</div>
							</div>
						</li>
					</ul>					
					</div>
					<?php }
				} 
				wp_reset_postdata(); ?>	
		</div>
	</div>

</div>

<?php get_footer(); ?>	