<template>
    <div class="content-wrapper" id="content-wrapper">
        <data-table title="Quản lý sinh viên"
                    :columns="columns"
                    :data="data"
                    :targets="[]"
                    :buttonConfig="buttonConfig"
                    :resetCheck="resetCheck"
                    :menu="menu"
                    :primaryKey="primaryKey"
                    :pages="totalPage"
                    :lengths="lengths"
                    :setAll="setAll"
                    @selectAll="selectAll"
                    @unSelectAll="unSelectAll"
                    @deleteSelected="deleteSelected"
                    @action="action($event)"
                    @clickedKeyItem="clickedKeyItem"
                    @changePerPage="changePerPage"
                    @changePageSelect="changePageSelect"

        >
            <div id="modal_danger" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title"><i class="icon-warning"></i> Cảnh báo</h6>
                        </div>

                        <div class="modal-body">

                            <p> <i class="icon-warning"></i> Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
                            <div style="border: snow" class="panel panel-body border-top-danger text-center">
                                <div class="pace-demo" v-if="deleting == true">
                                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" @click="deleteItem">Xác định xóa</button>

                        </div>
                    </div>
                </div>
            </div>
            <div id="modal-danger-delete-list" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title"><i class="icon-warning"></i> Cảnh báo</h6>
                        </div>

                        <div class="modal-body">

                            <p> <i class="icon-warning"></i> Bạn đang xóa nhiều sinh viên. Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
                            <div style="border: snow" class="panel panel-body border-top-danger text-center">
                                <div class="pace-demo" v-if="deleting == true">
                                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" @click="deleteListItem">Xác định xóa</button>

                        </div>
                    </div>
                </div>
            </div>
            <div id="modal-push-excel" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm sinh viên bằng CSV</h5>
                        </div>

                        <form v-on:submit.prevent="uploadExcelFile" class="form-inline" enctype="multipart/form-data">

                            <div class="modal-body">
                                <input type="file"class="form-control" @change="setExcelFile($event)">
                                <div class="pace-demo" v-if="uploading == true">
                                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-primary">Tải file lên <i class="icon-plus22"></i></button>
                                <a href="/admin/get-sample-csv-file/student" target="_blank" type="button" class="btn btn-info">Tải CSV mẫu <i class="glyphicon glyphicon-info-sign"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal-update-excel" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h5 class="modal-title">Update thông tin sinh viên bằng CSV</h5>
                        </div>

                        <form v-on:submit.prevent="uploadExcelFileUpdate" class="form-inline" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="file"class="form-control" @change="setUpdateExcelFile($event)">
                                <div class="pace-demo" v-if="uploading == true">
                                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-primary">Tải file lên <i class="icon-plus22"></i></button>
                                <a href="/admin/get-sample-csv-file/student" target="_blank" type="button" class="btn btn-info">Tải CSV mẫu <i class="glyphicon glyphicon-info-sign"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal-show-err" class="modal fade">
                <div class="modal-dialog  modal-full">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm danh sách sinh viên thành công</h5>
                        </div>

                        <div class="modal-body">
                            <p> Bạn đã thêm mới thành công <span class="text-danger-400">{{lengthSucces}}</span> sinh viên</p>

                            <div class="form-group">
                                <label><b>Danh sách mã sinh viên bị lỗi</b></label>
                                <textarea class="form-control" rows="15">
                                {{listCodeError}}
                            </textarea>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </data-table>
    </div>
