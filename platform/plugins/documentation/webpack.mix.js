const mix = require('laravel-mix')
const path = require('path')

const directory = path.basename(path.resolve(__dirname))
const source = `platform/plugins/${directory}`
const dist = `public/vendor/core/plugins/${directory}`

mix.js(`${source}/public/js/tst.js`, `${dist}/js`)
mix.postCss(`${source}/public/css/style.css`, `${dist}/css`) // Or .sass()

if (mix.inProduction()) {
    mix.copy(`${dist}/js/tst.js`, `${source}/public/js`)
    mix.copy(`${dist}/css/style.css`, `${source}/public/css`)
}
