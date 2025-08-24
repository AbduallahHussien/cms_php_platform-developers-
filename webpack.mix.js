const mix = require('laravel-mix');
const path = require('path');
 

// 🔧 Get plugin directory name dynamically
const pluginFolderName = 'whatsapp'; 
const source = `platform/plugins/${pluginFolderName}`;
// const dist = `platform/plugins/${pluginFolderName}/public`;  
const dist = `public/vendor/core/plugins/${pluginFolderName}`; 

// Tell Mix NOT to prepend public/
mix.setPublicPath('.'); // <-- important!

mix.js(`${source}/resources/js/app.js`, `${dist}/js`);

// ✅ Combine style.css + toastr.min.css into one minified CSS
mix.styles([
    `${source}/resources/css/style.css`,
    `${source}/resources/css/toastr.min.css`
], `${dist}/css/all.css`);

//    .postCss(`${source}/resources/css/style.css`, `${dist}/css`)
//     .postCss('node_modules/toastr/build/toastr.min.css', `${dist}/css`);

mix.disableNotifications();

