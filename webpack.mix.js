const mix = require('laravel-mix');
const path = require('path');

//Bundeling Whatsapp Plugin using laravel mix

// 🔧 Get plugin directory name dynamically
const directory = 'whatsapp';

// 🔧 Define source and dist paths
const source = `platform/plugins/${directory}`;
const dist = `public/vendor/core/plugins/${directory}`;

// ✅ Compile MAIN entry JS (app.js) — it will import firebase.js + chat.js
mix.js(`${source}/resources/js/app.js`, `${dist}/js`)
//    .postCss(`${source}/resources/css/style.css`, `${dist}/css`);
    .postCss('node_modules/toastr/build/toastr.min.css', `${dist}/css`);


mix.disableNotifications();

