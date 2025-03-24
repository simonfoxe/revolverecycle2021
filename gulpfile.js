/**
 * gulpfile.js
 *
 * Gulp is a preprocessing toolkit.a1
 * https://gulpjs.com/docs/en/getting-started
 * Write javascript - automate front-end processes
 *
 */
// Load settings
const pkg          = require('./package.json');

// Load plugins
const autoprefixer = require("autoprefixer");
const cssnano      = require("cssnano");
const del          = require("del");
const fs           = require('fs');
const yargs        = require('yargs/yargs')
const { hideBin }  = require('yargs/helpers')
const argv         = yargs(hideBin(process.argv)).argv
const gulp         = require("gulp");
const addsrc       = require('gulp-add-src');
const tap          = require('gulp-tap');
const babel        = require('gulp-babel');
const bump         = require('gulp-bump');
const gulpif       = require('gulp-if');
const gulpFn       = require('gulp-fn');
const header       = require('gulp-header');
const plumber      = require("gulp-plumber");
const postcss      = require("gulp-postcss");
const rename       = require("gulp-rename");
const replace      = require('gulp-replace');
const sass         = require('gulp-sass')(require('sass'));
const uglify       = require("gulp-uglify");
const concat       = require("gulp-concat");
const sourcemaps   = require('gulp-sourcemaps');
const jsonSass     = require('gulp-json-sass');
const notify       = require("gulp-notify");

// Error handling
function swallowError(error) {
  console.log(error.toString())
  this.emit('end')
}


// Debug
var debug = argv.debug || false;
debug = (debug === 'true') ? true : false;
function enable_debug(cb) {
  debug = true;
  cb();
}


// Paths and watch globs
var watch = {
  scss : ['./source/scss/**/*.scss'],
  js   : ['./source/js/**/*.js'],
  libs : ['./source/libs/**/*.js'],
  json : ['./source/json/**/*.json'],
}
var assets = {
  src: {
    scss : ['./source/scss/'],
    js   : ['./source/js/'],
    libs : ['./source/libs/'],
    json : ['./source/json/'],
  },
  clean: {
    css  : ['./assets/css/**/*.css', './assets/css/**/*.map'],
    js   : ['./assets/js/**/*.js'],
    libs : ['./assets/libs/**/*.js'],
    json : ['./assets/json/**/*.json'],
  },
  dest: {
    css  : "./assets/css/",
    js   : "./assets/js/",
    libs : "./assets/libs/",
    json : "./assets/json/"
  }
};
var lib = {
  directories: [
    "bootstrap",
    "aos"
  ],
  src  : "./node_modules/",
  dest : "./lib/"
}


/**
 * Libs
 * Manage bringing required libraries from NPM packages into the project
 */
function process_libs() {
  var lib_directories = [];
  for (var i = 0; i < lib.directories.length; i++) {
    lib_directories.push(lib.src + lib.directories[i] + "/**");
  }
  return gulp.src(lib_directories, {base: './node_modules/'})
    .pipe(plumber())
    .pipe(gulp.dest(lib.dest));
}
function clean_libs() {
  var lib_directories = [];
  for (var i = 0; i < lib.directories.length; i++) {
    lib_directories.push(lib.dest + lib.directories[i]);
  }
  return del(lib_directories);
}


/**
 * Assets Clean
 */

// Delete contents of css, js and libs assets folders
function assets_clean() {
  return del( [].concat(assets.clean.css, assets.clean.js, assets.clean.libs) );
}


/**
 * Stylesheets
 */

// CSS task
function process_css() {
  return gulp
    .src(`${assets.src.scss}/*.scss`)
    .pipe(tap(function(file, t) {
      return gulp
        .src([
          `${assets.src.json}/brand-colors.json`,
          `${assets.src.json}/bootstrap.json`
        ],{ allowEmpty: true })
        // Error catching
        .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
        // JSON Sass Parse
        .pipe(jsonSass({
          sass: false
        }))
        .pipe(addsrc.append([file.path]))
        //combine the files
        .pipe(concat(file.basename))
        .pipe(sass({
          style: 'expanded',
          includePaths: [`${assets.src.scss}`],
          errLogToConsole: false,
          onError: function(err) {
            return notify().write(err);
          }
        }))
        .pipe(postcss([autoprefixer()]))
        .pipe(gulpif(debug, gulp.dest(assets.dest.css)))
        .pipe(rename({ suffix: ".min" }))
        .pipe(postcss([cssnano()]))
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest(assets.dest.css));
    }));
}


