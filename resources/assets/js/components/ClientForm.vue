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
            						<div class="form-group" :class="{'has-error': errors.has('last_name') }">
            							<label for="last_name">Surname</label>
            							<input type="text" v-validate="'required|alpha'" class="form-control" name="last_name" v-model="client.last_name" placeholder="Surname">
            							<span v-show="errors.has('last_name')" class="help-block text-danger">{{ errors.first('last_name') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('first_name') }">
            							<label for="first_name">First Name</label>
            							<input type="text" v-validate="'required|alpha'" class="form-control" name="first_name" v-model="client.first_name" placeholder="First Name">
            							<span v-show="errors.has('first_name')" class="help-block text-danger">{{ errors.first('first_name') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('email') }">
            							<label for="email">Email</label>
            							<input type="email" v-validate="'required|email'" class="form-control" name="email" v-model="client.email" placeholder="Email">
            							<span v-show="errors.has('email')" class="help-block text-danger">{{ errors.first('email') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('phone') }">
            							<label for="phone">Home Number</label>
            							<input type="text" v-validate="'required|numeric'" class="form-control" name="phone" v-model="client.phone" placeholder="Home Number">
            							<span v-show="errors.has('phone')" class="help-block text-danger">{{ errors.first('phone') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('mobile') }">
            							<label for="mobile">Mobile Number</label>
            							<input type="text" v-validate="'required|numeric'" class="form-control" name="mobile" v-model="client.mobile" placeholder="Mobile Number">
            							<span v-show="errors.has('mobile')" class="help-block text-danger">{{ errors.first('mobile') }}</span>
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