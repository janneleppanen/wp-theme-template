var gulp       = require('gulp'),
    concat     = require('gulp-concat'),
    uglify     = require('gulp-uglify'),
    sass       = require('gulp-sass'),
    minifyCSS  = require('gulp-minify-css'),
    imagemin   = require('gulp-imagemin'),
    pngquant   = require('imagemin-pngquant'),
    livereload = require('gulp-livereload'),
    plumber    = require('gulp-plumber');

var path = {
    styles: {
        theme: 'styles/theme/',
        login: 'styles/login/',
        editor: 'styles/editor/'
    }
}

gulp.task('scripts', function() {
    return gulp.src('js/**/*.js')
        .pipe(concat('build.js'))
        .pipe(uglify())
        .pipe(gulp.dest('js/'));
});

gulp.task('styles.theme', function() {
    gulp.src(path.styles.theme + 'main.scss')
        .pipe(concat('theme.scss'))
        .pipe(plumber())
        .pipe(sass({
            includePaths: ['styles.theme']
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest('styles/'))
        .pipe(livereload());
});

gulp.task('styles.editor', function() {
    gulp.src(path.styles.editor + 'main.scss')
        .pipe(concat('editor.scss'))
        .pipe(plumber())
        .pipe(sass({
            includePaths: ['styles.editor']
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest('styles/'))
        .pipe(livereload());
});

gulp.task('styles.login', function() {
    gulp.src(path.styles.login + 'main.scss')
        .pipe(concat('login.scss'))
        .pipe(plumber())
        .pipe(sass({
            includePaths: ['styles.login']
        }))
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

    gulp.watch('*', function() {
        livereload.reload();
    });
});

gulp.task('watch', function() {
    gulp.watch(path.styles.theme + '**/*.scss', ['styles.theme']);
    gulp.watch(path.styles.editor + '**/*.scss', ['styles.editor']);
    gulp.watch(path.styles.login + '**/*.scss', ['styles.login']);
});

gulp.task('styles', ['styles.theme', 'styles.editor', 'styles.login']);

gulp.task('default', ['scripts', 'imagemin', 'styles', 'browsersync', 'watch']);