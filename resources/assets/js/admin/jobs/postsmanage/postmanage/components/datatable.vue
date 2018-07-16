<template>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Danh sách sinh viên</h5>
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
                <th></th>
                <th>Doanh nghiệp</th>
                <th>Tiêu đề</th>
                <th>Thời gian gửi</th>
                <th>Tình trạng</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody id="table_body">

            <tr-table v-for="item in dataRows" :key="item.id_item" :item="item" :checkAll="checkAll" @request_delete_item="confirm_delete_item($event)"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></tr-table>
            </tbody>
        </table>


        <!-- Danger modal -->
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

    import axios from '../../../../../axios/index'
    import configUrl from '../../../../../config/index'
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
            this.getPosts()
        },
        mounted(){
                this.setDatatable()
            // console.log(this.table.fnGetData())

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

                    buttons: {
                        columnDefs: [ { orderable: false, targets: [0,1,6] }],
                        buttons: [
                            {
                                extend: 'colvis',
                                text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                                className: 'btn bg-blue btn-icon'
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
                // console.log($(item).parents('tr'))
            },
            confirm_delete(){
                var vm = this
                vm.deleting = true
                axios.delete(vm.configUrl.API_ENTERPRISE_POST,
                    {
                        params: {
                            list_id_post : vm.id_item_selected
                        }
                    }).then(data => {
                    vm.posts = vm.posts.filter(value =>{
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
                        text: 'Đã xóa thành công '+vm.id_item_selected.length+' bài viết',
                        addclass: 'bg-success'
                    });
                    vm.id_item_selected = []
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ server',
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


            getPosts(){
                var vm = this
                axios.get(vm.configUrl.API_ADMIN_JOB_MANAGE_GET_LIST_JOB,{
                    params:{
                        get_all : true
                    }
                }).then(data => {
                   vm.dataRows = data.data
                    vm.posts = data.data
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
                axios.delete(vm.configUrl.API_ENTERPRISE_POST+'/'+id).then(data => {
                    vm.posts = vm.posts.filter(value =>{
                        return value.id !=id
                    })
                    var rows_selected = vm.fnGetSelected(vm.table)

                    for (var i = 0; i < rows_selected.length; i++) {
                        vm.table.fnDeleteRow(rows_selected[i])
                    };
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công bài viết',
                        addclass: 'bg-success'
                    });
                    vm.id_item_selected = []
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ server',
                        addclass: 'bg-danger'
                    });
                })

            }
        },
        data(){
            return {
                checkAll: false,
                table: '',
                id_item_selected: [],
                posts: [],
                ExcelFileuploading: false,
                dataRows: [],
                ExcelFileUpload: '',
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