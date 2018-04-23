<template>
    <div class="wrapper">
        <app-header />
        <sidebar-menu />
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Client Service Records</h1>
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
        <confirm-modal />
    </div>
</template>

<script>
import DetailsChallenge from './comps/DetailsChallenge';

export default {
    DetailsChallenge,
    data: () => ({
        columns: [
            { title: 'Surname', field: 'last_name', sortable: true},
            { title: 'First Name', field: 'first_name', sortable: true },
            { title: 'Email', field: 'email', sortable: true },
            { title: 'Home Number', field: 'phone', sortable: true },
            { title: 'Mobile Number', field: 'mobile', sortable: true },
            { title: 'Operation', tdComp: DetailsChallenge, visible: true },
            { field: 'id', visible: false },
            { field: 'client_id', visible: false }
        ],
        data: [],
        total: 0,
        query: {},
        xprops: {
            apiUri: '/service-records',
            redirectPath: 'home',
            editPath: 'client_service_records'
        }
    }),
    watch: {
        query: {
            handler(query) {
                this.$router.push({query});
            },
            deep: true
        },
        '$route.query' (query) {
            axios.post('/service-records', query).then((resp) => {
                this.data = resp.data.data.rows;
                this.total = resp.data.data.total;

                this.$nextTick(() => {
                    this.selection = [...this.data];
                });
            });
        }
    }
}
</script>