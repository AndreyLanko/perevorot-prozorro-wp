<?php get_header();  ?>
<div class="container page-content">
	<?php	
	switch ($post->ID) {

	case "123":
	while ( have_posts() ) : the_post();?>
		<div class="customer-menu">
			<ul class="nav">
			<?php	wp_nav_menu( array(
				'theme_location' => 'reform_menu',
				'fallback_cb' => '__return_empty_string',
				'items_wrap' => '%3$s',
				'container' => ''
			) );
			?>							
			</ul>
		</div>
        <h1 class="page-title"><?php the_title( ); ?></h1>
		<div class="row"> 
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php  the_content(); 
				$sidebar = get_post_meta($post->ID, "sidebar", true);
				if ($sidebar == 'sharebutton'){get_sidebar($sidebar);}?>
			</div>
		</div>
    <?php endwhile;
    break;

	case "253":
	while ( have_posts() ) : the_post();?>
        <h1 class="page-title"><?php the_title( ); ?></h1>
		<div class="container start-steps">
			<?php the_content(); ?>
		</div>
    <?php endwhile;
    break;

    case "271":
     while ( have_posts() ) : the_post(); ?>
		<div class="row contacts"> 
			<?php the_content(); ?>
		</div>
	<?php endwhile;
	break;

    case "346":?>
    	<h1 class="page-title"><?php the_title( ); ?></h1>
		<div class="row partners"> 
			<?php 	$args = array(
			'post_type' => 'partners',
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',					
			'posts_per_page' => -1				
		);
		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) {?>
			<?php while ( $wp_query->have_posts() ) {
			$wp_query->the_post();
			$img_url = wp_get_attachment_image_src(get_post_field('partner-img', $post->ID), 'medium'); ?>
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 ">
				<a href="<?php echo _e(get_post_field('partner-slug', $post->ID)); ?>" target="_blank"><img src="<?php  echo $img_url[0]; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>"></a>
			</div>
			<?php }
		} 
		wp_reset_postdata(); ?>
		</div>
	<?php break;

    default:
    while ( have_posts() ) : the_post(); ?>
    <h1 class="page-title"><?php the_title( ); ?></h1>
	<div class="row"> 
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php  the_content(); 
			$sidebar = get_post_meta($post->ID, "sidebar", true);
			if ($sidebar == 'sharebutton'){get_sidebar($sidebar);}?>
		</div>
	</div>

	 <?php endwhile;
		} 
	
	?>

</div>

<?php get_footer(); ?>	