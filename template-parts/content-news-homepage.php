<?php
/**
 * The default template for displaying news content on homepage (meta fields are above the permalink; contains external link class; categories NOT shown)
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class( 'post-listing news-article' ); ?>>
	<header>
		<h2 itemprop="headline">
			<small aria-hidden="true">
				<?php
				$terms = get_the_terms( $post->ID, 'program' );
				foreach ( $terms as $term ) :
					?>
					<?php echo $term->name; ?> Program
				<?php endforeach; ?>
			</small>
			<br>
			<?php if ( get_post_meta( $post->ID, 'ecpt_external_link', true ) ) : ?>
				<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_external_link', true ) ); ?>" target="_blank" title="<?php the_title(); ?>" class="front-post external-link" id="post-<?php the_ID(); ?>"><?php the_title(); ?> <span class="icon-new-tab2" aria-hidden="true"></span>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" class="front-post" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h2>
		<?php ksasacademic_entry_meta(); ?>
	</header>

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="grid-x">
				  <div class="medium-6 large-3 cell">
					<?php
					the_post_thumbnail(
						array( 200, 200 ),
						array(
							'class' => 'alignleft news-thumb',
							'alt'   => esc_html( get_the_title() ),
						)
					);
					?>
				</div>
				<div class="medium-6 large-9 cell">
					<?php the_excerpt(); ?>
				</div>
			</div>
		<?php else : ?>
			<?php the_excerpt(); ?>	
		<?php endif; ?> 
	</div>	
</article>

