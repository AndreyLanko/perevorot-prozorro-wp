	<div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
	<div class="row">
			<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 ">
			<?php 
			$category = get_category(get_query_var('cat'),false);
			$author = $category->cat_ID==16  ? all_experts() : '';
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;

			$args = array(
				'cat' => $category->cat_ID,
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC',
				'paged' => $paged,
				'author' => $author
			);
			$wp_query = new WP_Query( $args );
			if ( $wp_query->have_posts() ) {?>

				<?php while ( $wp_query->have_posts() ) {
				$wp_query->the_post(); 	?>
				<div class="row">
					<div class="blog <?php // echo ($paged == 1 ? 'first':''); ?> col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<?php if ($category->cat_ID==16) { 
						$avtor = get_the_author_meta('ID',$post->post_author);
						$user = get_userdata($avtor);?>
					 <div class="img_wrapper"><img src="<?php echo author_img($avtor);?>" alt="<?php echo $user->user_firstname . ' ' . $user->user_lastname ;?> " /></div>
					 <?php } ?>
					<span class="day"><?php the_time('d.m.y') ?></span>
					<h3 class="title"><a href="<?php the_permalink(); ?>"><?php echo $category->cat_ID==16 ? ($user->user_firstname . ' ' . $user->user_lastname.':<br/>') : '';?>  <?php the_title(); ?></a></h3>
					<?php echo content(50); ?>
					<div class="clearfix"></div>
					<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('share-sidebar'); ?>	
					<div class="more"><a href="<?php the_permalink(); ?>"><i class="sprite-arrow-right"></i><?php echo ' ';?><?php echo _e('[:ua] Детальніше [:en] More'); ?></a></div>
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
		</div>

		<div class="right-col col-md-4 col-lg-4 col-sm-4 col-xs-hidden ">
		<div class="fb-page" data-href="https://www.facebook.com/prozorro" data-tabs="timeline" data-width="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true" ><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/prozorro"><a href="https://www.facebook.com/prozorro">Система електронних державних закупівель ProZorro</a></blockquote></div></div>
			<div class="other-news">
				 <p>&nbsp;</p>
				<h3><?php echo _e('[:ua]Інші новини[:en]Other news'); ?></h3>
				<?php	
					$archiveCatNews = get_category_by_slug('news');
					$archiveCatStatti = get_category_by_slug('statti');
					$archiveCatVacancies = get_category_by_slug('vacancies');
					$args = array(
						'showposts' => 5, 
						'orderby' => 'date', 
						'category__in' =>  array($archiveCatNews->term_id, $archiveCatStatti->term_id, $archiveCatVacancies->term_id)
					);
				    $query = new WP_Query($args); 
				    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();?>
				      <div class="news-small">
				      	<div class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></div>
				      	<div class="date-time"><?php news_date($post->ID); echo', '.get_the_time();?></div>
				      </div>  
				    <?php endwhile; endif;
				    wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
