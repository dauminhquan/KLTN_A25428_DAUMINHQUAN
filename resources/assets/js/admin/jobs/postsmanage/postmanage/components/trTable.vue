

<template>
    <tr :will-delete="willDelete">
        <td class="check-item">
            <td-checkbox :checkAll="checkAll" :id-item="item.id"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
        </td>
        <td class="avatar-user"><img :src="getAvatar(item.avatar_enterprise)" alt=""></td>
        <td><a :href="infoEnterprise(item.user_name)" target="_blank">{{item.name_enterprise}}</a></td>
        <td><a :href="infoPost(item.id,item.accept)" target="_blank">{{item.title_post}}</a></td>
        <td>{{getDate(item.created_at)}}</td>

        <td><span class="label label-default" v-if="item.accept == 0 && accepted == false">Đang đợi duyệt</span> <span v-else-if="item.accept == 1 || accepted == true" class="label label-success" >Đã đăng</span> <span v-else class="label label-danger" >Đã hủy</span> </td>
        <td class="text-center">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li @click="request_delete"><a href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> Xóa bài viết</a></li>
                        <li @click="openInforPost(item.id)"><a href="javascript:void(0)"><i class="glyphicon glyphicon-edit"></i> Sửa bài viết</a></li>
                        <li v-if="item.accept == 0 && accepted == false" @click="acceptPost(item.id)"><a href="javascript:void(0)"><i class="icon-checkbox-checked2"></i> Xác nhận bài viết</a></li>
                    </ul>
                </li>
            </ul>
        </td>
    </tr>

</template>
<script>
    import tdCheckbox from './tdCheckbox'
    import configUrl from './../../../../../config'
    import axios from './../../../../../axios'
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
            infoEnterprise(user_name)
            {
                return this.configUrl.WEB_ADMIN_ENTERPRISE_MANAGE_INFO_ENTERPRISE+'?user_enterprise='+user_name
            },
            infoPost(id,accept){
                if(accept == '1')
                {
                    return this.configUrl.WEB_JOB_JOB_DETAIL(id)
                }
                if(accept == 0)
                {
                    return this.configUrl.WEB_ADMIN_JOB_MANAGE_JOBS_ID(id)
                }


            },
            openInforPost(id){
                window.open(this.configUrl.WEB_ADMIN_JOB_MANAGE_JOBS_ID(id),'_blank')
            },
            getDate(date){
                let d = new Date(date)
                return d.getDate() + '/'+d.getMonth()+'/'+d.getFullYear()
            },
            acceptPost(id){
                let vm = this
                    axios.put(vm.configUrl.API_ADMIN_JOB_MANAGE_ACCEPT_POST(id)).then(data => {
                        vm.accepted = true
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
            }
        }
    }
</script>
