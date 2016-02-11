<?php get_header();  ?>
	<div class="container">		
		<div class="row single-content">
		<?php
		if( $post->post_type == 'ai1ec_event' ) :
			get_template_part( 'single', 'event' );
			else :
			
			 while ( have_posts() ) : the_post(); ?>
			<?php 
				$category = get_the_category($post->ID);
			?>
				<div class="left-menu hidden-lg hidden-md hidden-sm col-xs-12 ">
					<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
					<ul>
						<li class="cat-item <?php echo ($category[0]->cat_ID=='18' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
						<li class="cat-item <?php echo ($category[0]->cat_ID=='17' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(19); ?>"><?php echo get_the_category_by_ID(17); ?></a></li>
						<li class="cat-item <?php echo ($category[0]->cat_ID=='16' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(16); ?>"><?php echo get_the_category_by_ID(16); ?></a></li>
						<li class="cat-item <?php echo ($category[0]->cat_ID=='1' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(1); ?>">Всі новини</a></li>
					</ul>
				</div>
				<div class="blog news col-md-8 col-lg-8 col-sm-8 col-xs-12 ">			

				<div class="back"><a href="<?php echo get_category_link($category[0]->cat_ID); ?>"><i class="sprite sprite-arrow-left"></i> <?php  echo get_the_category_by_ID($category[0]->cat_ID); ?></a></div>
				<div class="day"><?php the_time('d.m.y') ?></div>
				
				<?php if ($category[0]->cat_ID=='16') {
					 $avtor = get_the_author_meta('ID',$post->post_author);
		             $user = get_userdata($avtor); 
		             $author_posts_url = get_author_posts_url($user->ID);?>
				 <div class="img_wrapper">
	                <img src="<?php echo author_img($user->ID).'" alt="'. $user->user_firstname . ' ' . $user->user_lastname; ?>" />
	             </div>
	              <h3><?php the_title(); ?></h3>
	             <span class="day"><?php the_time('d.m.y') ?></span>
	             <span class="day"><?php echo $user->user_firstname . ' ' . $user->user_lastname; ?></span>
	              <?php } else {?>
	              <h3><?php the_title(); ?></h3>
	              <?php }?>
	             
	              <div class="clearfix"></div>
				<?php the_content(); ?>
				<div class="clearfix"></div>
				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('share-sidebar'); ?>	
				<div  class="up" id="scrollup"><i class="sprite sprite-arrow-up"></i></div>
				<div class="clearfix"></div>
				<?php if ($category[0]->cat_ID=='16') {?>
				 <div class="blog--fio">
                  <a href="<?php echo $author_posts_url; ?>"><i class="sprite-arrow-right"></i>&nbsp;<?php echo _e('[:ua]Всі статті автора [:en]'); ?> </a>
                </div>
                <?php } 
                 endwhile; ?>
			</div>

			<div class="right-col left-menu col-md-4 col-lg-4 col-sm-4 hidden-xs ">
				<h3><?php echo _e('[:ua]Рубрики [:en]Categories'); ?></h3>
				<ul>
					<li class="cat-item <?php echo ($category[0]->cat_ID=='18' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(18); ?>"><?php echo get_the_category_by_ID(18); ?></a></li>
					<li class="cat-item <?php echo ($category[0]->cat_ID=='17' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(17); ?>"><?php echo get_the_category_by_ID(17); ?></a></li>
					<li class="cat-item <?php echo ($category[0]->cat_ID=='16' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(16); ?>"><?php echo get_the_category_by_ID(16); ?></a></li>
					<li class="cat-item <?php echo ($category[0]->cat_ID=='1' ?'current-cat':'' );?>"><a href="<?php echo get_category_link(1); ?>">Всі новини</a></li>
				</ul>
				<hr />

				<div class="top-blog">
					<h3><a href="<?php echo get_category_link(16) ?>"><?php echo get_the_category_by_ID(16); ?></a></h3>
					<?php echo single_last_blog(16);?>
				</div>
				<hr />

				<div class="other-news">
					<?php  
					switch ($category->cat_ID) {
					 	case "18":
					        $c_id[1] = '1';
					        break;
					    case "17":
					    	$c_id[1] = '16';
					    	$c_id[2] = '18';
					        break;
					    case "16":
					    	$c_id[1] = '17';
					    	$c_id[2] = '18';
					        break;
					    case "1":
					        $c_id[1] = '18';
					        break;
					   }
					 ?>
					<h3><?php echo _e( ($category[0]->cat_ID==18) ? get_the_category_by_ID($c_id[1]) : '[:ua]Інші новини[:en]Other news'); ?></h3>
					<?php	
						$args = array(
							'showposts' => 5, 
							'orderby' => 'date',
							'order' => 'DESC', 
							'cat' => $c_id
						);
					    $query = new WP_Query($args); 
					    if ( $query->have_posts() ) : 
					    	while ( $query->have_posts() ) : 
					    	 $query->the_post();?>
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

<?php endif;
get_footer(); ?>	
