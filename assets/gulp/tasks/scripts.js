/**
 * scripts.js - Builds the distribution JavaScript and jQuery files
 *
 * @package     UpGulp
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://gitlab.com/uptechlabs/upgulp
 * @license     GNU General Public License 2.0+
 */

'use strict';

module.exports = function ( gulp, plugins, config ) {

	var handleErrors = require( config.gulpDir + 'utils/handleErrors.js' ),
		runSequence = require('run-sequence').use(gulp);

	/**
	 * scripts task which is callable
	 *
	 * Tasks are run synchronously to ensure each step is completed
	 * BEFORE moving on to the next one.  We don't want any race situations.
	 *
	 * @since 1.0.1
	 */
	gulp.task( 'scripts', function ( callback ) {
		runSequence( 'scripts-clean',
// 			'dependencies-concat',
			'js-concat',
			'js-minify',
			callback );
	} );

	gulp.task( 'scripts-clean', function () {
		var settings = config.scripts.clean;

		return cleanScripts( settings );
	} );

	gulp.task( 'dependencies-concat', function () {
		var settings = config.scripts.dependenciesConcat;

		return concatScripts( settings );
	} );

	gulp.task( 'js-concat', function () {
		var settings = config.scripts.concat;

		return concatScripts(settings);
	} );

	gulp.task( 'js-minify', function () {
		var settings = config.scripts.minify;

		return minifyScripts(settings);
	} );

	/*******************
	 * Task functions
	 ******************/

	/**
	 * Delete the .js before we minify and optimize
	 *
	 * @since 1.0.0
	 *
	 * @param settings
	 * @returns {*}
	 */
	function cleanScripts( settings ) {
		plugins.del( settings.src ).then( function () {
			plugins.util.log( plugins.util.colors.bgGreen( 'Scripts are now clean....[cleanScripts()]' ) );
		} );
	};

	/**
	 * Concatentate the scripts into one big butt file
	 *
	 * @since 1.0.0
	 *
	 * @returns {*}
	 */
	function concatScripts( settings ) {
// 		var settings = config.scripts.concat;

		return gulp.src( settings.src )
		           
           .pipe( plugins.plumber( {errorHandler: handleErrors} ) )

           .pipe( plugins.sourcemaps.init() )
           .pipe( plugins.concat( settings.concatSrc ) )
           .pipe( plugins.sourcemaps.write() )

           .pipe( gulp.dest( settings.dest ) )
           .pipe( plugins.browserSync.stream() );
	}
	/**
	 * Minify scripts
	 *
	 * @since 1.0.0
	 */
	function minifyScripts( settings ) {

		return gulp.src( settings.src )
	           .pipe( plugins.plumber( {errorHandler: handleErrors} ) )

	           .pipe( plugins.uglify( {
		           mangle: false
	           } ) )
               .pipe( plugins.rename( {
	               extname: '.min.js'
               } ) )
	           .pipe( gulp.dest( settings.dest ) )
	           .pipe( plugins.notify( {message: 'Scripts are built.'} ) );
	};
};