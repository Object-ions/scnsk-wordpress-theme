<?php
/**
 * Category, tag, author and date archives.
 *
 * @package scnsk
 */

get_header();
?>

<section class="band band-sage archive-head">
	<div class="wrap">
		<span class="t-label">
			<?php
			if ( is_category() ) {
				esc_html_e( 'Topic', 'scnsk' );
			} elseif ( is_tag() ) {
				esc_html_e( 'Tag', 'scnsk' );
			} elseif ( is_author() ) {
				esc_html_e( 'Author', 'scnsk' );
			} else {
				esc_html_e( 'Archive', 'scnsk' );
			}
			?>
		</span>
		<h1 class="t-display-l"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
		<?php if ( get_the_archive_description() ) : ?>
			<div class="archive-desc t-lead"><?php echo wp_kses_post( get_the_archive_description() ); ?></div>
		<?php endif; ?>
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
