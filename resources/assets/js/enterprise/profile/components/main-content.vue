<template>
    <div class="content-wrapper">

        <!-- Tab content -->
        <div class="tab-content">
            <profile :active="true" :email_address_enterprise="email_address_enterprise" ></profile>

            <employee :email_address_enterprise="email_address_enterprise"></employee>

        </div>
        <!-- /tab content -->
    </div>
</template>
<script>
    import profile from './profile.vue'
    import employee from './employee.vue'

    export default {
        components: {

            'profile' : profile,
            'employee': employee,

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