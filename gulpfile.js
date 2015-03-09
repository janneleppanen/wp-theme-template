var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	pngquant = require('imagemin-pngquant');

gulp.task('scripts', function() { 
	return gulp.src('js/**/*.js')
		.pipe(concat('build.js'))
		.pipe(uglify())
		.pipe(gulp.dest('js/'));
});

gulp.task('styles', function() {
	
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

gulp.task('default', ['scripts', 'imagemin']);