<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
if ( has_post_thumbnail( $post->ID ) ) : ?>
	<header class="featured-hero hide-for-print" role="banner" data-interchange="[<?php the_post_thumbnail_url('featured-small'); ?>, small], [<?php the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php the_post_thumbnail_url('featured-large'); ?>, large], [<?php the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]" aria-label="Featured Image">
        <?php $program_name = get_the_program_name($post);
        if ($program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew' || $program_name == 'Italian' || $program_name == 'Media Literacy' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) : ?>
        <div class="orbit-caption">
            <div class="row">
                <h1 class="entry-title"><?php echo $program_name;?> Program</h1>
            </div>
        </div>
        <?php endif;?>

	</header>

<?php else :
    //otherwise, randomly display one of the following images:
    $theme = get_template_directory_uri();
    $bg = array(
    		$theme.'/dist/assets/images/header-images/header-1.jpg', 
    		$theme.'/dist/assets/images/header-images/header-2.jpg', 
    		$theme.'/dist/assets/images/header-images/header-3.jpg', 
    		$theme.'/dist/assets/images/header-images/header-4.jpg', 
    		$theme.'/dist/assets/images/header-images/header-5.jpg', 
    		$theme.'/dist/assets/images/header-images/header-6.jpg', 
    		$theme.'/dist/assets/images/header-images/header-7.jpg',
    		$theme.'/dist/assets/images/header-images/header-8.jpg',
    		$theme.'/dist/assets/images/header-images/header-9.jpg',
    		$theme.'/dist/assets/images/header-images/header-10.jpg' 
    		); // array of filenames

    $i = rand(0, count($bg)-1); // generate random number size of the array
    $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
  
  ?>

  	<header class="featured-hero hide-for-print" role="banner" data-interchange="[<?php echo $selectedBg;?>, small], [<?php echo $selectedBg;?>, medium], [<?php echo $selectedBg;?>, large], [<?php echo $selectedBg;?>, xlarge]" aria-label="Featured Image">
        <?php $program_name = get_the_program_name($post);
       if ($program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew' || $program_name == 'Italian' || $program_name == 'Media Literacy' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) : ?>
        <div class="orbit-caption">
            <div class="row">
                <h1 class="entry-title"><?php echo $program_name;?> Program</h1>
            </div>
        </div>
        <?php endif;?>

  	</header>
<?php endif;