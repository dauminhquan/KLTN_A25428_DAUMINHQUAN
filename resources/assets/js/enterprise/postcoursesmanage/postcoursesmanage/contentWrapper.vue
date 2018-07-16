<template>

    <div class="content-wrapper" id="content-wrapper">
        <datatable></datatable>
    </div>

</template>
<script>
    import datatable from './components/datatable.vue'

    export default {
        components: {
            'datatable' : datatable
        },
        data(){
            return {

            }
        }
    }
</script>