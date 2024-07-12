const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();

// Используем динамический импорт для gulp-autoprefixer
async function css_style(done) {
    const autoprefixer = await import('gulp-autoprefixer');

    gulp.src('./resources/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            errorLogToConsole: true,
            outputStyle: 'compressed'
        }))
        .on('error', console.error.bind(console))
        .pipe(autoprefixer.default({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./resources/css/'))
        .pipe(browserSync.stream());

    done();
}

function browserReload(done){
    browserSync.reload();
    done();
}

function watchFiles(){
    gulp.watch("./resources/scss/**/*", css_style);
    gulp.watch("./**/*.html", browserReload);
    gulp.watch("./**/*.js", browserReload);
    gulp.watch("./**/*.php", browserReload);
}

function sync(done){
    browserSync.init({
        server: {
            baseDir: "./",
        },
        port: 3000
    });
    done();
}

gulp.task('default', gulp.parallel(sync, watchFiles));