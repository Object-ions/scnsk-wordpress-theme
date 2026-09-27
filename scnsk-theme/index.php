<?php
/**
 * Posts listing (the Blog page) and the generic fallback.
 *
 * @package scnsk
 */

get_header();
?>

<section class="band band-oat archive-head">
	<div class="wrap">
		<span class="t-label"><?php esc_html_e( 'Every post', 'scnsk' ); ?></span>
		<h1 class="t-display-l"><?php esc_html_e( 'The blog', 'scnsk' ); ?></h1>
		<p class="archive-desc t-lead muted"><?php esc_html_e( 'One post a week. Ingredients, treatments and the science of skin, explained the way a friend would.', 'scnsk' ); ?></p>
	</div>
</section>

<section class="band">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/card' );
				endwhile;
				?>
			</div>
			<?php
			the_posts_pagination(
				array(
					'prev_text' => __( 'Newer', 'scnsk' ),
					'next_text' => __( 'Older', 'scnsk' ),
				)
			);
			?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
