import Vue from 'vue';
import VueRouter from 'vue-router';
import ContributeInfo from './components/ContributeInfo.vue';
import Login from './components/Login.vue';
import Contribute from './components/Contribute.vue';
import ContributeDetails from './components/ContributeDetails.vue';
import UserInfo from './components/UserInfo.vue';
import UserProfile from './components/UserProfile.vue';
import Home from './components/Home.vue';
require('./bootstrap');

window.Vue = Vue;
Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
		{
			path: '/',
			component: Home
		},
		{
			path: '/contribute',
			component: ContributeInfo
		},
		{
			path: '/contribute/:contributeId',
			component: ContributeDetails
		},
		{
			path: '/user/:userId',
			component: UserInfo,
		},
		{
			path: '/user-profile/:userGmail',
			component: UserProfile
		}
	]
});

const app = new Vue({
    el: '#app',
		data: {
			user: [],
			message: null,
		},
    router:router,
		components: {
			'login': Login,
		},
		mounted: function()
		{
			if(this.message != null)
			{
				alert(this.message)
			}
		}
		});
