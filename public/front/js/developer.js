new Card({
  form: document.querySelector('form#reg_private'),
  container: '.private-card-wrapper',

  formSelectors: {
    numberInput: 'input#private_card_number',
    expiryInput: 'input#private_card_expiry',
    cvcInput: 'input#private_card_cvc',
    nameInput: 'input#private_card_name'
  },

  width: 200,
  formatting: true,

  messages: {
    monthYear: 'mm/yyyy',
  },

  placeholders: {
    number: '•••• •••• •••• ••••',
    name: 'Full Name',
    expiry: '••/••',
    cvc: '•••'
  },
});

new Card({
  form: document.querySelector('form#reg_district'),
  container: '.district-card-wrapper',

  formSelectors: {
    numberInput: 'input#district_card_number',
    expiryInput: 'input#district_card_expiry',
    cvcInput: 'input#district_card_cvc',
    nameInput: 'input#district_card_name'
  },

  width: 200,
  formatting: true,

  messages: {
    monthYear: 'mm/yyyy',
  },

  placeholders: {
    number: '•••• •••• •••• ••••',
    name: 'Full Name',
    expiry: '••/••',
    cvc: '•••'
  },
});


// Restriction decimal input
$('.phone-no').bind('paste', function () {
  var self = this;
  setTimeout(function () {
    if (!/^\d*(\d{1,2})+$/.test($(self).val())) $(self).val('');
  }, 0);
});

$('.phone-no').bind('keypress', function (e) {
  var character = String.fromCharCode(e.keyCode);
  var newValue = this.value + character;
  if (isNaN(newValue) || character == '.') {
    e.preventDefault();
    return false;
  }
});



$('.dcheckbox').click(function () {
  $('#couponshow').show()
  $('#checkboxdiv').hide()
})



$('#applycoupon').click(function () {
  var couponcode = $('#coupon_code').val();
  var planid = $('#getsubid').val()
  // console.log(couponcode);
  $.ajax({
    headers: {
      'x-csrf-token': $('[name=_csrf]').val()
    },
    type: 'POST',
    url: 'getcoupon',
    data: {
      "code": couponcode,
      "planid": planid
    },
    dataType: "json",
    success: function (data) {
      try {
        var coupon = (data.data['coupon'])
        var subscriptiondetails = (data.data['subscriptiondetails'])
        var deduction_amount = coupon['deduction_amount']
        var deduction_type = coupon['deduction_type']
        var plan_price = subscriptiondetails['price']

        if (deduction_type == 'flat') {
          if (plan_price > deduction_amount) {
            var finalprice = plan_price - deduction_amount
            console.log(finalprice)
            finalprice = Math.round(finalprice)
            $(".couponmessage").html("")
            $('.couponmessage').append("<b style='font-size:11px; color:green;'>Succesfully applied $" + deduction_amount + " off on this price. New plan price is " + finalprice + "</b>");
          } else {
            $(".couponmessage").html("")
            $('.couponmessage').append("<b style='font-size:11px; color:red;'>Coupon is not applicable for this plan</b>");
          }
        } else {
          var finalprice = plan_price * (100 - deduction_amount) / 100
          finalprice = Math.round(finalprice)
          $(".couponmessage").html("")
          $('.couponmessage').append("<b style='color:green; font-size:11px;'>Succesfully applied " + deduction_amount + "% off on this price. New price is " + finalprice + "</b>");
        }
      } catch (error) {
        console.log('not found')
        $(".couponmessage").html("")
        $('.couponmessage').append("<b style='font-size:11px; color:red;'>Coupon not found</b>");
      }

    },
    error: function () {
      console.log("unsuccessful");
    }
  });
})
