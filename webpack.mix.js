let mix = require('laravel-mix')

require('./nova.mix')

mix
  .setPublicPath('dist')
  .js('resources/js/import-export-card.js', 'js')
  .vue({ version: 3 })
  .nova('lupennat/import-export-card')
  .version();
