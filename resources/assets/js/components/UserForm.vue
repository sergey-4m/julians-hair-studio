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
	            					<div class="form-group">
	        							<label>Username:</label>
	        							<input type="text" class="form-control" id="username" v-model="user.username">
	        						</div>
	        						<div class="form-group">
	        							<label>Email:</label>
	        							<input type="email" class="form-control" id="email" v-model="user.email">
	        						</div>
	        						<div class="form-group">
	        							<label>Password:</label>
	        							<input type="password" class="form-control" id="password" v-model="user.password">
	        						</div>
	        						<div class="form-group">
	        							<label>Repeat password:</label>
	        							<input type="password" class="form-control" id="c_password" v-model="user.c_password">
	        						</div>
	        						<div class="form-group" v-if="!isNew">
	        							<label>Status:</label>
	        							<select class="form-control" id="status" v-model="user.status">
	        								<option value="open">Open</option>
	        								<option value="locked">Locked</option>
	        							</select>
	        						</div>
	        						<div class="form-group" v-if="!isNew">
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
			isNew: false
		};
	},
	created() {
		this.isNew = this.$route.params.id ? false : true;
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
			let apiPath = this.$route.params.id ? '/user-update/' + this.$route.params.id : '/user-create';
			let router = this.$router;
			axios.post(apiPath, this.user).then((resp) => {
				if (resp.data.user) {
					router.push({name:'users_list'});
				}
			});
		}
	}
}
</script>