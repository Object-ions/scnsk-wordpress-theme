<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'scnsk' ); ?></a>

<header class="site-header">
	<div class="wrap">
		<?php scnsk_wordmark( 'color' ); ?>

		<button class="nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false"
			data-open="<?php esc_attr_e( 'Menu', 'scnsk' ); ?>" data-close="<?php esc_attr_e( 'Close', 'scnsk' ); ?>">
			<span class="drop" aria-hidden="true"></span>
			<span class="nav-toggle-text"><?php esc_html_e( 'Menu', 'scnsk' ); ?></span>
		</button>

		<nav id="site-nav" class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'scnsk' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'scnsk_menu_fallback',
					'items_wrap'     => '<ul>%3$s<li class="menu-item-search">' . get_search_form( array( 'echo' => false ) ) . '</li></ul>',
				)
			);
			?>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
