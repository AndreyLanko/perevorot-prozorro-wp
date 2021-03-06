		<?php while ( have_posts() ) : the_post(); ?>

			<?php 
				 global $ai1ec_registry;
				 $currentPostId = get_the_ID();
				 $event = $ai1ec_registry->get( 'model.event', $currentPostId );	
				 $endTime = $event->get( 'end' )->format( 'U' );	
				 $currentTime = current_time('U');
				 $pagePath = get_page_by_path('arhiv-podij', OBJECT, 'page');
			?>

			<div class="left-menu hidden-lg hidden-md hidden-sm col-xs-12 ">
				<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
				<ul>
					<li class="cat-item current-cat"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
					<li class="cat-item sub-cat <?php echo (($currentTime>$endTime)?'current-cat':'');?>" ><a href="<?php echo get_the_permalink($pagePath->ID); ?>"><?php echo _e($pagePath->post_title); ?></a></li>
					<?php	wp_nav_menu( array(
						'theme_location' => 'news_menu',
						'fallback_cb' => '__return_empty_string',
						'items_wrap' => '%3$s',
						'container' => ''
					) );
					?>
				</ul>
			</div>
			<div class="blog news col-md-8 col-lg-8 col-sm-8 col-xs-12 ">			

			<div class="back"><a href="<?php echo get_category_link(18); ?>"><i class="sprite sprite-arrow-left"></i> <?php echo get_the_category_by_ID(18); ?></a></div>
			<h3><?php echo _e(($currentTime>$endTime)?'[:ua]<span class="blue">Завершено</span><br /> [:en]<span class="blue">Ended</span><br />':''); ?><?php the_title(); ?></h3>
			<?php the_content(); ?>
			<div class="clearfix"></div>
			<div class="clearfix"></div>
			<?php endwhile; ?>
		</div>

		<div class="right-col left-menu col-md-4 col-lg-4 col-sm-4 hidden-xs ">
			<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
			<ul>
				<li class="cat-item current-cat"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
				<li class="cat-item sub-cat <?php echo (($currentTime>$endTime)?'current-cat':'');?>" ><a href="<?php echo get_the_permalink($pagePath->ID); ?>"><?php echo _e($pagePath->post_title); ?></a></li>
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
					$args = array(
						'showposts' => 5, 
						'orderby' => 'date',
						'order' => 'DESC', 
						'cat' => 1
					);
				    $query = new WP_Query($args); 
				    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();?>
					     <div class="news-small">
						      <div class="news-title">
							      <a href="<?php the_permalink(); ?>">					      
						      		<?php the_title(); ?>
					    	     </a>
				    	   	 </div>
				    	   	 <div class="date-time">
					    	   	 <?php news_date($post->ID);?>
					    	   	 <?php echo', '.get_the_time(); ?>
				    	   	 </div>
				    	</div>   
				    <?php endwhile; endif;
				    wp_reset_postdata(); ?>
			</div>

		</div>
	</div>
</div>
