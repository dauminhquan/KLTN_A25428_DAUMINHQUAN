<template>
    <div class="tab-pane fade" id="list_post">


        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Thông tin về công việc</h6>

            </div>


            <div class="table-responsive">
                <table id="table" class="table tasks-list table-lg">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tiêu đề bài đăng</th>
                        <th>Ngày đăng</th>
                        <th>Tình trạng</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="row in dataRows">
                        <td>{{row.id}}</td>
                        <td>
                            <div class="text-semibold"><a :href="null">{{row.title_post}}</a></div>
                            <div class="text-muted">{{row.description_post}}</div>
                        </td>
                        <td>
                            <div class="input-group input-group-transparent">
                                <div class="input-group-addon"><i class="icon-calendar2 position-left"></i></div>
                                {{row.created_at}}
                            </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a :href="null" class="label label-danger" v-if="row.accept == -1">Không được đăng</a>
                                <a :href="null" class="label label-default" v-if="row.accept == 0">Đang đợi</a>
                                <a :href="null" class="label label-success" v-if="row.accept == 1">Đã đăng</a>

                            </div>
                        </td>



                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu9"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right">

                                        <li><a :href="null" @click="openEdit(row.id)"><i class="icon-pencil"></i> Sửa bài viết</a></li>
                                        <li><a :href="null" @click="confirm_delete_item(row.id)"><i class="icon-trash" ></i> Xóa bài viết</a></li>
                                        <li><a :href="null" v-if="row.accept == 0" @click="acceptPost(row.id)"><i class="icon-check2"></i> Xác nhận bài viết</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /orders history -->

    </div>

</template>

<script>
    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    export default {
        mounted(){
            this.setDatatable()
            this.getPosts()
        },
        props: ['email_address_enterprise']
        ,
        beforeUpdate(){
            this.table.fnDestroy()
        },
        updated(){
            this.$nextTick(function () {

                this.setDatatable()
            })
        },
        methods: {
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
                this.table = $('#table').dataTable({});
                // Add placeholder to the datatable filter option
                $('.dataTables_filter input[type=search]').attr('placeholder','Nhập từ khóa');


                // Enable Select2 select for the length option
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


            getPosts(){
                var vm = this
                axios.get(vm.configUrl.API_ADMIN_JOB_MANAGE_GET_LIST_JOB,{
                    params:{
                        email_address_enterprise: vm.email_address_enterprise
                    }
                }).then(data => {
                    vm.dataRows = data.data
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
                axios.delete(vm.configUrl.API_ENTERPRISE_POST+'/'+ id).then(data => {
                    vm.dataRows = vm.dataRows.filter(value =>{
                        return value.id !=id
                    })
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công doanh nghiệp',
                        addclass: 'bg-success'
                    });
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ serve',
                        addclass: 'bg-danger'
                    });
                })

            },
            acceptPost(id){
                let vm = this
                axios.put(vm.configUrl.API_ADMIN_JOB_MANAGE_ACCEPT_POST(id)).then(data => {
                    let index = vm.dataRows.findIndex((item) => {
                            return item.id == id
                    })

                    vm.dataRows[index].accept = 1
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Chấp nhận thành công',
                        addclass: 'bg-success'
                    });
                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ server',
                        addclass: 'bg-danger'
                    });
                })
            },
            openEdit(id){
                let vm = this
                window.open(vm.configUrl.WEB_ADMIN_JOB_MANAGE_JOBS_ID(id),'_blank')
            }
        },
        data(){
            return {
                table: '',
                dataRows: [],
                configUrl: new configUrl(),

            }
        }
    }
</script>

