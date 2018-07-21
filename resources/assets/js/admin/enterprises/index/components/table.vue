<template>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{title}}</h5>
        </div>
        <table id="table-test" class="table datatable-basic">
            <thead>
            <tr>
                <th>
                    <div class="btn-group navbar-btn">
                        <button type="button" class="btn btn-default btn-icon btn-checkbox-all">
                            <div class="checker"><span ><input type="checkbox"class="styled"></span></div>
                        </button>

                        <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);">Chọn tất cả</a></li>
                            <li><a href="javascript:void(0);">Bỏ chọn tất cả</a></li>
                            <li><a href="javascript:void(0);">Xóa mục đã chọn</a></li>
                        </ul>
                    </div>
                </th>
                <th v-for="column in columns" :key="column.key" v-html="column.text"></th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in data">
                <td>
                    <div class="checker">
                        <span>
                            <input type="checkbox" class="styled">
                        </span>
                    </div>
                </td>
                <td><a href="#">Enright</a></td>
                <td>Traffic Court Referee</td>
                <td>22 Jun 1972</td>
                <td><span class="label label-success">Active</span></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                                <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    // import $ from 'jquery'
    export default {
        props: ['title','data','columns','showCheck'],
        data(){
            return {
                selectAll: false,
                table: null,
                idSelected: [],
                checked:false,
            }
        },
        mounted(){
            this.Init()
        },
        methods: {
            Init()
            {
                let vm = this
                $.extend( $.fn.dataTable.defaults, {
                    autoWidth: false,
                    dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>Tìm kiếm:</span> _INPUT_',
                        lengthMenu: '<span>Hiển thị:</span> _MENU_',
                        paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
                    }
                });
                this.table = $('#table-test').dataTable({
                    // columnDefs: [ { orderable: false, targets: [0,1,7] }],
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


                                }
                            },
                            {
                                text: 'Thêm bằng Excel',
                                className: 'btn bg-success',
                                action: function(e, dt, node, config) {


                                }
                            },
                            {
                                text: 'Tải xuống Excel',
                                className: 'btn bg-purple',
                                action: function(e, dt, node, config) {

                                }
                            }
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
        },
    }
</script>