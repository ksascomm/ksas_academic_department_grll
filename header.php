<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="date" content="<?php the_modified_date(); ?>" />
		<title><?php create_page_title_grll(); ?></title>

		<!-- Icons & Favicons -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-57x57.png">
	    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-60x60.png">
	    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-72x72.png">
	    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-76x76.png">
	    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-114x114.png">
	    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-120x120.png">
	    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-144x144.png">
	    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-152x152.png">
	    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-180x180.png">
	    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/android-icon-192x192.png">
	    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/favicon-32x32.png">
	    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/favicon-96x96.png">
	    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/favicon-16x16.png">

		<!--[if lte IE 9]>
	 		<div class="callout alert">
				<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.'); ?>	
			</div>		
    	<![endif]-->

		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/dist/assets/images/icons/apple-icon-120x120.png">
    	<meta name="theme-color" content="#121212">

		<?php wp_head(); ?>
		
		<?php get_template_part( 'template-parts/analytics' ); ?>
		<?php get_template_part( 'template-parts/script-initiators' ); ?>
		<?php get_template_part( 'template-parts/grll-script-initiators' ); ?>
	</head>
	<body <?php body_class(); ?>>
	<div class="alert" role="navigation" aria-label="COVID-19 Alerts">
    	<a class="alert-message" href="https://krieger.jhu.edu/covid19/">COVID-19 information, resources, and giving opportunities for KSAS</a>
	</div>
	<div role="navigation" aria-label="Skip to main content">
		<a class="skip-main show-on-focus" href="#page" >Skip to main content</a>
	</div>
	<div class="show-for-print" aria-hidden="true">
		<img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/krieger.blue.svg" alt="krieger logo">
		<h1><?php echo get_bloginfo( 'description' ); ?> <?php echo get_bloginfo( 'title' ); ?></h1>
	</div>
	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>


	<header class="site-header" role="banner" aria-labelledby="dept-info">
		<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
			<div class="title-bar-left">
				<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
				<span class="site-mobile-title title-bar-title">
					Main Menu
				</span>
			</div>
		</div>

		<div class="roof-header-top show-for-large hide-for-print">
			<div class="row align-justify">
		    	<div class="roof-header-top-links">
		        	<?php get_template_part( 'template-parts/roof' ); ?>
		      	</div>
		    </div>
		</div>

		<div class="top-bar site-information hide-for-print">
				<div class="nav-shield">
					<a href="<?php echo esc_url( network_site_url( '/' ) ); ?>" rel="home">
						<img data-interchange="[<?php echo get_template_directory_uri(); ?>/dist/assets/images/krieger.blue.svg, small], [<?php echo get_template_directory_uri(); ?>/dist/assets/images/ksas-horizontal-md.png, medium], [<?php echo get_template_directory_uri(); ?>/dist/assets/images/ksas-horizontal-lg.png, large]" alt="Krieger School of Arts & Sciences">
					</a>
				</div>
				<div class="site-desktop-title">
					<div class="top-bar-title">
						<h1 itemprop="headline">
							<a id="dept-info" href="<?php echo site_url(); ?>">
								<?php if ( ! empty( get_bloginfo('description') ) ) : ?>
									<small itemprop="description" class="hide-for-small-only"><?php echo get_bloginfo( 'description' ); ?></small>
								<?php endif; ?>
							<?php echo get_bloginfo( 'title' ); ?>
							</a>
						</h1>
					</div>
				</div>
		</div>
		<nav class="top-bar main-navigation hide-for-print" aria-label="Main Menu">
			<div class="top-bar-left">
				<?php foundationpress_top_bar_r(); ?>
			</div>
			<div class="top-bar-right hide-for-small-only">
				<form method="GET" action="<?php echo home_url( '/' ); ?>" role="search" aria-label="Utility Bar Search">
					<div class="input-group">
						<label for="s" class="screen-reader-text">
			                Search This Website
			            </label>
						<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search this site" aria-label="Search This Website"/>
						<div class="input-group-button">
			    			<input type="submit" class="button" value="&#xf002;" aria-label="search">
			  			</div>	
					</div>
				</form>
			</div>
		</nav>
		<?php if ( ! is_front_page() ) : ?>
		<div class="secondary">
			<div class="grid-container">
				<div class="grid-x grid-padding-x">		
			 		<?php foundationpress_breadcrumb(); ?>
			 	</div>
			 </div>
		</div>
	<?php endif; ?>
	</header>