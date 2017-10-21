/**
 * Created by hyj on 2016/7/25.
 */
var gulp=require('gulp');

var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var minifycss = require("gulp-minify-css");
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var clean = require('gulp-clean');
var htmlmin = require('gulp-htmlmin');
var replace = require('gulp-replace');
var mkdirp = require('mkdirp');



var replace_softwareload_upload_folder = "D:/webrd/www/xhadmintools/softload/upload/";
var replace_install_softwareload = "/xhadmintools/softload/";
var replace_install_qrcode = "/xhadmintools/qrcode/";
var load_extension_1 = "jpg";
var load_extension_2 = "jpeg";
var load_extension_3 = "png";
var load_extension_4 = "zip";
var option = {
    buildPath_softwareload: "../www/xhadmintools/softload/",
    buildPath_qrcode: "../www/xhadmintools/qrcode/",
}
var option_html = {
    collapseWhitespace:true,
    collapseBooleanAttributes:true,
    removeComments:true,
    removeEmptyAttributes:true,
    removeStyleLinkTypeAttributes:true,
    minifyJS:true,
    minifyCSS:true
};


gulp.task('lint', function() {
    gulp.src('./js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
    gulp.src('./qrcodetool/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
    gulp.src('./softloadtool/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});
gulp.task('clean',function(){
    return gulp.src(option.buildPath_softwareload,{
        read:false
    }).pipe(clean({force:true}));
    return gulp.src(option.buildPath_qrcode,{
        read:false
    }).pipe(clean({force:true}));
})

gulp.task('sass', function() {
    gulp.src('./scss/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('./css'));
});

gulp.task("resourcecopy",function(){
//  buildPath_softwareload Part
    mkdirp.sync(option.buildPath_softwareload+"/upload/");
    gulp.src("./img/*")
        .pipe(gulp.dest(option.buildPath_softwareload+"/img/"));
    gulp.src("./resource/**/*")
        .pipe(gulp.dest(option.buildPath_softwareload+"/resource/"));
    gulp.src("./svg/**/*")
        .pipe(gulp.dest(option.buildPath_softwareload+"/svg/"));
    gulp.src("./jump.php")
        .pipe(gulp.dest(option.buildPath_softwareload+"/"));
    gulp.src("./*.ico")
        .pipe(gulp.dest(option.buildPath_softwareload+"/"));

    gulp.src("./softloadtool/admintools.php")
        .pipe(gulp.dest(option.buildPath_softwareload+"/"));
    gulp.src("./softloadtool/request.php")
        .pipe(replace(/_INSTALL_PATH_/,replace_install_softwareload))
        .pipe(gulp.dest(option.buildPath_softwareload+"/"));
    gulp.src("./softloadtool/upload.php")
        .pipe(replace(/_UPLOAD_PATH_/,replace_softwareload_upload_folder))
        .pipe(gulp.dest(option.buildPath_softwareload));

//  buildPath_qrcode Part
    mkdirp.sync(option.buildPath_qrcode+"/packages/");
    gulp.src("./img/*")
        .pipe(gulp.dest(option.buildPath_qrcode+"/img/"));
    gulp.src("./resource/**/*")
        .pipe(gulp.dest(option.buildPath_qrcode+"/resource/"));
    gulp.src("./svg/**/*")
        .pipe(gulp.dest(option.buildPath_qrcode+"/svg/"));
    gulp.src("./jump.php")
        .pipe(gulp.dest(option.buildPath_qrcode+"/"));
    gulp.src("./*.ico")
        .pipe(gulp.dest(option.buildPath_qrcode+"/"));

    gulp.src("./qrcodetool/admintools.php")
        .pipe(gulp.dest(option.buildPath_qrcode+"/"));
    gulp.src("./qrcodetool/request.php")
        .pipe(replace(/_INSTALL_PATH_/,replace_install_qrcode))
        .pipe(gulp.dest(option.buildPath_qrcode+"/"));

    //These part is just for HYJ test, can be removed in product environment.
    gulp.src("./qrcodetool/packages/**/*")
        .pipe(gulp.dest(option.buildPath_qrcode+"/packages/"));



})

gulp.task('scripts', function() {
    /*Common part, copy to 2 folders*/
    gulp.src('./js/hcu_util.js')
        .pipe(concat('hcu_util.js'))
        //.pipe(gulp.dest('./dist/js'))
        .pipe(rename('hcu_util.js'))
        .pipe(uglify())
        .pipe(gulp.dest(option.buildPath_softwareload+"/js/"));
    gulp.src('./js/login.js')
        .pipe(concat('login.js'))
        // .pipe(gulp.dest('./dist/js'))
        .pipe(rename('login.js'))
        .pipe(uglify())
        .pipe(gulp.dest(option.buildPath_softwareload+"/js/"));
    gulp.src('./js/nprogress.js')
        .pipe(concat('nprogress.js'))
        // .pipe(gulp.dest('./dist/js'))
        .pipe(rename('nprogress.js'))
        .pipe(uglify())
        .pipe(gulp.dest(option.buildPath_softwareload+"/js/"));
    gulp.src('./js/hcu_util.js')
        .pipe(concat('hcu_util.js'))
        //.pipe(gulp.dest('./dist/js'))
        .pipe(rename('hcu_util.js'))
        .pipe(uglify())
        .pipe(gulp.dest(option.buildPath_qrcode+"/js/"));
    gulp.src('./js/login.js')
        .pipe(concat('login.js'))
        // .pipe(gulp.dest('./dist/js'))
        .pipe(rename('login.js'))
        .pipe(uglify())
        .pipe(gulp.dest(option.buildPath_qrcode+"/js/"));
    gulp.src('./js/nprogress.js')
        .pipe(concat('nprogress.js'))
        .pipe(rename('nprogress.js'))
        .pipe(uglify())
        .pipe(gulp.dest(option.buildPath_qrcode+"/js/"));



    gulp.src('./css/Login.css')
        .pipe(rename('Login.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(option.buildPath_softwareload+"/css/"));
    gulp.src('./css/nprogress.css')
        .pipe(rename('nprogress.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(option.buildPath_softwareload+"/css/"));
    gulp.src('./css/scope.css')
        .pipe(rename('scope.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(option.buildPath_softwareload+"/css/"));
    gulp.src('./css/style.css')
        .pipe(rename('style.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(option.buildPath_softwareload+"/css/"));

    gulp.src('./css/Login.css')
        .pipe(rename('Login.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(option.buildPath_qrcode+"/css/"));
    gulp.src('./css/nprogress.css')
        .pipe(rename('nprogress.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(option.buildPath_qrcode+"/css/"));
    gulp.src('./css/scope.css')
        .pipe(rename('scope.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(option.buildPath_qrcode+"/css/"));
    gulp.src('./css/style.css')
        .pipe(rename('style.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(option.buildPath_qrcode+"/css/"));

    gulp.src('./Login.html')
        .pipe(htmlmin(option_html))
        .pipe(rename('login.html'))
        .pipe(gulp.dest(option.buildPath_softwareload));
    gulp.src('./LostPassword.html')
        .pipe(htmlmin(option_html))
        .pipe(gulp.dest(option.buildPath_softwareload));
    gulp.src('./scope.html')
        .pipe(htmlmin(option_html))
        .pipe(gulp.dest(option.buildPath_softwareload));
    gulp.src('./Login.html')
        .pipe(htmlmin(option_html))
        .pipe(rename('login.html'))
        .pipe(gulp.dest(option.buildPath_qrcode));
    gulp.src('./LostPassword.html')
        .pipe(htmlmin(option_html))
        .pipe(gulp.dest(option.buildPath_qrcode));
    gulp.src('./scope.html')
        .pipe(htmlmin(option_html))
        .pipe(gulp.dest(option.buildPath_qrcode));




    /*different part*/
    gulp.src('./softloadtool/js/admintools.js')
        .pipe(replace(/_INSTALL_PATH_/,replace_install_softwareload))
        .pipe(replace(/_LOAD_EXTEN_1_/,load_extension_1))
        .pipe(replace(/_LOAD_EXTEN_2_/,load_extension_2))
        .pipe(replace(/_LOAD_EXTEN_3_/,load_extension_3))
        .pipe(replace(/_LOAD_EXTEN_4_/,load_extension_4))
        .pipe(uglify())
        .pipe(gulp.dest(option.buildPath_softwareload+"/js/"));
    gulp.src('./softloadtool/admintools.html')
        .pipe(htmlmin(option_html))
        .pipe(gulp.dest(option.buildPath_softwareload));

    gulp.src('./softloadtool/filter.json')
        .pipe(gulp.dest(option.buildPath_softwareload));

    gulp.src('./qrcodetool/js/admintools.js')
        .pipe(replace(/_INSTALL_PATH_/,replace_install_qrcode))
        .pipe(uglify())
        .pipe(gulp.dest(option.buildPath_qrcode+"/js/"));
    gulp.src('./qrcodetool/admintools.html')
        .pipe(htmlmin(option_html))
        .pipe(gulp.dest(option.buildPath_qrcode));


});

gulp.task('default',['clean'], function(){
    gulp.run('lint', 'sass', 'scripts','resourcecopy');

});
