<template>
    <div class="content-wrapper" id="content-wrapper">
        <datatable></datatable>
    </div>

</template>
<script>
    import table from './components/datatable.vue'

    export default {
        components: {
            'datatable' : table
        },
        data(){
            return {

            }
        }
    }
</script>