import Vue from "vue";
import App from "./App.vue";
import VueRouter from "vue-router";
import Homepage from './Components/Homepage';
import Books from "./Components/Books";
import Book from "./Components/Book";
import NotFound from "./Components/NotFound";



window.axios = require('axios');
Vue.use(VueRouter);

const routes = [
	{
		path: "/",
		name: "Homepage",
		component: Homepage
	},
	{
		path: "/books",
		name: "Books",
		component: Books
	},
	{
		path: "/books/:id",
		name: "book",
		component: Book
	},
	{
		path: '*',
		name: "Not Found",
		component: NotFound
	}
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

new Vue({
	router,
  render: h => h(App)
}).$mount("#app");
