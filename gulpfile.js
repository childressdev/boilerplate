var gulp = require('gulp');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var order = require('gulp-order');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var cssnano = require('cssnano');

gulp.task('sass', function(){
  var processors = [
    autoprefixer,
    cssnano
  ]
  return gulp.src(['dev/scss/style.scss', 'dev/scss/editor.scss'])
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss(processors))
    .pipe(sourcemaps.write('../dev/maps'))
    .pipe(gulp.dest('wp-theme-files'))
});

gulp.task('js', function(){
  return gulp.src('dev/js/**/*.js')
    .pipe(sourcemaps.init())
    .pipe(order([
      'vendor/**/*.js',
      '9_custom-scripts.js'
    ]))
    .pipe(concat('custom-scripts.min.js'))
    .pipe(uglify({
      output: {
        comments: '/^!/'
      }
    }))
    .pipe(sourcemaps.write('../../dev/maps', {includeContent:false, sourceRoot: 'wp-theme-files'}))
    .pipe(gulp.dest('wp-theme-files/js'))
});

gulp.task('watch', function(){
  gulp.watch('dev/scss/**/*.scss', gulp.series('sass'));
  gulp.watch('dev/js/*.js', gulp.series('js'));
});

gulp.task('default', gulp.parallel(['js', 'sass', 'watch']));