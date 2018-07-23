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
        this.API_ADMIN_ENTERPRISES_LIST_STUDENT_ID = (ID) => {return this.API_ADMIN_ENTERPRISES+'/list-student'+'/'+ID}
        this.API_ADMIN_ENTERPRISES_IMPORT_CSV = this.API_ADMIN_ENTERPRISES+'/import-csv'
        this.API_ADMIN_ENTERPRISES_LIST_JOB_ID = (ID) => {return this.API_ADMIN_ENTERPRISES+'/list-job'+'/'+ID}
        this.API_ADMIN_ENTERPRISES_GET_OPTION_CSV = (ID) => this.API_ADMIN_ENTERPRISES+'/get-option-csv'
        /*ENTERPRISES*/




    }
}

export default Config