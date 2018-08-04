<template>
    <div class="content-wrapper" id="content-wrapper">
        <data-table title="Quản lý sự kiện "
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

                            <p> <i class="icon-warning"></i> Bạn đang xóa nhiều bài viết. Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
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
                            <h6 class="modal-title"><i class="icon-info3"></i> Thông tin tham dự </h6>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Mã sinh viên </b></label>
                                        <input type="text" readonly v-model="info.student_code" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Tình trạng </b></label>
                                        <select v-model="info.attended" class="form-control">
                                            <option value="0">Chưa tham dự</option>
                                            <option value="1">Đã tham dự</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label><b>Đánh giá </b></label>
                                    <textarea v-model="info.comment" class="form-control">

                                    </textarea>
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
                            <h6 class="modal-title"><i class="icon-info3"></i> Thêm sinh viên vào sự kiện </h6>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Mã sinh viên </b></label>
                                        <input type="text" v-model="create.student_code" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Tình trạng </b></label>
                                        <select v-model="create.attended" class="form-control">
                                            <option value="0">Chưa tham dự</option>
                                            <option value="1">Đã tham dự</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label><b>Đánh giá </b></label>
                                    <textarea v-model="create.comment" class="form-control">

                                    </textarea>
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
                            <h5 class="modal-title">Thêm sinh viên bằng Excel</h5>
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
                                <a href="/admin/student-manage/get-excel-example-student" target="_blank" type="button" class="btn btn-info">Tải Excel mẫu <i class="glyphicon glyphicon-info-sign"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal-update-excel" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm sinh viên bằng Excel</h5>
                        </div>

                        <form v-on:submit.prevent="uploadUpdateExcelFile" class="form-inline" enctype="multipart/form-data">

                            <div class="modal-body">
                                <input type="file"class="form-control" @change="setUpdateExcelFile($event)">
                                <div class="pace-demo" v-if="uploading == true">
                                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-primary">Tải file lên <i class="icon-plus22"></i></button>
                                <a href="/admin/student-manage/get-excel-example-student" target="_blank" type="button" class="btn btn-info">Tải Excel mẫu <i class="glyphicon glyphicon-info-sign"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </data-table>
    </div>
</template>
<script>
    import table from './components/table.vue'

    import 'select2'
    import axios from './../../../axios'

    import config from './../../../config'
    window._config = new config()
    export default {
        components: {
            'data-table' : table
        },
        props: ['keyItem'],
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
                        text: 'Thêm mới bằng Excel',
                        className: 'btn bg-warning',
                        action: function(e, dt, node, config) {
                            $('#modal-push-excel').modal('show')
                        }
                    },
                    {
                        text: 'Update bằng Excel',
                        className: 'btn bg-info',
                        action: function(e, dt, node, config) {
                            $('#modal-update-excel').modal('show')
                        }
                    }
                ],
                deleting: false,
                updating: false,
                creating: false,
                uploading:false,
                data :[],
                menu: [
                    {
                        action :'view',
                        html:'<a href="#"><i class="icon-info3"></i> Thông tin chi tiết</a>'
                    },
                    {
                        action :'delete',
                        html:'<a href="#"><i class="icon-trash"></i> Xóa sinh viên  </a>'
                    },
                ],
                primaryKey: 'id',
                lengths: ['All'],
                itemSelected: [],
                primaryKeyDelete: -1,
                deletedSelectItem: false,
                resetCheck:false,
                pages: [],
                page:1,
                totalPage:0,
                perPage:-1,
                fileAdd:null,
                fileUpdate:null,
                info:{
                    student_code: null,
                    event_id:null,
                    comment:null,
                    attended:false,
                    id: null

                },
                create:{
                    student_code: null,
                    event_id:null,

                },
                config: new config(),
            }
        },
        mounted(){
            let vm =this
            vm.getData()
        },
        methods: {

            getData(){
                var vm = this
                axios.get(vm.config.API_ADMIN_EVENTS_RESOURCE+'/'+vm.keyItem).then(data => {
                    vm.data = data.data.event_students
                    vm.data = vm.data.map(item => {
                        item.studentName = item.student == null?null: item.student.full_name
                        if(item.attended == 1)
                        {
                            item.attendedHtml = '<span class="label bg-success-400">Đã tham dự</span>'
                        }
                        else{
                            item.attendedHtml = '<span class="label bg-danger-400">Chưa tham dự</span>'
                        }
                        return item
                    })
                    vm.columns = [
                        {
                            key:'student_code',
                            text: 'Mã sinh viên'
                        }
                        ,
                        {
                            key:'studentName',
                            text: 'Tên sinh viên'
                        },
                        {
                            key:'attendedHtml',
                            text: 'Đã tham dự'
                        },
                        {
                            key:'comment',
                            text: 'Nhận xét'
                        },
                        {
                            key:'created_at',
                            text: 'Thời gian đăng ký'
                        }

                    ]
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError()
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
                vm.create.event_id = vm.keyItem
                axios.post(vm.config.API_ADMIN_EVENT_STUDENT_RESOURCE,vm.create).then(data => {
                    vm.config.notifySuccess('Thêm mới thành công')
                    vm.creating = false
                    vm.nameCreate=''
                    vm.getData()
                    $('#modal_create').modal('hide')
                }).catch(err => {
                    console.dir(err)
                    if(err.response.status == 422)
                    {
                        vm.config.notifyError(vm.config.getError(err.response.data))
                    }
                    else{
                        vm.config.notifyError()
                    }
                })
            },
            updateItem(){
                let vm = this
                vm.info.event_id = vm.keyItem
                vm.updating = true
              axios.put(vm.config.API_ADMIN_EVENT_STUDENT_RESOURCE+'/'+vm.info.id,vm.info).then(data => {
                  vm.config.notifySuccess('Update thông tin sự kiện cv thành công')
                  vm.updating = false
                  vm.getData()
                  $('#modal_info').modal('hide')
              }).catch(err => {
                  console.dir(err)

                  if(err.response.status == 422)
                  {
                      vm.config.notifyError(vm.config.getError(err.response.data))
                  }
                  else{
                      vm.config.notifyError()
                  }

              })
            },
            deleteItem(){
                let vm = this
                vm.deleting = true

                if(vm.primaryKeyDelete != -1)
                {
                    let indexOf = -1
                    axios.delete(vm.config.API_ADMIN_EVENT_STUDENT_RESOURCE+'/'+vm.primaryKeyDelete).then(data => {
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
                axios.delete(vm.config.API_ADMIN_EVENT_STUDENT_DELETE_LIST,{
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
                vm.fileAdd = files[0]
            },
            uploadExcelFile(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()
                formData.append('CsvFile',vm.fileAdd)
                axios.post(vm.config.API_ADMIN_EVENT_STUDENT_IMPORT_CSV,formData).then(data => {
                    vm.uploading = false
                    $('#modal-push-excel').modal('hide')
                    if(data.data.message == [] || data.data.error.length == 0 )
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
            setUpdateExcelFile(e){
                var vm = this
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                vm.fileUpdate = files[0]
            },
            uploadUpdateExcelFile(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()
                formData.append('CsvFile',vm.fileUpdate)
                axios.post(vm.config.API_ADMIN_EVENT_STUDENT_UPDATE_CSV,formData).then(data => {
                    vm.uploading = false
                    $('#modal-update-excel').modal('hide')
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
        }
    }
</script>