<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <!-- Bootstrap -->
    <link href="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/fonts/pfagorasanspro/fonts.css" rel="stylesheet">
    <link href="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>    
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/js/script.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<nav class="navbar navbar-default top-menu">
            <div class="container">
            <?php if ( function_exists('qtrans_generateLanguageSelectCode') ){ echo qtrans_generateLanguageSelectCode('text'); }?>
                <div class="pull-right">
                    <?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('social-sidebar'); ?>
                    <ul class="nav navbar-nav inline-navbar">
                        <li class="<?php echo ($post->ID == 253 ? 'active':''); ?>"><a href="<?php echo get_permalink( 253 ) ?>"><?php echo get_the_title( 253 ) ?></a></li>
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>

        <nav class="navbar navbar-default main-menu">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php  echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/images/prozorro-logo-tmp.png" width="200" alt="Logo" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="clearfix visible-sm"></div>
				<div class="main-menu--list">
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav nav-justified">
						<?php	wp_nav_menu( array(
							'theme_location' => 'header_menu',
							'fallback_cb' => '__return_empty_string',
							'items_wrap' => '%3$s',
							'container' => ''
						) );
						?>							
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container switcher">
        <?php $cur_post = get_the_ID();?>
			<ul class="nav nav-justified sections <?php echo(($cur_post==145)|($cur_post==148)|($cur_post==150) ? 'expanded':''); ?>">
				<li class="green-bg <?php echo ($cur_post==145 ? 'active':'notitle'); ?>"><a href="<?php echo get_permalink( 145 ) ?>"><i class="sprite-provider"></i> <span><?php echo get_the_title( 145 ) ?></span></a></li>
				<li class="gray-bg <?php echo ($cur_post==148 ? 'active':'notitle'); ?>"><a href="<?php  echo esc_url( home_url( '/' ) ); ?>"><i class="sprite-tender-search"></i> <span><?php echo get_the_title( 148 ) ?></span></a></li>
				<li class="blue-bg <?php echo ($cur_post==150 ? 'active':'notitle'); ?>"><a href="<?php echo get_permalink( 150 ) ?>"><i class="sprite-customer"></i> <span><?php echo get_the_title( 150 ) ?></span></a></li>
			</ul>
		</div>

<div class="site">
	<div id="content" class="site-content">
