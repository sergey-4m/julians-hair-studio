<template>
	<div class="wrapper">
		<app-header />
        <sidebar-menu />
        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{ createOrEdit }} Stylist Record</h1>
            </section>
            <section class="content">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="box box-primary">
            				<div class="box-header with-border"></div>
            				<form role="form" @submit.prevent="submitData" method="post">
            					<div class="box-body">
            						<div class="form-group">
            							<label for="last_name">Surname</label>
            							<input type="text" class="form-control" v-model="stylist.last_name" placeholder="Surname">
            						</div>
            						<div class="form-group">
            							<label for="first_name">First Name</label>
            							<input type="text" class="form-control" v-model="stylist.first_name" placeholder="First Name">
            						</div>
            						<div class="form-group">
            							<label for="email">Email</label>
            							<input type="email" class="form-control" v-model="stylist.email" placeholder="Email">
            						</div>
            						<div class="form-group">
            							<label for="phone">Home Number</label>
            							<input type="text" class="form-control" v-model="stylist.phone" placeholder="Home Number">
            						</div>
            						<div class="form-group">
            							<label for="mobile">Mobile Number</label>
            							<input type="text" class="form-control" v-model="stylist.mobile" placeholder="Mobile Number">
            						</div>
            					</div>
            					<div class="box-footer">
            						<button class="btn btn-primary">Submit</button>
            					</div>
            				</form>
            			</div>
            		</div>
            	</div>
            </section>
        </div>
	</div>
</template>

<script>
export default {
	props: {
		loaded: {
			last_name: '',
			first_name: '',
			email: '',
			phone: '',
			mobile: ''
		}
	},
	data() {
		return {
			createOrEdit: 'Create',
			stylist: {
				last_name: '',
				first_name: '',
				email: '',
				phone: '',
				mobile: ''
			},
			submitUri: '/service-records/create'
		};
	},
	created() {
		console.log(this.$route.params.id);
		if (this.$route.params.id) {
			let that = this;
			axios.get('/stylists-records/' + this.$route.params.id).then((resp) => {
				if (resp.data.stylist) {
					that.stylist = resp.data.stylist;
				}
			});
			this.createOrEdit = 'Edit';
		}
	},
	mounted() {
		
	},
	methods: {
		submitData() {
			let router = this.$router;
			let apiPath = (this.$route.params.id) ? '/stylists-records/update/' + this.$route.params.id : '/stylists-records/create' ; 
			axios.post(apiPath, this.stylist).then((resp) => {
				console.log(resp);
				if (resp.data.stylist) {
					router.push({name: 'stylists_list', params: {id: resp.data.stylist.id}});
				}
			});
		}
	}
}
</script>