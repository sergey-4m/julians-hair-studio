<template>
	<div class="wrapper">
		<app-header />
        <sidebar-menu />
        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{ createOrEdit }} Client Record</h1>
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
            							<input type="text" class="form-control" v-model="client.last_name" placeholder="Surname">
            						</div>
            						<div class="form-group">
            							<label for="first_name">First Name</label>
            							<input type="text" class="form-control" v-model="client.first_name" placeholder="First Name">
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('client.email') }">
            							<label for="email">Email</label>
            							<input type="email" v-validate="'required|client.email'" class="form-control" name="email" v-model="client.email" placeholder="Email">
            							<span v-show="errors.has('client.email')" class="help is-danger">{{ errors.first('client.email') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('client.phone') }">
            							<label for="phone">Home Number</label>
            							<input type="text" v-validate="'required|digits:{11}'" class="form-control" v-model="client.phone" placeholder="Home Number">
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('client.mobile') }">
            							<label for="mobile">Mobile Number</label>
            							<input type="text" v-validate="'required|digits:{11}'" class="form-control" v-model="client.mobile" placeholder="Mobile Number">
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
        <app-footer />
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
			client: {
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
			axios.get('/client-load/' + this.$route.params.id).then((resp) => {
				if (resp.data.client) {
					that.client = resp.data.client;
				}
			});
		}
	},
	mounted() {
		
	},
	methods: {
		submitData() {
			this.$validator.validateAll().then((result) => {
				if (result) {
					let router = this.$router;
					let apiPath = (this.$route.params.id) ? '/client-update/' + this.$route.params.id : '/client-create' ; 
					axios.post(apiPath, this.client).then((resp) => {
						console.log(resp);
						if (resp.data.client) {
							router.push({name: 'client_service_records', params: {id: resp.data.client.id}});
						}
					});
				}
			});
		}
	}
}
</script>