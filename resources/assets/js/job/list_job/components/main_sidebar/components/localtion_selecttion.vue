<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-pin-alt position-left"></i>
                Vị trí địa lý
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
                    <div class="checkbox no-margin-top" v-for="(local,index) in locals" v-if="index < max_show">
                        <label>
                            <input type="checkbox" class="styled" v-model="cities_selected" :value="local">
                            {{local}}
                        </label>
                    </div>
                </div>
            </div>
            <div class="panel-footer no-padding">
                <a href="javascript:void(0)" class="btn btn-default btn-block no-border" @click="max_show = locals.length" v-if="max_show < locals.length">Xem tất cả vị trí</a>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        computed:{
            get_cities_selected(){
                return this.cities_selected
            }
        },
        props: [],
        data(){
            return {

                locals : [
                    "An Giang"
                    ,"Bà Rịa - Vũng Tàu"
                    ,"Bắc Giang"
                    ,"Bắc Kạn"
                    ,"Bạc Liêu"
                    ,"Bắc Ninh"
                    ,"Bến Tre"
                    ,"Bình Định"
                    ,"Bình Dương"
                    ,"Bình Phước"
                    ,"Bình Thuận"
                    ,"Cà Mau"
                    ,"Cao Bằng"
                    ,"Đắk Lắk"
                    ,"Đắk Nông"
                    ,"Điện Biên"
                    ,"Đồng Nai"
                    ,"Đồng Tháp"
                    ,"Gia Lai"
                    ,"Hà Giang"
                    ,"Hà Nam"
                    ,"Hà Tĩnh"
                    ,"Hải Dương"
                    ,"Hậu Giang"
                    ,"Hòa Bình"
                    ,"Hưng Yên"
                    ,"Khánh Hòa"
                    ,"Kiên Giang"
                    ,"Kon Tum"
                    ,"Lai Châu"
                    ,"Lâm Đồng"
                    ,"Lạng Sơn"
                    ,"Lào Cai"
                    ,"Long An"
                    ,"Nam Định"
                    ,"Nghệ An"
                    ,"Ninh Bình"
                    ,"Ninh Thuận"
                    ,"Phú Thọ"
                    ,"Quảng Bình"
                    ,"Quảng Nam"
                    ,"Quảng Ngãi"
                    ,"Quảng Ninh"
                    ,"Quảng Trị"
                    ,"Sóc Trăng"
                    ,"Sơn La"
                    ,"Tây Ninh"
                    ,"Thái Bình"
                    ,"Thái Nguyên"
                    ,"Thanh Hóa"
                    ,"Thừa Thiên Huế"
                    ,"Tiền Giang"
                    ,"Trà Vinh"
                    ,"Tuyên Quang"
                    ,"Vĩnh Long"
                    ,"Vĩnh Phúc"
                    ,"Yên Bái"
                    ,"Phú Yên"
                    ,"Cần Thơ"
                    ,"Đà Nẵng"
                    ,"Hải Phòng"
                    ,"Hà Nội"
                    ,"TP HCM"
                ],
                cities_selected: [],
                max_show: 10
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
            get_cities_selected: {
                handler(newValue){
                    this.$emit('change_cities_selected',newValue)
                },
                deep: true
            }
        }
    }
</script>