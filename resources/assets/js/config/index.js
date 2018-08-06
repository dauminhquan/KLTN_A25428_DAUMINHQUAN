import PNotify from 'pnotify/dist/es/PNotifyCompat'
class Config{
    constructor(){
        /*API*/

        this.API = window.location.origin+'/api'

        /*ADMIN*/

        this.API_ADMIN = this.API+'/admin'

        /*ENTERPRISES*/
        this.API_ADMIN_ENTERPRISES = this.API_ADMIN+'/manage-enterprises'
        this.API_ADMIN_ENTERPRISES_RESOURCE = this.API_ADMIN_ENTERPRISES+'/resource'
        this.API_ADMIN_ENTERPRISES_RESOURCE_ID_USER = (ID) => {return this.API_ADMIN_ENTERPRISES_RESOURCE+'/'+ID+'/user'}
        this.API_ADMIN_ENTERPRISES_DELETE_LIST = this.API_ADMIN_ENTERPRISES+'/delete-list'
        this.API_ADMIN_ENTERPRISES_UPDATE_AVATAR = this.API_ADMIN_ENTERPRISES+'/update-avatar'
        this.API_ADMIN_ENTERPRISES_LIST_WORK_ID = (ID) => {return this.API_ADMIN_ENTERPRISES+'/list-work'+'/'+ID}
        this.API_ADMIN_ENTERPRISES_IMPORT_CSV = this.API_ADMIN_ENTERPRISES+'/import-csv'
        this.API_ADMIN_ENTERPRISES_LIST_TASK_ID = (ID) => {return this.API_ADMIN_ENTERPRISES+'/list-task'+'/'+ID}
        this.API_ADMIN_ENTERPRISES_GET_OPTION_CSV = (ID) => this.API_ADMIN_ENTERPRISES+'/get-option-csv'
        /*ENTERPRISES*/


        /*STUDENTS*/
        this.API_ADMIN_STUDENTS = this.API_ADMIN+'/manage-students'
        this.API_ADMIN_STUDENTS_RESOURCE = this.API_ADMIN_STUDENTS+'/resource'
        this.API_ADMIN_STUDENTS_RESOURCE_ID_USER = (ID) => {return this.API_ADMIN_STUDENTS_RESOURCE+'/'+ID+'/user'}
        this.API_ADMIN_STUDENTS_DELETE_LIST = this.API_ADMIN_STUDENTS+'/delete-list'
        this.API_ADMIN_STUDENTS_UPDATE_AVATAR = this.API_ADMIN_STUDENTS+'/update-avatar'
        this.API_ADMIN_STUDENTS_LIST_WORK_ID = (ID) => {return this.API_ADMIN_STUDENTS+'/list-work'+'/'+ID}
        this.API_ADMIN_STUDENTS_IMPORT_CSV = this.API_ADMIN_STUDENTS+'/import-csv'
        this.API_ADMIN_STUDENTS_LIST_TASK_ID = (ID) => {return this.API_ADMIN_STUDENTS+'/list-task'+'/'+ID}
        this.API_ADMIN_STUDENTS_GET_OPTION_CSV = (ID) => this.API_ADMIN_STUDENTS+'/get-option-csv'
        /*STUDENTS*/
        
        /*TASKS*/
        this.API_ADMIN_TASKS = this.API_ADMIN+'/manage-tasks'
        this.API_ADMIN_TASKS_RESOURCE = this.API_ADMIN_TASKS+'/resource'
        this.API_ADMIN_TASKS_UPDATE_FILE_ATTACH = this.API_ADMIN_TASKS+'/update-file-attach'
        this.API_ADMIN_TASKS_DELETE_LIST = this.API_ADMIN_TASKS+'/delete-list'
        this.API_ADMIN_TASKS_GET_OPTION_CSV = (ID) => this.API_ADMIN_TASKS+'/get-option-csv'
        /*TASKS*/


        /*WORKS*/
        this.API_ADMIN_WORKS = this.API_ADMIN+'/manage-works'
        this.API_ADMIN_WORKS_RESOURCE = this.API_ADMIN_WORKS+'/resource'
        this.API_ADMIN_WORKS_UPDATE_FILE_ATTACH = this.API_ADMIN_WORKS+'/update-file-attach'
        this.API_ADMIN_WORKS_DELETE_LIST = this.API_ADMIN_WORKS+'/delete-list'
        this.API_ADMIN_WORKS_IMPORT_CSV = this.API_ADMIN_WORKS+'/import-csv'
        this.API_ADMIN_WORKS_GET_OPTION_CSV = (ID) => this.API_ADMIN_WORKS+'/get-option-csv'
        /*WORKS*/

        this.API_ADMIN_TYPES = this.API_ADMIN+'/manage-types'
        this.API_ADMIN_TYPES_RESOURCE = this.API_ADMIN_TYPES+'/resource'
        this.API_ADMIN_TYPES_DELETE_LIST = this.API_ADMIN_TYPES+'/delete-list'

        this.API_ADMIN_SKILLS = this.API_ADMIN+'/manage-skills'
        this.API_ADMIN_SKILLS_RESOURCE = this.API_ADMIN_SKILLS+'/resource'
        this.API_ADMIN_SKILLS_DELETE_LIST = this.API_ADMIN_SKILLS+'/delete-list'

        this.API_ADMIN_EVENTS = this.API_ADMIN+'/manage-events'
        this.API_ADMIN_EVENTS_RESOURCE = this.API_ADMIN_EVENTS+'/resource'
        this.API_ADMIN_EVENTS_DELETE_LIST = this.API_ADMIN_EVENTS+'/delete-list'

        this.API_ADMIN_EVENT_STUDENT = this.API_ADMIN+'/manage-event-student'
        this.API_ADMIN_EVENT_STUDENT_RESOURCE = this.API_ADMIN_EVENT_STUDENT+'/resource'
        this.API_ADMIN_EVENT_STUDENT_DELETE_LIST = this.API_ADMIN_EVENT_STUDENT+'/delete-list'
        this.API_ADMIN_EVENT_STUDENT_IMPORT_CSV = this.API_ADMIN_EVENT_STUDENT+'/import-csv'
        this.API_ADMIN_EVENT_STUDENT_UPDATE_CSV = this.API_ADMIN_EVENT_STUDENT+'/update-csv'


        this.API_ADMIN_POSITIONS = this.API_ADMIN+'/manage-positions'
        this.API_ADMIN_POSITIONS_RESOURCE = this.API_ADMIN_POSITIONS+'/resource'
        this.API_ADMIN_POSITIONS_DELETE_LIST = this.API_ADMIN_POSITIONS+'/delete-list'

        this.API_ADMIN_SALARIES = this.API_ADMIN+'/manage-salaries'
        this.API_ADMIN_SALARIES_RESOURCE = this.API_ADMIN_SALARIES+'/resource'
        this.API_ADMIN_SALARIES_DELETE_LIST = this.API_ADMIN_SALARIES+'/delete-list'

        this.API_ADMIN_PROVINCES = this.API_ADMIN+'/manage-provinces'
        this.API_ADMIN_PROVINCES_RESOURCE = this.API_ADMIN_PROVINCES+'/resource'
        this.API_ADMIN_PROVINCES_DELETE_LIST = this.API_ADMIN_PROVINCES+'/delete-list'
        this.API_ADMIN_PROVINCES_IMPORT_CSV = this.API_ADMIN_PROVINCES+'/import-csv'

        this.API_ADMIN_RATINGS = this.API_ADMIN+'/manage-ratings'
        this.API_ADMIN_RATINGS_RESOURCE = this.API_ADMIN_RATINGS+'/resource'
        this.API_ADMIN_RATINGS_DELETE_LIST = this.API_ADMIN_RATINGS+'/delete-list'

        this.API_ADMIN_RANKS = this.API_ADMIN+'/manage-ranks'
        this.API_ADMIN_RANKS_RESOURCE = this.API_ADMIN_RANKS+'/resource'
        this.API_ADMIN_RANKS_DELETE_LIST = this.API_ADMIN_RANKS+'/delete-list'

        this.API_ADMIN_DEPARTMENTS = this.API_ADMIN+'/manage-departments'
        this.API_ADMIN_DEPARTMENTS_RESOURCE = this.API_ADMIN_DEPARTMENTS+'/resource'
        this.API_ADMIN_DEPARTMENTS_DELETE_LIST = this.API_ADMIN_DEPARTMENTS+'/delete-list'
        this.API_ADMIN_DEPARTMENTS_IMPORT_CSV = this.API_ADMIN_DEPARTMENTS+'/import-csv'

        this.API_ADMIN_BRANCHES = this.API_ADMIN+'/manage-branches'
        this.API_ADMIN_BRANCHES_RESOURCE = this.API_ADMIN_BRANCHES+'/resource'
        this.API_ADMIN_BRANCHES_DELETE_LIST = this.API_ADMIN_BRANCHES+'/delete-list'
        this.API_ADMIN_BRANCHES_IMPORT_CSV = this.API_ADMIN_BRANCHES+'/import-csv'

        this.API_ADMIN_COURSES = this.API_ADMIN+'/manage-courses'
        this.API_ADMIN_COURSES_RESOURCE = this.API_ADMIN_COURSES+'/resource'
        this.API_ADMIN_COURSES_DELETE_LIST = this.API_ADMIN_COURSES+'/delete-list'

        /*NOTIFIES*/
        this.API_ADMIN_NOTIFIES = this.API_ADMIN+'/manage-notifies'
        this.API_ADMIN_NOTIFIES_RESOURCE = this.API_ADMIN_NOTIFIES+'/resource'
        this.API_ADMIN_NOTIFIES_DELETE_LIST = this.API_ADMIN_NOTIFIES+'/delete-list'
        this.API_ADMIN_NOTIFIES_GET_OPTION_CSV = (ID) => this.API_ADMIN_NOTIFIES+'/get-option-csv'
        /*NOTIFIES*/
        
        /*ENTERPRISES*/

        this.API_ENTERPRISE= this.API+'/enterprise'

        this.API_ENTERPRISE_TASKS = this.API_ENTERPRISE+'/manage-tasks'
        this.API_ENTERPRISE_TASKS_RESOURCE = this.API_ENTERPRISE_TASKS+'/resource'
        this.API_ENTERPRISE_TASKS_UPDATE_FILE_ATTACH = this.API_ENTERPRISE_TASKS+'/update-file-attach'
        this.API_ENTERPRISE_TASKS_DELETE_LIST = this.API_ENTERPRISE_TASKS+'/delete-list'
        this.API_ENTERPRISE_TASKS_GET_OPTION_CSV = (ID) => this.API_ENTERPRISE_TASKS+'/get-option-csv'

        this.API_ENTERPRISE_PROFILE = this.API_ENTERPRISE+'/profile'
        this.API_ENTERPRISE_UPDATE_AVATAR = this.API_ENTERPRISE+'/update-avatar'


        this.API_STUDENT= this.API+'/student'
        this.API_STUDENT_PROFILE = this.API_STUDENT+'/profile'
        this.API_STUDENT_UPDATE_AVATAR = this.API_STUDENT+'/update-avatar'


        this.API_AUTH_LOGIN = this.API+'/login'
        this.API_GET_TOKEN = this.API+'/get-token'
        this.API_RESET_PASSWORD = this.API+'/reset-password'

        this.API_NOTIFIES = this.API +'/notifies'
        this.API_POSITIONS = this.API +'/positions'
        this.API_ENTERPRISES = this.API +'/enterprises'
        this.API_SKILLS = this.API +'/skills'
        this.API_TYPES = this.API +'/types'
        this.API_SALARIES = this.API +'/salaries'
        this.API_PROVINCES = this.API +'/provinces'
        this.API_TASKS = this.API+'/tasks'
        /*API*/

        /*WEB*/

        this.WEB = window.location.origin

        this.WEB_HOME = this.WEB

        this.WEB_ADMIN = this.WEB+'/admin'

        this.WEB_ADMIN_ENTERPRISES = this.WEB_ADMIN+'/enterprises'

        this.WEB_ADMIN_STUDENTS = this.WEB_ADMIN+'/students'

        this.WEB_ADMIN_TASKS = this.WEB_ADMIN+'/tasks'

        this.WEB_ADMIN_POSITIONS = this.WEB_ADMIN+'/positions'

        this.WEB_ADMIN_NOTIFIES = this.WEB_ADMIN+'/notifies'

        this.WEB_ADMIN_EVENTS = this.WEB_ADMIN+'/events'

        this.WEB_ENTERPRISE = this.WEB+'/enterprise'

        this.WEB_ENTERPRISE_TASKS = this.WEB_ENTERPRISE+'/tasks'

        this.WEB_TASKS = this.WEB+'/tasks'

        this.WEB_NOTIFIES = this.WEB+'/notifies'
        /*WEB*/

    }
    notifySuccess(message = ''){
        if(message != '')
        {
            new PNotify({
                title: 'Ohh Yeah! Thành công!',
                text: message,
                addclass: 'bg-success'
            });
        }
        else{
            new PNotify({
                title: 'Ohh Yeah! Thành công!',
                text: 'Thao tác thành công',
                addclass: 'bg-success'
            });
        }
    }

    notifyWarning(message = ''){
        if(message != '')
        {
            new PNotify({
                title: 'Ohh! Có gì đó sai sai!',
                text: message,
                addclass: 'bg-warning'
            });
        }
        else{
            new PNotify({
                title: 'Ohh! Có gì đó sai sai!',
                text: 'Thao tác thành công nhưng hình như có gì đó không đúng. Vui lòng kiểm tra lại',
                addclass: 'bg-warning'
            });
        }

    }

    notifyError(message = ''){
        if(message != '')
        {
            new PNotify({
                title: 'Ohh! Có lỗi xảy ra rồi!',
                text: message,
                addclass: 'bg-danger'
            });
        }
        else{
            new PNotify({
                title: 'Ohh! Có lỗi xảy ra rồi!',
                text: 'Thao tác thất bại',
                addclass: 'bg-danger'
            });
        }

    }

    getError(data){
        let message = ''
        message = data.message
        message+= '<br>'
        let errors = data.errors
        let keys = Object.keys(errors)
        keys.forEach(key => {
            errors[key].forEach(item => {
                message+=item+'<br>'
            })
        })
        return message
    }
}

export default Config