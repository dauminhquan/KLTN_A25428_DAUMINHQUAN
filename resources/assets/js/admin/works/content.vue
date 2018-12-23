<template>
    <div class="content-wrapper" id="content-wrapper">
        <data-table title="Quản lý thông tin việc"
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

                            <p> <i class="icon-warning"></i> Bạn đang xóa nhiều thông tin việc. Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
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
                            <h5 class="modal-title">Thêm thông tin việc bằng CSV</h5>
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
                                <a href="/admin/get-sample-csv-file/work" target="_blank" type="button" class="btn btn-info">Tải CSV mẫu <i class="glyphicon glyphicon-info-sign"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal_info" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title"><i class="icon-info3"></i> Thông tin loại công việc</h6>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="form-group">
                                    <label><b>Mã sinh viên</b></label>
                                    <input type="text" readonly  v-model="info.student_code" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label><b>Chọn doanh nghiệp</b></label>
                                    <v-select :options="enterprises" label="name" v-model="info.enterprise"></v-select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label><b>Chọn mức lương</b></label>
                                    <v-select :options="salaries" v-model="info.salary" label="about"></v-select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label><b>Chọn vị trí</b></label>
                                    <v-select :options="ranks" v-model="info.rank" label="name"></v-select>
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
                            <button type="button" class="btn btn-success" @click="updateItem">Update thông tin việc làm</button>

                        </div>
                    </div>
                </div>
            </div>
            <div id="modal_create" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title"><i class="icon-info3"></i> Thông tin loại công việc</h6>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="form-group">
                                    <label><b>Mã sinh viên</b></label>
                                    <input type="text"  v-model="create.student_code" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label><b>Chọn doanh nghiệp</b></label>
                                    <v-select :options="enterprises" label="name" v-model="create.enterprise_id"></v-select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label><b>Chọn mức lương</b></label>
                                   <v-select :options="salaries" v-model="create.salary_id" label="about"></v-select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label><b>Chọn vị trí</b></label>
                                    <v-select :options="ranks" v-model="create.rank_id" label="name"></v-select>
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
                            <button type="button" class="btn btn-success" @click="createItem">Thêm thông tin việc làm</button>

                        </div>
                    </div>
                </div>
            </div>
        </data-table>
    </div>
