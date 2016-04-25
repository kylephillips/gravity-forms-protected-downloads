var promise = require('es6-promise').polyfill();
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefix = require('gulp-autoprefixer');
var livereload = require('gulp-livereload');
var notify = require('gulp-notify');
var minifycss = require('gulp-minify-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

// Style Paths
var scss_front = 'assets/scss/public/*';
var scss_back = 'assets/scss/admin/*';
var css_front = 'assets/css/public/';
var css_back = 'assets/css/admin/';

// JS Paths
var js_source_front = [
	'assets/js/public/gravity-forms-protected-downloads.js'
];
var js_source_back = [
	'assets/js/admin/gravity-forms-protected-downloads.js'
];

var js_compiled_front = 'assets/js/public/';
var js_compiled_back = 'assets/js/admin/';

/**
* Process Front End Styles
*/
gulp.task('scss_front', function(){
	return gulp.src(scss_front)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 15 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(css_front))
		.pipe(livereload())
		.pipe(notify('Front end styles compiled & compressed.'));
});

/**
* Process Back End Styles
*/
gulp.task('scss_back', function(){
	return gulp.src(scss_front)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 15 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(css_back))
		.pipe(livereload())
		.pipe(notify('Back end styles compiled & compressed.'));
});

/**
* Front End Scripts
*/
gulp.task('js_front', function(){
	return gulp.src(js_source_front)
		.pipe(concat('gform-protected-downloads-scripts.min.js'))
		.pipe(gulp.dest(js_compiled_front))
		.pipe(uglify())
		.pipe(gulp.dest(js_compiled_front))
		.pipe(notify('Front end scripts compiles & compressed.'));
});

/**
* Back End Scripts
*/
gulp.task('js_back', function(){
	return gulp.src(js_source_back)
		.pipe(concat('gform-protected-downloads-scripts.min.js'))
		.pipe(gulp.dest(js_compiled_back))
		.pipe(uglify())
		.pipe(gulp.dest(js_compiled_back))
		.pipe(notify('Back end scripts compiles & compressed.'));
});

/**
* Watch Task
*/
gulp.task('watch', function(){
	livereload.listen(8000);
	gulp.watch(scss_front, ['scss_front']);
	gulp.watch(scss_back, ['scss_back']);
	gulp.watch(js_source_front, ['js_front']);
	gulp.watch(js_source_back, ['js_back']);
});

/**
* Default
*/
gulp.task('default', ['scss_front', 'scss_back', 'js_front', 'js_back', 'watch',]);