<template>
	<div id="app">
		<router-view/>
	</div>
</template>

<style lang="stylus">
#app
	font-family Avenir, Helvetica, Arial, sans-serif
	-webkit-font-smoothing antialiased
	-moz-osx-font-smoothing grayscale
	text-align center
	color #2c3e50
	margin-top 60px
</style>

<script>
import { mapState, mapMutations } from 'vuex';

export default {
	omputed: mapState({
		parts: state => state.parts
	}),
	methods: {
		...mapMutations({
			updateParts: 'SET_PARTS'
		}),
		otherMethod: function () {
			console.log('');
		}
	},
	mounted: function () {
		this.$http.get('/api/get')
			.then((response) => {
				if (response.data.success) {
					this.updateParts(response.data.parts);
					console.log(response.data);
				}
			});
	}
}
</script>
