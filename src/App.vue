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
	margin-top 20px

label
	font-weight bold
	margin-right 10px

input
	border 1px solid #999999

.search-container
	display flex
	padding 10px
	input
		flex-grow 1

table
	td:first-of-type
		width: 50%
	td:nth-of-type(2)
		width: 30%
	td:nth-of-type(3)
		width: 20%
	td input
		width 100%
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
