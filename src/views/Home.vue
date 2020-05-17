<template>
	<div class="home container-fluid">
		<h1>Parts Lookup</h1>
		<div v-if="addNew">
			<label>Item:</label>
			<input v-model="newTitle"/>
			<button @click="submit">
				Submit
			</button>
			<button @click="back">
				Back
			</button>
		</div>
		<div v-else>
			<div class="search-container">
				<label>Search</label>
				<input v-model="searchTerm">
			</div>
			<button @click="startNew">
				New
			</button>
		</div>
		<table class="table table-dark table-striped">
			<thead>
				<tr>
				<th scope="col">Part</th>
				<th scope="col">Location</th>
				<th scope="col">-</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="part in filteredList"
					v-bind:key="part._kp_id">
					<template v-if="part != editItem">
						<td>
							{{ part.name }}
						</td>
						<td>
							{{ part.location }}
						</td>
						<td>
							<button @click="startEdit(part)">
								Edit
							</button>
							<button @click="remove(part)">
								Del
							</button>
						</td>
					</template>
					<template v-else>
						<td>
							<input v-model="editItem.name"/>
						</td>
						<td>
							<input v-model="editItem.location"/>
						</td>
						<td>
							<button @click="finishEdit(part)">
								Save
							</button>
						</td>
					</template>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
// @ is an alias to /src

export default {
	name: 'Home',
	components: {
	},
	data: function () {
		return {
			searchTerm: '',
			editItem: null,
			addNew: false,
			newTitle: '',
			newLocation: '',
			newSublocation: ''
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
		...mapMutations({
			addPart: 'ADD_PART',
			removePart: 'REMOVE_PART'
		}),
		startEdit: function (item) {
			this.editItem = item;
		},
		startNew: function () {
			this.addNew = true;
		},
		back: function () {
			this.addNew = false;
		},
		finishEdit: function (item) {
			this.editItem = null;
			console.log(item);
			this.$http.post('/api/post', item)
				.then(() => {
					console.log('done');
				})
			console.log(item);
		},
		submit: function () {
			const item = {
				name: this.newTitle,
				location: this.newLocation,
				sublocation: this.newSublocation
			};
			this.$http.post('/api/post', item)
				.then((response) => {
					item._kp_part = response.data._kp_part;
					this.addPart(item);
					this.addNew = false;
					this.newTitle = '';
				})
		},
		remove: function (item) {
			this.$http.post('/api/delete', item)
				.then((response) => {
					this.removePart(item._kp_part);
				})
		}
	}
}
</script>
