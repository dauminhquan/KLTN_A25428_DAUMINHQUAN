<template>

    <div class="sidebar sidebar-main sidebar-default sidebar-separate">
        <div class="sidebar-content">
            <sidebar-search @search="search" @change_keyword="keyword = $event" @change_types_job_selected="types_job_selected = $event"></sidebar-search>
            <location-selection  @change_cities_selected="cities_selected = $event"></location-selection>
            <title-selection @change_positions_selected="positions_selected = $event"></title-selection>

            <company-selection  @change_enterprises_selected="enterprises_selected = $event"></company-selection>
            <specific-skills @change_skills_selected="skills_selected = $event"></specific-skills>
            <date-posted @change_dates_selected="dates_selected = $event"></date-posted>
            <latest-searches></latest-searches>
        </div>
    </div>
</template>
<script>
    import sidebar_search from './components/sidebar_search.vue'
    import location_selection from './components/localtion_selecttion.vue'
    import title_selection from './components/title_search.vue'

    import company_selection from './components/company_search.vue'
    import specific_skills from './components/specific_skills.vue'
    import date_posted from './components/date_poste.vue'
    import latest_search from './components/latest_searches.vue'
    import store from './../../Store'
    export default {
        store,
        computed:{
            get_key_query(){
                return this.$store.state.key_query
            },
            get_cities_selected(){
                return this.cities_selected
            },
            get_positions_selected(){
                return this.positions_selected
            },
            get_enterprises_selected(){
                return this.enterprises_selected
            },
            get_skills_selected(){
                return this.skills_selected
            },
            get_dates_selected(){
                return this.dates_selected
            },
            get_keyword(){
                return this.keyword
            },
            get_types_job_selected(){
                return this.types_job_selected
            }
        },
        components: {
            "sidebar-search" : sidebar_search,
            'location-selection' : location_selection,
            'title-selection' : title_selection,

            'company-selection' : company_selection,
            'specific-skills' : specific_skills,
            'date-posted' : date_posted,
            'latest-searches' : latest_search
        },
        mounted(){

        },
        data(){
            return {
                types_job_selected:[],
                cities_selected: [],
                positions_selected: [],
                enterprises_selected: [],
                skills_selected: [],
                dates_selected: [],
                keyword: '',
                key_query: {
                    eventSearch: false
                }
            }
        },
        methods: {
            search(){

                var vm = this
                vm.key_query.eventSearch= vm.key_query.eventSearch == true?false:true
                vm.$store.commit('setDetail',{})
                vm.$store.commit('updateKeyQuery',vm.key_query)
            }
        },
        watch:{
            get_cities_selected: {
                handler(newValue){
                    this.key_query.cities_selected= newValue
                },
                deep: true
            },
            get_positions_selected:{
                handler(newValue){
                    this.key_query.positions_selected= newValue
                },
                deep: true
            },
            get_enterprises_selected:{
                handler(newValue){
                    this.key_query.enterprises_selected= newValue
                },
                deep: true
            },
            get_skills_selected:{
                handler(newValue){
                    this.key_query.skills_selected= newValue
                },
                deep: true
            },
            get_dates_selected:{
                handler(newValue){
                    this.key_query.dates_selected= newValue
                },
                deep: true
            },
            get_keyword:{
                handler(newValue){
                    this.key_query.keyword= newValue
                },
                deep: true
            },
            get_types_job_selected:{
                handler(newValue){
                    this.key_query.types_job_selected = newValue
                },
                deep: true
            },
            get_dates_selected:{
                handler(newValue){
                    this.key_query.dates_selected = newValue
                },
                deep: true
            }

        }
    }
</script>