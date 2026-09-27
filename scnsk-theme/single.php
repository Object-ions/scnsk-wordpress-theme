<?php
/**
 * Single post: question headline, byline, lead, the why, the sign-off, keep reading.
 *
 * @package scnsk
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="article-head">
			<div class="wrap">
				<?php scnsk_category_tags( null, 3 ); ?>
				<h1 class="t-display-l"><?php the_title(); ?></h1>
				<?php scnsk_byline(); ?>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="article-hero">
				<?php the_post_thumbnail( 'scnsk-wide', array( 'fetchpriority' => 'high' ) ); ?>
			</figure>
		<?php endif; ?>

		<div class="wrap">
			<div class="prose entry-content">
				<?php
				the_content();
				wp_link_pages(
					array(
						'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'scnsk' ),
						'after'  => '</nav>',
					)
				);
				?>
			</div>

			<p class="article-end">
				<span class="drop" aria-hidden="true"></span>
				<span><?php esc_html_e( 'I tried it all so you don’t have to. — Skincare Junkie', 'scnsk' ); ?></span>
			</p>

			<?php if ( has_tag() ) : ?>
				<div class="article-tags tags">
					<?php
					foreach ( get_the_tags() as $tag ) {
						printf( '<a class="tag" href="%s">%s</a>', esc_url( get_tag_link( $tag ) ), esc_html( $tag->name ) );
					}
					?>
				</div>
			<?php endif; ?>

			<?php
			$prev = get_previous_post();
			$next = get_next_post();
			if ( $prev || $next ) :
				?>
				<nav class="post-nav" aria-label="<?php esc_attr_e( 'Posts', 'scnsk' ); ?>">
					<?php if ( $prev ) : ?>
						<a class="prev" href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
							<span class="t-label"><?php esc_html_e( 'Older post', 'scnsk' ); ?></span>
							<span class="t-title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
						</a>
					<?php else : ?>
						<span></span>
					<?php endif; ?>
					<?php if ( $next ) : ?>
						<a class="next" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
							<span class="t-label"><?php esc_html_e( 'Newer post', 'scnsk' ); ?></span>
							<span class="t-title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
						</a>
					<?php endif; ?>
				</nav>
			<?php endif; ?>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</div>
	</article>

	<?php
	$cats    = wp_get_post_categories( get_the_ID() );
	$related = new WP_Query(
		array(
			'posts_per_page'      => 3,
			'post__not_in'        => array( get_the_ID() ),
			'category__in'        => $cats,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	if ( $related->post_count < 3 ) {
		$related = new WP_Query(
			array(
				'posts_per_page'      => 3,
				'post__not_in'        => array( get_the_ID() ),
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
	}
	if ( $related->have_posts() ) :
		?>
		<section class="band band-oat" style="margin-top:96px">
			<div class="wrap">
				<div class="section-head">
					<h2 class="t-headline"><?php esc_html_e( 'Keep reading', 'scnsk' ); ?></h2>
				</div>
				<div class="post-grid">
					<?php
					while ( $related->have_posts() ) :
						$related->the_post();
						get_template_part( 'template-parts/card', null, array( 'block' => true ) );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
		<?php
	endif;
endwhile;

get_footer();
