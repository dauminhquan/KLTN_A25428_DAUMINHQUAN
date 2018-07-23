

<template>
    <tr :will-delete="willDelete">
        <td class="check-item">
            <td-checkbox :checkAll="checkAll" :id-item="item.id"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
        </td>
        <td><a :href="null" target="_blank">{{item.admin}}</a></td>
        <td><a :href="null" target="_blank">{{item.title_notify}}</a></td>
        <td>{{getDate(item.created_at)}}</td>

        <td class="text-center">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li @click="request_delete"><a href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> Xóa thông báo</a></li>
                        <li @click="openInforNotify(item.id)"><a href="javascript:void(0)"><i class="glyphicon glyphicon-edit"></i> Sửa thông báo</a></li>

                    </ul>
                </li>
            </ul>
        </td>
    </tr>

</template>
<script>
    import tdCheckbox from './tdCheckbox'
    import configUrl from './../../../../config'
    import axios from './../../../../axios'
    export default {
        components: {
          'td-checkbox' :tdCheckbox
        },
        props:['item','checkAll'],
        data(){
          return {
              willDelete: false,
              accepted: false,
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
           
            infoNotify(id,accept){
                if(accept == '1')
                {
                    return this.configUrl.WEB_JOB_JOB_DETAIL(id)
                }
                if(accept == 0)
                {
                    return this.configUrl.WEB_ADMIN_JOB_MANAGE_JOBS_ID(id)
                }


            },
            openInforNotify(id){
                window.open(this.configUrl.WEB_ADMIN_NOTIFY_MANAGE_UPDATE_NOTIFY(id),'_blank')
            },
            getDate(date){
                let d = new Date(date)
                return d.getDate() + '/'+d.getMonth()+'/'+d.getFullYear()
            },

        }
    }
</script>
