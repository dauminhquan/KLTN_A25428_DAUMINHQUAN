<template>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{title}}</h5>
        </div>
        <table id="data-table" class="table datatable-basic">
            <thead>
            <tr>
                <th>
                    <div class="btn-group navbar-btn">
                        <button type="button" class="btn btn-default btn-icon btn-checkbox-all" @click="selectAll">
                            <div class="checker"><span :class="checked"><input type="checkbox"class="styled"></span></div>
                        </button>

                        <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);" v-if="!allChecked" @click="selectAll">Chọn tất cả</a></li>
                            <li><a href="javascript:void(0);" v-if="allChecked" @click="unSelectAll">Bỏ chọn tất cả</a></li>
                            <li><a href="javascript:void(0);" @click="deleteSelected">Xóa mục đã chọn</a></li>
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
                    <checkbox-item @setClicked="checkedItem(item[primaryKey])" :allChecked="allChecked"></checkbox-item>

                </td>
                <td v-for="column in columns" :key="column.key" v-html="item[column.key]"></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li  v-for="li in menu" :key="li.action" v-html="li.html" @click="action(item[primaryKey],li.action)"></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
        <slot></slot>
    </div>

</template>
<script>
    import checkboxItem from './checkboxItem'
    export default {

        components:{
          'checkbox-item':checkboxItem
        },
        props: ['title','data','columns','showCheck','targets','buttonConfig','primaryKey','menu'],
        data(){
            return {
                table: null,
                idSelected: [],
                checked:'',
                allChecked: false,
            }
        },
        beforeUpdate(){
            this.table.fnDestroy()
        },
        updated(){
            this.$nextTick(function () {

                this.Init()
            })
        },
        mounted(){
            var vm = this

            this.Init()
        }
        ,
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
                let length = vm.columns.length
                var configted = false;
                vm.buttonConfig.forEach(item => {
                    if(item.extend == 'colvis')   {
                        configted = true
                    }
                })
                if(configted == false)
                {
                    vm.buttonConfig.push({
                        extend: 'colvis',
                        text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                        className: 'btn bg-blue btn-icon'
                    })
                }

                let targets = [0,length]
                targets = targets.concat(vm.targets)
                vm.table = $('#data-table').dataTable({
                    columnDefs: [ { orderable: false, targets: targets }],
                    buttons: {
                        buttons: vm.buttonConfig
                    }
                });

                $('.dataTables_filter input[type=search]').attr('placeholder','Nhập từ khóa');



                $('.dataTables_length select').select2({
                    minimumResultsForSearch: Infinity,
                    width: 'auto'
                });
                $('a.dt-button.buttons-collection.buttons-colvis.btn.bg-blue.btn-icon[tabindex="0"][aria-controls="data-table"]').click(function () {
                    if($(this).attr('removed') == undefined)
                    {
                        $('a.dt-button.buttons-columnVisibility.active[tabindex="0"]')[0].remove()
                        $(this).attr('removed',1)
                    }

                })

            },
            selectAll(){
                this.doChecked()
                this.allChecked = !this.allChecked
                this.$emit('selectAll')
            },
            unSelectAll(){
                this.doChecked()
                this.allChecked = false
                this.$emit('unSelectAll')
            },
            checkedItem(key)
            {
              this.$emit('clickedKeyItem',key)
            },
            doChecked(){
                if(this.checked == '')
                {
                    this.checked = 'checked'
                }
                else{
                    this.checked = ''
                }
            },

            deleteSelected(){
                this.$emit('deleteSelected')
            },
            action(key,action)
            {

                this.$emit('action',[key,action])
            }
        },
    }
</script>