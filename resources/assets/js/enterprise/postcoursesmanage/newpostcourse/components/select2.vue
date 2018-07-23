<template>
    <select :required="required" :multiple="multiple" :data-placeholder="dataPlaceholder" class="select">
        <option v-if="noneSelect"></option>
        <!--<option v-for="option in options">{{option.name}}</option>-->
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
                    .val(vm.value)
                    .trigger('change')
                    // emit event on change.
                    .on('change', function () {
                        if(vm.multiple == true)
                        {
                            vm.$emit('input', $(this).val())
                        }
                        else{
                            vm.$emit('input', this.value)
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
                    .on('change', function () {

                        if(vm.multiple == 'true')
                        {

                            vm.$emit('input', $(this).val())
                        }
                        else{
                            vm.$emit('input', this.value)
                        }
                    })
            }
        },
        watch: {
            value: function (value) {
                // update value
                if(this.select != null)
                {
                    $(this.$el)
                        .val(value)
                }


            },
            unReadonly(vl){
                if(vl != '' && vl!=null)
                {
                    $(this.$el).select2({ disabled:false })
                }
            },
            options: function (options) {
                // var vm = this
                $(this.$el).empty().select2({ data: options })
                // $(this.$el)
                //     .val(vm.value)
                //     .trigger('change')
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        },
        data(){
            return {
                select: null
            }
        }
    }
</script>