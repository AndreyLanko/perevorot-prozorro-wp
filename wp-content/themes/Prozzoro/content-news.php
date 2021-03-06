		<div class="row">
		<?php 
			$category = get_category(get_query_var('cat'),false);
			$_newsID = get_category_by_slug('ofitsijni-novyny')->term_id;
			$paged = get_query_var('paged') ? get_query_var('paged') : 1; 
		?>
			<div class="left-menu hidden-lg hidden-md hidden-sm col-xs-12 ">
				<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
				<ul>
					<li class="cat-item"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
				<?php	wp_nav_menu( array(
						'theme_location' => 'news_menu',
						'fallback_cb' => '__return_empty_string',
						'items_wrap' => '%3$s',
						'container' => ''
					) );
					?>		
				</ul>
			</div>
			<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 ">
			<?php if ($category->cat_ID=='18') { 
				header("HTTP/1.1 301 Moved Permanently"); 
				header("Location: /podiyi/"); 
				exit(); 
			} else {
			$args = array(
				'cat' => $category->cat_ID,
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC',
				'paged' => $paged		
			);
			$wp_query = new WP_Query( $args );
			if ( $wp_query->have_posts() ) {?>

				<?php while ( $wp_query->have_posts() ) {
				$wp_query->the_post(); 
				$my_excerpt = get_the_excerpt();
				$cut_content = content(20); ?>
				<div class="row">
					<div class="blog news col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="day"><?php the_time('d.m.y') ?></div>
					<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php echo (has_excerpt()? $my_excerpt : $cut_content); ?>
					<div class="clearfix"></div>
					<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('share-sidebar'); ?>	
					<div class="more"><a href="<?php the_permalink(); ?>"><i class="sprite-arrow-right"></i> <?php echo _e('[:ua]Детальніше [:en]More'); ?></a></div>
					<div class="clearfix"></div>
					<hr />		
					</div>
				</div>
				<?php }
			} 
			wp_reset_postdata(); ?>
		
			<div class="pager">
			    <?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
			</div>	
			<?php } ?>
		</div>

		<div class="right-col left-menu col-md-4 col-lg-4 col-sm-4 hidden-xs ">
			<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
			<ul>
				<li class="cat-item"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
				<?php	wp_nav_menu( array(
						'theme_location' => 'news_menu',
						'fallback_cb' => '__return_empty_string',
						'items_wrap' => '%3$s',
						'container' => ''
					) );
					?>		
			</ul>
		<hr />

			<div class="top-blog">
				<h3><a href="<?php echo get_category_link(16) ?>"><?php echo get_the_category_by_ID(16); ?></a></h3>
				<?php echo single_last_blog(16);?>
			</div>
			<hr />

			<div class="other-news">
				<h3><?php echo _e('[:ua]Інші новини[:en]Other news'); ?></h3>
				<?php	
					$archiveCatNews = get_category_by_slug('news');
					$archiveCatStatti = get_category_by_slug('statti');
					$archiveCatVacancies = get_category_by_slug('vacancies');
					$args = array(
						'showposts' => 5, 
						'orderby' => 'date',
						'order' => 'DESC', 
						'category__in' =>  array($archiveCatNews->term_id,
												 $archiveCatStatti->term_id,
												 $archiveCatVacancies->term_id,
												 $_newsID)
					);
				    $query = new WP_Query($args); 
				    if ( $query->have_posts() ) : 
				    	while ( $query->have_posts() ) : 
				    	 $query->the_post();?>
					     <div class="news-small">
						      <div class="news-title">
							      <a href="<?php  the_permalink(); ?>">					      
						      		<?php the_title(); ?>
					    	     </a>
				    	   	 </div>
				    	   	 <div class="date-time">
					    	   	 <?php news_date($post->ID);?>
					    	   	 <?php echo', '.get_the_time(); ?>
				    	   	 </div>
				    	</div>
				    <?php endwhile; endif;
				    wp_reset_postdata();
				   ?>

			</div>

		</div>
	</div>
