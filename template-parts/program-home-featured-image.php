<header class="featured-hero program-home hide-for-print hide-for-small-only" role="banner" data-interchange="[<?php the_post_thumbnail_url( 'featured-small' ); ?>, small], [<?php the_post_thumbnail_url( 'featured-medium' ); ?>, medium], [<?php the_post_thumbnail_url( 'full' ); ?>, large], [<?php the_post_thumbnail_url( 'full' ); ?>, xlarge]" aria-label="Featured Image">
	<?php if ( get_field( 'major' ) == 1 || ( get_field( 'minor' ) == 1 ) ) : ?>
	<figcaption class="orbit-caption" aria-hidden="true">
		<h1>
		<?php wp_reset_postdata(); ?>
			<small>
				<?php if ( get_field( 'major' ) == 1 ) : ?>
					<span class="degree major">Major</span>
				<?php endif; ?>
				<?php if ( get_field( 'minor' ) == 1 ) : ?>
					<span class="degree minor">Minor</span>
				<?php endif; ?>
				<?php
				$degrees = get_field( 'graduate_degree' );
				if ( $degrees ) :
					?>
						<?php foreach ( $degrees as $degree ) : ?>
							<span class="degree <?php echo $degree['value']; ?>"><?php echo $degree['label']; ?></span>
					<?php endforeach; ?>
				<?php endif; ?>	
			</small>
		</h1>
	</figcaption>
	<?php endif; ?>
</header>
