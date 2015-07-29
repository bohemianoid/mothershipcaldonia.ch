gulp         = require('gulp')
gUtil        = require('gulp-util')
gIf          = require('gulp-if')
browserSync  = require('browser-sync').create()
rename       = require('gulp-rename')
sass         = require('gulp-sass')
autoprefixer = require('gulp-autoprefixer')
csso         = require('gulp-csso')
recess       = require('gulp-recess')
coffee       = require('gulp-coffee')
concat       = require('gulp-concat')
uglify       = require('gulp-uglify')
modernizr    = require('gulp-modernizr')

# Broswersync
gulp.task 'browserSync', ->
  browserSync.init
    proxy: "localhost:8080"
    open:  false

# Rename
gulp.task 'rename', ->
  gulp.src 'bower_components/normalize.css/normalize.css'
    .pipe rename '_normalize.scss'
    .pipe gulp.dest 'wordpress/themes/mothershipcaldonia/sass/base'

# Styles
gulp.task 'styles', ->
  gulp.src 'wordpress/themes/mothershipcaldonia/sass/**/*.scss'
    .pipe sass
      precision: 1
    .on 'error', sass.logError
    .pipe autoprefixer()
    .pipe csso()
    .pipe gulp.dest 'wordpress/themes/mothershipcaldonia'
    .pipe browserSync.stream()

# RECESS
gulp.task 'recess', ->
  gulp.src 'wordpress/themes/mothershipcaldonia/style.css'
    .pipe recess
      noOverqualifying: false
      noUnderscores:    false
    .pipe recess.reporter()

# Scripts
gulp.task 'scripts', ->
  gulp.src [
    'bower_components/classie/classie.js'
    'bower_components/masonry/dist/masonry.pkgd.js'
    'wordpress/themes/mothershipcaldonia/coffee/overlay.coffee'
    'wordpress/themes/mothershipcaldonia/coffee/masonry.coffee'
  ]
    .pipe gIf /[.]coffee$/, coffee()
    .on 'error', gUtil.log
    .pipe concat 'scripts.js'
    .pipe uglify
      preserveComments: 'some'
    .pipe rename
      suffix: '.min'
    .pipe gulp.dest 'wordpress/themes/mothershipcaldonia/js'
    .pipe browserSync.stream()

# Modernizr
gulp.task 'modernizr', ->
  gulp.src [
    'wordpress/themes/mothershipcaldonia/sass/**/*.scss'
    'wordpress/themes/mothershipcaldonia/js/scripts.min.js'
  ]
    .pipe modernizr
      options: [
        'setClasses',
        'prefixed'
      ]
    .pipe uglify
      preserveComments: 'some'
    .pipe rename
      suffix: '.min'
    .pipe gulp.dest 'wordpress/themes/mothershipcaldonia/js'

# Default
gulp.task 'default', [
  'browserSync'
  'rename'
  'styles'
  'scripts'
  'modernizr'
], ->
  gulp.watch 'wordpress/themes/mothershipcaldonia/sass/**/*.scss', ['styles', 'modernizr']
  gulp.watch 'wordpress/themes/mothershipcaldonia/coffee/*.coffee', ['scripts', 'modernizr']
  gulp.watch 'wordpress/**/*.php'
    .on 'change', browserSync.reload