// JS Libraries
// We have three separate libs areas now - head / async / defer, which will each be enqueued differently.
function process_jslibs() {
  // Async - request done async but processing before body
  gulp
    .src([`${assets.src.libs}/async/**/*.js`])
    .pipe(concat('libs-async.js'))
    .pipe(gulpif(debug, gulp.dest(assets.dest.libs)))
    .pipe(rename({ suffix: '.min' }))
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest(assets.dest.libs));

  // Defer - move script request and processing to after DOM loaded
  gulp
    .src([`${assets.src.libs}/defer/**/*.js`])
    .pipe(concat('libs-defer.js'))
    .pipe(gulpif(debug, gulp.dest(assets.dest.libs)))
    .pipe(rename({ suffix: '.min' }))
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest(assets.dest.libs))

  // Head - Render blocking <head> scripts
  return (
    gulp
      .src([`${assets.src.libs}/head/**/*.js`])
      .pipe(concat('libs-head.js'))
      .pipe(gulpif(debug, gulp.dest(assets.dest.libs)))
      .pipe(rename({ suffix: '.min' }))
      .pipe(plumber())
      .pipe(uglify())
      .pipe(gulp.dest(assets.dest.libs))
  );
}


// Transpile, concatenate and minify scripts
function process_js() {

  // Independant scripts
  gulp
    .src([`${assets.src.js}/independant/**/*.js`])
    .pipe(plumber())
    .pipe(babel({presets: ['@babel/env']}))
    .pipe(gulpif(debug, gulp.dest(`${assets.dest.js}/independant/`)))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest(`${assets.dest.js}/independant/`));

  // Admin - Scripts loaded for WordPress admin only
  gulp
    .src([`${assets.src.js}/admin/**/*.js`])
    .pipe(concat('scripts-admin.js'))
    .pipe(plumber())
    .pipe(babel({presets: ['@babel/env']}))
    .pipe(gulpif(debug, gulp.dest(assets.dest.js)))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest(assets.dest.js));

  // Async - request done async but processing before body
  gulp
    .src([`${assets.src.js}/async/**/*.js`])
    .pipe(concat('scripts-async.js'))
    .pipe(plumber())
    .pipe(babel({presets: ['@babel/env']}))
    .pipe(gulpif(debug, gulp.dest(assets.dest.js)))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest(assets.dest.js));

  // Defer - move script request and processing to after DOM loaded
  gulp
    .src([`${assets.src.js}/defer/**/*.js`])
    .pipe(concat('scripts-defer.js'))
    .pipe(plumber())
    .pipe(babel({presets: ['@babel/env']}))
    .pipe(gulpif(debug, gulp.dest(assets.dest.js)))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest(assets.dest.js))

  // Head - Render blocking <head> scripts
  return (
    gulp
      .src([`${assets.src.js}/head/**/*.js`])
      .pipe(concat('scripts-head.js'))
      .pipe(plumber())
      .pipe(babel({presets: ['@babel/env']}))
      .pipe(gulpif(debug, gulp.dest(assets.dest.js)))
      .pipe(rename({ suffix: '.min' }))
      .pipe(uglify())
      .pipe(gulp.dest(assets.dest.js))
  );
}


/**
 * -------------------------------------------------------
 * GitHub version bumping, committing, tagging & releasing
 *
 */

// Get the version of this project from package.json
function getPackageJsonVersion () {
  // We parse the json file instead of using require because require caches
  // multiple calls so the version number won't be updated
  return JSON.parse(fs.readFileSync('./package.json', 'utf8')).version;
};

