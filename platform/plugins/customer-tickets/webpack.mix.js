const mix = require('laravel-mix')
const path = require('path')

const directory = path.basename(path.resolve(__dirname))
const source = `platform/plugins/${directory}`
const dist = `public/vendor/core/plugins/${directory}`

mix.js(`${source}/public/js/main.js`, `${dist}/js`)
mix.js(`${source}/public/js/intTelInput.min.js`, `${dist}/js`)
mix.js(`${source}/public/js/utils.js`, `${dist}/js`)
mix.postCss(`${source}/public/css/intlTelInput.css`, `${dist}/css`) // Or .sass()

if (mix.inProduction()) {
    mix.copy(`${dist}/js/main.js`, `${source}/public/js`)
    mix.copy(`${dist}/js/intTelInput.min.js`, `${source}/public/js`)
    mix.copy(`${dist}/js/utils.js`, `${source}/public/js`)
    mix.copy(`${dist}/css/intlTelInput.css`, `${source}/public/css`)
}
