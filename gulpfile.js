var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify');

gulp.task('scripts', function() { 
	return gulp.src('js/**/*.js')
		.pipe(concat('build.js'))
		.pipe(uglify())
		.pipe(gulp.dest('js/'));
});

gulp.task('styles', function() {
	
});

gulp.task('imagemin', function() { 

});

gulp.task('browsersync', function() {
	
});

gulp.task('default', ['scripts']);