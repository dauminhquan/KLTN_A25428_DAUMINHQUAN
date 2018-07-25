<template>
    <div class="content-wrapper">
        <div class="tab-content">
            <profile v-if="active == 'profile'" :keyItem="keyItem" @updateNameItem="updateNameItem" @updateAvatar="updateAvatar"></profile>
            <students v-if="active == 'students'" :keyItem="keyItem"></students>
            <jobs v-if="active == 'jobs'" :keyItem="keyItem"></jobs>
        </div>
    </div>
</template>
<script>
    import profile from './profile.vue'
    import works from './works.vue'
    import jobs from './jobs'
    export default {
        components: {
            'jobs': jobs,
            'profile' : profile,
            'students': works,
        },
        props:["key-item",'active'],
        methods: {
            updateNameItem(nameItem){
                let vm =this
                vm.$emit('updateNameItem',nameItem)
            },
            updateAvatar(avatar){
                let vm =this
                vm.$emit('updateAvatar',avatar)
            }
        }
    }
</script>