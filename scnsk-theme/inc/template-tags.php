<?php
/**
 * Small template helpers.
 *
 * @package scnsk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Reading time in minutes (200 wpm), minimum 1.
 */
function scnsk_reading_time( $post = null ) {
	$post  = get_post( $post );
	$words = str_word_count( wp_strip_all_tags( $post->post_content ) );
	return max( 1, (int) ceil( $words / 200 ) );
}

/**
 * Category tags for a post: "Active Ingredients" etc., as pill tags with the talk corner.
 */
function scnsk_category_tags( $post = null, $limit = 2 ) {
	$cats = get_the_category( $post );
	if ( empty( $cats ) ) {
		return;
	}
	echo '<div class="tags">';
	foreach ( array_slice( $cats, 0, $limit ) as $cat ) {
		printf(
			'<a class="tag" href="%s">%s</a>',
			esc_url( get_category_link( $cat ) ),
			esc_html( $cat->name )
		);
	}
	echo '</div>';
}

/**
 * Meta line: "6 min read · Mar 11, 2026".
 */
function scnsk_meta_line( $post = null ) {
	$post = get_post( $post );
	printf(
		'<span class="card-meta">%s · <time datetime="%s">%s</time></span>',
		esc_html( sprintf( _n( '%d min read', '%d min read', scnsk_reading_time( $post ), 'scnsk' ), scnsk_reading_time( $post ) ) ),
		esc_attr( get_the_date( DATE_W3C, $post ) ),
		esc_html( get_the_date( 'M j, Y', $post ) )
	);
}

/**
 * The byline component: SK mark, author name, meta.
 */
function scnsk_byline( $post = null, $show_meta = true ) {
	$post   = get_post( $post );
	$author = get_the_author_meta( 'display_name', $post->post_author );
	?>
	<a class="byline" href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
		<span class="byline-mark" aria-hidden="true">SK</span>
		<span class="byline-text">
			<span class="byline-name"><?php echo esc_html( $author ); ?></span>
			<?php if ( $show_meta ) : ?>
				<span class="byline-meta"><?php echo esc_html( sprintf( __( '%1$s · %2$d min read', 'scnsk' ), get_the_date( 'F j, Y', $post ), scnsk_reading_time( $post ) ) ); ?></span>
			<?php endif; ?>
		</span>
	</a>
	<?php
}

/**
 * The wordmark for the header/footer. Custom Logo wins if set; otherwise the brand SVG.
 *
 * @param string $ink 'color' (paper/oat grounds) or 'oat' (on forest).
 */
function scnsk_wordmark( $ink = 'color' ) {
	$name = get_bloginfo( 'name' );
	if ( 'color' === $ink && has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	printf(
		'<a class="brand" href="%s" rel="home" aria-label="%s"><img src="%s" alt="%s" width="1409" height="280"></a>',
		esc_url( home_url( '/' ) ),
		esc_attr( $name ),
		esc_url( get_template_directory_uri() . '/assets/img/scnsk-wordmark-' . $ink . '.svg' ),
		esc_attr( $name )
	);
}

/**
 * Fallback menu: the site's pages, when no menu is assigned yet.
 */
function scnsk_menu_fallback( $args = array() ) {
	echo '<ul>';
	wp_list_pages( array( 'title_li' => '', 'depth' => 1, 'exclude' => get_option( 'page_on_front' ) ) );
	if ( ! empty( $args['theme_location'] ) && 'primary' === $args['theme_location'] ) {
		echo '<li class="menu-item-search">' . get_search_form( array( 'echo' => false ) ) . '</li>';
	}
	echo '</ul>';
}
