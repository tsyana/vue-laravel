// var utils = require('./utils')
// var config = require('../config')
// var isProduction = process.env.NODE_ENV === 'production'
//
// module.exports = {
//   loaders: utils.cssLoaders({
//     sourceMap: isProduction
//       ? config.build.productionSourceMap
//       : config.dev.cssSourceMap,
//     extract: isProduction
//   })
// }
module.exports = {
    preserveWhitespace: false,
    postcss: [
        require('autoprefixer')({
            browsers: ['last 5 versions'],
            remove: false
        }),
        require('postcss-px2rem')({
            remUnit: 75
        })
    ]
}
