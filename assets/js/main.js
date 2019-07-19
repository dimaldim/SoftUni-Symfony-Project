(function ($) {
  "use strict"

  $('.add-to-cart-btn').click(function (e) {
    e.preventDefault();
    var productId = $(this).data('productId');
    var qty = Number($('input[name="quantity"]').val()) || 1;
    $.ajax({
      method: "post",
      url: "/cart/add/" + productId + "/" + qty,
      success: (response) => {
        var data = response.data;
        var totalItems = 0;
        var totalPrice = 0.00;
        for (let [key, value] of Object.entries(data)) {
          totalPrice += Number(data[key]['price']) * Number(data[key]['qty']);
          totalItems += Number(data[key]['qty']);
        }
        //Update cart info
        var cartProductCount = $('#header_cart_qty');
        var cartListTotalAmount = $('#cart-summary-total');
        var cartListTotalItems = $('#cart-summary-items');
        var cartProductList = $('div.product-widget');

        if (cartProductList.length === 0) {
          $('.cart-list').append(
            `<div class="product-widget" data-product-id="${productId}">
                    <div class="product-img">
                        <img src="${data[productId]['image']}" alt="">
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a href="#">${data[productId]['productName']}</a></h3>
                        <h4 class="product-price"><span
                                    class="qty">${data[productId]['qty']}x</span>$${data[productId]['price'].toFixed(2)}
                        </h4>
                    </div>
                    <button class="delete"><i class="fa fa-close"></i></button>
                </div>`);
        }

        cartProductList.each(function () {
          if (productId === $(this).data('productId')) {
            $(this).find('.qty').html(data[productId]['qty'] + 'x');
            return false;
          } else {
            $('.cart-list').append(
              `<div class="product-widget" data-product-id="${productId}">
                    <div class="product-img">
                        <img src="${data[productId]['image']}" alt="">
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a href="#">${data[productId]['productName']}</a></h3>
                        <h4 class="product-price"><span
                                    class="qty">${data[productId]['qty']}x</span>$${data[productId]['price'].toFixed(2)}
                        </h4>
                    </div>
                    <button class="delete"><i class="fa fa-close"></i></button>
                </div>`);
          }
        });

        cartListTotalItems.text(totalItems);
        cartProductCount.html(totalItems);
        cartListTotalAmount.text(totalPrice.toFixed(2));
        $.notify({
          title: "Success:",
          message: "The product <b>" + data[productId]['productName'] + "</b> has been added to your shopping cart."
        }, {
          type: 'success',
          animate:
            {
              enter: 'animated bounceIn',
              exit: 'animated bounceOut'
            }
        });
      },
      error: (data) => {
        $.notify({
            title: "Warning:",
            message: "Something went wrong! <b>" + data.responseJSON.error + "</b>"
          }, {
            type: 'danger',
            animate:
              {
                enter: 'animated bounceIn',
                exit: 'animated bounceOut'
              }
          }
        );
      }
    })
  });

// Mobile Nav toggle
  $('.menu-toggle > a').on('click', function (e) {
    e.preventDefault();
    $('#responsive-nav').toggleClass('active');
  })

// Fix cart dropdown from closing
  $('.cart-dropdown').on('click', function (e) {
    e.stopPropagation();
  });

/////////////////////////////////////////

// Products Slick
  $('.products-slick').each(function () {
    var $this = $(this),
      $nav = $this.attr('data-nav');

    $this.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      infinite: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
      responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        },
      ]
    });
  });

// Products Widget Slick
  $('.products-widget-slick').each(function () {
    var $this = $(this),
      $nav = $this.attr('data-nav');

    $this.slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
    });
  });

/////////////////////////////////////////

// Product Main img Slick
  $('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: 0,
    vertical: true,
    asNavFor: '#product-main-img',
    responsive: [{
      breakpoint: 991,
      settings: {
        vertical: false,
        arrows: false,
        dots: true,
      }
    },
    ]
  });

// Product img zoom
  var zoomMainProduct = document.getElementById('product-main-img');
  if (zoomMainProduct) {
    $('#product-main-img .product-preview').zoom();
  }

/////////////////////////////////////////

// Input number
  $('.input-number').each(function () {
    var $this = $(this),
      $input = $this.find('input[type="number"]'),
      up = $this.find('.qty-up'),
      down = $this.find('.qty-down');

    down.on('click', function () {
      var value = parseInt($input.val()) - 1;
      value = value < 1 ? 1 : value;
      $input.val(value);
      $input.change();
      updatePriceSlider($this, value)
    })

    up.on('click', function () {
      var value = parseInt($input.val()) + 1;
      $input.val(value);
      $input.change();
      updatePriceSlider($this, value)
    })
  });

// var priceInputMax = document.getElementById('price-max'),
//   priceInputMin = document.getElementById('price-min');
//
// priceInputMax.addEventListener('change', function () {
//   updatePriceSlider($(this).parent(), this.value)
// });
//
// priceInputMin.addEventListener('change', function () {
//   updatePriceSlider($(this).parent(), this.value)
// });

  function updatePriceSlider(elem, value) {
    if (elem.hasClass('price-min')) {
      console.log('min')
      priceSlider.noUiSlider.set([value, null]);
    } else if (elem.hasClass('price-max')) {
      console.log('max')
      priceSlider.noUiSlider.set([null, value]);
    }
  }

// Price Slider
  var priceSlider = document.getElementById('price-slider');
  if (priceSlider) {
    noUiSlider.create(priceSlider, {
      start: [1, 999],
      connect: true,
      step: 1,
      range: {
        'min': 1,
        'max': 999
      }
    });

    priceSlider.noUiSlider.on('update', function (values, handle) {
      var value = values[handle];
      handle ? priceInputMax.value = value : priceInputMin.value = value
    });
  }

})
(jQuery);

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
    }
  },
  el: '#app',
  components: {
    Cart,
    AddToCartBtn
  }
});
