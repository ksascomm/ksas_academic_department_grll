<?php if ( have_rows( 'explore_the_department' ) ) : ?>
<div class="bucket-area">
	<div class="buckets">
			<?php $heading = get_field( 'buckets_heading' ); ?>
			<!--Print Heading if there-->
			<?php if ( $heading ) : ?>
			<div class="grid-x grid-padding-x">
				<header class="cell explore-title" aria-label="<?php the_field( 'buckets_heading' ); ?>">
					<h2><?php echo $heading; ?></h2>
				</header>
			</div>
			<?php endif; ?>
			<div class="grid-x grid-padding-x">
				<div class="cell large-auto">
					<div class="button-group bucket">
						<?php
						while ( have_rows( 'explore_the_department' ) ) :
							the_row();
							?>
						<!--Loop through each repeater field-->
						<a class="button single-bucket" href="<?php the_sub_field( 'explore_bucket_link' ); ?>"><?php the_sub_field( 'explore_bucket_heading' ); ?></a>
						
						<?php endwhile; ?>
					</div>
				</div>
			</div>
	</div>
</div>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
