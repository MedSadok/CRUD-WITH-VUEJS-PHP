import Vue from "vue";
import App from "./App.vue";
import Footer from "./Components/Footer.vue";
import VueRouter from "vue-router";
import EditBook from './Components/EditBook';
import Books from "./Components/Books";
import Book from "./Components/Book";
import NotFound from "./Components/NotFound";



window.axios = require('axios');
Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Books",
        component: Books
    },
    {
        path: "/books/:id",
        name: "book",
        component: Book
    },
    {
        path: "/edit-books",
        name: "EditBook",
        component: EditBook
    }, {
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

new Vue({
    render: h => h(Footer)
}).$mount("#footer");