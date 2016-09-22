// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass            = require('gulp-sass');
var concat          = require('gulp-concat');
var uglify          = require('gulp-uglify');
var cssnano         = require('gulp-cssnano');
var rename          = require('gulp-rename');
var autoprefixer    = require('gulp-autoprefixer');
var plumber         = require('gulp-plumber');
var notify          = require('gulp-notify');

// Compile Our Sass
gulp.task('sass-dist', function() {
    return gulp.src('assets/source/sass/main.scss')
            .pipe(plumber({
                errorHandler: notify.onError({
                    title: 'Sass build failed',
                    message: '<%= error.message %>'
                })
            }))
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(rename({suffix: '.min'}))
            .pipe(cssnano({
                mergeLonghand: false,
                zindex: false
            }))
            .pipe(gulp.dest('assets/dist/css'));
});

gulp.task('sass-editor', function() {
    return gulp.src('assets/source/sass/editor-style.scss')
            .pipe(plumber({
                errorHandler: notify.onError({
                    title: 'Sass build failed',
                    message: '<%= error.message %>'
                })
            }))
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(cssnano({
                mergeLonghand: false,
                zindex: false
            }))
            .pipe(gulp.dest('assets/dist/css'));
});

gulp.task('sass-dev', function() {
    return gulp.src('assets/source/sass/main.scss')
            .pipe(plumber({
                errorHandler: notify.onError({
                    title: 'Sass build failed',
                    message: '<%= error.message %>'
                })
            }))
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(rename({suffix: '.dev'}))
            .pipe(gulp.dest('assets/dist/css'));
});

// Concatenate & Minify JS
gulp.task('scripts-dist', function() {
    return gulp.src('assets/source/js/**/*.js')
            .pipe(plumber({
                errorHandler: notify.onError({
                    title: 'JS build failed',
                    message: '<%= error.message %>'
                })
            }))
            .pipe(concat('app.js'))
            .pipe(gulp.dest('assets/dist/js'))
            .pipe(rename('app.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('assets/dist/js'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('assets/source/js/**/*.js', ['scripts-dist']);
    gulp.watch('assets/source/sass/**/*.scss', ['sass-dist', 'sass-dev', 'sass-editor']);
//    gulp.watch('assets/source/images/**/*', ['imagemin']);
});

// Default Task
gulp.task('default', ['sass-dist', 'sass-dev', 'sass-editor', 'scripts-dist', 'watch']);
