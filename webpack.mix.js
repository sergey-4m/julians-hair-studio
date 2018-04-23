let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/tree.js', 'public/js')
	.extract([
		'axios',
		'vue', 
		'vue-axios',
		'vue-router', 
		'vue-template-compiler', 
		'popper.js', 
		'lodash'
	]);
mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.webpackConfig({
    node: {
      fs: "empty"
    },
    resolve: {
        alias: {
            "handlebars" : "handlebars/dist/handlebars.js"
        }
    },
    module: {
    	rules: [{
    		test: /\.js$/,
    		loader: 'babel-loader?cacheDirectory',
    		include: [
    			path.resolve(__dirname, 'node_modules/'),
    			/vue2-datatable-component/
    		]
    	}]
    }
});