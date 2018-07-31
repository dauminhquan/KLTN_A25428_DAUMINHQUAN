<template>
    <div class="content-wrapper">
        <form v-on:submit.prevent="submitInsert">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Điền thông tin thông báo</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tiêu đề thông báo:</label>
                                        <input type="text" v-model="info.title" placeholder="Tiêu đề thông báo" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mô tả:</label>
                                        <input type="text" placeholder="Mô tả thông báo" v-model="info.description" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nội dung thông báo</label>
                                <textarea id="textarea-info" rows="5" cols="5" class="form-control" v-model="info.content" placeholder="Điền nội dung thông báo"></textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Thêm mới thông báo <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    import axios from './../../../../axios'
    import config from './../../../../config'
    export default {
        data(){
            return {
                info:{
                    name:'',
                    title: '',
                    description: '',
                    content: '',
                },
                config : new config(),
            }
        },
        mounted(){
            let vm = this
            CKEDITOR.replace('textarea-info').on('change',function () {
                vm.info.content = this.getData()
            })
        },
        methods:{
            submitInsert(){
                let vm =this
                axios.post(vm.config.API_ADMIN_NOTIFIES_RESOURCE,vm.info).then(data => {
                   vm.config.notifySuccess()
                    setTimeout(function () {
                        window.location.href = vm.config.WEB_ADMIN_NOTIFIES
                    },2000)
                }).catch(err => {
                    console.dir(err)
                    if(err.response.status == 422)
                    {
                        let message = ''
                        message = err.response.data.message
                        message+= '<br>'
                        let errors = err.response.data.errors
                        let keys = Object.keys(errors)
                        keys.forEach(key => {
                            errors[key].forEach(item => {
                                message+=item+'<br>'
                            })
                        })
                        vm.config.notifyError(message)
                    }
                    else{
                        vm.config.notifyError()
                    }
                })
            },
        },
    }
</script>