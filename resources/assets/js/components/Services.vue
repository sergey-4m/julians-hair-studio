<template>
	<div class="wrapper">
        <app-header />
        <sidebar-menu />
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Services</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <div class="col-md-3 col-md-offset-9">
                                    <div class="form-group">
                                        <input type="text" name="filter" class="form-control" placeholder="Search for..." v-model="query.search">
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <datatable v-bind="$data" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <confirm-modal />
        <app-footer />
    </div>
</template>

<script>
import DetailsChallenge from './comps/DetailsChallenge';

export default {
	data() {
		return {
            columns: [
                { title: 'Service', field: 'title', sortable: true},
                { title: 'Operation', tdComp: DetailsChallenge, visible: true },
                { field: 'id', visible: false }
            ],
            data: [],
            total: 0,
            query: {},
            xprops: {
                apiUri: '/service-item',
                redirectPath: 'service_items',
                editPath: 'service_items_edit'
            }
		};
	},
    created() {
        let that = this;
        axios.get('/service-item').then((resp) => {
            if (resp.data.serviceItems) {
                that.data = resp.data.serviceItems;
                that.total = resp.data.total;
            }
        });
    },
    watch: {
        query: {
            handler(query) {
                this.$router.push({query});
            },
            deep: true
        },
        '$route.query' (query) {
            axios.get('/service-item', query).then((resp) => {
                this.data = resp.data.serviceItems;
                this.total = resp.data.total;

                this.$nextTick(() => {
                    this.selection = [...this.data];
                });
            });
        }
    }
}
</script>