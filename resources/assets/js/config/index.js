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
        this.API_ADMIN_ENTERPRISES_LIST_JOB_ID = (ID) => {return this.API_ADMIN_ENTERPRISES+'/list-job'+'/'+ID}
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
        this.API_ADMIN_STUDENTS_LIST_JOB_ID = (ID) => {return this.API_ADMIN_STUDENTS+'/list-job'+'/'+ID}
        this.API_ADMIN_STUDENTS_GET_OPTION_CSV = (ID) => this.API_ADMIN_STUDENTS+'/get-option-csv'
        /*STUDENTS*/
        
        /*JOBS*/
        this.API_ADMIN_JOBS = this.API_ADMIN+'/manage-jobs'
        this.API_ADMIN_JOBS_RESOURCE = this.API_ADMIN_JOBS+'/resource'
        this.API_ADMIN_JOBS_UPDATE_FILE_ATTACH = this.API_ADMIN_JOBS+'/update-file-attach'
        this.API_ADMIN_JOBS_DELETE_LIST = this.API_ADMIN_JOBS+'/delete-list'
        this.API_ADMIN_JOBS_GET_OPTION_CSV = (ID) => this.API_ADMIN_JOBS+'/get-option-csv'
        /*JOBS*/

        this.API_ADMIN_TYPES = this.API_ADMIN+'/manage-types'
        this.API_ADMIN_TYPES_RESOURCE = this.API_ADMIN_TYPES+'/resource'
        this.API_ADMIN_TYPES_DELETE_LIST = this.API_ADMIN_TYPES+'/delete-list'

        this.API_ADMIN_SKILLS = this.API_ADMIN+'/manage-skills'
        this.API_ADMIN_SKILLS_RESOURCE = this.API_ADMIN_SKILLS+'/resource'
        this.API_ADMIN_SKILLS_DELETE_LIST = this.API_ADMIN_SKILLS+'/delete-list'

        this.API_ADMIN_POSITIONS = this.API_ADMIN+'/manage-positions'
        this.API_ADMIN_POSITIONS_RESOURCE = this.API_ADMIN_POSITIONS+'/resource'
        this.API_ADMIN_POSITIONS_DELETE_LIST = this.API_ADMIN_POSITIONS+'/delete-list'

        this.API_ADMIN_SALARIES = this.API_ADMIN+'/manage-salaries'
        this.API_ADMIN_SALARIES_RESOURCE = this.API_ADMIN_SALARIES+'/resource'
        this.API_ADMIN_SALARIES_DELETE_LIST = this.API_ADMIN_SALARIES+'/delete-list'


        /*NOTIFIES*/
        this.API_ADMIN_NOTIFIES = this.API_ADMIN+'/manage-notifies'
        this.API_ADMIN_NOTIFIES_RESOURCE = this.API_ADMIN_NOTIFIES+'/resource'
        this.API_ADMIN_NOTIFIES_DELETE_LIST = this.API_ADMIN_NOTIFIES+'/delete-list'
        this.API_ADMIN_NOTIFIES_GET_OPTION_CSV = (ID) => this.API_ADMIN_NOTIFIES+'/get-option-csv'
        /*NOTIFIES*/
        
        /*API*/

        /*WEB*/

        this.WEB = window.location.origin

        this.WEB_ADMIN = this.WEB+'/admin'

        this.WEB_ADMIN_ENTERPRISES = this.WEB_ADMIN+'/enterprises'

        this.WEB_ADMIN_JOBS = this.WEB_ADMIN+'/jobs'

        this.WEB_ADMIN_POSITIONS = this.WEB_ADMIN+'/positions'

        this.WEB_ADMIN_NOTIFIES = this.WEB_ADMIN+'/notifies'
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