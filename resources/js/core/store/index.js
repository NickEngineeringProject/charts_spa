import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import chart from "./chart";
const store = new Vuex.Store({
    modules: {chart}
})

export const {dispatch, commit, getters} = store

export default store
