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
export default {
	data() {
		return {
			service: {
				
			}
		};
	}
}
</script>