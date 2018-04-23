require('./bootstrap');

window.Vue = require('vue');
window.jQuery = require('jquery');

import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueAuth from '@websanova/vue-auth';
import Datatable from 'vue2-datatable-component'
import App from './App.vue';
import AppHeader from './components/_partials/AppHeader.vue';
import AppFooter from './components/_partials/AppFooter.vue';
import SidebarMenu from './components/_partials/SidebarMenu.vue';
import ConfirmModal from './components/_partials/ConfirmModal.vue';
import Home from './components/Home.vue';
import ClientProfile from './components/ClientProfile.vue';
import ClientForm from './components/ClientForm.vue';
import EntryForm from './components/EntryForm.vue';
import UserForm from './components/UserForm.vue';
import Users from './components/Users.vue';
import Stylists from './components/Stylists.vue';
import Login from './components/Login.vue';

axios.defaults.baseURL = 'http://julians-hair-studio.loc/api';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Datatable);

Vue.component('app-header', AppHeader);
Vue.component('app-footer', AppFooter);
Vue.component('sidebar-menu', SidebarMenu);
Vue.component('confirm-modal', ConfirmModal);

const router = new VueRouter({
	routes: [{
		path: '/',
		name: 'home',
		component: Home,
		meta: {
			auth: true
		}
	}, {
		path: '/service-record-new',
		name: 'client_service_records_new',
		component: ClientForm,
		meta: {
			auth: true
		}
	}, {
		path: '/service-record-add/:client',
		name: 'client_service_records_add',
		component: EntryForm,
		meta: {
			auth: true
		}
	}, {
		path: '/service-records/:id',
		name: 'client_service_records',
		component: ClientProfile,
		meta: {
			auth: true
		}
	}, {
		path: '/client-edit/:id',
		name: 'client_records_edit',
		component: ClientForm,
		meta: {
			auth: true
		}
	}, {
		path: '/login',
		name: 'login',
		component: Login,
		meta: {
			auth: false
		}
	}, {
		path: '/stylists',
		name: 'stylists_list',
		component: Stylists,
		meta: {
			auth: true
		}
	}/*, {
		path: '/stylist-add',
		name: 'stylist_create',
		component: StylistForm,
		meta: {
			auth: true
		}
	}, {
		path: '/stylist-edit/:id',
		name: 'stylist_edit',
		component: StylistForm,
		meta: {
			auth: true
		}
	}*/, {
		path: '/users',
		name: 'users_list',
		component: Users,
		meta: {
			auth: true
		}
	}, {
		path: '/users-add',
		name: 'users_create',
		component: UserForm,
		meta: {
			auth: true
		}
	}, {
		path: '/users-edit/:id',
		name: 'users_edit',
		component: UserForm,
		meta: {
			auth: true
		}
	}],
	linkActiveClass: 'active'
});

Vue.router = router;

Vue.use(VueAuth, {
	/*auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),*/
	auth: {
	    request: function (req, token) {
	        this.options.http._setHeaders.call(this, req, {Authorization: 'Bearer ' + token});
	    },
	    response: function (res) {
	    	return (res.data.data || {}).token;
	    }
	},
	http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
	router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
	loginData: {
		url: 'login',
		method: 'POST',
		redirect: '/',
		fetchUser: true
	},
	fetchData: {
		url: 'get-details',
		method: 'POST', 
		enabled: true,
		authType: 'bearer'
	},
	refreshData: {
		enabled: false
	}
});

App.router = Vue.router;

new Vue(App).$mount('#app');
