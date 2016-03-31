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
    <link href="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/css/owl.theme.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/style.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/js/attrchange.js"></script>
    <script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/js/owl.carousel.js"></script>    
    <script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/js/script.js"></script>
	<?php wp_head(); ?>
    <meta property="og:image" content="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/images/logo-prozorro-big.png"/>
    <link rel="image_src" href="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/images/logo-prozorro-big.png" />
</head>
<body <?php body_class(); ?>>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-73774371-1', 'auto');
      ga('send', 'pageview');

    </script>
	<nav class="navbar navbar-default top-menu">
            <div class="container">
                 <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 no-padding ofnews">
                    <?php $_newsID = get_category_by_slug('ofitsijni-novyny')->term_id;?>
                   <a href="<?php echo get_category_link($_newsID); ?>"><i class="sprite-attantion"></i></a>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-2 col-xs-4 no-padding">
                    <div class="social">
                        <?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('social-sidebar'); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-3 hidden-xs no-padding">
                 <?php if ( function_exists('qtrans_generateLanguageSelectCode') ){ echo qtrans_generateLanguageSelectCode('text'); }?>
                </div>
                <div class="col-lg-4 col-md-2 col-sm-3 hidden-xs no-padding">
                     <ul class="nav navbar-nav nav-justified">
                        <?php   wp_nav_menu( array(
                            'theme_location' => 'top_menu',
                            'fallback_cb' => '__return_empty_string',
                            'items_wrap' => '%3$s',
                            'container' => ''
                        ) );
                        ?>                          
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3 col-sm-2 col-xs-2 no-padding event-calendar">
                     <a href="<?php echo get_category_link(18); ?>"><span class="text"><?php echo _e('[:ua]Календар подій [:en]Event calendar'); ?></span> <i class="sprite-icon-calendar"></i></a>
                </div>
                <div class="hidden-lg  hidden-md hidden-sm col-xs-5 no-padding text-right">
                      <?php if ( function_exists('qtrans_generateLanguageSelectCode') ){ echo qtrans_generateLanguageSelectCode('text'); }?>
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
                    <a class="navbar-brand" href="<?php  echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/Prozzoro/images/logo-prozorro<?php echo ((qtrans_getLanguage()=='en')?'-en':''); ?>.png" alt="Logo" /></a>
                    <a class="green-btn registration visible-sm" href="#"><?php _e('[:ua]Зареєструватись[:en]Register'); ?></a>
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
                        <ul class="nav navbar-nav nav-justified visible-xs">
                        <?php   wp_nav_menu( array(
                            'theme_location' => 'top_menu',
                            'fallback_cb' => '__return_empty_string',
                            'items_wrap' => '%3$s',
                            'container' => ''
                        ) );
                        ?>                          
                    </ul>
					</div><!-- /.navbar-collapse -->
				</div>
                <div class="navbar-header pull-right">
                    <a class="green-btn registration hidden-md hidden-sm" href="#"><?php _e('[:ua]Зареєструватись[:en]Register'); ?></a>
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
        <section class="startpopup">
            <div class="startpopup-wrapper">
                <a href="#" class="close-startpopup">&#215;</a>
                <h1 id="title" align="center"><?php echo _e('[:ua]Почати роботу[:en]Start working'); ?></h1>
                <h1 id="btn" align="center"><a class="blue-btn" href="<?php echo get_permalink( get_page_by_path( 'pochaty-robotu-zamovnyku' ) ); ?>"><?php echo _e('[:ua]Як Замовник[:en]I am procurer'); ?></a></h1>
                <h1 id="btn" align="center"><a class="green-btn" href="<?php echo get_permalink( get_page_by_path( 'pochaty-robotu-postachalnyku' ) ); ?>"><?php echo _e('[:ua]Як Постачальник[:en]I am supplier');?></a></h1>
            </div>
        </section>

<div class="site">
	<div id="content" class="site-content">
    <a href="#" class="go-down hidden-sm hidden-xs"></a>
