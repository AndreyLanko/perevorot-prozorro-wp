<?php get_header();  ?>

<div class="container page-content">
    
    <h1 class="page-title"><?php the_title( ); ?></h1>
	<div class="row"> 
		<div class="left-menu hidden-lg hidden-md hidden-sm col-xs-12 ">
		<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
			<ul>
				<li class="cat-item current-cat"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
				<li class="cat-item"><a href="<?php echo get_category_link(17); ?>"><?php echo get_the_category_by_ID(17); ?></a></li>
				<li class="cat-item"><a href="<?php echo get_category_link(16); ?>"><?php echo get_the_category_by_ID(16); ?></a></li>
				<li class="cat-item"><a href="<?php echo get_category_link(1); ?>">Всі новини</a></li>
			</ul>
		</div>
		<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 ">
			<?php while ( have_posts() ) : the_post(); 
			the_content(); 
			$sidebar = get_post_meta($post->ID, "sidebar", true);
			if ($sidebar == 'sharebutton'){get_sidebar($sidebar);}
			endwhile; ?>
		</div>
		<div class="right-col left-menu col-md-4 col-lg-4 col-sm-4 hidden-xs ">
			<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
			<ul>
				<li class="cat-item current-cat"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
				<li class="cat-item"><a href="<?php echo get_category_link(17); ?>"><?php echo get_the_category_by_ID(17); ?></a></li>
				<li class="cat-item"><a href="<?php echo get_category_link(16); ?>"><?php echo get_the_category_by_ID(16); ?></a></li>
				<li class="cat-item"><a href="<?php echo get_category_link(1); ?>">Всі новини</a></li>
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
			    wp_reset_postdata();
			   ?>
		</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>	