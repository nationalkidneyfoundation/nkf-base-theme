
// Require dependencies.
var gulp          = require('gulp');
//var rework        = require('gulp-rework');
//var reworkNpm     = require('rework-npm');
//var reworkVars    = require('rework-vars');
//var reworkMedia   = require('rework-custom-media');
//var reworkCalc    = require('rework-calc');
//var reworkColors  = require('rework-plugin-colors');
//var reworkInherit = require('rework-inherit');
//var reworkRename  = require('rework-selector-rename');
var cssAutoprefix = require('gulp-autoprefixer');
var cssMinify     = require('gulp-minify-css');
var rename        = require('gulp-rename');
var sass          = require('gulp-sass');
var clean         = require('gulp-clean');
var jade          = require('gulp-jade');
var size          = require('gulp-size');
var browserSync   = require('browser-sync');
var compress      = require('compression');


// Paths
var paths = {
  index:           './templates/index.jade'
  , style:            './sass/styles.scss'
  , styles:           './sass/**/*.scss'
  , styleMin:         './styles.min.css'
  , stylesDistDir:    '../css'
  , vendorDir:        './sass/vendor'
  , normalizeSrc:     './node_modules/normalize.css/normalize.css'
  , normalizeSass:    'normalize.scss'
  //, hackPath:         '../nkf-ts-donation/profiles/kidneys_distro//themes/custom/nkf_base/css'
}

// css prefix options
var cssPrefixOptions = {}

// scripts run on npm's postinstall, see package.json
/*gulp.task('postinstall', shell.task([
  'find node_modules/ -name "*.info" -type f -delete' // needed for pantheon
  , 'mv ./node_modules/normalize.css/normalize.css ./sass/vendor/normalize.scss'
]))*/

// scripts run on npm's postinstall, see package.json
gulp.task('postinstall', ['move-normalize', 'remove-info-files']);

gulp.task('move-normalize', function() {
  return gulp.src(paths.normalizeSrc)
    .pipe(rename(paths.normalizeSass))
    .pipe(gulp.dest(paths.vendorDir))
});


gulp.task('remove-info-files', function () {
  return gulp.src('./node_modules/**/*.info', {read: false})
    .pipe(clean());
});

// browser-sync
gulp.task('browser-sync', function() {
  browserSync({
    server: {
      baseDir: "./",
      middleware: [compress()]
    }
  });
});

gulp.task('browser-reload', function () {
  browserSync.reload();
});

gulp.task('css-build', function () {
  gulp.src(paths.style)
    .pipe(sass({errLogToConsole: true}))
    .pipe(cssAutoprefix(cssPrefixOptions))
    .pipe(size({gzip: false, showFiles: true, title:'Raw css'}))
    .pipe(size({gzip: true, showFiles: true, title:'Raw gzipped css'}))
    .pipe(gulp.dest(paths.stylesDistDir))
    .pipe(cssMinify())
    .pipe(rename(paths.styleMin))
    .pipe(size({gzip: false, showFiles: true, title:'Min css'}))
    .pipe(size({gzip: true, showFiles: true, title:'Min gzipped css'}))
    .pipe(gulp.dest(paths.stylesDistDir))
    //.pipe(gulp.dest(paths.hackPath))
    //.pipe(browserSync.reload({stream:true}))
    ;
});

gulp.task('html-build', function () {
  gulp.src(paths.index)
    .pipe(jade())
    .pipe(gulp.dest('./'))
    .pipe(browserSync.reload({stream:true}))
    ;
});


// combine builds
gulp.task('build', ['css-build', 'html-build']);

// watch for changes
gulp.task('watch', function () {
  gulp.watch(paths.styles, ['css-build']);
  gulp.watch(paths.index, ['html-build']);
});

// let's get started
//gulp.task('default', ['build', 'watch', 'browser-sync']);
gulp.task('default', ['build', 'watch']);
