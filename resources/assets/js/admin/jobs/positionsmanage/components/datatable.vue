<template>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Chức vụ</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <table id="table" class="table datatable-button-html5-columns">
            <thead>
            <tr>
                <th class="check-all">
                    <th-check-all :selected="false" @delete_selected="delete_selected" @setcheckAll="setCheckAllData"></th-check-all>
                </th>
                <th>Tên chức vụ</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody id="table_body">

            <tr-table v-for="item in dataRows" @showEdit="showEdit" :key="item.id_item" :item="item" :checkAll="checkAll" @request_delete_item="confirm_delete_item($event)"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></tr-table>
            </tbody>
        </table>


        <div id="modal-push-position" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title">Nhập tên chức vụ</h5>
                    </div>
                    <form v-on:submit.prevent="submitPushPosition" class="form-inline" enctype="multipart/form-data">

                        <div class="modal-body">
                            <input type="text"class="form-control" v-model="add_name_position">
                            <div class="pace-demo" v-if="addingPositon == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary">Thêm mới <i class="icon-plus22"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="modal-edit-position" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title">Sửa chức vụ</h5>
                    </div>
                    <form v-on:submit.prevent="submitEditPostion" class="form-inline" enctype="multipart/form-data">

                        <div class="modal-body">
                            <input type="text" required class="form-control" v-model="item_position_edit.name_position">
                            <div class="pace-demo" v-if="addingPositon == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary">Thêm mới <i class="icon-plus22"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                        <button type="button" class="btn btn-danger" @click="confirm_delete">Xác định xóa</button>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>

    import tdCheckbox from './tdCheckbox.vue'
    import thCheckAll from './thCheckAll.vue'
    import trTable from './trTable.vue'

    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    export default {

        components:{
            'td-checkbox' : tdCheckbox,
            'th-check-all': thCheckAll,
            'tr-table': trTable,
        },

        computed: {
            getDataRows(){
                return this.dataRows
            }
        },
        beforeCreate(){


        },
        beforeMount(){
            this.getPositions()
        },
        mounted(){
                this.setDatatable()


        },
        beforeUpdate(){
            this.table.fnDestroy()
        },
        updated(){
            this.$nextTick(function () {

                this.setDatatable()
            })
        }
        ,
        methods: {
            setCheckAllData(vl){
                this.checkAll = vl
            },
            setDatatable()
            {
                $.extend( $.fn.dataTable.defaults, {
                    autoWidth: false,
                    dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>Tìm kiếm:</span> _INPUT_',
                        lengthMenu: '<span>Hiển thị:</span> _MENU_',
                        paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
                    }
                });
                this.table = $('#table').dataTable({
                    columnDefs: [ { orderable: false, targets: [0] }],
                    buttons: {
                        buttons: [
                            {
                                extend: 'colvis',
                                text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                                className: 'btn bg-blue btn-icon'
                            },
                            {
                                text: 'Thêm mới',
                                className: 'btn bg-primary',
                                action: function(e, dt, node, config) {
                                    $('#modal-push-position').modal('show')

                                }
                            },
                        ]
                    }
                });

                $('.dataTables_filter input[type=search]').attr('placeholder','Nhập từ khóa');



                $('.dataTables_length select').select2({
                    minimumResultsForSearch: Infinity,
                    width: 'auto'
                });
                $('a.dt-button.buttons-collection.buttons-colvis.btn.bg-blue.btn-icon[tabindex="0"][aria-controls="table"]').click(function () {
                   if($(this).attr('removed') == undefined)
                   {
                       $('a.dt-button.buttons-columnVisibility.active[tabindex="0"]')[0].remove()
                       $(this).attr('removed',1)
                   }

                })

            },
            pop_id_item(id_item){
                this.id_item_selected = this.id_item_selected.filter(value => {
                    return value != id_item
                })
            },
            delete_selected(){
                $('#modal_danger').modal('show')

            },
            confirm_delete(){
                var vm = this
                vm.deleting = true
                axios.delete(vm.configUrl.API_ADMIN_JOB_MANAGE_DELETE_LIST_POSITION,
                    {
                        params: {
                            list_id_position : vm.id_item_selected
                        }
                    }).then(data => {
                    vm.positions = vm.positions.filter(value =>{
                        return vm.id_item_selected.indexOf(value.id) == -1
                    })
                    var rows_selected = vm.fnGetSelected(vm.table)

                    for (var i = 0; i < rows_selected.length; i++) {
                        vm.table.fnDeleteRow(rows_selected[i])
                    };

                    vm.deleting = false
                    $('#modal_danger').modal('hide')
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công '+vm.id_item_selected.length+' chức vụ',
                        addclass: 'bg-success'
                    });
                    vm.id_item_selected = []
                }).catch(err => {
                    console.log(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ serve',
                        addclass: 'bg-danger'
                    });
                })

            },
            push_id_item_selected(id){
                this.id_item_selected.push(id)
                this.table.$('tr[will-delete="true"]')
            },
            fnGetSelected( oTableLocal )
            {
                return oTableLocal.$('tr[will-delete="true"]');
            },
            getPositions(){
                var vm = this
                axios.get(vm.configUrl.API_ADMIN_JOB_MANAGE_GET_LIST_POSITION).then(data => {
                   vm.dataRows = data.data
                    vm.positions = data.data
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: err.response.data,
                        addclass: 'bg-danger'
                    });
                })
            },
            confirm_delete_item(id){
                var vm = this
                vm.deleting = true
                axios.delete(vm.configUrl.API_ADMIN_JOB_MANAGE_DELETE_POSITION,
                    {
                        params: {
                            id : id
                        }
                    }).then(data => {
                    vm.positions = vm.positions.filter(value =>{
                        return value.id !=id
                    })
                    var rows_selected = vm.fnGetSelected(vm.table)

                    for (var i = 0; i < rows_selected.length; i++) {
                        vm.table.fnDeleteRow(rows_selected[i])
                    };
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: data.data.message,
                        addclass: 'bg-success'
                    });
                    vm.id_item_selected = []
                    vm.deleting = false
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ serve',
                        addclass: 'bg-danger'
                    });
                })

            },
            showEdit(id_postion)
            {
                var vm = this
                var item_position = vm.positions.filter(item => {
                    return item.id == id_postion
                })[0]
                vm.item_position_edit.id = item_position.id
                vm.item_position_edit.name_position = item_position.name_position
                $('#modal-edit-position').modal('show')
            },
            submitPushPosition(){
                var vm =this

                axios.post(vm.configUrl.API_ADMIN_JOB_MANAGE_ADD_POSITION,{
                    name_position:vm.add_name_position
                }).then(data => {
                    $('#modal-push-position').modal('hide')
                    console.log(data)
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: data.data.message,
                        addclass: 'bg-success'
                    });
                    vm.add_name_position= ''
                    vm.getPositions()
                }).catch(err => {
                    console.dir(err)
                    var err_html = ''
                    err.response.data.name_position.forEach(value => {
                        err_html+=value+'<br>'
                    })
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: err_html,
                        addclass: 'bg-danger'
                    });
                })
            },
            submitEditPostion(){
                var vm = this
                if(vm.item_position_edit.id == '')
                {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi! Chức vụ chưa được xác định',
                        text: err_html,
                        addclass: 'bg-danger'
                    });
                }
                else{
                    axios.put(vm.configUrl.API_ADMIN_JOB_MANAGE_EDIT_POSITION,vm.item_position_edit).then(data => {
                        new PNotify({
                            title: 'Ohh Yeah! Thành công!',
                            text: data.data.message,
                            addclass: 'bg-success'
                        });
                        this.getPositions()
                        $('#modal-edit-position').modal('hide')
                    }).catch(err => {
                        console.dir(err)
                        var err_html = ''
                        err.response.data.name_position.forEach(value => {
                            err_html+=value+'<br>'
                        })
                        new PNotify({
                            title: 'Ohh! Có lỗi xảy ra rồi!',
                            text: err_html,
                            addclass: 'bg-danger'
                        });
                    })
                }
            }
        },
        data(){
            return {
                checkAll: false,
                table: '',
                id_item_selected: [],
                item_position_edit: {
                    id: '',
                    name_position: ''
                },
                positions: [],
                add_name_position: '',
                addingPositon: false,
                dataRows: [],
                deleting: false,
                configUrl: new configUrl()

            }
        },
        watch:{
            getDataRows: {
                    handler(old){
                        // console.log(old)
                        // console.log($('#table_body').html())
                    },
                    deep: true
                }
        },
    }
</script>
<style>
    .avatar-user{
        width: 45px;
        height: 60px;
    }
    .avatar-user img{
        border-radius: 50%;
        width: 50px;
    }
    .check-all{
        width: 200px
    }
    .check-item div.checker{
        margin-left: 30px;
    }
</style>