<?php
/*
Template Name: Постачальнику
*/
 get_header(); ?>

<div class="container system-advantages">
	 <div class="provider-menu">
		<ul class="nav">
		<?php	wp_nav_menu( array(
			'theme_location' => 'provider_menu',
			'fallback_cb' => '__return_empty_string',
			'items_wrap' => '%3$s',
			'container' => ''
		) );
		?>							
		</ul>
	</div>
		<?php $field = get_field_object('first-green', $post->ID);?>
		<h1><a id="perevagy"></a><?php echo _e($field['label']); ?></h1>
		<div class="system-advantages--steps green-list">
			<div class="row">				
				<div class="col-sm-4 margin-bottom ">
					<i class="sprite-sherif-gr"></i><br />
					<?php echo _e(get_post_field('first-green', $post->ID)); ?>
				</div>
				<div class="col-sm-4 margin-bottom ">
					<i class="sprite-box-gr"></i><br />
					<?php echo _e(get_post_field('second-green', $post->ID)); ?>
				</div>
				<div class="col-sm-4 margin-bottom ">
					<i class="sprite-money-gr"></i><br />
					<?php echo _e(get_post_field('third-green', $post->ID)); ?>
				</div>
			</div>				
		</div>		
	<hr />

	<?php while ( have_posts() ) : the_post(); ?>
	<div class="green-content margin-bottom page-content">
		<?php the_content(); ?>
	</div>
	<?php endwhile;?>

</div>

<?php get_footer(); ?>