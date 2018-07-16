class Config{
    constructor(){
        this.WEB= window.location.origin
        this.API= window.location.origin+'/api'
        this.API_ADM= this.API+'/admin'
        this.API_ENTERPRISE = this.API+'/enterprise'

        this.API_REQUEST_INFO = this.API+'/request-info'
        /*WEB*/

        /*WEB ADMIN*/
        this.WEB_ADMIN = this.WEB+'/admin'
        /*ADMIN ENTERPRISE MANAGE*/
        this.WEB_ADMIN_ENTERPRISE_MANAGE = this.WEB_ADMIN+'/enterprise-manage'

        this.WEB_ADMIN_ENTERPRISE_MANAGE_ADD_ENTERPRISE = this.WEB_ADMIN_ENTERPRISE_MANAGE+'/add-enterprise'
        this.WEB_ADMIN_ENTERPRISE_MANAGE_GET_EXCEL_ENTERPRISE = this.WEB_ADMIN_ENTERPRISE_MANAGE+'/get-excel-enterprise'
        this.WEB_ADMIN_ENTERPRISE_MANAGE_GET_EXCEL_EXAMPLE_ENTERPRISE = this.WEB_ADMIN_ENTERPRISE_MANAGE+'/get-excel-example-enterprise'
        this.WEB_ADMIN_ENTERPRISE_MANAGE_INFO_ENTERPRISE = this.WEB_ADMIN_ENTERPRISE_MANAGE+'/info-enterprise'
        /*ADMIN ENTERPRISE MANAGE*/
        /*ADMIN JOB*/
        this.WEB_ADMIN_JOB_MANAGE = this.WEB_ADMIN+'/job-manage'
        this.WEB_ADMIN_JOB_MANAGE_JOBS = this.WEB_ADMIN_JOB_MANAGE+'/jobs'
        this.WEB_ADMIN_JOB_MANAGE_JOBS_ID = (ID) => {return this.WEB_ADMIN_JOB_MANAGE+'/jobs/'+ID}
        this.WEB_ADMIN_JOB_MANAGE_POSITION = this.WEB_ADMIN_JOB_MANAGE+'/position'
        this.WEB_ADMIN_JOB_MANAGE_SKILL = this.WEB_ADMIN_JOB_MANAGE+'/skill'
        /*ADMIN JOB*/

        /*ADMIN NOTIFY*/

        this.WEB_ADMIN_NOTIFY_MANAGE = this.WEB_ADMIN +'/notify-manage'
        this.WEB_ADMIN_NOTIFY_MANAGE_NOTIFIES = this.WEB_ADMIN_NOTIFY_MANAGE + '/notifies'
        this.WEB_ADMIN_NOTIFY_MANAGE_UPDATE_NOTIFY = (ID) => {return this.WEB_ADMIN_NOTIFY_MANAGE + '/edit/'+ID}
        /*---ADMIN NOTIFY*/


        /*ADMIN POST COURSE*/

        this.WEB_ADMIN_POST_COURSE = (ID) => { return this.WEB_ADMIN+'/post-course/'+ID}
        this.WEB_ADMIN_POST_COURSES = this.WEB_ADMIN+'/post-courses'


        // this.

        /*ADMIN POST COURSE*/
        /*ADMIN STUDENT MANAGE*/
        this.WEB_ADMIN_STUDENT_MANAGE = this.WEB_ADMIN+'/student-manage'
        this.WEB_ADMIN_STUDENT_MANAGE_ADD_STUDENT = this.WEB_ADMIN_STUDENT_MANAGE+'/add-student'
        this.WEB_ADMIN_STUDENT_MANAGE_GET_EXECL_EXAMPLE_STUDENT = this.WEB_ADMIN_STUDENT_MANAGE+'/get-excel-example-student'
        this.WEB_ADMIN_STUDENT_MANAGE_GET_EXECL_WORK_STUDENT = this.WEB_ADMIN_STUDENT_MANAGE+'/get-excel-work-student'
        this.WEB_ADMIN_STUDENT_MANAGE_GET_EXCEL_STUDENT = this.WEB_ADMIN_STUDENT_MANAGE+'/get-excel-student'
        this.WEB_ADMIN_STUDENT_MANAGE_INFO_STUDENT = this.WEB_ADMIN_STUDENT_MANAGE+'/info-student'
        /*ADMIN STUDENT MANAGE*/

        /*WEB ADMIN*/

        /*WEB ENTERPRISE*/
        this.WEB_ENTERPRISE = this.WEB+'/enterprise'

        this.WEB_ENTERPRISE_NEW_POST = this.WEB_ENTERPRISE+'/new-post'
        this.WEB_ENTERPRISE_POST_MANAGE = this.WEB_ENTERPRISE+'/post-manage'
        this.WEB_ENTERPRISE_POST = (ID) => { return this.WEB_ENTERPRISE+'/post/'+ID}

        this.WEB_ENTERPRISE_NEW_POST_COURSE = this.WEB_ENTERPRISE+'/new-post-course'
        this.WEB_ENTERPRISE_POST_COURSE_MANAGE = this.WEB_ENTERPRISE+'/post-course-manage'
        this.WEB_ENTERPRISE_POST_COURSE = (ID) => { return this.WEB_ENTERPRISE+'/post-course/'+ID}
        /*WEB ENTERPRISE*/

        /*WEB JOB*/
        this.WEB_JOB = this.WEB+'/job'

        this.WEB_JOB_FILE = (ID) => {return this.WEB_JOB+'/file/'+ID}
        this.WEB_JOB_JOB_DETAIL = (ID) => {return this.WEB_JOB+'/job-detail/'+ID}
        this.WEB_JOB_LIST_JOB = this.WEB_JOB+'/list-job'
        /*WEB JOB*/

        /*WEB*/


      /*  API ADMIN*/
        /*STUDENT MANAGE*/
        this.API_ADMIN_STUDENT_MANAGE= this.API_ADM+'/student-manage'
        this.API_ADMIN_STUDENT_MANAGE_ADD_STUDENT_EXCEL= this.API_ADMIN_STUDENT_MANAGE+'/add-student-excel'
        this.API_ADMIN_STUDENT_MANAGE_ADD_WORK_STUDENT_EXCEL= this.API_ADMIN_STUDENT_MANAGE+'/add-work-student-excel'
        this.API_ADMIN_STUDENT_MANAGE_ADD_WORK_STUDENT= this.API_ADMIN_STUDENT_MANAGE+'/add-work-student'
        this.API_ADMIN_STUDENT_MANAGE_GET_LIST_STUDENT= this.API_ADMIN_STUDENT_MANAGE+'/get-list-student'
        this.API_ADMIN_STUDENT_MANAGE_DELETE_LIST_STUDENT= this.API_ADMIN_STUDENT_MANAGE+'/delete-list-student'
        this.API_ADMIN_STUDENT_MANAGE_DELETE_STUDENT= this.API_ADMIN_STUDENT_MANAGE+'/delete-student'
        this.API_ADMIN_STUDENT_MANAGE_ADD_STUDENT= this.API_ADMIN_STUDENT_MANAGE+'/add-student'
        this.API_ADMIN_STUDENT_MANAGE_UPDATE_STUDENT= this.API_ADMIN_STUDENT_MANAGE+'/update-student'
        this.API_ADMIN_STUDENT_MANAGE_UPDATE_AVATAR_STUDENT= this.API_ADMIN_STUDENT_MANAGE+'/update-avatar-student'
        this.API_ADMIN_STUDENT_MANAGE_GET_WORK_STUDENT= this.API_ADMIN_STUDENT_MANAGE+'/get-work-student'
        this.API_ADMIN_STUDENT_MANAGE_UPDATE_WORK_STUDENT= (ID) => {return this.API_ADMIN_STUDENT_MANAGE+'/update-work-student/' + ID}
        this.API_ADMIN_STUDENT_MANAGE_DELETE_WORK_STUDENT= (ID) => {return this.API_ADMIN_STUDENT_MANAGE+'/delete-work-student/' + ID}
        this.API_ADMIN_STUDENT_MANAGE_GET_LIST_ENTERPRISE= this.API_ADMIN_STUDENT_MANAGE+'/get-list-enterprise'
        /*STUDENT MANAGE*/

        /*ENTERPRISE MANGE*/
        this.API_ADMIN_ENTERPRISE_MANAGE= this.API_ADM+'/enterprise-manage'

        this.API_ADMIN_ENTERPRISE_MANAGE_ADD_ENTERPRISE_EXCEL= this.API_ADMIN_ENTERPRISE_MANAGE+'/add-enterprise-excel'
        this.API_ADMIN_ENTERPRISE_MANAGE_GET_LIST_ENTERPRISE= this.API_ADMIN_ENTERPRISE_MANAGE+'/get-list-enterprise'
        this.API_ADMIN_ENTERPRISE_MANAGE_DELETE_LIST_ENTERPRISE= this.API_ADMIN_ENTERPRISE_MANAGE+'/delete-list-enterprise'
        this.API_ADMIN_ENTERPRISE_MANAGE_DELETE_ENTERPRISE= this.API_ADMIN_ENTERPRISE_MANAGE+'/delete-enterprise'
        this.API_ADMIN_ENTERPRISE_MANAGE_ADD_ENTERPRISE= this.API_ADMIN_ENTERPRISE_MANAGE+'/add-enterprise'
        this.API_ADMIN_ENTERPRISE_MANAGE_UPDATE_ENTERPRISE= this.API_ADMIN_ENTERPRISE_MANAGE+'/update-enterprise'
        this.API_ADMIN_ENTERPRISE_MANAGE_UPDATE_AVATAR_ENTERPRISE= this.API_ADMIN_ENTERPRISE_MANAGE+'/update-avatar-enterprise'
        this.API_ADMIN_ENTERPRISE_MANAGE_GET_EMPLOYEE_ENTERPRISE= this.API_ADMIN_ENTERPRISE_MANAGE+'/get-employees-enterprise'
        /*ENTERPRISE MANGE*/

        /*JOB MANAGE*/
        this.API_ADMIN_JOB_MANAGE= this.API_ADM+'/job-manage'

        this.API_ADMIN_JOB_MANAGE_GET_LIST_POSITION= this.API_ADMIN_JOB_MANAGE+'/get-list-position'
        this.API_ADMIN_JOB_MANAGE_ADD_POSITION= this.API_ADMIN_JOB_MANAGE+'/add-position'
        this.API_ADMIN_JOB_MANAGE_DELETE_LIST_POSITION= this.API_ADMIN_JOB_MANAGE+'/delete-list-position'
        this.API_ADMIN_JOB_MANAGE_DELETE_POSITION= this.API_ADMIN_JOB_MANAGE+'/delete-position'
        this.API_ADMIN_JOB_MANAGE_EDIT_POSITION= this.API_ADMIN_JOB_MANAGE+'/edit-position'
        this.API_ADMIN_JOB_MANAGE_GET_LIST_SKILL= this.API_ADMIN_JOB_MANAGE+'/get-list-skill'
        this.API_ADMIN_JOB_MANAGE_ADD_SKILL= this.API_ADMIN_JOB_MANAGE+'/add-skill'
        this.API_ADMIN_JOB_MANAGE_DELETE_LIST_SKILL= this.API_ADMIN_JOB_MANAGE+'/delete-list-skill'
        this.API_ADMIN_JOB_MANAGE_DELETE_SKILL= this.API_ADMIN_JOB_MANAGE+'/delete-skill'
        this.API_ADMIN_JOB_MANAGE_EDIT_SKILL= this.API_ADMIN_JOB_MANAGE+'/edit-skill'
        this.API_ADMIN_JOB_MANAGE_GET_LIST_JOB = this.API_ADMIN_JOB_MANAGE+'/get-list-post'
        this.API_ADMIN_JOB_MANAGE_ACCEPT_POST = (ID) => {return this.API_ADMIN_JOB_MANAGE+'/accept-post/'+ID}
        this.API_ADMIN_JOB_MANAGE_GET_DETAIL_POST = (ID) => {return this.API_ADMIN_JOB_MANAGE+'/get-detail-post/'+ID}
        /*JOB MANAGE*/
        /*NOTIFY MANAGE*/

        this.API_ADMIN_NOTIFY_MANAGE = this.API_ADM +'/notify-manage'
        this.API_ADMIN_NOTIFY_MANAGE_NOTIFIES = this.API_ADMIN_NOTIFY_MANAGE + '/notifies'
        this.API_ADMIN_NOTIFY_MANAGE_GET_NOTIFY = (ID)=> { return this.API_ADMIN_NOTIFY_MANAGE + '/notify/' + ID}
        this.API_ADMIN_NOTIFY_MANAGE_UPDATE_NOTIFY = (ID)=> {return this.API_ADMIN_NOTIFY_MANAGE + '/update-notify/' + ID}
        this.API_ADMIN_NOTIFY_MANAGE_DELETE_NOTIFY = (ID) => {return this.API_ADMIN_NOTIFY_MANAGE + '/delete-notify/' + ID}
        this.API_ADMIN_NOTIFY_MANAGE_DELETE_LIST_NOTIFY = this.API_ADMIN_NOTIFY_MANAGE + '/delete-list-notify'
        this.API_ADMIN_NOTIFY_MANAGE_ADD_NOTIFY = this.API_ADMIN_NOTIFY_MANAGE+'/add-notify'
        /*NOTIFY MANAGE*/
        /*POST COURSE*/

        this.API_ADMIN_POST_COURSE_MANAGE = this.API_ADM+'/post-course-manage'
        this.API_ADMIN_POST_COURSE_MANAGE_ACCEPT_POST_COURSE = (ID) => { this.API_ADMIN_POST_COURSE_MANAGE+'/accept-post-course/'+ID }
        this.API_ADMIN_POST_COURSE_MANAGE_GET_DETAIL_POST_COURSE = (ID) => { this.API_ADMIN_POST_COURSE_MANAGE+'/get-detail-post-course/'+ID }
        this.API_ADMIN_POST_COURSE_MANAGE_GET_LIST_POST_COURSE =  this.API_ADMIN_POST_COURSE_MANAGE+'/get-list-post-course/'
        this.API_ADMIN_POST_COURSE_MANAGE_ACCEPT_POST_COURSE = (ID) => {return this.API_ADMIN_POST_COURSE_MANAGE+'/accept-post-course/'+ID}

        /*POST COURSE*/
        /*API ADMIN*/

        /*API ENTERPRISE*/

        this.API_ENTERPRISE_POST = this.API_ENTERPRISE+'/post'
        this.API_ENTERPRISE_POST_COURSE = this.API_ENTERPRISE+'/post-course'

        this.API_ENTERPRISE_OPTION_PROFILE = this.API_ENTERPRISE+'/option-profile'
        this.API_ENTERPRISE_INFO = this.API_ENTERPRISE+'/info'
        this.API_ENTERPRISE_EMPLOYEES = this.API_ENTERPRISE+'/employees'
        /*API ENTERPRISE*/

        /*API STUDENT*/

        this.API_STUDENT = this.API+'/student'
        this.API_STUDENT_OPTION_PROFILE = this.API_STUDENT+'/option-profile'
        this.API_STUDENT_INFO = this.API_STUDENT+'/info'
        this.API_STUDENT_WORKS = this.API_STUDENT+'/works'

        this.API_STUDENT_GET_LIST_ENTERPRISE = this.API_STUDENT+'/get-list-enterprise'

        this.API_STUDENT_ADD_WORK_STUDENT_EXCEL= this.API_STUDENT+'/add-work-excel'
        this.API_STUDENT_ADD_WORK_STUDENT= this.API_STUDENT+'/add-work'

        this.API_STUDENT_DELETE_WORK_STUDENT= (ID) => {return this.API_STUDENT+'/delete-work/' + ID}

        this.API_STUDENT_UPDATE_AVATAR= this.API_STUDENT+'/update-avatar'
        this.API_STUDENT_UPDATE_INFO= this.API_STUDENT+'/update-info'

        /*API STUDENT*/

        /*API JOB*/
        this.API_JOB = this.API+'/job'

        this.API_JOB_DETAIL = (ID) => { return this.API_JOB+'/detail/'+ID}
        this.API_JOB_GET_LIST_ENTERPRISE = this.API_JOB+'/get-list-enterprise'
        this.API_JOB_GET_LIST_JOB = this.API_JOB+'/get-list-job'
        this.API_JOB_GET_LIST_POSITION = this.API_JOB+'/get-list-position'
        this.API_JOB_GET_LIST_SKILL = this.API_JOB+'/get-list-skill'
        this.API_JOB_GET_LIST_TYPE_JOB = this.API_JOB+'/get-list-type-job'
        this.API_JOB_SIMILAR_JOB = this.API_JOB+'/similar-job'

        /*API JOB*/

        /*API REQUEST INFO*/
        this.API_REQUEST_INFO_GET_COURSES = this.API_REQUEST_INFO+'/get-courses'
        this.API_REQUEST_INFO_GET_DEPARTMENTS = this.API_REQUEST_INFO+'/get-departments'
        this.API_REQUEST_INFO_GET_INFO_ENTERPRISE = this.API_REQUEST_INFO+'/get-info-enterprise'
        this.API_REQUEST_INFO_GET_INFO_STUDENT = this.API_REQUEST_INFO+'/get-info-student'
        this.API_REQUEST_INFO_GET_LIST_SALARY = this.API_REQUEST_INFO+'/get-list-salary'
        this.API_REQUEST_INFO_GET_OPTION_ENTERPRISE = this.API_REQUEST_INFO+'/get-option-enterprise'
        this.API_REQUEST_INFO_GET_OPTION_STUDENT = this.API_REQUEST_INFO+'/get-option-student'
        this.API_REQUEST_INFO_CHECK_EXIST_INFO_ENTERPRISE = this.API_REQUEST_INFO+'/check-exist-info-enterprise'
        this.API_REQUEST_INFO_CHECK_EXIST_INFO_STUDENT = this.API_REQUEST_INFO+'/check-exist-info-student'
        this.API_REQUEST_INFO_GET_BRANCHES = (DEPARTMENT) => { return this.API_REQUEST_INFO+'/get-branches/'+DEPARTMENT}
        /*API REQUEST INFO*/
    }
}

export default Config