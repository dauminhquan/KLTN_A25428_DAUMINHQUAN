<template>
    <div class="content-wrapper" id="content-wrapper">
        <data-table title="Xin chao cac ban" :columns="columns" :data="data" :targets="[]" :buttonConfig="[]"
        @selectAll="selectAll" @unSelectAll="unSelectAll"
                    @action="action($event)"
                    @clickedKeyItem="clickedKeyItem"
                    :menu="menu"
                    :primaryKey="primaryKey"

        />
    </div>
</template>
<script>
    import table from './components/table.vue'
    import axios from 'axios'
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
                data :[],
                menu: [
                    {
                        action :'view',
                        html:'<a href="#"><i class="icon-file-excel"></i> Nhap Exel</a>'
                    }
                ],
                primaryKey: 'code',
                itemSelected: [],
            }
        },
        mounted(){
          this.getData()
        },
        methods: {
            getData(){
                axios.get('http://127.0.0.1:8000/api/admin/manage-courses/resource').then(data => {
                    var vm = this
                    vm.data = data.data
                    vm.columns = [
                        {
                            key: 'code',
                            text: 'Ma SV'
                        },
                        {
                            key:'name',
                            text: 'Ten'
                        }
                    ]
                }).catch(err => {
                    console.log(err)
                })
                this.data = [
                    {
                        name: 'Dau Minh quan',
                        email: 'Địa chỉ email'
                    }
                ]
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


                let indexOf = -1
                let vm = this
                vm.data.forEach((item,index) => {
                    if(item[vm.primaryKey] == event[0])
                    {
                        indexOf = index
                    }
                })
                vm.data.splice(indexOf,1)
            },
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
            }
        }
    }
</script>