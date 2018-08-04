<template>
    <div class="content-wrapper">
        <div class="tab-content">
            <profile @updateNameItem="updateNameItem" @updateAvatar="updateAvatar"></profile>
        </div>
    </div>
</template>
<script>
    import profile from './profile.vue'
    export default {
        components: {
            'profile' : profile,
        },
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