</template>
<script>
    import table from './../../../components/datatable/table'
    import axios from './../../../axios'

    import config from './../../../config'
    window._config = new config()
    export default {
        computed:{
            setAll(){
                // return this.data.length == this.itemSelected.length
            }
        },
        components: {
            'data-table' : table
        },
        data(){
            return {
                columns : [
                ],
                buttonConfig: [
                    {
                        text: 'Thêm mới',
                        className: 'btn bg-primary',
                        action: function(e, dt, node, config) {

                            window.open(window._config.WEB_ADMIN_STUDENTS+'/create')
                        }
                    },
                    {
                        text: 'Thêm bằng CSV',
                        className: 'btn bg-info',
                        action: function(e, dt, node, config) {
                            $('#modal-push-excel').modal('show')
                        }
                    },
                    {
                        text: 'Update bằng CSV',
                        className: 'btn bg-danger',
                        action: function(e, dt, node, config) {
                            $('#modal-update-excel').modal('show')
                        }
                    }
                ],
                deleting: false,
                data :[],
                menu: [
                    {
                        action :'view',
                        html:'<a href="javascript:void(0);"><i class="icon-info3"></i> Thông tin chi tiết</a>'
                    },
                    {
                        action :'delete',
                        html:'<a href="javascript:void(0);"><i class="icon-trash"></i> Xóa sinh viên</a>'
                    }
                ],
                primaryKey: 'code',
                lengths: [50,100,200,500,1000,2000,5000],
                itemSelected: [],
                primaryKeyDelete: -1,
                deletedSelectItem: false,
                resetCheck:false,
                uploading: false,
                excelFile: null,
                pages: [],
                page:1,
                totalPage:0,
                perPage:500,
                lengthSucces: 0,
                listCodeError: '',
                config: new config(),
                excelFileUpdate: null
            }
        },
        mounted(){
            this.getData()
        },
        methods: {

            getData(perPage=500,page=1){
                var vm = this
                axios.get(vm.config.API_ADMIN_STUDENTS_RESOURCE+'?size='+perPage+'&page='+page).then(data => {
                    vm.data = data.data.data
                    vm.perPage = data.data.per_page
                    vm.totalPage = data.data.total
                    vm.data = vm.data.map(item => {
                        item.department_name = item.department == null ? null : item.department.name
                        item.branch_name = item.branch == null ? null : item.branch.name
                        item.course_name = item.course == null ? null : item.course.name
                        if(item.graduated == 1)
                        {
                            item.graduated = '<span class="label bg-success-400">Đã tốt nghiệp</span>'
                        }
                        else{
                            item.graduated = '<span class="label bg-grey-400">Chưa tốt nghiệp</span>'
                        }
                        return item
                    })
                    vm.columns = [
                        {
                            key: 'code',
                            text: 'Mã sinh viên'
                        },
                        {
                            key:'full_name',
                            text: 'Tên sinh viên'
                        },
                        {
                            key:'course_name',
                            text: 'Tên khóa'
                        },
                        {
                            key:'branch_name',
                            text: 'Tên ngành'
                        },
                        {
                            key:'department_name',
                            text: 'Tên khoa'
                        },
                        {
                            key:'email_address',
                            text: 'Địa chỉ Email'
                        },
                        {
                            key: 'graduated',
                            text: 'Tốt nghiệp'
                        }

                    ]
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError()
                })
            },
            selectAll(){
                console.log(123)
                let vm = this
                vm.itemSelected = []
                vm.data.forEach(item => {
                    vm.itemSelected.push(item[vm.primaryKey])
                })
            },
            unSelectAll(){
                this.itemSelected = []
            },
            action(event){
                let vm = this
                if(event[1] == 'delete')
                {
                    vm.primaryKeyDelete = event[0]
                    $('#modal_danger').modal('show')
                }
                if(event[1] == 'view')
                {
                    vm.showItem(event[0])
                }
            },
            deleteItem(){
                let vm = this
                vm.deleting = true

                if(vm.primaryKeyDelete != -1)
                {
                    let indexOf = -1
                    axios.delete(vm.config.API_ADMIN_STUDENTS_RESOURCE+'/'+vm.primaryKeyDelete).then(data => {
                        vm.data.forEach((item,index) => {

                            if(item[vm.primaryKey] == vm.primaryKeyDelete)
                            {
                                indexOf = index
                            }
                        })
                        if(indexOf != -1)
                        {
                            vm.data.splice(indexOf,1)
                            vm.config.notifySuccess()
                        }
                        else
                        {
                            vm.config.notifyWarning()
                        }
                        vm.deleting = false
                        $('#modal_danger').modal('hide')
                        $('div.checker>span').removeClass('checked')
                    }).catch(err => {
                        console.log(err)
                        vm.config.notifyError()
                        vm.deleting = false
                        $('#modal_danger').modal('hide')
                    })
                }
                else{
                    vm.deleting = false
                    $('#modal_danger').modal('hide')
                }
            },
            clickedKeyItem(item) {
                let vm =this

                let index = vm.itemSelected.indexOf(item)

                if (index > -1) {
                    vm.itemSelected.splice(index, 1);
                }
                else{
                    vm.itemSelected.push(item)
                }
            },
            deleteSelected(){
                $('#modal-danger-delete-list').modal('show')
            },
            deleteListItem() {
                let vm = this
                vm.deleting = true
                axios.delete(vm.config.API_ADMIN_STUDENTS_DELETE_LIST,{
                    params:{
                        id_list: vm.itemSelected
                    }
                }).then(data => {
                    $('#modal-danger-delete-list').modal('hide')
                    vm.deleting = false
                    let list_id = vm.itemSelected
                    let newData = []
                        vm.data.forEach((dt) => {
                            if(!vm.existsItem(dt[vm.primaryKey],list_id))
                            {
                                newData.push(dt)
                            }
                        })

                    vm.data = newData

                    vm.config.notifySuccess()
                    vm.itemSelected = []
                    vm.resetCheck = !vm.resetCheck

                }).catch(err => {
                    $('#modal-danger-delete-list').modal('hide')
                    vm.deleting = false
                    console.log(err)
                    vm.config.notifyError()
                })
            },
            existsItem(item,Arry){
                let result = false
                Arry.forEach((i) => {
                    if(item == i)
                    {
                        result = true
                    }
                })
                return result
            },
            showItem(id) {
                let vm = this
                window.open(vm.config.WEB_ADMIN_STUDENTS+'/'+id+'/edit','_blank')
            },
            setExcelFile(e){
                var vm = this
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                vm.excelFile = files[0]
            },
            setUpdateExcelFile(e){
                var vm = this
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                vm.excelFileUpdate = files[0]
            },
            uploadExcelFile(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()
                formData.append('CsvFile',vm.excelFile)
                axios.post(vm.config.API_ADMIN_STUDENTS_IMPORT_CSV,formData).then(data => {
                    vm.uploading = false
                    $('#modal-push-excel').modal('hide')
                    if(data.data.message == [] || data.data.error.length == 0)
                    {
                       vm.config.notifySuccess()
                    }
                    else{
                        vm.config.notifyWarning()
                        vm.lengthSucces = data.data.lengthError
                        vm.listCodeError = data.data.error
                        $('#modal-show-err').modal('show')

                    }
                    vm.getData()
                }).catch(err => {
                    if(err.response.status == 406)
                    {
                        vm.config.notifyError('Toàn bộ file bị lỗi dữ liệu. Vui lòng kiểm tra lại')
                    }
                    else{
                        vm.config.notifyError()
                    }
                    this.uploading = false
                    console.dir(err)


                })
            },
            uploadExcelFileUpdate(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()
                formData.append('CsvFile',vm.excelFileUpdate)
                axios.post(vm.config.API_ADMIN_STUDENTS_IMPORT_UPDATE_CSV,formData).then(data => {
                    vm.uploading = false
                    $('#modal-update-excel').modal('hide')
                    if(data.data.message == [] || data.data.error.length == 0)
                    {
                        vm.config.notifySuccess()
                    }
                    else{
                        vm.config.notifyWarning()
                        vm.lengthSucces = data.data.lengthError
                        vm.listCodeError = data.data.error
                        $('#modal-show-err').modal('show')

                    }
                    vm.getData()
                }).catch(err => {
                    if(err.response.status == 406)
                    {
                        vm.config.notifyError('Toàn bộ file bị lỗi dữ liệu. Vui lòng kiểm tra lại')
                    }
                    else{
                        vm.config.notifyError()
                    }
                    this.uploading = false
                    console.dir(err)


                })
            },
            changePerPage(perPage){
                this.getData(perPage)
            },
            changePageSelect(page){
                this.getData(this.perPage,page)
            }
        }
    }
</script>
