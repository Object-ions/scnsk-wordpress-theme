<?php
/**
 * Static pages: About, Contact, Credits.
 *
 * @package scnsk
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="page-head">
			<div class="wrap">
				<h1 class="t-display-l"><?php the_title(); ?></h1>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="article-hero">
				<?php the_post_thumbnail( 'scnsk-wide' ); ?>
			</figure>
		<?php endif; ?>

		<div class="wrap">
			<div class="prose entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	</article>
	<?php
endwhile;

get_footer();
