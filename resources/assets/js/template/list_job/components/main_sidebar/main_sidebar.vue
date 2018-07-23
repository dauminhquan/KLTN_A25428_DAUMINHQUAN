<template>

    <div class="sidebar sidebar-main sidebar-default sidebar-separate">
        <div class="sidebar-content">
            <sidebar-search></sidebar-search>
            <location-selection></location-selection>
            <title-selection></title-selection>

            <company-selection></company-selection>
            <specific-skills></specific-skills>
            <date-posted></date-posted>
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

    export default {
        components: {
            "sidebar-search" : sidebar_search,
            'location-selection' : location_selection,
            'title-selection' : title_selection,

            'company-selection' : company_selection,
            'specific-skills' : specific_skills,
            'date-posted' : date_posted,
            'latest-searches' : latest_search
        }
    }
</script>