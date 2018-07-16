<template>
    <div class="btn-group navbar-btn">
        <button type="button" class="btn btn-default btn-icon btn-checkbox-all">
            <div class="checker"><span :class="styleCheck"><input type="checkbox" v-model="checked" class="styled"></span></div>
        </button>

        <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>

        <ul class="dropdown-menu">
            <li><a href="javascript:void(0);" @click="selectAll" v-if="checked == false">Chọn tất cả</a></li>
            <li><a href="javascript:void(0);" @click="selectAll" v-if="checked == true">Bỏ chọn tất cả</a></li>
        </ul>
    </div>
</template>
<script>
    export default {
        mounted(){
          this.checked = this.selected
        },
        computed: {
            getCheck(){
                return this.checked;
            }
        },
        data(){
            return {
                checked:false,
                styleCheck: ''
            }
        },
        props: ['selected']
        ,
        watch:{
            getCheck: {
                handler(new_value,old_value)
                {
                    this.$emit('setcheckAll',new_value)
                    if(new_value == true)
                    {
                        this.styleCheck = 'checked'
                    }
                    else{
                        this.styleCheck=''
                    }
                },
                deep:true
            }
        },
        methods: {
            selectAll(){
                if(this.checked == true)
                {
                    this.checked = false
                }
                else{
                    this.checked = true
                }
            }
        }
    }
</script>