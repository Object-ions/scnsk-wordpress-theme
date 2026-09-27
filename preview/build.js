// Builds static previews of the SCNSK theme from the live site's REST API.
// Usage: node preview/build.js   → writes preview/index.html, preview/post.html, preview/topic.html
// The markup mirrors the PHP templates so the CSS in scnsk-theme/assets/css/scnsk.css is exercised as-is.
const fs = require('fs');
const path = require('path');

const SITE = 'https://skincareandskintalk.com';
const OUT = __dirname;
const ASSETS = '../scnsk-theme/assets';

const esc = (s) => String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
const decode = (s) => String(s).replace(/&#(\d+);/g, (_, n) => String.fromCharCode(n)).replace(/&amp;/g, '&').replace(/&#8217;/g, '’').replace(/&#8211;/g, '–').replace(/&#8220;/g, '“').replace(/&#8221;/g, '”').replace(/&hellip;/g, '…');
const strip = (h) => decode(h.replace(/<[^>]+>/g, ' ')).replace(/\[…\]|\[\.\.\.\]|\[&hellip;\]/g, '').replace(/\s+/g, ' ').trim();
const fmt = (d, long) => new Date(d).toLocaleDateString('en-US', long ? { month: 'long', day: 'numeric', year: 'numeric' } : { month: 'short', day: 'numeric', year: 'numeric' });
const words = (n, s) => { const w = s.split(' '); return w.length > n ? w.slice(0, n).join(' ') + '…' : s; };
const readMin = (html) => Math.max(1, Math.ceil(strip(html).split(' ').length / 200));

async function get(p) { const r = await fetch(SITE + '/wp-json/wp/v2/' + p); return r.json(); }

function tags(post, cats, limit = 2) {
  const list = post.categories.map((id) => cats.find((c) => c.id === id)).filter(Boolean).slice(0, limit);
  return `<div class="tags">${list.map((c) => `<a class="tag" href="topic.html">${esc(decode(c.name))}</a>`).join('')}</div>`;
}
function card(post, cats, block) {
  return `<article class="card${block ? ' card-block' : ''}">
  ${tags(post, cats)}
  <h3 class="card-title"><a href="post.html">${esc(decode(post.title.rendered))}</a></h3>
  <div class="card-excerpt"><p>${esc(words(26, strip(post.excerpt.rendered)))}</p></div>
  <span class="card-meta">${readMin(post.content.rendered)} min read · <time>${fmt(post.date)}</time></span>
</article>`;
}
function byline(post) {
  return `<a class="byline" href="#"><span class="byline-mark" aria-hidden="true">SK</span><span class="byline-text"><span class="byline-name">Skincare Junkie</span><span class="byline-meta">${fmt(post.date, true)} · ${readMin(post.content.rendered)} min read</span></span></a>`;
}
const nav = `<ul><li><a href="index.html">Home</a></li><li><a href="topic.html">Blog</a></li><li><a href="#">About</a></li><li><a href="#">Contact Us</a></li><li class="menu-item-search"><form role="search" class="search-form" action="#"><label class="screen-reader-text" for="s">Search the blog</label><input type="search" id="s" name="s" placeholder="Search skin talk"><button type="submit">Go</button></form></li></ul>`;

function shell(title, body) {
  return `<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>${esc(title)} – Skin Care &amp; Skin Talk</title>
<link rel="icon" href="${ASSETS}/img/scnsk-favicon.svg" type="image/svg+xml">
<link rel="stylesheet" href="${ASSETS}/css/scnsk.css">
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header"><div class="wrap">
  <a class="brand" href="index.html" rel="home" aria-label="Skin Care &amp; Skin Talk"><img src="${ASSETS}/img/scnsk-wordmark-color.svg" alt="SCNSK" width="1409" height="280"></a>
  <button class="nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false" data-open="Menu" data-close="Close"><span class="drop" aria-hidden="true"></span><span class="nav-toggle-text">Menu</span></button>
  <nav id="site-nav" class="site-nav" aria-label="Primary">${nav}</nav>
</div></header>
<main id="main" class="site-main">
${body}
</main>
<footer class="site-footer"><div class="wrap">
  <div class="footer-top">
    <div class="footer-brand">
      <a class="brand" href="index.html"><img src="${ASSETS}/img/scnsk-wordmark-oat.svg" alt="SCNSK" width="1409" height="280"></a>
      <p class="footer-line">No hype. Just skin.</p>
      <p class="footer-sign">I tried it all so you don’t have to. — Skincare Junkie</p>
    </div>
    <nav class="footer-nav" aria-label="Footer"><span class="t-label">Around the site</span><ul><li><a href="#">About</a></li><li><a href="topic.html">Blog</a></li><li><a href="#">Contact Us</a></li><li><a href="#">Credits</a></li></ul></nav>
    <div class="footer-stamp"><img src="${ASSETS}/img/scnsk-stamp-oat.svg" alt="" width="800" height="800"></div>
  </div>
  <div class="footer-bottom"><span>© 2026 SCNSK · Skincare &amp; Skin Talk</span><span>Skincare Junkie · SCNSK</span></div>
</div></footer>
<script src="${ASSETS}/js/nav.js"></script>
</body>
</html>`;
}

(async () => {
  const [posts, cats] = await Promise.all([get('posts?per_page=20&_fields=id,title,date,excerpt,content,categories'), get('categories?per_page=50')]);
  const latest = posts[0];
  const rest = posts.slice(1, 10);
  const topics = cats.filter((c) => c.id !== 1).sort((a, b) => b.count - a.count);

  // Home
  const home = `
<section class="hero band band-forest">
  <div class="wrap"><div class="hero-copy">
    <h1 class="t-display-xl">Straight talk about skin.</h1>
    <p class="t-lead">Ten years inside the skincare industry, more products than I’d like to admit. Here’s what works, what doesn’t, and why, in plain words.</p>
    <div class="hero-meta"><a class="btn" href="#latest">Read the latest post</a><span class="t-small muted">New post every week.</span></div>
  </div></div>
  <img class="hero-bloom" src="${ASSETS}/img/scnsk-bloom-sage.svg" alt="" width="512" height="512">
</section>
<section id="latest" class="band"><div class="wrap">
  <div class="section-head"><h2 class="t-headline">This week</h2></div>
  <article class="featured">
    <div>${tags(latest, cats)}<h3 class="t-display-l"><a href="post.html">${esc(decode(latest.title.rendered))}</a></h3></div>
    <div class="featured-side"><p class="t-lead">${esc(words(34, strip(latest.excerpt.rendered)))}</p>${byline(latest)}<a class="btn btn-primary" href="post.html">Read the post</a></div>
  </article>
</div></section>
<section class="band" style="padding-top:0"><div class="wrap">
  <div class="section-head"><h2 class="t-headline">More posts</h2><a href="topic.html">All posts</a></div>
  <div class="post-grid">${rest.map((p) => card(p, cats)).join('\n')}</div>
</div></section>
<section class="band band-sage"><div class="wrap">
  <div class="section-head"><h2 class="t-headline">What I write about</h2></div>
  <div class="topics">${topics.map((t) => `<a class="topic" href="topic.html"><h3 class="topic-name">${esc(decode(t.name))}</h3><span class="topic-count">${t.count ? t.count + ' post' + (t.count === 1 ? '' : 's') : 'Coming soon'}</span>${t.description ? `<p class="topic-desc">${esc(decode(t.description))}</p>` : ''}</a>`).join('')}</div>
</div></section>`;
  fs.writeFileSync(path.join(OUT, 'index.html'), shell('Straight talk about skin', home));

  // Single post (the retinoids one has headings, lists and separators)
  const post = posts.find((p) => /Retinoids/.test(p.title.rendered)) || posts[1];
  const related = posts.filter((p) => p.id !== post.id && p.categories.some((c) => post.categories.includes(c))).slice(0, 3);
  const single = `
<article class="post">
  <header class="article-head"><div class="wrap">${tags(post, cats, 3)}<h1 class="t-display-l">${esc(decode(post.title.rendered))}</h1>${byline(post)}</div></header>
  <div class="wrap">
    <div class="prose entry-content">${post.content.rendered}</div>
    <p class="article-end"><span class="drop" aria-hidden="true"></span><span>I tried it all so you don’t have to. — Skincare Junkie</span></p>
    <nav class="post-nav" aria-label="Posts">
      <a class="prev" href="post.html"><span class="t-label">Older post</span><span class="t-title">${esc(decode(posts[posts.indexOf(post) + 1].title.rendered))}</span></a>
      <a class="next" href="post.html"><span class="t-label">Newer post</span><span class="t-title">${esc(decode(posts[posts.indexOf(post) - 1].title.rendered))}</span></a>
    </nav>
  </div>
</article>
<section class="band band-oat" style="margin-top:96px"><div class="wrap">
  <div class="section-head"><h2 class="t-headline">Keep reading</h2></div>
  <div class="post-grid">${(related.length ? related : posts.slice(0, 3)).map((p) => card(p, cats, true)).join('\n')}</div>
</div></section>`;
  fs.writeFileSync(path.join(OUT, 'post.html'), shell(decode(post.title.rendered), single));

  // Category archive
  const cat = cats.find((c) => c.slug === 'science-of-skin');
  const inCat = posts.filter((p) => p.categories.includes(cat.id));
  const topic = `
<section class="band band-sage archive-head"><div class="wrap">
  <span class="t-label">Topic</span>
  <h1 class="t-display-l">${esc(decode(cat.name))}</h1>
  <div class="archive-desc t-lead"><p>${esc(decode(cat.description))}</p></div>
</div></section>
<section class="band"><div class="wrap"><div class="post-grid">${inCat.map((p) => card(p, cats)).join('\n')}</div></div></section>`;
  fs.writeFileSync(path.join(OUT, 'topic.html'), shell(decode(cat.name), topic));

  console.log('wrote preview/index.html, post.html, topic.html');
})();
