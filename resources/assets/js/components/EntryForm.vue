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
            						<div class="form-group" :class="{'has-error': errors.has('date_at') }">
            							<label>Date:</label>
            							<div class="input-group date">
            								<div class="input-group-addon">
            									<i class="fa fa-calendar"></i>
            								</div>
            								<input type="text" v-validate="'required|date_format:DD/MM/YYYY'" name="date_at" class="form-control pull-right" id="date_at" v-model="service.date_at">
            							</div>
                                        <span v-show="errors.has('date_at')" class="help-block text-danger">{{ errors.first('date_at') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('brand') }">
            							<label>Brand Used</label>
            							<select class="form-control" v-validate="'required:true'" id="brand" name="brand" v-model="service.brand">
            								<option value="Wella">Wella</option>
            								<option value="Affinage">Affinage</option>
            								<option value="Graphics">Graphics</option>
            							</select>
                                        <span v-show="errors.has('brand')" class="help-block text-danger">{{ errors.first('brand') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('bleach') }">
            							<label>Bleach</label>
            							<input type="text" class="form-control" v-validate="'required:true'" name="bleach" v-model="service.bleach" placeholder="Bleach">
                                        <span v-show="errors.has('bleach')" class="help-block text-danger">{{ errors.first('bleach') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('tint') }">
            							<label>Tint</label>
            							<input type="text" class="form-control" v-validate="'required:true'" name="tint" v-model="service.tint" placeholder="Tint">
                                        <span v-show="errors.has('tint')" class="help-block text-danger">{{ errors.first('tint') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('peroxide') }">
            							<label>Peroxide volume</label>
            							<input type="text" class="form-control" v-validate="'required:true'" name="peroxide" v-model="service.peroxide" placeholder="Peroxide volume">
                                        <span v-show="errors.has('peroxide')" class="help-block text-danger">{{ errors.first('peroxide') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('service') }">
            							<label>Service</label>
            							<select class="form-control" v-validate="'required:true'" name="service" id="service" v-model="service.service_id">
                                            <option v-for="item in serviceItems" v-bind:value="item.id">
                                                {{ item.title }}
                                            </option>
            							</select>
                                        <span v-show="errors.has('service')" class="help-block text-danger">{{ errors.first('service') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('stylist') }">
            							<label>Stylist</label>
            							<select class="form-control" v-validate="'required:true'" id="stylist" name="stylist" v-model="service.stylist_id">
            								<option v-for="stylist in stylists" v-bind:value="stylist.id">
            									{{ stylist.name }}
            								</option>
            							</select>
                                        <span v-show="errors.has('stylist')" class="help-block text-danger">{{ errors.first('stylist') }}</span>
            						</div>
            						<div class="form-group" :class="{'has-error': errors.has('charge') }">
            							<label>Charge</label>
            							<div class="input-group">
            								<span class="input-group-addon">&pound;</span>
            								<input type="text" class="form-control" v-validate="'required:numeric'" name="charge" v-model="service.charge" placeholder="Charge">
            							</div>
                                        <span v-show="errors.has('charge')" class="help-block text-danger">{{ errors.first('charge') }}</span>
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
				service_id: 0,
				stylist_id: 0,
				charge: 0
			},
			stylists: [],
			submitPath: '',
            serviceItems: []
		};
	},
	created() {
		let that = this;
		axios.get('/stylists-list').then((resp) => {
			if (resp.data.stylists) {
				that.stylists = resp.data.stylists;
			}
		});
        axios.get('/service-item').then((resp) => {
            if (resp.data.serviceItems) {
                that.serviceItems = resp.data.serviceItems;
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
            this.$validator.validateAll().then((result) => {
                if (result) {
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
            });
		}
	}
}
</script>