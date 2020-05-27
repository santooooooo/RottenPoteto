import Vue from 'vue';
import VueRouter from 'vue-router';
import Contribute from './components/Contribute.vue';
import Login from './components/Login.vue';

window.Vue = Vue;
Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
		{
			path: '/',
			component: Contribute
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
