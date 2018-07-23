import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex)
export default new Vuex.Store({
    state(){
        selected: []
    },
    mutations:{
        setSelected(state,selected)
        {
            state.selected = selected
        }
    },
    getters: {
        getSelected(state)
        {
            return state.selected
        }
    }
})