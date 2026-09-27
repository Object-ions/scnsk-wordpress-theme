<?php
/**
 * Home: hero band, the latest post, the grid, the topics.
 *
 * @package scnsk
 */

get_header();

$latest = new WP_Query(
	array(
		'posts_per_page'      => 1,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
$latest_id = $latest->have_posts() ? $latest->posts[0]->ID : 0;

$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$grid  = new WP_Query(
	array(
		'posts_per_page' => 9,
		'post__not_in'   => $latest_id ? array( $latest_id ) : array(),
		'paged'          => $paged,
	)
);
?>

<section class="hero band band-forest">
	<div class="wrap">
		<div class="hero-copy">
			<h1 class="t-display-xl"><?php esc_html_e( 'Straight talk about skin.', 'scnsk' ); ?></h1>
			<p class="t-lead"><?php esc_html_e( 'Ten years inside the skincare industry, more products than I’d like to admit. Here’s what works, what doesn’t, and why, in plain words.', 'scnsk' ); ?></p>
			<div class="hero-meta">
				<a class="btn" href="#latest"><?php esc_html_e( 'Read the latest post', 'scnsk' ); ?></a>
				<span class="t-small muted"><?php esc_html_e( 'New post every week.', 'scnsk' ); ?></span>
			</div>
		</div>
	</div>
	<img class="hero-bloom" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/scnsk-bloom-sage.svg' ); ?>" alt="" width="512" height="512">
</section>

<?php if ( $latest->have_posts() ) : ?>
<section id="latest" class="band">
	<div class="wrap">
		<div class="section-head">
			<h2 class="t-headline"><?php esc_html_e( 'This week', 'scnsk' ); ?></h2>
		</div>
		<?php
		while ( $latest->have_posts() ) :
			$latest->the_post();
			?>
			<article class="featured">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'scnsk-wide', array( 'class' => 'featured-thumb' ) ); ?>
				<?php endif; ?>
				<div>
					<?php scnsk_category_tags( null, 2 ); ?>
					<h3 class="t-display-l"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="featured-side">
					<p class="t-lead"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 34, '…' ) ); ?></p>
					<?php scnsk_byline(); ?>
					<a class="btn btn-primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read the post', 'scnsk' ); ?></a>
				</div>
			</article>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
<?php endif; ?>

<?php if ( $grid->have_posts() ) : ?>
<section class="band" style="padding-top:0">
	<div class="wrap">
		<div class="section-head">
			<h2 class="t-headline"><?php esc_html_e( 'More posts', 'scnsk' ); ?></h2>
			<?php $blog = get_option( 'page_for_posts' ); ?>
			<?php if ( $blog ) : ?>
				<a href="<?php echo esc_url( get_permalink( $blog ) ); ?>"><?php esc_html_e( 'All posts', 'scnsk' ); ?></a>
			<?php endif; ?>
		</div>
		<div class="post-grid">
			<?php
			while ( $grid->have_posts() ) :
				$grid->the_post();
				get_template_part( 'template-parts/card' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<?php
		$links = paginate_links(
			array(
				'total'     => $grid->max_num_pages,
				'current'   => $paged,
				'type'      => 'list',
				'prev_text' => __( 'Newer', 'scnsk' ),
				'next_text' => __( 'Older', 'scnsk' ),
			)
		);
		if ( $links ) {
			echo '<nav class="pagination" aria-label="' . esc_attr__( 'Posts', 'scnsk' ) . '"><div class="nav-links">' . wp_kses_post( $links ) . '</div></nav>';
		}
		?>
	</div>
</section>
<?php endif; ?>

<?php
$topics = get_categories(
	array(
		'hide_empty' => false,
		'exclude'    => array( 1 ), // "Blog General" is the catch-all; the topics band is for the real subjects.
		'orderby'    => 'count',
		'order'      => 'DESC',
	)
);
if ( $topics ) :
	?>
<section class="band band-sage">
	<div class="wrap">
		<div class="section-head">
			<h2 class="t-headline"><?php esc_html_e( 'What I write about', 'scnsk' ); ?></h2>
		</div>
		<div class="topics">
			<?php foreach ( $topics as $topic ) : ?>
				<a class="topic" href="<?php echo esc_url( get_category_link( $topic ) ); ?>">
					<h3 class="topic-name"><?php echo esc_html( $topic->name ); ?></h3>
					<span class="topic-count"><?php echo $topic->count ? esc_html( sprintf( _n( '%d post', '%d posts', $topic->count, 'scnsk' ), $topic->count ) ) : esc_html__( 'Coming soon', 'scnsk' ); ?></span>
					<?php if ( $topic->description ) : ?>
						<p class="topic-desc"><?php echo esc_html( $topic->description ); ?></p>
					<?php endif; ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
get_footer();
