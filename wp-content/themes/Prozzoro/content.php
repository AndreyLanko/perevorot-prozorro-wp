
<article <?php post_class(); ?>>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title(  '<h2 class="entry-title">', '</h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
			global $more;
			$more = 1;       // игнорируем тег more (не обрезаем).
			the_content();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
