<template>
    <div class="checkbox">
        <label class="display-block">
            <div class="checker" @click="clicked"><span :class="checked"><input type="checkbox" class="styled"></span></div>
            {{text}}
        </label>
    </div>
</template>
<script>

    export default {
        watch:{
            checked(value){
                if(value == null)
                {
                    this.$emit('checked',[this.value,null])
                }
                else{
                    this.$emit('checked',[this.value,1])
                }
            }
        },
        props: ['text', 'value'],
        data() {
            return {
                checked: null
            }
        },
        methods:{
            clicked() {
                this.checked = this.checked === null?'checked' : null
            }
        }
    }
</script>