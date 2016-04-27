<?php get_header();  ?>

<div class="container page-content">
    
    <h1 class="page-title"><?php the_title( ); ?></h1>

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
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$eventsIds = array();
				global $ai1ec_registry;
				$e_time = new Ai1ec_Date_Time($ai1ec_registry);
				$s_time = new Ai1ec_Date_Time($ai1ec_registry,"now -1 year");
				$search = $ai1ec_registry->get( 'model.search' );				
				$events = $search->get_events_between($s_time,$e_time);
				//var_dump($events[0]->get('post'));
				//exit();

			    foreach($events as $event): 
			    	$publish_status = $event->get('post')->post_status;
			    	if ( $publish_status == 'publish') {
			    		array_push($eventsIds, $event->get('post')->ID);
			    	 }
			    endforeach;
			    $_eventsIds = array_reverse($eventsIds);
			    $args = array(
					'post__in' => $_eventsIds,
					'orderby'=>'post__in',
					'post_type' => 'ai1ec_event',
					'paged' => $paged
				);
			    $wp_query = new WP_Query( $args );
				if ( $wp_query->have_posts() ) {?>
					<?php while ( $wp_query->have_posts() ) {
					$wp_query->the_post();
					$eventInfo = $ai1ec_registry->get( 'model.event', $post->ID );	
					$startTime = $eventInfo->get( 'start' )->format( 'd.m.Y' );
					$_startTime = $eventInfo->get( 'start' )->format( 'H:i' );
					$endTime = $eventInfo->get( 'end' )->format( 'd.m.Y' );
					$_endTime = $eventInfo->get( 'end' )->format( 'H:i' );		 ?>
						 <div class="row">
							<div class="blog">
								<span class="day">
								<?php  if (strtotime($startTime)==strtotime($endTime)) {
										echo ($startTime.' @ '.$_startTime.' - '.$_endTime);
										 } else { 
										 echo ($startTime.' '.$_startTime.' - '.$endTime.' '.$_endTime);
									 }; ?>
								</span>
							<h3 class="title"><a href="<?php echo get_the_permalink();?>"><?php echo get_the_title();?></a></h3>
							<?php echo _e(trim_event_text(strip_tags(get_the_content()), 250, '...'));?>
							<div class="clearfix"></div>
							<div class="more"><a href="<?php echo get_the_permalink();?>"><i class="sprite-arrow-right"></i><?php echo ' ';?><?php echo _e('[:ua] Детальніше [:en] More'); ?></a></div>
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

<?php get_footer(); ?>	