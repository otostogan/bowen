const gulp = require('gulp');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');
const rename = require("gulp-rename");
const webpack = require("webpack-stream");

const dist = "../assets/js";

gulp.task('styles', function() {
    return gulp.src("../src/scss/**/*.+(scss|sass)")
        .pipe(sass().on('error', sass.logError))
        .pipe(rename({suffix: '.min', prefix: ''}))
        .pipe(autoprefixer())
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest("../assets/css"))
});

gulp.task('watch', function() {
    gulp.watch("../src/scss/**/*.+(scss|sass|css)", gulp.parallel('styles'));
    gulp.watch("../src/js/**/*.js").on('change', gulp.parallel('scripts'));
});


gulp.task("scripts", () => {
    return gulp.src("../src/js/main.js")
                .pipe(webpack({
                    mode: 'development',
                    output: {
                        filename: 'bowen_video_gallery_scripts.js'
                    },
                    watch: false,
                    devtool: "source-map",
                    
                }))
                .pipe(gulp.dest(dist))
});
gulp.task("build-prod-js", () => {
    return gulp.src("../src/js/main.js")
                .pipe(webpack({
                    mode: 'production',
                    output: {
                        filename: 'bowen_video_gallery_scripts.js'
                    },
                    module: {
                        rules: [
                          {
                            test: /\.m?js$/,
                            exclude: /(node_modules|bower_components)/,
                            use: {
                              loader: 'babel-loader',
                              options: {
                                presets: [['@babel/preset-env', {
                                    corejs: 3,
                                    useBuiltIns: "usage"
                                }]]
                              }
                            }
                          }
                        ]
                      }
                }))
                .pipe(gulp.dest(dist));
});

gulp.task('default', gulp.parallel('watch',  'styles', 'scripts', ));