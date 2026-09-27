</main>

<footer class="site-footer">
	<div class="wrap">
		<div class="footer-top">
			<div class="footer-brand">
				<?php scnsk_wordmark( 'oat' ); ?>
				<p class="footer-line"><?php esc_html_e( 'No hype. Just skin.', 'scnsk' ); ?></p>
				<p class="footer-sign"><?php esc_html_e( 'I tried it all so you don’t have to. — Skincare Junkie', 'scnsk' ); ?></p>
			</div>

			<nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'scnsk' ); ?>">
				<span class="t-label"><?php esc_html_e( 'Around the site', 'scnsk' ); ?></span>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => 'scnsk_menu_fallback',
					)
				);
				?>
			</nav>

			<div class="footer-stamp">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/scnsk-stamp-oat.svg' ); ?>" alt="" width="800" height="800" loading="lazy">
			</div>
		</div>

		<div class="footer-bottom">
			<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> SCNSK · <?php esc_html_e( 'Skincare & Skin Talk', 'scnsk' ); ?></span>
			<span><?php esc_html_e( 'Skincare Junkie · SCNSK', 'scnsk' ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
