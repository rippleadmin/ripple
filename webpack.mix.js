const mix = require('laravel-mix')
const fs = require('fs')

mix.setPublicPath('public')
  .js('resources/js/main.js', 'public/js')
  .js('resources/js/water-admin.js', 'public/js')
  .webpackConfig({
    output: {
      publicPath: '/vendor/water-admin/',
      chunkFilename: 'js/[name].js?id=[chunkhash]'
    },
    resolve: {
      alias: {
        vue$: 'vue/dist/vue.runtime.esm.js',
        '@': path.resolve('resources/js')
      }
    }
  })

fs.access('../water-admin-test', error => {
  if (!error) {
    mix.copy('public', '../water-admin-test/public/vendor/water-admin')
  }
})
