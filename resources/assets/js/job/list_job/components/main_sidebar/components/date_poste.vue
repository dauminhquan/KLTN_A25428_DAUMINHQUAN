<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-calendar3 position-left"></i>
                Ngày đăng
            </div>
            <div class="heading-elements not-collapsible">
                <a href="#" class="heading-text">+ Add</a>
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>
        <form action="#">
            <div class="panel-body">
                <div class="form-group">
                    <div class="radio no-margin-top">
                        <label>
                            <input type="radio" name="when_posted" value="0" class="styled" v-model="dates_selected">
                            Hôm nay

                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" value="1" class="styled" v-model="dates_selected">
                            Hôm qua

                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" value="2" class="styled" v-model="dates_selected">
                            Tuần trước

                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" class="styled" value="3" v-model="dates_selected">
                            Tháng trước
                        </label>
                    </div>

                    <div class="radio no-margin-bottom">
                        <label>
                            <input type="radio" name="when_posted" class="styled" value="4" v-model="dates_selected">
                            Bất kỳ lúc nào
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>

    export default {
        computed:{
            get_dates_selected(){
                return this.dates_selected
            }
        },
        props: [],
        data(){
            return {

                dates : [],
                dates_selected: []
            }
        },
        methods:{

        },


        beforeUpdate(){

        },
        updated(){
            $(".styled, .multiselect-container input").uniform({
                radioClass: 'choice'
            });
        },

        mounted(){


        }
        ,
        watch:{
            get_dates_selected: {
                handler(newValue){
                    this.$emit('change_dates_selected',newValue)
                },
                deep: true
            }
        }
    }
</script>