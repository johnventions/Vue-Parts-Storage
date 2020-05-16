<template>
	<div class="home">
		<div>
			<input v-model="searchTerm">
		</div>
		<ul>
			<li v-for="part in filteredList" v-bind:key="part._kp_id">
				{{ part.name }}
			</li>
		</ul>
	</div>
</template>

<script>
import { mapState } from 'vuex';
// @ is an alias to /src

export default {
	name: 'Home',
	components: {
	},
	data: function () {
		return {
			searchTerm: ''
		}
	},
	computed: mapState({
		parts: state => state.parts,
		filteredList: function (state) {
			if (this.searchTerm !== '') {
				return state.parts.filter(x => {
					return x.name.toLowerCase().indexOf(this.searchTerm.toLowerCase()) > -1
				});
			}
			return state.parts;
		}

	}),
	methods: {
	}
}
</script>
