var gulp         = require('gulp');
var rename       = require('gulp-rename');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('rename', function() {
  gulp.src('bower_components/normalize.css/normalize.css')
    .pipe(rename('_normalize.scss'))
    .pipe(gulp.dest('wordpress/themes/mothershipcaldonia/sass/base'));
});

gulp.task('css', function() {
  gulp.src('wordpress/themes/mothershipcaldonia/sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('wordpress/themes/mothershipcaldonia'));
})

gulp.task('default', [
  'rename',
  'css'
], function() {
  gulp.watch('wordpress/themes/mothershipcaldonia/sass/**/*.scss', ['css']);
});
