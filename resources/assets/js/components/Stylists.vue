<template>
    <div class="wrapper">
        <app-header />
        <sidebar-menu />
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Stylists</h1>
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
    data: () => ({
        columns: [
            { title: 'Surname', field: 'last_name', sortable: true},
            { title: 'First Name', field: 'first_name', sortable: true },
            { title: 'Email', field: 'email', sortable: true },
            { title: 'Home Number', field: 'phone', sortable: true },
            { title: 'Mobile Number', field: 'mobile', sortable: true },
            { title: 'Operation', tdComp: DetailsChallenge, visible: true },
            { field: 'id', explain: '/stylists-records', visible: false }
        ],
        data: [],
        total: 0,
        query: {},
        xprops: {
            apiUri: '/stylists-records',
            redirectPath: 'stylists_list',
            editPath: 'stylist_edit'
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
            axios.post('/stylists-list', query).then((resp) => {
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