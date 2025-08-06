const mix = require('laravel-mix');
const path = require('path');

// 🔧 Get plugin directory name dynamically
const directory = path.basename(path.resolve(__dirname));

// 🔧 Define source and dist paths
const source = `platform/plugins/${directory}`;
const dist = `public/vendor/core/plugins/${directory}`;

// ✅ Compile MAIN entry JS (app.js) — it will import firebase.js + chat.js
mix.js(`${source}/resources/js/app.js`, `${dist}/js`);
//    .postCss(`${source}/resources/css/style.css`, `${dist}/css`);

// ✅ Copy built files back to plugin’s public folder in production
if (mix.inProduction()) {
    mix.copy(`${dist}/js/app.js`, `${source}/public/js`);
    // mix.copy(`${dist}/css/style.css`, `${source}/public/css`);
}

// ✅ Optional: Add versioning for cache-busting
if (mix.inProduction()) {
    mix.version();
}
