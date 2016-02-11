<?php get_header();  ?>
<div class="container">
	<?php  
	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;?>
	<h1 class="page-title"><?php echo $curauth->first_name. ' ' . $curauth->last_name; ?></h1>
		<div class="row">
			<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 ">
			<?php 
			$args = array(
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC',
				'paged' => $paged,
				'author' => $curauth->ID			
			);
			$wp_query = new WP_Query( $args );

			if ( $wp_query->have_posts() ) {?>

				<?php while ( $wp_query->have_posts() ) {
				$wp_query->the_post(); 
				$avtor = get_the_author_meta('ID',$post->post_author);
				$user = get_userdata($avtor);?>
				<div class="row">
					<div class="blog <?php// echo ($paged == 1 ? 'first':''); ?> col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="img_wrapper"><img src="<?php echo author_img($avtor);?>" alt="<?php echo $user->user_firstname . ' ' . $user->user_lastname ;?> " /></div>
					<span class="day"><?php the_time('d.m.y') ?></span>
					<h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>
					<?php echo content(50); ?>
					<div class="clearfix"></div>
					<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('share-sidebar'); ?>	
					<div class="more"><a href="<?php the_permalink(); ?>"><i class="sprite-arrow-right"></i><?php echo _e('[:ua]Детальніше [:en]More'); ?></a></div>
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
		</div>
	</div>

</div>

<?php get_footer(); ?>	