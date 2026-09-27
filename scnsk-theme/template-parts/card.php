<?php
/**
 * Post card. Set $args['block'] = true for a sage card.
 *
 * @package scnsk
 */

$is_block = ! empty( $args['block'] );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' . ( $is_block ? ' card-block' : '' ) ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'scnsk-card', array( 'class' => 'card-thumb', 'loading' => 'lazy' ) ); ?>
		</a>
	<?php endif; ?>

	<?php scnsk_category_tags( null, 2 ); ?>

	<h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<div class="card-excerpt"><?php the_excerpt(); ?></div>

	<?php scnsk_meta_line(); ?>
</article>
