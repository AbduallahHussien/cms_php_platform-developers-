const mix = require('laravel-mix')
const path = require('path')

const directory = path.basename(path.resolve(__dirname))
const source = `platform/plugins/${directory}`
const dist = `public/vendor/core/plugins/${directory}`

mix
    .sass(`${source}/resources/sass/gift.scss`, `${dist}/css`)
    .sass(`${source}/resources/sass/gift-public.scss`, `${dist}/css`)
    .js(`${source}/resources/js/gift.js`, `${dist}/js`)
    .js(`${source}/resources/js/gift-public.js`, `${dist}/js`)

if (mix.inProduction()) {
    mix
        .copy(`${dist}/css/gift.css`, `${source}/public/css`)
        .copy(`${dist}/css/gift-public.css`, `${source}/public/css`)
        .copy(`${dist}/js/gift.js`, `${source}/public/js`)
        .copy(`${dist}/js/gift-public.js`, `${source}/public/js`)
}
