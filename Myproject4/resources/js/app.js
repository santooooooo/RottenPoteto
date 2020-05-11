import Vue from 'vue';
import VueRouter from 'vue-router';
import Example from './components/ExampleComponent.vue';
import Login from './components/Login.vue'; 

window.Vue = Vue;
Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
	 {
	 	path: '/',
		component: Example
	 },
	 {
		path: '/login',
		component: Login
	 } 
	]
});

const app = new Vue({
    el: '#app',
    router:router 
});
