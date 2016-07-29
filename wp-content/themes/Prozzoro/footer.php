
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
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter38632605 = new Ya.Metrika({ id:38632605, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/38632605" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

</body>
</html>
