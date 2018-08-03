let mix = require('laravel-mix');


mix.sass('resources/assets/sass/app.scss','public/css/common.css')

//common
mix.js('resources/assets/js/core/app.js', 'public/assets/js/common.js');
//admin
// enterprise
mix.js('resources/assets/js/admin/enterprises/index/index.js', 'public/assets/js/build/pages/admin/enterprises/index.js');
mix.js('resources/assets/js/admin/enterprises/create/index.js', 'public/assets/js/build/pages/admin/enterprises/create.js');
mix.js('resources/assets/js/admin/enterprises/edit/index.js', 'public/assets/js/build/pages/admin/enterprises/edit.js');
//student
mix.js('resources/assets/js/admin/students/index/index.js', 'public/assets/js/build/pages/admin/students/index.js');
mix.js('resources/assets/js/admin/students/create/index.js', 'public/assets/js/build/pages/admin/students/create.js');
mix.js('resources/assets/js/admin/students/edit/index.js', 'public/assets/js/build/pages/admin/students/edit.js');

// //job
mix.js('resources/assets/js/admin/jobs/index/index.js', 'public/assets/js/build/pages/admin/jobs/index.js');
mix.js('resources/assets/js/admin/jobs/edit/index.js', 'public/assets/js/build/pages/admin/jobs/edit.js');
//
mix.js('resources/assets/js/admin/positions/index/index.js', 'public/assets/js/build/pages/admin/positions/index.js');
mix.js('resources/assets/js/admin/skills/index/index.js', 'public/assets/js/build/pages/admin/skills/index.js');
mix.js('resources/assets/js/admin/types/index/index.js', 'public/assets/js/build/pages/admin/types/index.js');
mix.js('resources/assets/js/admin/salaries/index/index.js', 'public/assets/js/build/pages/admin/salaries/index.js');
mix.js('resources/assets/js/admin/ratings/index/index.js', 'public/assets/js/build/pages/admin/ratings/index.js');
mix.js('resources/assets/js/admin/ranks/index/index.js', 'public/assets/js/build/pages/admin/ranks/index.js');
mix.js('resources/assets/js/admin/departments/index/index.js', 'public/assets/js/build/pages/admin/departments/index.js');
mix.js('resources/assets/js/admin/branches/index/index.js', 'public/assets/js/build/pages/admin/branches/index.js');
//notifies
mix.js('resources/assets/js/admin/notifies/index/index.js', 'public/assets/js/build/pages/admin/notifies/index.js');
mix.js('resources/assets/js/admin/notifies/create/index.js', 'public/assets/js/build/pages/admin/notifies/create.js');
mix.js('resources/assets/js/admin/notifies/edit/index.js', 'public/assets/js/build/pages/admin/notifies/edit.js');

//admin

mix.js('resources/assets/js/enterprise/jobs/index/index.js', 'public/assets/js/build/pages/enterprise/jobs/index.js');
mix.js('resources/assets/js/enterprise/jobs/edit/index.js', 'public/assets/js/build/pages/enterprise/jobs/edit.js');
mix.js('resources/assets/js/enterprise/jobs/create/index.js', 'public/assets/js/build/pages/enterprise/jobs/create.js');
//enterprise


//enterprise
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
mix.js('resources/assets/js/auth/login.js', 'public/assets/js/build/pages/auth/login.js');
//
//
//
// mix.js('resources/assets/js/core.js', 'public/assets/js/core/index.js');
//
//
//
// mix.js('resources/assets/js/components/datatable', 'public/assets/js/test/datatable');



mix.copyDirectory('resources/assets/images', 'public/assets/images');
mix.copyDirectory('resources/plugin', 'public/assets/js/plugins');