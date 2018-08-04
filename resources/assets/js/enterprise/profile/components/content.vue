<template>
    <div class="page-content">
        <main-sidebar  :nameItem="nameItem" :avatar="avatar"></main-sidebar>
        <main-content :active="active" @updateNameItem="updateNameItem" @updateAvatar="updateAvatar"></main-content>
    </div>
</template>
<script>
    import mainSidebar from './main-sidebar.vue'
    import mainContent from './main-content'
    export default {
        components: {
            'main-sidebar' : mainSidebar,
            'main-content': mainContent
        },
        data(){
          return {
              nameItem: '',
              avatar: '',
              active:'',
          }
        },
        methods:{
            updateNameItem(nameItem){

                this.nameItem = nameItem
            },
            updateAvatar(avatar){
                this.avatar = avatar
            },
        }
    }
</script>