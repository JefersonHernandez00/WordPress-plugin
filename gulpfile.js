const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');


// Compile SASS files to CSS
gulp.task('sass', function () {
    return gulp.src('scss/**/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('app/css'));
});

// Watch for changes in SASS files and compile them to CSS
gulp.task('watch', function () {
    gulp.watch('sass/**/*.scss', gulp.series('sass'));
});


// Concatenate and minify all CSS files in app/css
gulp.task('combine-minimize-css', function () {
    return gulp.src('app/css/*.css')
        .pipe(concat('products-public.css'))
        .pipe(cleanCSS())
        .pipe(gulp.dest('plugin/public/css'));
});

// Concatenate and minify all JavaScript files in app/js
gulp.task('combine-minimize-js', function () {
    return gulp.src('app/js/*.js')
        .pipe(concat('products-public.js'))
        .pipe(uglify())
        .pipe(gulp.dest('plugin/public/js'));
});