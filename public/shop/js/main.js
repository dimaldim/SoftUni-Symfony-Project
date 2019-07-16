jQuery(document).ready(function ($) {

  // jQuery sticky Menu

  $(".mainmenu-area").sticky({topSpacing: 0});


  $('.product-carousel').owlCarousel({
    loop: true,
    nav: true,
    margin: 20,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      }
    }
  });

  $('.related-products-carousel').owlCarousel({
    loop: true,
    nav: true,
    margin: 20,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 2,
      },
      1200: {
        items: 3,
      }
    }
  });

  $('.brand-list').owlCarousel({
    loop: true,
    nav: true,
    margin: 20,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 4,
      }
    }
  });


  // Bootstrap Mobile Menu fix
  $(".navbar-nav li a").click(function () {
    $(".navbar-collapse").removeClass('in');
  });

  // jQuery Scroll effect
  $('.navbar-nav li a, .scroll-to-up').bind('click', function (event) {
    var $anchor = $(this);
    var headerH = $('.header-area').outerHeight();
    $('html, body').stop().animate({
      scrollTop: $($anchor.attr('href')).offset().top - headerH + "px"
    }, 1200, 'easeInOutExpo');

    event.preventDefault();
  });

  // Bootstrap ScrollPSY
  $('body').scrollspy({
    target: '.navbar-collapse',
    offset: 95
  })

  $('.add-to-cart-link, .add_to_cart_button').click(function (e) {
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
        var cartProductCount = $('.product-count');
        var cartTotalAmount = $('.cart-amunt');
        cartProductCount.html(totalItems);
        cartTotalAmount.text(`$${totalPrice.toFixed(2)}`);
        $.notify({
          title: "Success:",
          message: "The product <b>" + data[productId]['productName'] + "</b> has been added to your shopping cart."
        }, {type: 'success'});
      },
      error: (data) => {
        $.notify({
          title: "Warning:",
          message: "Something went wrong! <b>" + data.responseJSON.error + "</b>"
        }, {type: 'danger'});
      }
    })
  });
});

(function (i, s, o, g, r, a, m) {
  i['GoogleAnalyticsObject'] = r;
  i[r] = i[r] || function () {
    (i[r].q = i[r].q || []).push(arguments)
  }, i[r].l = 1 * new Date();
  a = s.createElement(o),
    m = s.getElementsByTagName(o)[0];
  a.async = 1;
  a.src = g;
  m.parentNode.insertBefore(a, m)
})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-10146041-21', 'auto');
ga('send', 'pageview');
