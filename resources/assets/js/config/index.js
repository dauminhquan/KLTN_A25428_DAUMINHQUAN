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

        /*API*/

        /*WEB*/

        this.WEB = window.location.origin

        this.WEB_ADMIN = this.WEB+'/admin'

        this.WEB_ADMIN_ENTERPRISES = this.WEB_ADMIN+'/enterprises'


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