</template>
<script>
    import vSelect from 'vue-select'
    import table from './../../components/datatable/table'
    import axios from './../../axios'
    import config from './../../config'

    window._config = new config()
    export default {
        components: {
            'data-table' : table,
            'v-select': vSelect
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
                        action: function(e, dt, node, config) {
                            $('#modal-push-excel').modal('show')
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
                        html:'<a href="javascript:void(0);"><i class="icon-trash"></i> Xóa thông tin việc</a>'
                    }
                ],
                primaryKey: 'id',
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
                config: new config(),
                info: {
                    student_code:null,
                    enterprise_id: null,
                    salary: null,
                    rank:null,
                    enterprise:null
                },
                create: {
                    student_code:null,
                    enterprise_id: null,
                    salary_id: null,
                    rank_id:null,
                },
                ranks: [],
                salaries: [],
                enterprises: [],
                updating: false,
                creating:false
            }
        },
        mounted(){
            this.getSalaries()
            this.getEnterprises()
            this.getRanks()
            this.getData()
        },
        methods: {

            getData(perPage=500,page=1){
                var vm = this
                axios.get(vm.config.API_ADMIN_WORKS_RESOURCE+'?size='+perPage+'&page='+page).then(data => {
                    vm.data = data.data.data
                    if(vm.data.length > 0)
                    {
                        vm.data = vm.data.map(item =>{
                            item.enterpriseName = item.enterprise == null? null:item.enterprise.name
                            item.studentName = item.student == null?null:item.student.full_name
                            item.rankName = item.rank==null?null:item.rank.name
                            item.salaryName = item.salary==null?null:item.salary.about
                            return item
                        })

                    }
                    vm.perPage = data.data.per_page
                    vm.totalPage = data.data.total
                    vm.columns = [
                        {
                            key: 'id',
                            text: 'ID việc'
                        },
                        {
                            key:'enterpriseName',
                            text: 'Tên doanh nghiệp'
                        },
                        {
                            key:'studentName',
                            text: 'Tên sinh viên'
                        },
                        {
                            key:'rankName',
                            text: 'Vị trí'
                        },
                        {
                            key:'salaryName',
                            text: 'Mức lương'
                        },
                    ]
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError()
                })
            },
            getSalaries(){
                let vm = this
                axios.get(vm.config.API_ADMIN_SALARIES_RESOURCE+'?size=-1').then(data=>{
                    vm.salaries = data.data.data
                }).catch(err => {
                    console.dir(err)
                    vm.config.notifyError('Server has Error')
                })
            },
            getRanks(){
                let vm = this
                axios.get(vm.config.API_ADMIN_RANKS_RESOURCE+'?size=-1').then(data=>{
                    vm.ranks = data.data.data
                }).catch(err => {
                    console.dir(err)
                    vm.config.notifyError('Server has Error')
                })
            },
            getEnterprises(){
                let vm = this
                axios.get(vm.config.API_ADMIN_ENTERPRISES_RESOURCE+'?size=-1').then(data=>{
                    vm.enterprises = data.data.data
                }).catch(err => {
                    console.dir(err)
                    vm.config.notifyError('Server has Error')
                })
            },
            createItem(){
                let vm = this
                let errorHtml = ''
                if(vm.create.enterprise_id == null || vm.create.enterprise_id == undefined)
                {
                    errorHtml+='Vui lòng chọn một doanh nghiệp<br>'
                }
                if(vm.create.salary_id == null || vm.create.salary_id == undefined)
                {
                    errorHtml+='Vui lòng chọn một mức lương<br>'
                }
                if(vm.create.rank_id == null || vm.create.rank_id == undefined)
                {
                    errorHtml+='Vui lòng chọn một vị trí<br>'
                }
                if(errorHtml != '')
                {
                    vm.config.notifyError(errorHtml)
                    return false
                }
                vm.creating = true
                let itemNew = {
                    student_code:null,
                    enterprise_id: null,
                    salary_id: null,
                    rank_id:null,
                }
                itemNew.salary_id = vm.create.salary_id.id
                itemNew.rank_id = vm.create.rank_id.id
                itemNew.enterprise_id = vm.create.enterprise_id.id
                itemNew.student_code = vm.create.student_code
                axios.post(vm.config.API_ADMIN_WORKS_RESOURCE,itemNew).then(data => {
                    vm.config.notifySuccess('Thêm mới thành công')
                    $('#modal_create').modal('hide')
                    vm.getData()
                    vm.creating =false
                }).catch(err => {
                    console.dir(err)
                    vm.config.notifyError('Có lỗi xảy ra. Vui lòng kiểm tra lại')
                    $('#modal_create').modal('hide')
                    vm.creating =false
                })

            },
            updateItem(){
                let vm = this
                let errorHtml = ''
                if(vm.info.enterprise == null || vm.info.enterprise == undefined)
                {
                    errorHtml+='Vui lòng chọn một doanh nghiệp<br>'
                }
                if(vm.info.salary == null || vm.info.salary == undefined)
                {
                    errorHtml+='Vui lòng chọn một mức lương<br>'
                }
                if(vm.info.rank == null || vm.info.rank == undefined)
                {
                    errorHtml+='Vui lòng chọn một vị trí<br>'
                }
                if(errorHtml != '')
                {
                    vm.config.notifyError(errorHtml)
                    return false
                }
                vm.updating = true
                let itemNew = {
                    student_code:null,
                    enterprise_id: null,
                    salary_id: null,
                    rank_id:null,
                }
                itemNew.id = vm.info.id
                itemNew.salary_id = vm.info.salary.id
                itemNew.rank_id = vm.info.rank.id
                itemNew.enterprise_id = vm.info.enterprise.id
                itemNew.student_code = vm.info.student_code
                axios.put(vm.config.API_ADMIN_WORKS_RESOURCE+'/'+itemNew.id,itemNew).then(data => {
                    vm.config.notifySuccess('Update thành công')
                    $('#modal_info').modal('hide')
                    vm.getData()
                    vm.updating = false
                }).catch(err => {
                    console.dir(err)
                    vm.config.notifyError('Có lỗi xảy ra. Vui lòng kiểm tra lại')
                    $('#modal_info').modal('hide')
                    vm.updating = false
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
            deleteItem(){
                let vm = this
                vm.deleting = true

                if(vm.primaryKeyDelete != -1)
                {
                    let indexOf = -1
                    axios.delete(vm.config.API_ADMIN_WORKS_RESOURCE+'/'+vm.primaryKeyDelete).then(data => {
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
                axios.delete(vm.config.API_ADMIN_WORKS_DELETE_LIST,{
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
                axios.post(vm.config.API_ADMIN_WORKS_IMPORT_CSV,formData).then(data => {
                    vm.uploading = false
                    $('#modal-push-excel').modal('hide')
                    if(data.data.message == [] || data.data.error.length == 0)
                    {
                       vm.config.notifySuccess()
                    }
                    else{
                        vm.config.notifyWarning()
                    }
                    vm.getData()
                }).catch(err => {
                    this.uploading = false
                    console.dir(err)
                    vm.config.notifyError()

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
