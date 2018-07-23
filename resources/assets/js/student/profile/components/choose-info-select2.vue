<template>
    <select :required="required" :multiple="multiple" :data-placeholder="dataPlaceholder" class="select">
        <option></option>

    </select>
</template>
<script>
    export default {
        props: ['options','readonly','unReadonly', 'value','data-placeholder','required','multiple'],
        updated(){

        },
        mounted: function () {
            var vm = this
            console.log(this.value)

            if(vm.readonly == true)
            {
                $(this.$el).select2({ data: vm.options,disabled:true })
                    .val(vm.value)
                    .trigger('change')

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
            value: function (value) {
                // update value

                $(this.$el)
                    .val(value)
                    .trigger('change')
            },
            unReadonly(vl){
                if(vl != '' && vl!=null)
                {
                    $(this.$el).select2({ disabled:false })
                }
            },
            options: function (options) {
                var vm = this
                $(this.$el).empty().select2({ data: options })
                $(this.$el)
                    .val(vm.value)
                    .trigger('change')
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }
</script>