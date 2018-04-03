<?php get_header(); 
$program_slug = get_the_program_slug($post);
$slider_query = new WP_Query(array(
	'post_type' => 'slider',
	'program' => $program_slug,
	'posts_per_page' => '1'));
?>
<?php if ( $slider_query->have_posts() ) : while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
	<?php get_template_part( 'template-parts/program-home-featured-image' ); ?>
<?php endwhile; endif;?>
<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
        	<h1 class="page-title capitalize"><?php echo $program_slug; ?> Faculty Books</h1>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'books' ); ?>
            <?php endwhile;?>    
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer();
