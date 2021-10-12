<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="date" content="<?php the_modified_date(); ?>" />

		<?php wp_head(); ?>

		<meta name="msapplication-config" content="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/favicons/browserconfig.xml" />

		<?php get_template_part( 'template-parts/analytics' ); ?>
		<?php get_template_part( 'template-parts/script-initiators' ); ?>
		<?php get_template_part( 'template-parts/grll-script-initiators' ); ?>
	</head>
	<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VTN64C"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div role="navigation" aria-label="Skip to main content">
		<a class="skip-main show-on-focus" href="#page" >Skip to main content</a>
	</div>
	<div class="alert" role="navigation" aria-label="COVID-19 Alerts">
		<a class="alert-message" href="https://krieger.jhu.edu/covid19/">COVID-19 information, resources, and giving opportunities for KSAS</a>
	</div>
	<div class="show-for-print" aria-hidden="true">
		<img width="300" height="87" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/krieger.blue.svg" alt="krieger logo" loading="lazy">
		<h1><?php bloginfo( 'description' ); ?> <?php bloginfo( 'title' ); ?></h1>
	</div>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<header class="site-header" role="banner" aria-labelledby="dept-info">
		<div class="site-title-bar title-bar" <?php ksasacademic_title_bar_responsive_toggle(); ?>>
			<div class="title-bar-left">
				<button aria-label="<?php _e( 'Main Menu', 'ksasacademic' ); ?>" class="menu-icon" type="button" data-toggle="<?php ksasacademic_mobile_menu_id(); ?>"></button>
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

		<div class="small-site-holder">
			<div class="site-information hide-for-print">
				<div class="nav-shield">
					<a href="<?php echo esc_url( network_site_url( '/' ) ); ?>" rel="home">
						<div class="blue">
							<img width="300" height="87" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/krieger.blue.svg" alt="KSAS Shield" loading="lazy">
						</div>
						<div class="white">
							<img width="300" height="87" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/krieger.white.svg" alt="KSAS Shield">
						</div>
					</a>
				</div>
				<div class="site-desktop-title">
					<div class="top-bar-title">
						<h1 itemprop="headline">
							<a id="dept-info" href="<?php echo esc_url( site_url() ); ?>">
								<?php if ( ! empty( get_bloginfo( 'description' ) ) ) : ?>
									<small class="hide-for-small-only"><?php bloginfo( 'description' ); ?></small>
								<?php endif; ?>
								<?php bloginfo( 'title' ); ?>
							</a>
						</h1>
					</div>
				</div>
			</div>
		</div>
		<nav class="top-bar main-navigation hide-for-print" aria-label="Main Menu">
			<div class="top-bar-left">
				<?php ksasacademic_top_bar_r(); ?>
			</div>
			<div class="top-bar-right hide-for-small-only">
				<form method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" aria-label="Utility Bar Search">
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
					<?php ksasacademic_breadcrumb(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	</header>
