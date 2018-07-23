<template>
    <select :required="required" :multiple="multiple" :data-placeholder="dataPlaceholder" class="select">
        <option v-if="noneSelect"></option>

    </select>
</template>
<script>
    export default {
        props: ['options','readonly','unReadonly', 'value','data-placeholder','required','multiple','none-select'],
        updated(){

        },
        mounted: function () {
            var vm = this

            // $el chính nó

            if(vm.readonly == true)
            {
                vm.select =  $(this.$el).select2({
                    data: vm.options,
                    multiple:vm.multiple,
                    placeholder: vm.dataPlaceholder
                })
                    .val(this.value)
                    .trigger('change')
                    // emit event on change.
                    .on('change', function () {
                        if(vm.select != null)
                        {
                            if(vm.multiple == true)
                            {
                                vm.$emit('input', $(this).val())
                            }
                            else{
                                vm.$emit('input', this.value)
                            }
                        }


                    })
            }
            else{

                vm.select= $(this.$el).select2(
                    {
                        data: vm.options,
                        multiple:vm.multiple,
                        placeholder: vm.dataPlaceholder
                    })
                    .val(this.value)
                    .trigger('change')
                    // emit event on change.
                    .on('change', function (i) {

                        if(vm.cn != 0)
                        {
                            if(vm.multiple == 'true')
                            {

                                vm.$emit('input', $(this).val())
                            }
                            else{
                                vm.$emit('input', this.value)
                            }

                        }
                        else{
                            vm.cn = 1
                        }

                    })
            }
        },
        watch: {
            value: function (value) {
                if(this.cn == 0)
                {
                    console.log(value)
                    $(this.select).val(value).trigger('change')
                }
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
        },
        data(){
            return {
                select: null,
                cn : 0
            }
        }
    }
</script>