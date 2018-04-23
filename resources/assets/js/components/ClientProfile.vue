<template>
	<div class="wrapper">
		<app-header />
        <sidebar-menu />
        <div class="content-wrapper">
            <section class="content-header">
            	<h1>Client profile</h1>
            </section>
            <section class="content">
            	<div class="row">
            		<div class="col-md-3">
            			<div class="box box-primary">
            				<div class="box-body box-profile">
            					<img class="profile-user-img img-responsive img-circle" :src="'./img/user4-128x128.jpg'" alt="User profile picture">
            					<h3 class="profile-username text-center">{{ client.first_name }} {{ client.last_name }}</h3>
            					<ul class="list-group list-group-unbordered">
            						<li class="list-group-item">
            							<b>Phone number</b> <a class="pull-right">{{ client.phone }}</a>
            						</li>
            						<li class="list-group-item">
            							<b>Mobile number</b> <a class="pull-right">{{ client.mobile }}</a>
            						</li>
            						<li class="list-group-item">
            							<b>Email address</b> <a class="pull-right">{{ client.email }}</a>
            						</li>
            					</ul>
            					<router-link :to="{name: 'client_service_records_add', params: {client: client.id}}" class="btn btn-success btn-block">
            						<b>Add Entry</b>
            					</router-link>
            					<router-link :to="{name: 'client_records_edit', params: {client: client.id}}" class="btn btn-primary btn-block">
            						<b>Edit details</b>
            					</router-link>
            				</div>
            			</div>
            		</div>
            		<div class="col-md-9">
            			<div class="box box-primary">
            				<div class="box-header with-border"></div>
                            <div class="box-body">
                                <datatable v-bind="$data" />
                            </div>
            			</div>
            		</div>
            	</div>
            </section>
        </div>
    </div>
</template>

<script>
export default {
	data() {
		return {
			client: {
				id: 0,
				first_name: '',
				last_name: '',
				email: '',
				phone: '',
				mobile: ''
			},
			columns: [
	            { title: 'Date', field: 'date_at', sortable: true},
	            { title: 'Brand used', field: 'brand', sortable: true },
	            { title: 'Bleach', field: 'bleach', sortable: true },
	            { title: 'Peroxide vol.', field: 'peroxide_volume', sortable: true },
	            { title: 'Service', field: 'service', sortable: true },
	            { title: 'Stylist', field: 'stylist_name', sortable: true },
	            { title: 'Charge', field: 'charge', sortable: true },
	            { field: 'id', visible: false }
	        ],
	        data: [],
	        total: 0,
	        query: {}
		};
	},
	created() {
		if (this.$route.params.id) {
			let that = this;
			axios.get('/client-records/' + this.$route.params.id).then((resp) => {
				console.log(resp);
				if (resp.data.data.client) {
					that.client = resp.data.data.client;
					that.data = resp.data.data.records;
					that.total = resp.data.data.total;
				}
			});
		}
	},
	methods: {
		addEntry() {
			//this.$router.push({name: 'client_service_records_add', client: this.$route.params.id});
			/*axios.post('/client-records/' + this.$route.params.id + '/add').then((resp) => {
				console.log(resp);
			});*/
		}
	}
}
</script>