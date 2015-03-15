var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	less = require('gulp-less'),
	minifyCSS = require('gulp-minify-css'),
	imagemin = require('gulp-imagemin'),
	pngquant = require('imagemin-pngquant');

var path = {
	themeStyles: [
		'styles/main.less',
		'styles/shop.less'	
	],
	loginStyles: [
		'styles/login.less'
	],
	editorStyles: [
		'styles/editor.less'
	]
};

gulp.task('scripts', function() { 
	return gulp.src('js/**/*.js')
		.pipe(concat('build.js'))
		.pipe(uglify())
		.pipe(gulp.dest('js/'));
});

gulp.task('themeStyles', function() {
	gulp.src(path.themeStyles)
		.pipe(concat('main.less'))
		.pipe(less())
		.pipe(minifyCSS())
		.pipe(gulp.dest('styles/'));
});

gulp.task('editorStyles', function() {
	gulp.src(path.editorStyles)
		.pipe(concat('editor.less'))
		.pipe(less())
		.pipe(minifyCSS())
		.pipe(gulp.dest('styles/'));
});

gulp.task('loginStyles', function() {
	gulp.src(path.loginStyles)
		.pipe(concat('login.less'))
		.pipe(less())
		.pipe(minifyCSS())
		.pipe(gulp.dest('styles/'));
});

gulp.task('imagemin', function() { 
    return gulp.src('images/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('images/'));
});

gulp.task('browsersync', function() {
	
});


gulp.task('styles', ['themeStyles', 'loginStyles', 'editorStyles']);
gulp.task('default', ['scripts', 'imagemin']);