/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('product-component', require('./components/products/ProductComponent.vue').default);

Vue.component('supplier-component', require('./components/suppliers/SupplierComponent.vue').default);

Vue.component('supplier-products-component', require('./components/supplierproducts/SupplierProductComponent.vue').default);

Vue.component('order-component', require('./components/orders/OrderComponent.vue').default);

Vue.component('order-details-component', require('./components/orderdetails/OrderDetailComponent.vue').default);
// ===chart ====//
Vue.component('main-chart-component', require('./components/charts/ChartContainer.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// importing sweet alert for notifications
import swal from 'sweetalert';
// register multiselect 
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)
// call pagination component
 Vue.component('pagination', require('laravel-vue-pagination'));
const app = new Vue({
    el: '#app',
});
