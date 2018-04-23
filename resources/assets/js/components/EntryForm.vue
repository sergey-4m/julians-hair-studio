<template>
	<div class="wrapper">
		<app-header />
        <sidebar-menu />
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Add entry</h1>
            </section>
            <section class="content">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="box box-primary">
            				<div class="box-header with-border"></div>
            				<form role="form" @submit.prevent="submitData" method="post">
            					<div class="box-body">
            						<div class="form-group">
            							<label>Date:</label>
            							<div class="input-group date">
            								<div class="input-group-addon">
            									<i class="fa fa-calendar"></i>
            								</div>
            								<input type="text" class="form-control pull-right" id="date_at" v-model="service.date_at">
            							</div>
            						</div>
            						<div class="form-group">
            							<label>Brand Used</label>
            							<select class="form-control" id="brand" v-model="service.brand">
            								<option value="Wella">Wella</option>
            								<option value="Affinage">Affinage</option>
            								<option value="Graphics">Graphics</option>
            							</select>
            						</div>
            						<div class="form-group">
            							<label>Bleach</label>
            							<input type="text" class="form-control" v-model="service.bleach" placeholder="Bleach">
            						</div>
            						<div class="form-group">
            							<label>Tint</label>
            							<input type="text" class="form-control" v-model="service.tint" placeholder="Tint">
            						</div>
            						<div class="form-group">
            							<label>Peroxide volume</label>
            							<input type="text" class="form-control" v-model="service.peroxide" placeholder="Peroxide volume">
            						</div>
            						<div class="form-group">
            							<label>Service</label>
            							<select class="form-control" id="service" v-model="service.service">
            								<option value="Full Head & Foils">Full Head & Foils</option>
            								<option value="1/2 Head Foils">1/2 Head Foils</option>
            								<option value="Tint">Tint</option>
            								<option value="Roots Only">Roots Only</option>
            								<option value="T-Section">T-Section</option>
            								<option value="Perm">Perm</option>
            							</select>
            						</div>
            						<div class="form-group">
            							<label>Stylist</label>
            							<select class="form-control" id="stylist" v-model="service.stylist_id">
            								<option v-for="stylist in stylists" v-bind:value="stylist.id">
            									{{ stylist.name }}
            								</option>
            							</select>
            						</div>
            						<div class="form-group">
            							<label>Charge</label>
            							<div class="input-group">
            								<span class="input-group-addon">&pound;</span>
            								<input type="text" class="form-control" v-model="service.charge" placeholder="Charge">
            							</div>
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
			service: {
				date_at: '',
				bleach: '',
				tint: '',
				peroxide: '',
				service: '',
				stylist_id: 0,
				charge: 0
			},
			stylists: [],
			submitPath: ''
		};
	},
	created() {
		let that = this;
		axios.get('/stylists-list').then((resp) => {
			if (resp.data.stylists) {
				that.stylists = resp.data.stylists;
			}
		});
	},
	mounted() {
		$('#date_at').datepicker({
			autoclose: true
		});
		console.log(this.stylists)
	},
	methods: {
		submitData() {
			let router = this.$router;
			let clientId = this.$route.params.client;
			this.service.date_at = $('#date_at').val();
			axios.post('client-records/' + clientId + '/add', this.service).then((resp) => {
				console.log(resp);
				if (resp.data.record) {
					router.push({name: 'client_service_records', params: {id: resp.data.record.client_id}});
				}
			});
		}
	}
}
</script>