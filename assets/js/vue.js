//Vue JS
import Vue from 'vue';

import Cart from './components/Cart';
import AddToCartBtn from './components/AddToCartBtn';


import axios from 'axios';
import VueSession from 'vue-session';
import Notifications from 'vue-notification';

Vue.use(VueSession);
Vue.use(Notifications);

Vue.config.productionTip = false;

new Vue({
  data: {
    cart: {}
  },
  mounted() {
    this.getCartInfo();
  },
  methods: {
    getCartInfo() {
      axios.get('/cart/get')
        .then((response) => {
          this.cart = response.data;
        });
    },
    updateCart(data) {
      axios.post('/cart/add/' + data.product + '/' + data.qty)
        .then((response) => {
          this.getCartInfo();
          this.$notify({
            group: 'app',
            type: 'success',
            animationType: 'css',
            title: 'Done',
            text: 'Your product has been added to your shopping cart.'
          });
        });
    },
    removeItem(id) {
      axios.post('/cart/remove/' + id)
        .then((response) => {
          this.getCartInfo();
          this.$notify({
            group: 'app',
            type: 'success',
            animationType: 'css',
            title: 'Done',
            text: 'Your product has been removed.'
          });
        });
    }
  },
  el: '#app',
  components: {
    Cart,
    AddToCartBtn
  }
});
