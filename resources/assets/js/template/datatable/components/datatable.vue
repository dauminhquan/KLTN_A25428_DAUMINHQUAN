<template>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Danh sách</h5>
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
                <th>
                    <th-check-all :selected="false" @setcheckAll="setCheckAllData"></th-check-all>
                </th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Job Title</th>
                <th>DOB</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                   <td-checkbox :checkAll="checkAll"></td-checkbox>
                </td>
                <td>Maaarth</td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Jackelyn</td>
                <td>Weible</td>
                <td><a href="#">Airline Transport Pilot</a></td>
                <td>3 Oct 1981</td>
                <td><span class="label label-default">Inactive</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Aura</td>
                <td>Hard</td>
                <td>Business Services Sales Representative</td>
                <td>19 Apr 1969</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Nathalie</td>
                <td><a href="#">Pretty</a></td>
                <td>Drywall Stripper</td>
                <td>13 Dec 1977</td>
                <td><span class="label label-info">Pending</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Sharan</td>
                <td>Leland</td>
                <td>Aviation Tactical Readiness Officer</td>
                <td>30 Dec 1991</td>
                <td><span class="label label-default">Inactive</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Maxine</td>
                <td><a href="#">Woldt</a></td>
                <td><a href="#">Business Services Sales Representative</a></td>
                <td>17 Oct 1987</td>
                <td><span class="label label-info">Pending</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Sylvia</td>
                <td><a href="#">Mcgaughy</a></td>
                <td>Hemodialysis Technician</td>
                <td>11 Nov 1983</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Lizzee</td>
                <td><a href="#">Goodlow</a></td>
                <td>Technical Services Librarian</td>
                <td>1 Nov 1961</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Lizzee</td>
                <td><a href="#">Goodlow</a></td>
                <td>Technical Services Librarian</td>
                <td>1 Nov 1961</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Lizzee</td>
                <td><a href="#">Goodlow</a></td>
                <td>Technical Services Librarian</td>
                <td>1 Nov 1961</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Lizzee</td>
                <td><a href="#">Goodlow</a></td>
                <td>Technical Services Librarian</td>
                <td>1 Nov 1961</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Lizzee</td>
                <td><a href="#">Goodlow</a></td>
                <td>Technical Services Librarian</td>
                <td>1 Nov 1961</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Lizzee</td>
                <td><a href="#">Goodlow</a></td>
                <td>Technical Services Librarian</td>
                <td>1 Nov 1961</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Lizzee</td>
                <td><a href="#">Goodlow</a></td>
                <td>Technical Services Librarian</td>
                <td>1 Nov 1961</td>
                <td><span class="label label-danger">Suspended</span></td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Kennedy</td>
                <td>Haley</td>
                <td>Senior Marketing Designer</td>
                <td>18 Dec 1960</td>
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
            <tr>
                <td><td-checkbox :checkAll="checkAll"></td-checkbox></td>
                <td>Chantal</td>
                <td><a href="#">Nailor</a></td>
                <td>Technical Services Librarian</td>
                <td>10 Jan 1980</td>
                <td><span class="label label-default">Inactive</span></td>
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
    import store from './../store'
    import tdCheckbox from './tdCheckbox.vue'
    import thCheckAll from './thCheckAll.vue'
    export default {
        components:{
            'td-checkbox' : tdCheckbox,
            'th-check-all': thCheckAll
        },
        store:store,
        computed: {
            getSelected(){
                return this.$store.getters.getSelected
            }
        },
        mounted(){
            this.setDatatable()

        },
        methods: {
            setCheckAllData(vl){
                this.checkAll = vl
            },
            setdata(){
                this.table.destroy()
            },
            setDatatable()
            {
                $.extend( $.fn.dataTable.defaults, {
                    autoWidth: false,
                    dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>Filter:</span> _INPUT_',
                        lengthMenu: '<span>Show:</span> _MENU_',
                        paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
                    }
                });
                this.table = $('#table').DataTable({
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
                                className: 'btn bg-teal-400',
                                action: function(e, dt, node, config) {
                                    swal({
                                        title: "Good job!",
                                        text: "Custom button activated",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success"
                                    });
                                    addSelect()
                                }
                            }
                        ]
                    }
                });
                // Add placeholder to the datatable filter option
                $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


                // Enable Select2 select for the length option
                $('.dataTables_length select').select2({
                    minimumResultsForSearch: Infinity,
                    width: 'auto'
                });
            },

        },
        data(){
            return {
                checkAll: false,
                table: ''
            }
        },
        watch:{
            getSelected:{
                handle(old_value,new_value)
                {
                    console.log(old_value,new_value)
                }
            }
        },
    }
</script>