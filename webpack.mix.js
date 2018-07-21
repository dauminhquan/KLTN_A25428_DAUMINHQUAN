let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */



// --admin

// mix.js('resources/assets/js/admin/students/studentmanage/studentmanage.js', 'public/assets/js/build/pages/admin/student-manage/student-manage.js');
//
// mix.js('resources/assets/js/admin/students/addstudent/addstudent.js', 'public/assets/js/build/pages/admin/student-manage/add-student.js');
//
// mix.js('resources/assets/js/admin/students/infostudent/infostudent.js', 'public/assets/js/build/pages/admin/student-manage/info-student.js');
//

// enterprise
mix.js('resources/assets/js/admin/enterprises/index/index.js', 'public/assets/js/build/pages/admin/enterprises/index.js');

// mix.js('resources/assets/js/admin/enterprises/create/index.js', 'public/assets/js/build/pages/admin/enterprises/create.js');
//
// mix.js('resources/assets/js/admin/enterprises/edit/index.js', 'public/assets/js/build/pages/admin/enterprises/edit.js');

// //job
// mix.js('resources/assets/js/admin/jobs/positionsmanage/positionsmanage.js', 'public/assets/js/build/pages/admin/post/position.js');
//
// mix.js('resources/assets/js/admin/jobs/skillsmanage/positionsmanage.js', 'public/assets/js/build/pages/admin/post/skill.js');
//
// mix.js('resources/assets/js/admin/jobs/postsmanage/postmanage/postsmanage.js', 'public/assets/js/build/pages/admin/post/post.js');
// mix.js('resources/assets/js/admin/jobs/postsmanage/updatepost/updatepost.js', 'public/assets/js/build/pages/admin/post/update-post.js');
//
//
// mix.js('resources/assets/js/admin/notifies/notifymanage/notifymanage.js', 'public/assets/js/build/pages/admin/notify/notify.js');
// mix.js('resources/assets/js/admin/notifies/updatenotify/updatenotify.js', 'public/assets/js/build/pages/admin/notify/update-notify.js');
//
// mix.js('resources/assets/js/admin/notifies/addnotify/addnotify.js', 'public/assets/js/build/pages/admin/notify/add-notify.js');
//notify

//--notify
// !-- admin
// -- enterprise
// mix.js('resources/assets/js/enterprise/postsmanage/newpost/newpost.js', 'public/assets/js/build/pages/enterprise/post-manage/new-post.js');
//
// mix.js('resources/assets/js/enterprise/postsmanage/postsmanage/postmanage.js', 'public/assets/js/build/pages/enterprise/post-manage/post-manage.js');
//
// mix.js('resources/assets/js/enterprise/postsmanage/updatepost/updatepost.js', 'public/assets/js/build/pages/enterprise/post-manage/update-post.js');
//
//
// mix.js('resources/assets/js/enterprise/postcoursesmanage/newpostcourse/newpostcourse.js', 'public/assets/js/build/pages/enterprise/post-course-manage/new-post-course.js');
//
// mix.js('resources/assets/js/enterprise/postcoursesmanage/postcoursesmanage/postcoursemanage.js', 'public/assets/js/build/pages/enterprise/post-course-manage/post-course-manage.js');
//
// mix.js('resources/assets/js/enterprise/postcoursesmanage/updatepostcourse/updatepostcourse.js', 'public/assets/js/build/pages/enterprise/post-course-manage/update-post-course.js');
//
// mix.js('resources/assets/js/enterprise/profile/infoenterprise.js', 'public/assets/js/build/pages/enterprise/profile.js');

//!-- enterprise
//dung chung

// -- student
//
// mix.js('resources/assets/js/student/profile/profilestudent.js', 'public/assets/js/build/pages/student/profile.js');
//
// //!-- student
//
// //job
//
// mix.js('resources/assets/js/job/list_job/list_job.js', 'public/assets/js/build/pages/job/list-job/list-job.js');
//
//
// mix.js('resources/assets/js/job/list_job/job_detail.js', 'public/assets/js/build/pages/job/list-job/job-detail.js');
//
//
// //auth
// mix.js('resources/assets/js/auth/login.js', 'public/assets/js/build/pages/auth/login.js');
//
//
//
// mix.js('resources/assets/js/core.js', 'public/assets/js/core/index.js');
//
//
//
// mix.js('resources/assets/js/components/datatable', 'public/assets/js/test/datatable');

