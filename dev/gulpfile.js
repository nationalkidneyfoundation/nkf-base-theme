
// Require dependencies.
var gulp          = require('gulp');
var rework        = require('gulp-rework');
var reworkNpm     = require('rework-npm');
var reworkVars    = require('rework-vars');
var reworkMedia   = require('rework-custom-media');
var reworkCalc    = require('rework-calc');
var reworkColors  = require('rework-plugin-colors');
var reworkInherit = require('rework-inherit');
var reworkRename  = require('rework-selector-rename');
var cssAutoprefix = require('gulp-autoprefixer');
var cssMinify     = require('gulp-minify-css');
var rename        = require('gulp-rename');
var browserSync   = require('browser-sync');

// Paths
var paths = {
  homepage:           'index.html'
  , style:            'css/styles.css'
  , styles:           'css/**/*.css'
  , styleMin:         'styles.min.css'
  , stylesDistDir:    '../css'
}

// css prefix options
var cssPrefixOptions = {}

// selector rename patterns
var mutate = [
  ['Grid', 'grid']
];


// browser-sync
gulp.task('browser-sync', function() {
  browserSync({
    server: {
      baseDir: "../../../"
    }
  });
});


// build css
gulp.task('css-build', function() {
  return gulp.src(paths.style)
    .pipe(rework(
      reworkNpm()
      , reworkVars()
      , reworkMedia()
      , reworkCalc // don't need ()
      , reworkColors()
      , reworkRename(mutate)
      , reworkInherit()
    ))
    .pipe(cssAutoprefix(cssPrefixOptions))
    .pipe(gulp.dest(paths.stylesDistDir))
    .pipe(cssMinify())
    .pipe(rename(paths.styleMin))
    .pipe(gulp.dest(paths.stylesDistDir))
    .pipe(browserSync.reload({stream:true}));
});

// combine builds
gulp.task('build', ['css-build']);

// watch for changes
gulp.task('watch', function () {
  gulp.watch(paths.styles, ['css-build']);
});

// let's get started
//gulp.task('default', ['build', 'watch', 'browser-sync']);
gulp.task('default', ['build']);
