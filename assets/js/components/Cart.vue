<template>
    <div class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-shopping-cart"></i>
            <span>Your Cart</span>
            <div id="header_cart_qty" class="qty">{{ cart.totalItems }}</div>
        </a>
        <div class="cart-dropdown">
            <div class="cart-list">
                <div class="product-widget" v-for="product in cart.products" data-product-id="">
                    <div class="product-img">
                        <img :src="product.image" alt="">
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a href="#">{{ product.name }}</a></h3>
                        <h4 class="product-price"><span
                                class="qty">{{ product.qty }}x</span>${{ formatPrice(product.price) }}
                        </h4>
                    </div>
                    <button class="delete" @click.prevent="removeItem(product.id)"><i class="fa fa-close"></i></button>
                </div>
            </div>
            <div class="cart-summary">
                <small><span id="cart-summary-items">{{ cart.totalItems }}</span> Item(s) selected</small>
                <h5>SUBTOTAL: $<span id="cart-summary-total">{{ formatPrice(cart.totalPrice) }}</span></h5>
            </div>
            <div class="cart-btns">
                <a href="/checkout">Checkout <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    props: {
      cart: Object
    },
    methods: {
      formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      },
      removeItem: function (id) {
        this.$emit('removefromcart', id)
      }
    },
    name: "Cart"
  }
</script>
