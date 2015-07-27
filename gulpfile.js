var gulp         = require('gulp');
var gUtil        = require('gulp-util');
var gIf          = require('gulp-if');
var browserSync  = require('browser-sync').create();
var rename       = require('gulp-rename');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var csso         = require('gulp-csso');
var recess       = require('gulp-recess');
var coffee       = require('gulp-coffee');
var concat       = require('gulp-concat');
var uglify       = require('gulp-uglify');
var modernizr    = require('gulp-modernizr');

// Broswersync
gulp.task('browserSync', function() {
  browserSync.init({
    proxy: "localhost:8080",
    open:  false
  })
});

// Rename
gulp.task('rename', function() {
  gulp.src('bower_components/normalize.css/normalize.css')
    .pipe(rename('_normalize.scss'))
    .pipe(gulp.dest('wordpress/themes/mothershipcaldonia/sass/base'));
});

// Styles
gulp.task('styles', function() {
  gulp.src('wordpress/themes/mothershipcaldonia/sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(csso())
    .pipe(gulp.dest('wordpress/themes/mothershipcaldonia'))
    .pipe(browserSync.stream());
});

// RECESS
gulp.task('recess', function() {
  gulp.src('wordpress/themes/mothershipcaldonia/style.css')
    .pipe(recess())
    .pipe(recess.reporter().on('error', gUtil.log));
});

// Scripts
gulp.task('scripts', function() {
  gulp.src([
    'bower_components/classie/classie.js',
    'bower_components/masonry/dist/masonry.pkgd.js',
    'wordpress/themes/mothershipcaldonia/coffee/overlay.coffee',
    'wordpress/themes/mothershipcaldonia/coffee/masonry.coffee'
  ])
    .pipe(gIf(/[.]coffee$/, coffee()).on('error', gUtil.log))
    .pipe(concat('scripts.js'))
    .pipe(uglify({preserveComments: 'some'}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('wordpress/themes/mothershipcaldonia/js'))
    .pipe(browserSync.stream());
});

// Modernizr
gulp.task('modernizr', function() {
  gulp.src([
    'wordpress/themes/mothershipcaldonia/sass/**/*.scss',
    'wordpress/themes/mothershipcaldonia/js/scripts.min.js'
  ])
    .pipe(modernizr({options: [
      'setClasses',
      'prefixed'
    ]}))
    .pipe(uglify({preserveComments: 'some'}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('wordpress/themes/mothershipcaldonia/js'));
});

// Default
gulp.task('default', [
  'browserSync',
  'rename',
  'styles',
  'scripts',
  'modernizr'
], function() {
  gulp.watch('wordpress/themes/mothershipcaldonia/sass/**/*.scss', ['styles', 'modernizr']);
  gulp.watch('wordpress/themes/mothershipcaldonia/coffee/*.coffee', ['scripts', 'modernizr']);
  gulp.watch('wordpress/**/*.php').on('change', browserSync.reload);
});
