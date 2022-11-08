<?php
/**
 * The default template for displaying news content on PROGRAM homepage (in columns)
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class( 'post-listing news-article cell medium-12 large-4' ); ?>>
	<header>
		<h2 itemprop="headline">
			<?php if ( get_post_meta( $post->ID, 'ecpt_location', true ) ) : ?>
				<a href="<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_location', true ) ); ?>" target="_blank" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?> <span class="icon-new-tab2" aria-hidden="true"></span>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h2>
		<?php ksasacademic_entry_meta(); ?>
	</header>

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="news-article-image">
				<?php
				the_post_thumbnail(
					'full',
					array(
						'class' => 'news-thumb',
						'alt'   => esc_html( get_the_title() ),
					)
				);
				?>
			</div>	
				<?php the_excerpt(); ?>
		<?php else : ?>
			<?php the_excerpt(); ?>	
		<?php endif; ?> 
	</div>
</article>
