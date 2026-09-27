<?php
/**
 * Comments.
 *
 * @package scnsk
 */

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="t-headline"><?php echo esc_html( sprintf( _n( '%d comment', '%d comments', get_comments_number(), 'scnsk' ), get_comments_number() ) ); ?></h2>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 0,
				)
			);
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'        => __( 'Say something', 'scnsk' ),
			'title_reply_before' => '<h2 id="reply-title" class="t-headline">',
			'title_reply_after'  => '</h2>',
			'class_submit'       => 'btn btn-ink',
			'label_submit'       => __( 'Post comment', 'scnsk' ),
		)
	);
	?>
</section>
