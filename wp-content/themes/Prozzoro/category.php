<?php get_header(); 
	 inherit_template(); ?>
<div class="container">
	<h1 class="page-title"><?php single_cat_title( ); ?></h1>
	<?php $category = get_category(get_query_var('cat'),false);
	$cat_list = $category->cat_ID;
	$cat_name = $category->slug;

	if (($cat_list == 16) | ($cat_name == 'vacancies') |  ($cat_name == 'event-archive') ) {
		get_template_part( 'content', 'blog' );
	}
	elseif (($cat_list == 1) | ($cat_list == 17) | ($cat_list == 18) |  ($cat_name == 'ofitsijni-novyny') ){
		get_template_part( 'content', 'news' );
	}
	else {
		get_template_part( 'content');
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

		?>

</div>

<?php get_footer(); ?>	