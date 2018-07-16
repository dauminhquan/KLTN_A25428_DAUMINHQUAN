<template>
    <tr :will-delete="willDelete">
        <td class="check-item">
            <td-checkbox :checkAll="checkAll" :id-item="item.id"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
        </td>
        <td><a :href="infoPost(item.id,item.accept)" target="_blank">{{item.title_post}}</a>

        </td>
        <td>{{coverDate(item.created_at)}}</td>
        <td><span v-for="position in item.positions" :key="position.name_position" class="label label-primary" >{{position.name_position}}</span></td>
        <td><span v-for="type in item.types" :key="type.name_job_type" class="label label-info" >{{type.name_job_type}}</span></td>
        <td><span class="label label-default" v-if="item.accept == 0">Đang đợi</span> <span class="label label-danger" v-else-if="item.accept == 2">Đã hủy</span> <span v-else class="label label-success" >Đã đăng</span> </td>
        <td class="text-center">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li @click="request_delete"><a href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> Xóa bài viết</a></li>
                        <li @click="openInforPost(item.id)"><a href="javascript:void(0)"><i class="glyphicon glyphicon-edit"></i> Sửa bài đăng</a></li>
                    </ul>
                </li>
            </ul>
        </td>
    </tr>

</template>
<script>
    import tdCheckbox from './tdCheckbox'
    import configUrl from './../../../../config'
    export default {
        components: {
          'td-checkbox' :tdCheckbox
        },
        props:['item','checkAll'],
        data(){
          return {
              willDelete: false,
              configUrl: new configUrl()
          }
        },
        methods: {
            push_id_item_selected(id){
                this.willDelete = true
                this.$emit('push_item_selected',id)

            },
            getAvatar(url){
              return window.location.origin+url
            },
            pop_id_item(id){
                this.willDelete = false
                this.$emit('pop_item_selected',id)
            },
            request_delete(){
                this.willDelete = true
                var vm = this
                vm.$emit('request_delete_item',vm.item.id)
            },
            infoPost(id,accept)
            {
                let vm = this
                if(accept == '1')
                {
                    return vm.configUrl.WEB_JOB_JOB_DETAIL(id)
                }
                if(accept == 2)
                {
                    return 'javascript:void()'
                }
                return vm.configUrl.WEB_ENTERPRISE_POST(id)

            },
            openInforPost(id){
                let vm = this
                window.open(vm.configUrl.WEB_ENTERPRISE_POST(id),'_blank')
            },
            coverDate(newDate){
                let date = new Date(newDate)

                return date.getDate()+'/'+date.getMonth()+'/'+date.getFullYear()
            }
        }
    }
</script>