// Update the WordPress style.css with the latest version from package.json
function wpversion(done) {
  // Load the Package JSON master file
  let package = JSON.parse(fs.readFileSync('./package.json', 'utf-8'));

  /*
  // Theme.json
  // Not needed at this time - the version in JSON is not the theme version.
  var theme_json_filename = 'theme.json';
  if (fs.existsSync(theme_json_filename)) {
    let theme_json = JSON.parse(fs.readFileSync(theme_json_filename, 'utf-8'));
    theme_json.version = package.version;
    fs.writeFile(theme_json_filename, JSON.stringify(theme_json, null, 2), 'utf8', function (err) {
      if (err) {
        console.log("An error occured while writing theme.json.");
        return console.log(err);
      }
      //console.log("Theme.json updated.");
    });
  } else {
    console.log('WordPress theme.json does not exist, skipping');
  }
  */

  // Style.css
  let regex_firstcomment = /\/\*[^*]*\*+([^\/*][^*]*\*+)*\//;
  let theme_banner = [
    '/*!',
    ` * Theme Name: ${package.wordpress.theme_name || package.name}`,
    (package.description) ? ` * Description: ${package.description}` : null,
    (package.author) ? ` * Author: ${package.author}` : null,
    (package.author_url) ? ` * Author URI: ${package.author_url}` : null,
    ` * Version: ${package.version}`,
    (package.license) ? ` * License: ${package.license}` : null,
    (package.license_url) ? ` * License URI: ${package.license_url}` : null,
    (package.wordpress.requires_php) ? ` * Requires PHP: ${package.wordpress.requires_php}` : null,
    (package.wordpress.requires_wordpress) ? ` * Requires at least: ${package.wordpress.requires_wordpress}` : null,
    (package.wordpress.template) ? ` * Template: ${package.wordpress.template}` : null,
    (package.wordpress.tested_wordpress) ? ` * Tested up to: ${package.wordpress.tested_wordpress}` : null,
    (package.wordpress.tags) ? ` * Tags: ${package.wordpress.tags}` : null,
    (package.wordpress.text_domain) ? ` * Text Domain: ${package.wordpress.text_domain}` : null,
    ' *',
    ' * Note: This theme uses SASS. Please do not add CSS styles to this file.',
    ' */',
    ''
  ].filter(function (el) {
    return el != null;
  }).join("\n");
  return gulp
    .src('./style.css')
    .pipe(replace(regex_firstcomment, ""))
    .pipe(header(theme_banner))
    .pipe(gulp.dest('./'));
}
wpversion.description = "Update the WordPress style.css from the package.json";
exports.wpversion = wpversion;

// Increment the version in package.json
function bump_version(importance) {
  return gulp.src(['./package.json'])
    // bump the version number in those files
    .pipe(bump({type: importance}).on('error', swallowError))
    // save it back to filesystem
    .pipe(gulp.dest('./'))
    // Execute any followup tasks
    .pipe(gulpFn(function(file, enc) {
      // Update the WordPress style.css banner
      wpversion();
    }));
}
function bump_patch() { return bump_version('patch'); }
bump_patch.description = "Increment the patch version of the project 0.0.X";
function bump_minor() { return bump_version('minor'); }
bump_minor.description = "Increment the minor version of the project 0.X.0";
function bump_major() { return bump_version('major'); }
bump_major.description = "Increment the major version of the project X.0.0";


/**
 * Gulp Processes
 */


// Watch files
function watchFiles() {
  gulp.watch(watch.scss, process_css);
  gulp.watch(watch.libs, process_jslibs);
  gulp.watch(watch.js, process_js);
  gulp.watch(watch.json, gulp.parallel(process_css, process_js));
}


// Combo processes
const process_watch = gulp.parallel(watchFiles);
const process_build = gulp.series(assets_clean, gulp.parallel(process_css, process_jslibs, process_js));
const process_build_debug = gulp.series(enable_debug, assets_clean, gulp.parallel(process_css, process_jslibs, process_js));


// Export tasks
exports.clean = assets_clean;
exports.css = process_css;
exports.js = process_js;
exports.jslibs = process_jslibs;
exports.libs = gulp.series(clean_libs, process_libs);
exports.build = process_build;
exports.build_debug = process_build_debug;
exports.watch = process_watch;
exports.default = process_watch;
module.exports['bump-patch'] = bump_patch;
module.exports['bump-minor'] = bump_minor;
module.exports['bump-major'] = bump_major;
module.exports['bump'] = gulp.series(module.exports['bump-patch']);