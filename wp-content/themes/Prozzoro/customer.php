<?php
/*
Template Name: Замовнику
*/
 get_header(); ?>
 
<div class="container system-advantages">
		<div class="customer-menu">
			<ul class="nav">
			<?php	wp_nav_menu( array(
				'theme_location' => 'customer_menu',
				'fallback_cb' => '__return_empty_string',
				'items_wrap' => '%3$s',
				'container' => ''
			) );
			?>							
			</ul>
		</div>

		<?php echo do_shortcode('[official-news-in-top]'); ?>

		<?php $field = get_field_object('no-money-blue', $post->ID);?>
		<h1><a id="perevagy"></a><?php echo _e($field['label']); ?></h1>
		<div class="system-advantages--steps">
			<div class="row">				
				<div class="col-sm-4 margin-bottom ">
					<i class="sprite-no-money2-blue"></i><br />
					<?php echo _e(get_post_field('no-money-blue', $post->ID)); ?>
				</div>
				<div class="col-sm-4 margin-bottom ">
					<i class="sprite-auction2-blue"></i><br />
					<?php echo _e(get_post_field('auction-blue', $post->ID)); ?>
				</div>
				<div class="col-sm-4 margin-bottom ">
					<i class="sprite-white-arrow"></i><br />
					<?php echo _e(get_post_field('cursor-blue', $post->ID)); ?>
				</div>
			</div>				
		</div>		
		<hr />
		<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile;?>
		<a id="faq"></a>
		<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('customer-sidebar'); ?>
					
		<div class="clearfix"></div>				
	</div>	
	</div>
			

</div>

<?php get_footer(); ?>