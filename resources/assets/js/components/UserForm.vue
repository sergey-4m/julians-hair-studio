<template>
	<div class="wrapper">
		<app-header />
        <sidebar-menu />
        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{ isNew ? 'Add' : 'Edit' }} User</h1>
            </section>
            <section class="content">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="box box-primary">
            				<div class="box-header with-border"></div>
            				<form role="form" @submit.prevent="submitData" method="post">
            					<div class="box-body">
            						<div v-if="apiError" class="callout callout-danger">
            							<h4>{{ apiError }}</h4>
            						</div>
	            					<div class="form-group" :class="{'has-error': errors.has('username') }">
	        							<label>Username:</label>
	        							<input type="text" v-validate="'required:true'" class="form-control" name="username" id="username" v-model="user.username">
	        							<span v-show="errors.has('username')" class="help-block text-danger">{{ errors.first('username') }}</span>
	        						</div>
	        						<div class="form-group" :class="{'has-error': errors.has('email') }">
	        							<label>Email:</label>
	        							<input type="email" v-validate="'required|email'" class="form-control" id="email" name="email" v-model="user.email">
	        							<span v-show="errors.has('email')" class="help-block text-danger">{{ errors.first('email') }}</span>
	        						</div>
	        						<div class="form-group" :class="{'has-error': errors.has('password') }">
	        							<label>Password:</label>
	        							<input type="password" class="form-control" id="password" name="password" v-model="user.password">
	        							<span v-show="errors.has('password')" class="help-block text-danger">{{ errors.first('password') }}</span>
	        						</div>
	        						<div class="form-group" :class="{'has-error': errors.has('c_password') }">
	        							<label>Repeat password:</label>
	        							<input type="password" class="form-control" v-validate="'required|confirmed:password'" id="c_password" name="c_password" v-model="user.c_password">
	        							<span v-show="errors.has('c_password')" class="help-block text-danger">{{ errors.first('c_password') }}</span>
	        						</div>
	        						<div class="form-group" :class="{'has-error': errors.has('status') }">
	        							<label>Status:</label>
	        							<select class="form-control" v-validate="'required:true'" name="status" id="status" v-model="user.status">
	        								<option value="open">Open</option>
	        								<option value="locked">Locked</option>
	        							</select>
	        							<span v-show="errors.has('status')" class="help-block text-danger">{{ errors.first('status') }}</span>
	        						</div>
	        						<div class="form-group">
	        							<label>IP Address (If locked):</label>
	        							<input type="text" class="form-control" id="ip" v-model="user.ip">
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
import { Validator } from 'vee-validate';

export default {
	data() {
		return {
			user: {
				username: '',
				email: '',
				password: '',
				c_password: '',
				status: '',
				ip: ''
			},
			c_password: '',
			isNew: false,
			apiError: false
		};
	},
	created() {
		this.isNew = this.$route.params.id ? false : true;
		const dictionary = {
			en: {
				attributes: {
					c_password: 'password'
				}
			}
		};
		Validator.localize(dictionary);
		if (!this.isNew) {
			let that = this;
			axios.get('/user/' + this.$route.params.id).then((resp) => {
				if (resp.data.user) {
					that.user = resp.data.user;
				}
			});
		}
	},
	methods: {
		submitData() {
			this.$validator.validateAll().then((result) => {
				if (result) {
					let apiPath = this.$route.params.id ? '/user-update/' + this.$route.params.id : '/user-create';
					let router = this.$router;
					axios.post(apiPath, this.user).then((resp) => {
						if (resp.data.user) {
							router.push({name:'users_list'});
						} else if (resp.data.error) {
							this.apiError = resp.data.error;
						}
					});
				}
			});
		}
	}
}
</script>