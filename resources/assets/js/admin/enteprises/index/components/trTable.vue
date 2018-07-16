

<template>
    <tr :will-delete="willDelete">
        <td class="check-item">
            <td-checkbox :checkAll="checkAll" :id-item="item.id"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
        </td>
        <td class="avatar-user"><img :src="getAvatar(item.avatar_enterprise)" alt=""></td>
        <td ><a :href="infoEnterprise(item.user_enterprise)">{{item.name_enterprise}}</a></td>
        <td>{{item.user_enterprise}}</td>
        <td>{{item.name_president_enterprise}}</td>
        <td>{{item.address_enterprise}}</td>
        <td>{{DateCreated(item.created_at)}}</td>
        <td class="text-center">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li @click="request_delete"><a href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> Xóa doanh nghiệp</a></li>
                        <li @click="openInforEnterprise(item.user_enterprise)"><a href="javascript:void(0)"><i class="icon-info22"></i> Thông tin chi tiết</a></li>
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
            infoEnterprise(user_enterprise)
            {
                return this.configUrl.WEB_ADMIN_ENTERPRISE_MANAGE_INFO_ENTERPRISE+'?user_enterprise='+user_enterprise
            },
            openInforEnterprise(user_enterprise){
                window.open(this.configUrl.WEB_ADMIN_ENTERPRISE_MANAGE_INFO_ENTERPRISE+'?user_enterprise='+user_enterprise,'_blank')
            },
            DateCreated(date)
            {
                let d = new Date(date)
                return d.getDate()+'/'+d.getMonth()+'/'+d.getFullYear()
            }
        }
    }
</script>
