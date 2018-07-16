

<template>
    <tr :will-delete="willDelete">
        <td class="check-item">
            <td-checkbox :checkAll="checkAll" :id-item="item.id"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
        </td>
        <td class="avatar-user">
            <img :src="getAvatar(item.avatar_student)" alt="">
            <div class="text-grey text-size-small" style="width: 100%;text-align: center;padding-top:5px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">

                {{item.code_student}}
            </div>
        </td>
        <td><a :href="infoStudent(item.code_student)">{{item.first_name_student + ' ' +item.last_name_student}}</a>

        </td>
        <td>{{item.name_department}}</td>
        <td>{{item.name_branch}}</td>
        <td>{{item.name_course}}</td>
        <td><span class="label label-default" v-if="item.graduated == 1">Đã tốt nghiệp</span> <span v-else class="label label-success" >Chưa tốt nghiệp</span> </td>
        <td class="text-center">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li @click="request_delete"><a href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> Xóa sinh viên</a></li>
                        <li @click="openInforStudent(item.code_student)"><a href="javascript:void(0)"><i class="icon-info22"></i> Thông tin chi tiết</a></li>
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
            infoStudent(code_student)
            {
                return this.configUrl.WEB_ADMIN_STUDENT_MANAGE_INFO_STUDENT+'?code_student='+code_student
            },
            openInforStudent(code_student){
                window.open(this.configUrl.WEB_ADMIN_STUDENT_MANAGE_INFO_STUDENT+'?code_student='+code_student,'_blank')
            }
        }
    }
</script>
