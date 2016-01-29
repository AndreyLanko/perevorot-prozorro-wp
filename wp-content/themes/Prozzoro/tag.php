<?php get_header();  ?>
<div class="container">
	<h1 class="page-title"><?php echo _e('[:ua]Результати пошуку за запитом " [:en]Search result for "'); single_tag_title(); echo('"'); ?></h1>
		<div class="row">
			<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 ">
			<?php if ( have_posts() ) : ?>
				<?php  $tags =& new WP_Query("tag=$tag&showposts=-1");?>
					<div class="search-status"><?php  echo _e('[:ua]За запитом <b>" [:en]Search for <b>"'); single_tag_title(); echo _e(' [:ua]"</b> результатів пошуку: [:en]"</b> are: '); echo ('<b> '.$tags->found_posts .' </b>'); ?><hr /></div>
			<div class="search-wrapper">
				<?php
					while ( have_posts() ) : the_post(); ?>
						<?php 
						$category = get_category(get_query_var('cat'),false);
						$avtor = get_the_author_meta('ID',$post->post_author);
						$user = get_userdata($avtor);?>
						<div class="row">
							<div class="blog col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="img_wrapper"><img src="<?php echo author_img($avtor);?>" alt="<?php echo $user->user_firstname . ' ' . $user->user_lastname ;?> " /></div>
							<span class="day"><?php the_time('d.m.y') ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php echo $user->user_firstname . ' ' . $user->user_lastname ;?>:<br/>  <?php the_title(); ?></a></h3>
							<?php echo content(35); ?>
							<div class="clearfix"></div>
							<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('share-sidebar'); ?>	
							<div class="more"><a href="<?php the_permalink(); ?>"><i class="sprite-arrow-right"></i><?php echo ' ';?><?php echo _e('[:ua] Детальніше [:en] More'); ?></a></div>
							<div class="clearfix"></div>
							<hr />		
							</div>
						</div>
					<?php endwhile; ?>
			</div>
			<?php	else : ?>
					<div class="search-status"><?php echo _e('<!--:uk-->За запитом "<!--:--> <!--:en-->Search for "<!--:-->'.urldecode($tag).'<!--:uk-->" нічого не знайдено<!--:--> <!--:en-->" are: nothing found<!--:-->'); ?><hr /></div>
			<?php endif;
				?>
				<div style="clear:both;"></div>
		</div>

		<div class="right-col col-md-4 col-lg-4 col-sm-4 col-xs-hidden ">
		<h3><?php echo _e('[:ua]Популярні записи [:en]Featured Blog'); ?></h3>
		<?php last_news(5); ?>
		</div>
	</div>

</div>

<?php get_footer(); ?>	