<template>
    <div class="content-wrapper">

        <!-- Tab content -->
        <div class="tab-content">
            <profile :active="true" :email_address_enterprise="email_address_enterprise" ></profile>

            <employee :email_address_enterprise="email_address_enterprise"></employee>
            <list-post :email_address_enterprise="email_address_enterprise"></list-post>
            <list-post-course :email_address_enterprise="email_address_enterprise"></list-post-course>
        </div>
        <!-- /tab content -->
    </div>
</template>
<script>
    import profile from './profile.vue'
    import employee from './employee.vue'
    import list_post from './list_post'
    import list_post_course from './list_post_course'
    export default {
        components: {
            'list-post': list_post,
            'profile' : profile,
            'employee': employee,
            'list-post-course': list_post_course,
        },
        data(){
            return {

            }
        },
        mounted(){

        },
        props:["email_address_enterprise"]
    }
</script>