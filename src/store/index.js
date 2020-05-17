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
		},
		ADD_PART: function (state, payload) {
			state.parts.push(payload);
		},
		REMOVE_PART: function (state, payload) {
			state.parts = [
				...state.parts.filter(x => x._kp_part !== payload)
			]
		}
	},
	actions: {
	},
	modules: {
	}
})
