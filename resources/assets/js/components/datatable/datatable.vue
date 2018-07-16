<template>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{title}}</h5>
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
                    <div class="btn-group navbar-btn">
                        <button type="button" class="btn btn-default btn-icon btn-checkbox-all">
                            <div class="checker"><span :class="styleCheck"><input type="checkbox" v-model="checked" class="styled"></span></div>
                        </button>

                        <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);"  v-if="checked == false">Chọn tất cả</a></li>
                            <li><a href="javascript:void(0);"  v-if="checked == true">Bỏ chọn tất cả</a></li>
                            <li><a href="javascript:void(0);" >Xóa mục đã chọn</a></li>
                        </ul>
                    </div>
                </th>
                <th v-for="column in columns" :key="column">
                    {{column}}
                </th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody id="table_body">

            <!--<tr-table v-for="item in dataRows" :key="item.id_item" :item="item" :checkAll="checkAll" @request_delete_item="confirm_delete_item($event)"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></tr-table>-->
            </tbody>
        </table>
        <slot name="extend">

        </slot>
    </div>
</template>
<script>



    export default {
        props: ['title','columns','targets','buttonsConfig','dataRows'],
        components:{

        },
        computed: {
            getCheck(){
                return this.checked;
            }
        },
        mounted(){
            this.checked = this.selected
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

                let buttonsConfig = [
                    {
                        extend: 'colvis',
                        text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                        className: 'btn bg-blue btn-icon'
                    }
                ]

                vm.buttonsConfig.forEach((item) => {
                    buttonsConfig.push(item)
                })

                this.table = $('#table').dataTable({
                    columnDefs: [ { orderable: false, targets: vm.targets }],
                    buttons: {
                        buttons: buttonsConfig
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

            push_id_item_selected(id){
                this.id_item_selected.push(id)
                this.table.$('tr[will-delete="true"]')
            },

            selectAll(){
                if(this.checked == true)
                {
                    this.checked = false
                }
                else{
                    this.checked = true
                }
            },


        },
        data(){
            return {
                checkAll: false,
                table: '',
                id_item_selected: [],
                checked:false,
                styleCheck: ''
            }
        },
    }
</script>
<style>
    .avatar-user{
        width: 100px;

    }
    .avatar-user img{
        border-radius: 50%;
        width: 100%;
    }
    .check-all{
        width: 200px
    }
    .check-item div.checker{
        margin-left: 30px;
    }
</style>