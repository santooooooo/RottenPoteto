import Vue from 'vue';
import VueRouter from 'vue-router';
import ContributeInfo from './components/ContributeInfo.vue';
import Login from './components/Login.vue';
import Contribute from './components/Contribute.vue';
import ControllUsers from './components/ControllUsers.vue';
require('./bootstrap');

window.Vue = Vue;
Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
		{
			path: '/',
			component: ContributeInfo
		},
	]
});

const app = new Vue({
    el: '#app',
		data: {
			user: [],
		},
    router:router,
		components: {
			'login': Login,
		}
		});
