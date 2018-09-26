<template>
    <div class="content-wrapper" id="content-wrapper">
        <data-table title="Quản lý tài khoản "
                    :columns="columns"
                    :data="data"
                    :targets="[]"
                    :buttonConfig="buttonConfig"
                    :resetCheck="resetCheck"
                    :menu="menu"
                    :primaryKey="primaryKey"
                    :pages="totalPage"
                    :lengths="lengths"
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

                            <p> <i class="icon-warning"></i> Bạn đang xóa nhiều tài khoản. Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
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
            <div id="modal_info" class="modal fade">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title"><i class="icon-info3"></i> Thông tin tài khoản </h6>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Email </b></label>
                                        <input type="text" v-model="info.email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Tình trạng </b></label>
                                        <select v-model="info.authentication" class="form-control">
                                            <option value="0">Chưa xác thực / Khóa</option>
                                            <option value="1">Đã xác thực</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Password </b></label>
                                        <input type="password" v-model="info.password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Nhập lại password </b></label>
                                        <input type="password" v-model="info.rep_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div style="border: snow" class="panel panel-body border-top-danger text-center">
                                <div class="pace-demo" v-if="updating == true">
                                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-success" @click="updateItem">Update thông tin</button>

                        </div>
                    </div>
                </div>
            </div>
            <div id="modal_create" class="modal fade">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title"><i class="icon-info3"></i> Thông tin tài khoản </h6>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Email </b></label>
                                        <input type="text" v-model="create.email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Password </b></label>
                                        <input type="password" v-model="create.password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Nhập lại password </b></label>
                                        <input type="password" v-model="create.rep_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Loại tài khoản </b></label>
                                        <select class="form-control" v-model="create.type">
                                            <option value="1">Admin</option>
                                            <option value="2">Doanh nghiệp</option>
                                            <option value="3">Sinh viên</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>{{text}}</b></label>
                                        <v-select :options="persCreate" label="text" v-model="create.per" v-if="create.type != 3"></v-select>
                                        <input type="text" class="form-control" v-model="create.per" v-if="create.type == 3">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Tình trạng </b></label>
                                        <select  v-model="create.authentication" class="form-control">
                                            <option value="0">Chưa xác thực / Khóa</option>
                                            <option value="1">Đã xác thực</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="border: snow" class="panel panel-body border-top-danger text-center">
                                <div class="pace-demo" v-if="creating == true">
                                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-success" @click="createItem">Thêm mới</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modal-push-excel" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm người dùng bằng CSV</h5>
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
                                <a href="/admin/get-sample-csv-file/user" target="_blank" type="button" class="btn btn-info">Tải CSV mẫu <i class="glyphicon glyphicon-info-sign"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal-show-err" class="modal fade">
                <div class="modal-dialog  modal-full">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm danh sách người dùng thành công</h5>
                        </div>

                        <div class="modal-body">
                            <p> Bạn đã thêm mới thành công <span class="text-danger-400">{{lengthSucces}}</span> người dùng</p>

                            <div class="form-group">
                                <label><b>Danh sách dòng</b></label>
                                <textarea class="form-control" rows="15">
                                {{listRowError}}
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
    import vSelect from 'vue-select'
    import 'select2'
    import axios from './../../../axios'
    import config from './../../../config'
    window._config = new config()
    export default {
        components: {
            'data-table' : table,
            'v-select' : vSelect
        },
        computed: {
            infoType() {
                return this.info.type
            },
            createType() {
                return this.create.type
            }
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
                            $('#modal_create').modal('show')
                        }
                    },
                    {
                        text: 'Thêm bằng CSV',
                        className: 'btn bg-info',
                        action: function (e, dt, node, config) {
                            $('#modal-push-excel').modal('show')
                        }
                    },
                ],
                deleting: false,
                updating: false,
                uploading: false,
                creating: false,
                data :[],
                menu: [
                    {
                        action :'view',
                        html:'<a href="javascript:void(0);"><i class="icon-info3"></i> Thông tin chi tiết</a>'
                    },
                    {
                        action :'delete',
                        html:'<a href="javascript:void(0);"><i class="icon-trash"></i> Xóa tài khoản  </a>'
                    }
                ],
                primaryKey: 'id',
                lengths: [50,100,200,500,1000,2000,5000],
                itemSelected: [],
                primaryKeyDelete: -1,
                deletedSelectItem: false,
                resetCheck:false,
                pages: [],
                page:1,
                totalPage:0,
                perPage:500,
                excelFile: null,
                info:{
                    email:null,
                    password:null,
                    rep_password: null,
                    type: null,
                    per:null,
                    authentication: 0
                },
                create:{
                    email:null,
                    password:null,
                    rep_password: null,
                    type: null,
                    per:null,
                    authentication: 0
                },
                enterprises: [],
                students: [],
                admins: [],
                persCreate: [],
                text:'Chọn đối tượng',
                lengthSucces: 0,
                listRowError: [],
                config: new config(),
            }
        },
        mounted(){
            let vm =this
            vm.getAdmin()
            vm.getEnterprises()
            vm.getData()

        },
        methods: {
            getData(perPage=500,page=1){
                var vm = this
                axios.get(vm.config.API_ADMIN_USERS_RESOURCE+'?size='+perPage+'&page='+page).then(data => {
                    vm.data = data.data.data
                    vm.data = vm.data.map(item => {
                        if(item.type == 1 )
                        {
                            item.userType = 'Admin'
                            if(item.admin != null)
                            {
                                item.userName = item.admin.name
                            }
                            else{
                                item.userName = null
                            }
                        }
                        if(item.type == 2)
                        {
                            item.userType = 'Doanh nghiệp'
                            if(item.enterprise != null)
                            {
                                item.userName = item.enterprise.name
                            }
                            else{
                                item.userName = null
                            }

                        }
                        if(item.type == 3)
                        {
                            item.userType = 'Sinh viên'

                            if(item.student != null)
                            {
                                item.userName = item.student.full_name
                            }
                            else{
                                item.userName = null
                            }
                        }
                        if(item.authentication == 1)
                        {
                            item.status = '<span class="label bg-success-400">Đã xác thực</span>'
                        }
                        else{

                            item.status = '<span class="label bg-warning-400">Chưa xác thực/ Bị khóa</span>'
                        }
                        return item
                    })
                    vm.perPage = data.data.per_page
                    vm.totalPage = data.data.total
                    vm.columns = [
                        {
                            key: 'id',
                            text: 'ID tài khoản'
                        },
                        {
                            key:'email',
                            text:'Email'
                        }
                        ,
                        {
                            key:'userType',
                            text: 'Loại tài khoản'
                        },
                        {
                            key: 'userName',
                            text: 'Tên người dùng'
                        },
                        {
                            key: 'status',
                            text: 'Tình trạng'
                        }

                    ]
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError()
                })
            },
            getAdmin(){
                let vm = this
                axios.get(vm.config.API_ADMIN_ADMINS_RESOURCE+'?size=-1').then(data => {
                    vm.admins = data.data.data
                    vm.admins = vm.admins.map(item => {
                        item.text = item.name
                        return item
                    })
                    vm.admins = vm.admins.filter(item => {
                        return item.user_id == null
                    })
                })  .catch(err => {
                    console.dir(err)
                    vm.config.notifyError('Không thể lấy thông tin các admin')
                })
            },
            getEnterprises(){
                let vm = this
                axios.get(vm.config.API_ADMIN_ENTERPRISES_RESOURCE+'?size=-1').then(data => {
                    vm.enterprises = data.data.data
                    vm.enterprises = vm.enterprises.map(item => {
                        item.text = item.name
                        return item
                    })
                    vm.enterprises = vm.enterprises.filter(item => {
                        return item.user_id == null
                    })
                })  .catch(err => {
                    console.dir(err)
                    vm.config.notifyError('Không thể lấy thông tin các admin')
                })
            },
            selectAll(){
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
            createItem(){
                let vm = this
                vm.creating = true
                if(vm.create.per == null || vm.create.type == null)
                {
                    vm.config.notifyWarning('Vui lòng điền đầy đủ thông tin')
                    return false
                }
                let create = {
                }
                create.email = vm.create.email
                create.password = vm.create.password
                create.rep_password = vm.create.rep_password
                create.type = vm.create.type
                create.per = vm.create.per
                if(create.type == 1 || create.type == 2)
                {
                    create.per = vm.create.per.id
                }
                create.authentication = vm.create.authentication
                axios.post(vm.config.API_ADMIN_USERS_RESOURCE,create).then(data => {
                    vm.config.notifySuccess('Thêm mới thành công')
                    vm.creating = false
                    vm.create = {
                        email:null,
                        password:null,
                        rep_password: null,
                        type: null,
                        per:null
                    }
                    vm.getData()
                    $('#modal_create').modal('hide')
                }).catch(err => {
                    console.dir(err)
                    if(err.response.status == 422)
                    {
                        vm.config.notifyError(vm.config.getError(err.response.data))
                    }else
                    {

                        vm.config.notifyError()
                    }
                })
            },
            updateItem(){
                let vm = this
                vm.updating = true
                let update = {

                }
                update.email = vm.info.email
                update.password = vm.info.password
                update.rep_password = vm.info.rep_password
                update.type = vm.info.type
                update.authentication = vm.info.authentication
                update.per = vm.info.per
                axios.put(vm.config.API_ADMIN_USERS_RESOURCE+'/'+vm.info.id,update,{
                    name:vm.info.name
                }).then(data => {
                    vm.config.notifySuccess('Update thông tin tài khoản thành công')
                    vm.updating = false
                    vm.getData()
                    $('#modal_info').modal('hide')
                }).catch(err => {
                    console.dir(err)
                    vm.config.notifyError()
                })
            },
            deleteItem(){
                let vm = this
                vm.deleting = true

                if(vm.primaryKeyDelete != -1)
                {
                    let indexOf = -1
                    axios.delete(vm.config.API_ADMIN_USERS_RESOURCE+'/'+vm.primaryKeyDelete).then(data => {
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
                axios.delete(vm.config.API_ADMIN_USERS_DELETE_LIST,{
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
                vm.info = vm.data.find(item => {
                    return item.id == id
                })
                $('#modal_info').modal('show')
            },
            changePerPage(perPage){
                this.getData(perPage)
            },
            changePageSelect(page){
                this.getData(this.perPage,page)
            },
            setExcelFile(e){
                var vm = this
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                vm.excelFile = files[0]
            },
            uploadExcelFile(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()
                formData.append('CsvFile',vm.excelFile)
                axios.post(vm.config.API_ADMIN_USERS_IMPORT_CSV,formData).then(data => {
                    vm.uploading = false
                    $('#modal-push-excel').modal('hide')
                    if(data.data.message == [] || data.data.error.length == 0)
                    {
                        vm.config.notifySuccess()
                    }
                    else{

                        vm.config.notifyWarning()
                        vm.lengthSucces = data.data.lengthSucess
                        vm.listRowError = data.data.error
                        $('#modal-show-err').modal('show')

                    }
                    vm.getData()
                }).catch(err => {
                    this.uploading = false
                    console.dir(err)
                    if(err.response.status == 405)
                    {
                        vm.config.notifyError('Lỗi nghiêm trọng! Định dạng file không đúng, vui lòng kiểm tra lại')
                    }
                    if(err.response.status == 422)
                    {
                        vm.config.notifyError(err.response.data.message)
                    }
                    else{
                        vm.config.notifyError()
                    }
                })
            },
        },
        watch:{
            createType(value){
                let vm = this
                if (value == 1)
                {
                    vm.text = 'Chọn 1 Admin'
                    vm.persCreate = vm.admins
                }
                else if (value == 2)
                {
                    vm.text = 'Chọn 1 doanh nghiệp'
                    vm.persCreate =  vm.enterprises
                }
                else if (value == 3)
                {
                    vm.text = 'Nhập mã sinh viên'
                    vm.persCreate =  []
                }
                else{
                    vm.text = 'Chọn một người dùng'
                    vm.persCreate =  []
                }
            }
        }
    }
</script>
