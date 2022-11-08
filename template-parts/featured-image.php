<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
if ( has_post_thumbnail( $post->ID ) ) : ?>
	<header class="featured-hero hide-for-print" role="banner" data-interchange="[<?php the_post_thumbnail_url( 'featured-small' ); ?>, small], [<?php the_post_thumbnail_url( 'featured-medium' ); ?>, medium], [<?php the_post_thumbnail_url( 'featured-large' ); ?>, large], [<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, xlarge]" aria-label="Featured Image">
	</header>

	<?php
else :
	// otherwise, randomly display one of the following images:
	$theme = get_template_directory_uri();
	$bg    = array(
		$theme . '/dist/assets/images/header-images/deptThemeStandard02.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard03.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard04.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard05.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard06.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard07.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard08.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard09.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard10.jpg',
	); // array of filenames

	$i          = rand( 0, count( $bg ) - 1 ); // generate random number size of the array
	$selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen

	?>

	<header class="featured-hero hide-for-print" role="banner" data-interchange="[<?php echo $selectedBg; ?>, small], [<?php echo $selectedBg; ?>, medium], [<?php echo $selectedBg; ?>, large], [<?php echo $selectedBg; ?>, xlarge]" aria-label="Featured Image">
	</header>
	<?php
endif;
