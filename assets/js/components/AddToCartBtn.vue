<template>
    <div>
        <button class="add-to-cart-btn" @click.prevent="addToCart(product, 1)">
            <i class="fa fa-shopping-cart"></i> add to cart
        </button>
    </div>
</template>

<script>
  export default {
    props: {
      product: Number,
    },
    methods: {
      addToCart: function (value, qty) {
        this.$emit('addproduct', {product: value, qty: qty})
      }
    },
    name: "AddToCartBtn"
  }
</script>
