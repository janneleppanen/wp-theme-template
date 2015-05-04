var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	less = require('gulp-less'),
	sass = require('gulp-sass'),
	minifyCSS = require('gulp-minify-css'),
	imagemin = require('gulp-imagemin'),
	pngquant = require('imagemin-pngquant'),
	livereload = require('gulp-livereload'),
	neat = require('node-neat').includePaths;

var path = {
	themeStyles: [
		'styles/main.scss'
	],
	loginStyles: [
		'styles/login.scss'
	],
	editorStyles: [
		'styles/editor.scss'
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
		.pipe(concat('main.scss'))
		.pipe(sass({
			includePaths: ['themeStyles'].concat(neat)
		}))
		.pipe(minifyCSS())
		.pipe(gulp.dest('styles/'))
		.pipe(livereload());
});

gulp.task('editorStyles', function() {
	gulp.src(path.editorStyles)
		.pipe(concat('editor.scss'))
		.pipe(sass())
		.pipe(minifyCSS())
		.pipe(gulp.dest('styles/'))
		.pipe(livereload());
});

gulp.task('loginStyles', function() {
	gulp.src(path.loginStyles)
		.pipe(concat('login.scss'))
		.pipe(sass())
		.pipe(minifyCSS())
		.pipe(gulp.dest('styles/'))
		.pipe(livereload());
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
	livereload.listen();
	
	gulp.watch(path.themeStyles, ['themeStyles']);
	gulp.watch(path.editorStyles, ['editorStyles']);
	gulp.watch(path.loginStyles, ['loginStyles']);
	
	gulp.watch('*', function() {
		livereload.reload();
	});
});


gulp.task('styles', ['themeStyles', 'loginStyles', 'editorStyles']);
gulp.task('default', ['scripts', 'imagemin', 'styles', 'browsersync']);