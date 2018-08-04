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
mix.js('resources/assets/js/admin/provinces/index/index.js', 'public/assets/js/build/pages/admin/provinces/index.js');
mix.js('resources/assets/js/admin/works/index.js', 'public/assets/js/build/pages/admin/works/index.js');
//notifies
mix.js('resources/assets/js/admin/notifies/index/index.js', 'public/assets/js/build/pages/admin/notifies/index.js');
mix.js('resources/assets/js/admin/notifies/create/index.js', 'public/assets/js/build/pages/admin/notifies/create.js');
mix.js('resources/assets/js/admin/notifies/edit/index.js', 'public/assets/js/build/pages/admin/notifies/edit.js');


//event
mix.js('resources/assets/js/admin/events/index/index.js', 'public/assets/js/build/pages/admin/events/index.js');
mix.js('resources/assets/js/admin/events/edit/index.js', 'public/assets/js/build/pages/admin/events/edit.js');


//admin

mix.js('resources/assets/js/enterprise/jobs/index/index.js', 'public/assets/js/build/pages/enterprise/jobs/index.js');
mix.js('resources/assets/js/enterprise/jobs/edit/index.js', 'public/assets/js/build/pages/enterprise/jobs/edit.js');
mix.js('resources/assets/js/enterprise/jobs/create/index.js', 'public/assets/js/build/pages/enterprise/jobs/create.js');
mix.js('resources/assets/js/enterprise/profile/index.js', 'public/assets/js/build/pages/enterprise/profile/index.js');

//enterprise

//student
mix.js('resources/assets/js/student/profile/index.js', 'public/assets/js/build/pages/student/profile/index.js');



// //auth
mix.js('resources/assets/js/auth/login.js', 'public/assets/js/build/pages/auth/login.js');


mix.copyDirectory('resources/assets/images', 'public/assets/images');
mix.copyDirectory('resources/plugin', 'public/assets/js/plugins');