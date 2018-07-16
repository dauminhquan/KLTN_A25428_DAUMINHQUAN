<template>
    <div class="checker"><span :class="styleCheck"><input type="checkbox" v-model="checked"  class="styled"></span></div>
</template>
<script>
    export default {
        computed: {
          getCheck(){
              return this.checked;
          },
          getCheckAll(){
            return this.checkAll
          }
        },
        data(){
            return {
                checked: false,
                styleCheck: ''
            }
        },
        props:['checkAll'],
        watch:{
            getCheck: {
                handler(new_value,old_value)
                {
                    if(new_value == true)
                    {
                        this.styleCheck = 'checked'
                    }
                    else{
                        this.styleCheck=''
                    }
                },
                deep:true
            },
            getCheckAll:{
                handler(new_value,old_value)
                {
                    console.log(new_value)
                    if(new_value == true)
                    {
                        this.checked = true

                    }
                    else
                    {
                        this.checked = false

                    }
                }
            }
        }
    }
</script>