const mix = require('laravel-mix')
const fs = require('fs')
const path = require('path')

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
  .version()
  .sourceMaps()

// Auto copy assets to test Laravel project
fs.access('../water-admin-test', error => {
  if (!error) {
    mix.then(() => {
      // Run Laravel Mix copy file method
      new (require('laravel-mix/src/tasks/CopyFilesTask'))({
        from: 'public',
        to: new File('../water-admin-test/public/vendor/water-admin')
      }).run()
    })
  }
})
