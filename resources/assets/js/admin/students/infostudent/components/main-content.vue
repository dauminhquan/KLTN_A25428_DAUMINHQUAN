<template>
    <div class="content-wrapper">


        <div class="tab-content">
            <profile :active="true" :code_student="code_student" ></profile>

            <work :code_student="code_student"></work>
        </div>

    </div>
</template>
<script>
    import profile from './profile.vue'
    import work from './work.vue'
    export default {
        components: {
            'profile' : profile,
            'work': work
        },
        data(){
            return {

            }
        },
        mounted(){



        },
        props:["code_student"]
    }
</script>