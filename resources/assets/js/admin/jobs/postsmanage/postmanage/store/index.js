import store from 'vuex'
import vue from 'vue'
vue.use(store)
export  default new store.Store({
    state: {
        hello: 'dsa'
    },
    mutations: {
        setHello(state,value)
        {
            state.hello = value
        }
    }
})