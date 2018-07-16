<template>
    <div class="content-wrapper">
        <cards-layout></cards-layout>
        <pagination></pagination>
    </div>
</template>
<script>
    import cards_layout from './components/cards_layout.vue'
    import pagination from './components/pagination.vue'
    export default {
        components: {
            'cards-layout' : cards_layout,
            'pagination' : pagination
        }
    }
</script>