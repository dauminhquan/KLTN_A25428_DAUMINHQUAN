<template>
    <data-table title="Quản lý tin tuyển dụng"
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

                        <p> <i class="icon-warning"></i> Bạn đang xóa nhiều doanh nghiệp. Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
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
                        <h5 class="modal-title">Thêm doanh nghiệp bằng Excel</h5>
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
    </data-table>
</template>

<script>
    import 'select2'
    import axios from './../../../../axios'
    import config  from './../../../../config'
    import table from './../../../../components/datatable/table'
    export default {
        components:{
          'data-table' : table
        },
        mounted(){
            this.getData()
        },
        props: ['keyItem'],
        data(){
            return {
                columns : [
                ],
                buttonConfig: [
                ],
                deleting: false,
                data :[],
                menu: [
                    {
                        action :'view',
                        html:'<a href="#"><i class="icon-info3"></i> Thông tin chi tiết</a>'
                    },
                    {
                        action :'delete',
                        html:'<a href="#"><i class="icon-trash"></i> Xóa bài viết</a>'
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
            }
        },
        methods:{
            getData(perPage=500,page=1){
                var vm = this
                axios.get(vm.config.API_ADMIN_ENTERPRISES_LIST_JOB_ID(vm.keyItem)+'?size='+perPage+'&page='+page).then(data => {
                    vm.data = data.data.data
                    vm.perPage = data.data.per_page
                    vm.totalPage = data.data.total
                    vm.columns = [
                        {
                            key: 'id',
                            text: 'ID bài đăng'
                        },
                        {
                            key:'name',
                            text: 'Tên doanh nghiệp'
                        },
                        {
                            key:'title',
                            text: 'Tiêu đề'
                        },
                        {
                            key:'created_at',
                            text: 'Thời gian gửi'
                        },
                        {
                            key:'accept',
                            text: 'Trạng thái'
                        },

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
            deleteItem(){
                let vm = this
                vm.deleting = true

                if(vm.primaryKeyDelete != -1)
                {
                    let indexOf = -1
                    axios.delete(vm.config.API_ADMIN_ENTERPRISES_RESOURCE+'/'+vm.primaryKeyDelete).then(data => {
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
                axios.delete(vm.config.API_ADMIN_ENTERPRISES_DELETE_LIST,{
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
                window.open(vm.config.WEB_ADMIN_ENTERPRISES+'/'+id+'/edit','_blank')
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
                axios.post(vm.config.API_ADMIN_ENTERPRISES_IMPORT_CSV,formData).then(data => {
                    vm.uploading = false
                    $('#modal-push-excel').modal('hide')
                    if(data.data.message == [])
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

