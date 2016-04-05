
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
				<div class="col-md-4 col-xs-12">© 2015 Prozorro. <?php echo _e('[:ua]Всі права захищено. [:en]All rights reserved.');?></div>
				<div class="col-md-4 col-xs-12 text-center"><?php echo _e('[:ua]Створення сайта:  [:en]Created by:');?>&nbsp;<a href="http://lemon.ua">Lemon.ua</a> </div>
				<div class="col-md-4 col-xs-12 text-right"><?php echo _e('[:ua]Служба підтримки: [:en]Support:');?> (044) 281-42-87</div>
				</div>
			</div>
        </nav>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
