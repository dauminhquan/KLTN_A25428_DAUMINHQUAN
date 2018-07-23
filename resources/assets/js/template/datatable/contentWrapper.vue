<template>
    <!-- Main content -->
    <div class="content-wrapper" id="content-wrapper">
        <datatable></datatable>
    </div>
    <!-- /main content -->
</template>
<script>
    import datatable from './components/datatable.vue'
    import Vue from 'vue'

    Vue.component('datatable',datatable)
    export default {
        data(){
            return {

            }
        }
    }
</script>