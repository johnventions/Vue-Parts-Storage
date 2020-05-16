import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		parts: null
	},
	mutations: {
		SET_PARTS: function (state, payload) {
			state.parts = payload;
		}
	},
	actions: {
	},
	modules: {
	}
})
