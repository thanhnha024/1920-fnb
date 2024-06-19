"use strict";

const nameFolderTheme = "zippy-child";
const gulp = require("gulp");
const destFolder = "src/wp-content/themes/" + nameFolderTheme + "/assets/main";

//SCSS minify
const sass = require("gulp-sass");
const concat = require("gulp-concat");
const autoprefixer = require('gulp-autoprefixer');
const sassFolder = [
  "src/wp-content/themes/" + nameFolderTheme + "/assets/lib/**/*.css",
  "src/wp-content/themes/" + nameFolderTheme + "/**/*.scss",
  "src/wp-content/themes/" + nameFolderTheme + "/site-structure/general/main.scss",
];

gulp.task("sass", function () {
  // 1. where is my scss file
  return (
    gulp
      .src(sassFolder)
      // 2. pass that file through sass compiler
      .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
      .pipe(concat("main.css"))
      .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
      // 3. Autoprefix css for cross browser compatibility
      .pipe(autoprefixer())
      // 4. where do I save the compiled css
      .pipe(gulp.dest(destFolder))
  );
});

//JS minify
const order = require("gulp-order");
const sourcemaps = require("gulp-sourcemaps");
const babel = require("gulp-babel");
const uglify = require("gulp-uglify");
const remember = require("gulp-remember");
const cached = require("gulp-cached");
const eslint = require("gulp-eslint");
const jsFolder = [
  "src/wp-content/themes/" + nameFolderTheme + "/assets/lib/**/*.js",
  "src/wp-content/themes/" + nameFolderTheme + "/site-structure/**/*.js",
];

gulp.task("js", function () {
  return gulp
    .src(jsFolder)
    .pipe(
      order([
        "slick/*.js",
        "gsap/*.js",
        "counter/*.js",
        "bootstrap/*.js",
        "**/main.js",
        // "**/*.js"
      ])
    )
    .pipe(
      eslint({
        rules: {
          camelcase: 1,
          "comma-dangle": 2,
          quotes: 0,
        },
        globals: ["jQuery", "$"],
        envs: ["browser"],
      })
    )
    .pipe(cached("babel is fun"))
    .pipe(babel())
    .pipe(remember("babel is fun"))
    .pipe(concat("main.js"))
    .pipe(uglify())
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(destFolder));
});

gulp.task(
  "watch",
  gulp.series(function () {
    gulp.watch(sassFolder, gulp.series("sass"));
    gulp.watch(jsFolder, gulp.series("js"));
  })
);

gulp.task("default", gulp.series("watch"));
