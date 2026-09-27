<?php
/**
 * 404.
 *
 * @package scnsk
 */

get_header();
?>

<section class="band">
	<div class="wrap">
		<div class="empty">
			<span class="t-label muted"><?php esc_html_e( 'Error 404', 'scnsk' ); ?></span>
			<h1 class="t-display-l"><?php esc_html_e( 'That page doesn’t exist.', 'scnsk' ); ?></h1>
			<p class="t-lead"><?php esc_html_e( 'The link is old or the address has a typo. Search the blog, or head back to the latest posts.', 'scnsk' ); ?></p>
			<?php get_search_form(); ?>
			<p style="margin-top:24px"><a class="btn btn-ink" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the blog', 'scnsk' ); ?></a></p>
		</div>
	</div>
</section>

<?php
get_footer();
