import Vue from 'vue';
import VueRouter from 'vue-router';
import Contribute from './components/Contribute.vue';
import ControllUsers './components/ControllUsers.vue';

window.Vue = Vue;
Vue.use(VueRouter);

const adminerRouter = new VueRouter({
	routes: [
		{
			path: '/contribute',
			component: Contribute
		},
		{
			path: '/controll-users',
			component: ControllUsers
		},
	]
});

const appAdminer = new Vue({
    el: '#app',
    router:adminerRouter,
		});
