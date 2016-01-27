<?php
/*
Template Name: Замовнику
*/
 get_header(); ?>

<div class="container system-advantages">
		<?php $field = get_field_object('no-money-blue', $post->ID);
		echo('<h1>'. $field['label'] . '</h1>' );
		?>
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

		<?php $field = get_field_object('etapy-zakupivli', $post->ID);
		echo('<h1>'. $field['label'] . '</h1>' );
		?>
		<div class="custom-counter"><?php echo _e(get_post_field('etapy-zakupivli', $post->ID)); ?></div>
		<hr />

		<?php $field = get_field_object('propozitsii', $post->ID);
		echo('<h1>'. $field['label'] . '</h1>' );
		?>			
		<div class="system-advantages--text"><?php echo (get_post_field('propozitsii', $post->ID)); ?></div>			

		<?php echo author_in_top();?>


		<?php while ( have_posts() ) : the_post(); ?>
		<div class="specification gray-bg padding margin-bottom ">
			<?php the_content(); ?>
		</div>
		<?php endwhile;?>

		<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('customer-sidebar'); ?>
					
		<div class="clearfix"></div>				
	</div>
	
	<hr />

	<div class="system-advantages--buttons">
		<a class="green-btn" href="<?php echo get_permalink( 253 ) ?>"><?php echo get_the_title( 253 ) ?></a>
		<a href="https://prozorro.zendesk.com/hc/uk" target="_blank" class="blue-btn">Перейти на Базу знань</a>
	</div>
			

</div>

<?php get_footer(); ?>