<template>
    <div class="content-wrapper">
        <cards-layout :updateData="updateData" @set_total_page="total_page = $event" :current_page="current_page"></cards-layout>
        <pagination @set_current_page="current_page = $event" :current_page="current_page" :total_page="total_page"></pagination>
    </div>
</template>
<script>
    import cards_layout from './components/cards_layout.vue'
    import pagination from './components/pagination.vue'

    export default {
        props: ['updateData'],
        components: {
            'cards-layout' : cards_layout,
            'pagination' : pagination
        },
        data(){
            return {
                current_page: 1,
                total_page: null
            }
        },

    }
</script>