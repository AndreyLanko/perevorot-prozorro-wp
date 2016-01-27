<?php get_header();  ?>
	<div class="container">		
		<div class="row single-content">
		<?php while ( have_posts() ) : the_post(); ?>
		<?php 
			$category = get_the_category($post->ID);
		?>
			<div class="left-menu hidden-lg hidden-md hidden-sm col-xs-12 ">
				<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
				<ul>
					<li class="cat-item <?php echo ($category[0]->cat_ID=='19' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(19); ?>"><?php echo get_the_category_by_ID(19); ?></a></li>
					<li class="cat-item <?php echo ($category[0]->cat_ID=='18' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
					<li class="cat-item <?php echo ($category[0]->cat_ID=='17' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(19); ?>"><?php echo get_the_category_by_ID(17); ?></a></li>
					<li class="cat-item <?php echo ($category[0]->cat_ID=='16' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(16); ?>"><?php echo get_the_category_by_ID(16); ?></a></li>
				</ul>
			</div>
			<div class="blog news col-md-8 col-lg-8 col-sm-8 col-xs-12 ">
			

			<div class="back"><a href="<?php echo get_category_link($category[0]->cat_ID); ?>"><i class="sprite sprite-arrow-left"></i> <?php  echo get_the_category_by_ID($category[0]->cat_ID); ?></a></div>
			<div class="day"><?php the_time('d.m.y') ?></div>
			<h3><?php the_title(); ?></h3>
			<?php the_content(); ?>
			<div class="clearfix"></div>
			<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('share-sidebar'); ?>	
			<div  class="up" id="scrollup"><i class="sprite sprite-arrow-up"></i></div>
			<div class="clearfix"></div>

			<?php endwhile; ?>
		</div>

		<div class="right-col left-menu col-md-4 col-lg-4 col-sm-4 hidden-xs ">
			<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
			<ul>
				<li class="cat-item <?php echo ($category[0]->cat_ID=='19' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(19); ?>"><?php echo get_the_category_by_ID(19); ?></a></li>
				<li class="cat-item <?php echo ($category[0]->cat_ID=='18' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
				<li class="cat-item <?php echo ($category[0]->cat_ID=='17' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(17); ?>"><?php echo get_the_category_by_ID(17); ?></a></li>
				<li class="cat-item <?php echo ($category[0]->cat_ID=='16' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(16); ?>"><?php echo get_the_category_by_ID(16); ?></a></li>
			</ul>
			<hr />

			<div class="top-blog">
				<h3><?php echo get_the_category_by_ID(16); ?></h3>
				<?php	
					$args = array(
						'showposts' => 1, 
						'orderby' => 'date', 
						'author' => all_experts()
					);
				    $query = new WP_Query($args); 
				    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				       $avtor = get_the_author_meta('ID',$post->post_author);
				       $user = get_userdata($avtor);
				      echo '<div class="gray-bg">';
				      echo '<div class="img_wrapper"><img src="'.author_img($avtor).'" alt="'. $user->user_firstname . ' ' . $user->user_lastname .'" /></div><div class="padding"><div class="news-title"><a href="';the_permalink(); echo '">'. $user->user_firstname . ' ' . $user->user_lastname .' : '; the_title(); echo '</div><div class="more">'.comments($post->ID).'<a href="'; the_permalink(); echo '" ><i class="sprite-arrow-right"></i>&nbsp;<span id="ua">Детальніше</span><span id="en">More</span></a></div></div><div class="clearfix"></div></div>';   
				    endwhile; endif;
				    wp_reset_postdata();
				   ?>
			</div>

			<div class="other-news">
				<?php  
				switch ($category[0]->cat_ID) {
					case "19":
				        $c_id[1] = '18';
				        break;
				 	case "18":
				        $c_id[1] = '19';
				        break;
				    case "17":
				    	$c_id[1] = '16';
				    	$c_id[2] = '18';
				        $c_id[3] = '19';
				        break;
				    case "16":
				    	$c_id[1] = '17';
				    	$c_id[2] = '18';
				        $c_id[3] = '19';
				        break;
				   }
				 ?>
				<h3><?php echo _e( ($category[0]->cat_ID==18 | $category[0]->cat_ID==19) ? get_the_category_by_ID($c_id[1]) : '[:ua]Інші новини[:en]Other news'); ?></h3>
				<?php	
					$args = array(
						'showposts' => 5, 
						'orderby' => 'date', 
						'category' => $c_id
					);
				    $query = new WP_Query($args); 
				    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				      echo '<div class="news-small">';
				      echo '<div class="news-title"><a href="';the_permalink(); echo '">'; the_title(); echo '</div><div class="date-time">'.get_the_time().'</div></div>';   
				    endwhile; endif;
				    wp_reset_postdata();
				   ?>

			</div>

			</div>
		</div>
	</div>

<?php get_footer(); ?>	
