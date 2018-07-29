<template>
    <div class="content-wrapper" id="content-wrapper">
        <data-table title="Quản lý mức lương"
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

                            <p> <i class="icon-warning"></i> Bạn đang xóa nhiều mục. Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
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
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title"><i class="icon-info3"></i> Thông tin mức lương</h6>
                        </div>

                        <div class="modal-body">

                           <div class="row">
                               <div class="form-group">
                                   <label><b>Tên mức lương</b></label>
                                   <input type="text" v-model="info.about" class="form-control">
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
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title"><i class="icon-info3"></i> Thông tin mức lương</h6>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="form-group">
                                    <label><b>Tên mức lương</b></label>
                                    <input type="text" v-model="nameCreate" class="form-control">
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
        data(){
            return {
                columns : [
                ],
                buttonConfig: [
                ],
                deleting: false,
                updating: false,
                creating: false,
                data :[],
                menu: [
                    {
                        action :'view',
                        html:'<a href="#"><i class="icon-info3"></i> Thông tin chi tiết</a>'
                    },
                    {
                        action :'delete',
                        html:'<a href="#"><i class="icon-trash"></i> Xóa mức lương</a>'
                    }
                ],
                primaryKey: 'id',
                lengths: [50,100,200,500,1000,2000,5000],
                itemSelected: [],
                primaryKeyDelete: -1,
                buttonConfig: [
                    {
                        text: 'Thêm mới',
                        className: 'btn bg-primary',
                        action: function(e, dt, node, config) {
                            $('#modal_create').modal('show')
                        }
                    },
                ],
                deletedSelectItem: false,
                resetCheck:false,
                pages: [],
                page:1,
                totalPage:0,
                perPage:500,
                info:{
                  name: ''
                },
                nameCreate:'',
                config: new config(),
            }
        },
        mounted(){
            this.getData()
        },
        methods: {

            getData(perPage=500,page=1){
                var vm = this
                axios.get(vm.config.API_ADMIN_SALARIES_RESOURCE+'?size='+perPage+'&page='+page).then(data => {
                    vm.data = data.data.data
                    vm.perPage = data.data.per_page
                    vm.totalPage = data.data.total
                    vm.columns = [
                        {
                            key: 'id',
                            text: 'ID mức lương'
                        },
                        {
                            key:'about',
                            text:'Giá trị'
                        }
                        ,
                        {
                            key:'created_at',
                            text: 'Thời gian tạo'
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
                axios.post(vm.config.API_ADMIN_SALARIES_RESOURCE,{
                    about:vm.nameCreate
                }).then(data => {
                    vm.config.notifySuccess('Thêm mới thành công')
                    vm.creating = false
                    vm.nameCreate=''
                    vm.getData()
                    $('#modal_create').modal('hide')
                }).catch(err => {
                    console.dir(err)
                    vm.config.notifyError()
                })
            },
            updateItem(){
                let vm = this
                vm.updating = true
              axios.put(vm.config.API_ADMIN_SALARIES_RESOURCE+'/'+vm.info.id,{
                  about:vm.info.about
              }).then(data => {
                  vm.config.notifySuccess('Update thông tin loại cv thành công')
                  vm.updating = false
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
                    axios.delete(vm.config.API_ADMIN_SALARIES_RESOURCE+'/'+vm.primaryKeyDelete).then(data => {
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
                axios.delete(vm.config.API_ADMIN_SALARIES_DELETE_LIST,{
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
                let positions = vm.data.filter(item => {
                    return item.id == id
                })
                if(positions.length > 0)
                {
                    vm.info = positions[0]
                }
                $('#modal_info').modal('show')
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