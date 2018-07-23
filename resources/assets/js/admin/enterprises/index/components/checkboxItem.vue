<template>

    <div class="checker">
         <span :class="classChecked">
             <input type="checkbox" @click="clicked" class="styled">
         </span>
    </div>
</template>
<script>
    export default {
        props: ['allChecked'],
        data(){
          return {
              classChecked: ''
          }
        },
        methods:{
            clicked(){
                if(this.classChecked == '')
                {
                    this.classChecked = 'checked'
                }
                else{
                    this.classChecked = ''
                }
                this.$emit('setClicked')
            }
        },
        watch:{
            allChecked(value){
                if(value == true)
                {
                    this.classChecked = 'checked'
                }
                else{
                    this.classChecked = ''
                }
            }
        }
    }
</script>