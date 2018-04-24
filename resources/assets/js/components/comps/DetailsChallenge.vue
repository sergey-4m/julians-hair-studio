<template>
	<div class="btn-group btn-group-sm">
		<a @click="editItem()" class="btn btn-default" title="edit">
			<i class="fa fa-pencil"></i>
		</a>
		<a @click="deleteItem()" class="btn btn-danger" title="delete">
			<i class="fa fa-times"></i>
		</a>
	</div>
</template>

<script>
export default {
	name: "DetailsChallenge",
	props: ['row', 'uri'],
	data() {
		return {
			apiPath: this.uri
		}
	},
	mounted() {

	},
	methods: {
		editItem() {
			let path = this.$parent.xprops.editPath;
			let params = {
				id: (this.row.client_id ? this.row.client_id : this.row.id)
			};
			this.$router.push({ name: path, params: params});
		},
		deleteItem() {
			let apiPath = this.$parent.xprops.apiUri + '/delete/' + this.row.id;
			let redirectPath = this.$parent.xprops.redirectPath;
			let router = this.$router;
			$('#modal-confirm').on('show.bs.modal', (event) => {
				$(event.currentTarget).find('.modal-footer #confirm-delete').on('click', () => {
					axios.post(apiPath).then((resp) => {
						if (resp.data.status == 'ok') {
							router.push({name: redirectPath, query: {search: ''}});
						}
					});
					$('#modal-confirm').modal('hide');
				});
			});
			$('#modal-confirm').modal('show');
		}
	}
}
</script>