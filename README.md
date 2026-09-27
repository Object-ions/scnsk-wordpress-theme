# SCNSK — Skincare & Skin Talk

WordPress theme for [skincareandskintalk.com](https://skincareandskintalk.com), built from the SCNSK brand kit.
Bold expanded type, flat botanical color blocks, and the Talk Drop corner (bottom-left corner square) on every rounded shape. No hype. Just skin.

## What's here

| Path | What it is |
|---|---|
| `scnsk-theme/` | The WordPress theme. Zip this folder and upload it. |
| `SCNSK-brand-kit/brand-book/` | Manifesto, voice, logo rules, visual rules and `tokens.json` (the source of the CSS variables). |
| `preview/build.js` | Builds static HTML previews of the theme from the live site's REST API (`node preview/build.js`). |

The brand kit's PNG/SVG/font exports are **not** in this repo on purpose. The theme carries only the files it actually serves (`scnsk-theme/assets/`).

## Install

1. Zip the theme: `cd` into the repo and run `zip -r scnsk-theme.zip scnsk-theme -x '*.DS_Store'`.
2. WordPress admin → **Appearance → Themes → Add New → Upload Theme** → pick the zip → **Activate**.
3. **Appearance → Menus**: create a menu (About, Blog, Contact Us, Credits) and assign it to **Primary menu** and **Footer menu**. Until then, the theme lists your pages automatically.
4. **Settings → Reading**: leave *Your homepage displays* on **Your latest posts**. The theme's `front-page.php` draws the home layout, and `/blog/` keeps working once you set the **Posts page** to *Blog*.
5. Optional: **Appearance → Customize → Site Identity** to set the site icon. If you skip it, the theme serves the brand favicon itself.

Elementor and Astra are no longer needed once SCNSK is active. Deactivating Elementor is safe: the posts are plain Gutenberg blocks.

## Templates

- `front-page.php` — forest hero, "This week" featured post (the one clay button), post grid, "What I write about" topics on sage.
- `index.php` — the Blog page (all posts, paginated).
- `single.php` — question headline, byline, lead paragraph, 68ch body, Talk Drop sign-off, older/newer, "Keep reading".
- `archive.php`, `search.php`, `page.php`, `404.php`, `comments.php`.

## Brand rules the CSS enforces

- Colors, type scale, spacing and radii are the tokens from `tokens.json`, declared once on `:root` in `assets/css/scnsk.css`.
- Clay appears once per view: the wordmark's N in the header and one primary button on the home page. Everything else is forest, moss, sage, mist, oat and paper.
- No shadows, no gradients. Depth is color blocks and 2px rules.
- Archivo (body) and Archivo Expanded (display) are self-hosted from `assets/fonts/`.

## Develop

- Edit `scnsk-theme/assets/css/scnsk.css`; bump `SCNSK_VERSION` in `functions.php` to bust caches.
- `node preview/build.js` then open `preview/index.html`, `post.html` or `topic.html` to see the layout without a WordPress install.

Built by Skincare Junkie with Claude Code. Fonts: Archivo (SIL Open Font License).
