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
                            <div class="box-header with-border"></div>
                            <div class="box-body">
                                <datatable v-bind="$data" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
                apiUri: '/service-items',
                redirectPath: 'service_items',
                editPath: 'service_items_edit'
            }
		};
	},
    created() {
        let that = this;
        axios.get('/service-items').then((resp) => {
            if (resp.data.serviceItems) {
                that.data = resp.data.serviceItems;
            }
        });
    },
    methods: {

    }
}
</script>