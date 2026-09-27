SCNSK is a skincare blog for curious beginners, written by an author called **Skincare Junkie**. It's written SCNSK, said **"Skin Talk,"** and spelled out as **Skincare & Skin Talk**. The promise fits in one line: *straight talk about skin.* The look is bold and graphic, built from soft botanical colors. Heavy expanded type and flat color blocks carry the confidence. Sage, oat and forest keep it calm. One clay accent does the talking.

## The core idea: the talk corner

Everything in this system comes from one shape, the **Talk Drop**: a circle with one square corner at the bottom left. It reads as a drop of product and a speech bubble at the same time, so it says skincare and talk in one mark.

- Put **SK** inside the Talk Drop and you get the monogram. SK plus a speech bubble literally says "Skin Talk."
- Four Talk Drops with their square corners meeting form the **Bloom**, the brand's botanical flourish.
- In UI, every rounded shape keeps its **bottom-left corner square**. Use `radius-pill` or `radius-lg` on three corners and `radius-0` on the bottom left: `border-radius: var(--radius-pill) var(--radius-pill) var(--radius-pill) var(--radius-0)`. This is the most recognizable detail in the system, so never round all four corners.

## Color

- Keep the weight about 50% paper/oat, 25% forest, 15% sage, 5% mist and 5% clay.
- Set text in `ink` on `surface`, `surface-raised` or `surface-tint`. Use `ink-muted` for meta and captions on those same grounds.
- Make bold color blocks with `surface-block` (sage) and put `on-block` text on them. Full-bleed sage and forest bands with hard `radius-0` edges are the signature layout move.
- **Use clay (`accent`) once per view.** That can be the N in the wordmark, one primary button, one highlighted word in a headline, or a Talk Drop bullet run. Never use two clay moments side by side.
- Put clay text only on `surface` or `surface-raised`. Don't set clay text on sage or mist, and never put clay on forest (2.2:1).
- Keyboard focus is a solid 2px `focus` outline with a 2px offset, on every interactive element.
- Links use `link` (ink) with a 2px `accent` underline at a 3px offset.
- The brand primitives (`forest`, `moss`, `sage`, `mist`, `oat`, `paper`, `clay`) are fixed. Logos and printed pieces use them directly, not the themed tokens.
- There are no gradients and no shadows. Depth comes from color blocks and 2px `line-strong` rules.

## Type

- There's one family in two widths. Everything that shouts uses **Archivo Expanded** (`display`), and everything you read uses **Archivo** (`sans`).
- Use `display-xl` once per page, on the hero or a cover line. Article titles are `display-l`, section heads are `headline` and card titles are `title`.
- `label` is the lab-label voice: always uppercase with wide tracking. Use it for eyebrows, step numbers (`STEP 02 · PM`) and tags.
- Open every article with a `lead` paragraph that gives the straight answer. Body copy is `body` at 18px with a 68ch max line length.
- `body-strong` is for the verdict line ("You don't need this."). Use it at most twice per article.
- Headlines are sentence case. **SCNSK** is always set in capitals. "Skincare" is one word.
- On the web, load Archivo from Google Fonts with the width axis (`family=Archivo:wdth,wght@62..125,100..900`) and get Expanded with `font-stretch: 125%`. The files in `fonts/` are the same faces, already split into two families.

## Logo use (short version)

- **Primary logo:** `scnsk-logo-stacked-color.svg`, the wordmark over SKINCARE & SKIN TALK. Use it wherever the name needs explaining: the About page, the book and first impressions.
- **Site header:** `scnsk-wordmark-color.svg`, the wordmark alone with its clay N. The N marks the "and": **SC · N · SK** = SkinCare 'n' SKin.
- **Avatars, favicon and watermark:** the monogram (`scnsk-avatar-*`, `scnsk-favicon.svg`).
- **Merch and packaging:** the stamp (`scnsk-stamp-*`).
- **Clay appears once per logo.** If a lockup's Talk Drop is clay, its N goes to ink.
- Full rules are in the Logo system section.

## Layout and imagery

- Pair a 12-column grid with generous color blocks. Gutters are `space-4` on mobile and `space-6` on desktop. Sections breathe at `space-9`.
- Photograph product flat-lays on seamless sage, oat or mist, in hard daylight with real skin texture. Show real texture, not "results," and never use before/after miracle framing.
- Crop tight and let the color block do the styling. One photo per block works better than a collage.

## Iconography

- The Talk Drop is the bullet, the end-of-article mark and the "tip" marker, in `ink` or once in `accent`.
- Use simple 2px-stroke line icons in `ink` with square caps, and keep them few.
- Don't use emoji in brand graphics, headlines or UI. A social caption can carry at most one.
- All logo and mark SVGs are single-color outlined paths with no live text. Each file name says its ink.

## Motion

- Keep motion minimal. Use 150–200ms ease-out color and position changes on hover and focus only. Nothing bounces and nothing sparkles, which also keeps hype out of the motion.
