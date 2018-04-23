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
                                    <div class="form-group" :class="{'has-error': errors.has('title') }">
                                        <label>Service Name</label>
                                        <input type="text" v-validate="'required|alpha_num'" class="form-control" name="title" v-model="service.title" placeholder="Service Name">
                                        <span v-show="errors.has('title')" class="help-block text-danger">{{ errors.first('title') }}</span>
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
                title: ''
            }
        };
    },
    created() {
        if (this.$route.params.id) {
            let that = this;
            axios.get('/service-item/' + this.$route.params.id).then((resp) => {
                if (resp.data.serviceItem) {
                    that.service = resp.data.serviceItem;
                }
            });
        }
    },
    methods: {
        submitData() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    let router = this.$router;
                    let apiPath = (this.$route.params.id) ? '/service-item/update/' + this.$route.params.id : '/service-item/create';
                    axios.post(apiPath, this.service).then((resp) => {
                        console.log(resp);
                        if (resp.data.serviceItem) {
                            router.push({name: 'service_items'});
                        }
                    });
                }
            });
        }
    }
}
</script>