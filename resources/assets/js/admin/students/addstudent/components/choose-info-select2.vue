<template>
    <select :required="required" :data-placeholder="dataPlaceholder" class="select">
        <option></option>
        <!--<option v-for="option in options">{{option.name}}</option>-->
    </select>
</template>
<script>
    export default {
        props: ['options','readonly','unReadonly', 'value','data-placeholder','required'],
        mounted: function () {
            var vm = this
            // $el chính nó
            if(vm.readonly == true)
            {
                $(this.$el).select2({ data: vm.options,disabled:true })
                    .val(this.value)
                    .trigger('change')
                    // emit event on change.
                    .on('change', function () {
                        vm.$emit('input', this.value)
                    })
            }
            else{
                $(this.$el).select2({ data: vm.options })
                    .val(this.value)
                    .trigger('change')
                    // emit event on change.
                    .on('change', function () {
                        vm.$emit('input', this.value)
                    })
            }
        },
        watch: {
            // value: function (value) {
            //     // update value
            //     $(this.$el)
            //         .val(value)
            //         .trigger('change')
            // },
            unReadonly(vl){
                if(vl != '' && vl!=null)
                {
                    $(this.$el).select2({ disabled:false })
                }
            },
            options: function (options) {
                $(this.$el).empty().select2({ data: options })
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }
</script>