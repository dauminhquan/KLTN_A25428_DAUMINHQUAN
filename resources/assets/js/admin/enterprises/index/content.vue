<template>
    <div class="content-wrapper" id="content-wrapper">
        <data-table title="Xin chao cac ban"
                    :columns="columns"
                    :data="data"
                    :targets="[]"
                    :buttonConfig="buttonConfig"
                    :resetCheck="resetCheck"
                    :menu="menu"
                    :primaryKey="primaryKey"
                    @selectAll="selectAll"
                    @unSelectAll="unSelectAll"
                    @deleteSelected="deleteSelected"
                    @action="action($event)"
                    @clickedKeyItem="clickedKeyItem"
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

        </data-table>
    </div>
</template>
<script>
    import table from './components/table.vue'
    var $ = require('jquery')
    import 'select2'
    import PNotify from 'pnotify/dist/es/PNotifyCompat'
    import axios from './../../../axios'
    import config from './../../../config'
    export default {
        components: {
            'data-table' : table
        },
        data(){
            return {
                columns : [
                    {
                        key: 'name',
                        text: 'Tên'
                    },
                    {
                        key: 'email',
                        text: 'Địa chỉ Email'
                    }
                ],
                buttonConfig: [
                    {
                        text: 'Thêm mới',
                        className: 'btn bg-primary',
                        action: function(e, dt, node, config) {
                            window.open(this.config.WEB_ADMIN_ENTERPRISE)
                        }
                    }
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
                        html:'<a href="#"><i class="icon-trash"></i> Xóa doanh nghiệp</a>'
                    }
                ],
                primaryKey: 'id',
                itemSelected: [],
                primaryKeyDelete: -1,
                deletedSelectItem: false,
                config: new config(),
                resetCheck:false
            }
        },
        mounted(){
            this.getData()
        },
        methods: {

            getData(){
                var vm = this
                axios.get(vm.config.API_ADMIN_ENTERPRISES_RESOURCE).then(data => {
                    vm.data = data.data
                    vm.columns = [
                        {
                            key: 'id',
                            text: 'ID doanh nghiệp'
                        },
                        {
                            key:'name',
                            text: 'Tên doanh nghiệp'
                        },
                        {
                            key:'address',
                            text: 'Địa chỉ'
                        },
                        {
                            key:'email_address',
                            text: 'Địa chỉ Email'
                        },

                    ]
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ serve',
                        addclass: 'bg-danger'
                    });
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
                            new PNotify({
                                title: 'Ohh Yeah! Thành công!',
                                text: 'Đã xóa thành công doanh nghiệp',
                                addclass: 'bg-success'
                            });
                        }
                        else
                        {
                            new PNotify({
                                title: 'Ohh! Có lỗi xảy ra rồi!',
                                text: 'Hình như có gì đó không đúng. Hãy load lại trang nhé',
                                addclass: 'bg-warning'
                            });
                        }
                        vm.deleting = false
                        $('#modal_danger').modal('hide')
                        $('div.checker>span').removeClass('checked')
                    }).catch(err => {
                        console.log(err)
                        new PNotify({
                            title: 'Ohh! Có lỗi xảy ra rồi!',
                            text: 'Đã có lỗi từ serve',
                            addclass: 'bg-danger'
                        });
                        vm.deleting = false
                        $('#modal_danger').modal('hide')
                    })
                }
                else{
                    vm.deleting = false
                    $('#modal_danger').modal('hide')
                }
            }
            ,
            clickedKeyItem(item)
            {
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
            deleteListItem()
            {


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

                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công danh sách doanh nghiệp',
                        addclass: 'bg-success'
                    });
                    vm.itemSelected = []
                    vm.resetCheck = !vm.resetCheck

                }).catch(err => {
                    $('#modal-danger-delete-list').modal('hide')
                    vm.deleting = false
                    console.log(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ serve',
                        addclass: 'bg-danger'
                    });
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
            showItem(id)
            {
                let vm = this
                window.open(vm.config.WEB_ADMIN_ENTERPRISES+'/'+id+'/edit','_blank')
            }
        }
    }
</script>