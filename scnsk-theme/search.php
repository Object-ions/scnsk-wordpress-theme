<?php
/**
 * Search results.
 *
 * @package scnsk
 */

get_header();
?>

<section class="band band-oat archive-head">
	<div class="wrap">
		<span class="t-label"><?php esc_html_e( 'Search', 'scnsk' ); ?></span>
		<h1 class="t-display-l">
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Results for “%s”', 'scnsk' ),
				esc_html( get_search_query() )
			);
			?>
		</h1>
		<p class="archive-desc t-lead muted">
			<?php
			printf(
				esc_html( _n( '%d post matches.', '%d posts match.', (int) $wp_query->found_posts, 'scnsk' ) ),
				(int) $wp_query->found_posts
			);
			?>
		</p>
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
