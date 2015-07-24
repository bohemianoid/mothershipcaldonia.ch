var gulp         = require('gulp');
var browserSync  = require('browser-sync').create();
var rename       = require('gulp-rename');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('browserSync', function() {
  browserSync.init({
    proxy: "localhost:8080",
    open:  false
  })
});

gulp.task('rename', function() {
  gulp.src('bower_components/normalize.css/normalize.css')
    .pipe(rename('_normalize.scss'))
    .pipe(gulp.dest('wordpress/themes/mothershipcaldonia/sass/base'));
});

gulp.task('css', function() {
  gulp.src('wordpress/themes/mothershipcaldonia/sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('wordpress/themes/mothershipcaldonia'))
    .pipe(browserSync.stream());
});

gulp.task('default', [
  'browserSync',
  'rename',
  'css'
], function() {
  gulp.watch('wordpress/themes/mothershipcaldonia/sass/**/*.scss', ['css']);
  gulp.watch('wordpress/**/*.php').on('change', browserSync.reload);
});
