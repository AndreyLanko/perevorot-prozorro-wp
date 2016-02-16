
	</div><!-- .site-content -->

	<nav class="navbar navbar-default footer">
            <div class="container">
            	<a href="#" class="back-to-top hidden-sm hidden-xs"></a>
				<div class="row">
					<div class="col-md-3 margin-bottom">
						<h4><?php echo _e(lemon_menu_name('foot_menu_left'));?></h4>
						
						<ul class="nav nav-list">
						<?php	wp_nav_menu( array(
							'theme_location' => 'foot_menu_left',
							'fallback_cb' => '__return_empty_string',
							'items_wrap' => '%3$s',
							'container' => ''
						) );
						?>	
						</ul>
					</div>
					
					<div class="col-md-3 margin-bottom">
						<h4><?php echo _e(lemon_menu_name('foot_menu_center'));?></h4>
						
						<ul class="nav nav-list margin-bottom">
						<?php	wp_nav_menu( array(
							'theme_location' => 'foot_menu_center',
							'fallback_cb' => '__return_empty_string',
							'items_wrap' => '%3$s',
							'container' => ''
						) );
						?>
						</ul>
					</div>
					
					<div class="col-md-3 margin-bottom">
						<h4><?php echo _e(lemon_menu_name('foot_menu_right'));?></h4>
						
						<ul class="nav nav-list margin-bottom">
						<?php	wp_nav_menu( array(
							'theme_location' => 'foot_menu_right',
							'fallback_cb' => '__return_empty_string',
							'items_wrap' => '%3$s',
							'container' => ''
						) );
						?>
						</ul>
					</div>
					
					<div class="col-md-3 margin-bottom">
						<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('footer-contacts-sidebar');?>
						<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('social-sidebar'); ?>
					</div>
				</div>
                
            </div>
			<div class="footer--copyright">
			<div class="container">
				© 2015 Prozorro. Всі права захищено.
				<div class="pull-right">Служба підтримки: (044) 537-85-96</div>
				</div>
			</div>
        </nav>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
