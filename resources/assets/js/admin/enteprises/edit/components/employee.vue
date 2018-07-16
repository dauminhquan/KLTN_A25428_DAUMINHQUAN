<template>
    <div class="tab-pane fade" id="employee">

        <!-- Orders history -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Thông tin về công việc</h6>

            </div>



            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th colspan="2">Sinh viên</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Chức vụ</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for=" employee in employees" :key="employee.code_student">
                        <td class="no-padding-right avatar-user" style="width: 45px;">
                            <a :href="openStudentInfo(employee.code_student)" target="_blank">
                                <img :src="getAvatar(employee.avatar_student)" height="60" class="" alt="">
                            </a>
                        </td>
                        <td>
                            <a :href="openStudentInfo(employee.code_student)" target="_blank" class="text-semibold">{{employee.first_name_student+' '+employee.last_name_student}}</a>
                            <div class="text-muted text-size-small" style="width: 200px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                                <span class="status-mark bg-grey position-left"></span>
                                {{employee.branch}}
                            </div>
                        </td>
                        <td>{{getDate(employee.time_start)}}</td>
                        <td>{{getDate(employee.time_end)}}</td>
                        <td>
                            <a href="javascript:void(0)">{{employee.position}}</a>
                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- /orders history -->

    </div>
</template>
<script>
    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    export default {

        props: ['email_address_enterprise'],
        data() {
            return {
                employees: [],
                configUrl: new configUrl()
            }
        },
        methods: {
            getEmployees()
            {
                var vm = this
                axios.get(vm.configUrl.API_ADMIN_ENTERPRISE_MANAGE_GET_EMPLOYEE_ENTERPRISE+'?email_address_enterprise='+vm.email_address_enterprise).then(data => {
                    console.log(data)
                    vm.employees = data.data
                }).catch(err => {
                    console.log(err)
                })
            },
            getAvatar(url){
                return window.location.origin+url
            },
            getDate(time)
            {
                if(time == null)
                {
                    return null
                }
                return time.date
            },
            openStudentInfo(code_student)
            {
                return this.configUrl.WEB_ADMIN_STUDENT_MANAGE_INFO_STUDENT+'?code_student='+code_student
            }
        },
        mounted(){
            this.getEmployees()
        }
    }
</script>
<style>
    .avatar-user{

    }
    .avatar-user img{
        border-radius: 50%;
        width: 60px;
    }

</style>