const mix = require('laravel-mix');
const path = require('path');
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

const styleLintPlugin = require('stylelint-webpack-plugin');
mix.webpackConfig({
	stats: {
		children: false
	},
	// 	plugins: [
	// 		new styleLintPlugin({
	// 			files: ['**/*.scss'],
	// 			configFile: path.resolve(__dirname, '.stylelintrc'),
	// 			syntax: 'scss',
	// 			options: {
	// 				fix: false
	// 			}
	// 		}),
	// 	],
});

mix.js('resources/js/app.js', 'public/js')
	.sass('resources/sass/app.scss', 'public/css')
	.sass('resources/sass/style.scss', 'public/css')
	.sass('resources/sass/hall.scss', 'public/css')
	.sass('resources/sass/top_menu.scss', 'public/css')
	.sass('resources/sass/common.scss', 'public/css');

mix.styles([
	'public/css/app.css',
	'public/css/reset.css'
], 'public/css/apps.css');

mix.browserSync({
	proxy: {
		target: "http://127.0.0.1:8080",
	},
	files: [
		'resources/views/**/*.blade.php',
		'public/css/*.css',
		'Http/*',
	],
});
