@extends('front.layouts.MainLayout')
@section('title')
Add Address
@endsection
<style>
    .chkfrm{margin-top: 20px;}
    .chkfrm input{font-size: 14px;}
    .chkfrm input::placeholder{font-size: 14px;}
    .chkfrm label{font-size: 14px;}
    .chkfrm label span{color: red;}
    .adddres_button{display: flex; align-items: center; justify-content: flex-start;}
    .adddres_button label{font-size: 14px; margin-bottom: 0;display: flex; width: 100%; align-items: center;}
    .adddres_button input[type=radio]{width: 20px; margin-right:10px;}
    .adddres_button input:focus{outline: none; border: none; box-shadow: none;}
</style>
@section('content')

<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/chk-bg.jpg" alt="">
        <div class="inner-ban-head">
            <h1>Checkout</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>

</section>


<!-- Checkout-page-page -->

<!-- contact area -->

<div id="contact-area" class="checkout-page">
    <div class="container">
     <form method="get" action="{{route('checkout_processs')}}" id="chechk_out_form">
          {{csrf_field()}}
        <div class="row">
            <div class="col-md-6">
                <div class="cont-pg-head lv-msg">
                    <div class="section-heading mb-2">
                        <h2>Billing Address </h2>
                    </div>
                </div>
                <div class="contact-page cont-l">
                    <div class="row">


                        <div class="col-md-12 contact-form">
                            @foreach($user_address as $data)
                            <div class="defult-address">
                                <div class="dflt-ad">

                                    <?php
                                    $name = $data->first_name.' '.$data->last_name;
                                    ?>
                                    <p>{{$name}}</p>
                                    <span>{{isset($data->address_one)?$data->address_one:''}}</span>
                                    @if($data->address_two!='')
                                    <span>{{isset($data->address_two)?$data->address_two:''}}</span>
                                    @endif
                                    <span>{{isset($data->city)?$data->city:''}} - {{isset($data->pincode)?$data->pincode:''}}</span>
                                    <span>{{isset($data->state_name)?$data->state_name:''}}, {{isset($data->country_name)?$data->country_name:''}}</span>
                                    <span>Mobile: {{isset($data->phone)?$data->phone:''}}</span>
                                    <div class="adddres_button">
                                        <label>
                                            <input type="radio" class="form-control" name="address" id="address_{{$data->id}}" value="{{$data->id}}" data-id="{{$data->id}}" data-fname="{{$data->first_name}}" data-lname="{{$data->last_name}}" data-email="{{$data->email}}" data-phone="{{$data->phone}}" data-company="{{$data->company_name}}" data-address1="{{$data->address_one}}" data-address2="{{$data->address_two}}" data-city="{{$data->city}}" data-zip="{{$data->pincode}}" data-country="{{$data->country}}" data-state="{{$data->state}}">
                                        Use Address  </label>

                                    </div>
                                </div>

                                <div class="address-edit-remove" >
                                    <span class="address-edit"><a href="javascript:;" onclick="UserAddressDelete(<?php echo $data->id;?>)">Remove</a></span>
                                </div>
                            </div>
                            @endforeach


                                <input type="hidden" name="user_address_id" id="user_address_id" value="">
                                <input type="hidden" name="user_address_state_id" id="user_address_state_id" value="">
                                <div class="row chkfrm">
                                    <div class="col-md-6">
                                        <div class="register-form" role="form">
                                            <div class="form-group">
                                                <label class="info-title" for="billing_fname">First Name
                                                    <span>*</span></label>
                                                    <input type="text" class="form-control unicase-form-control text-input"
                                                    id="billing_fname" name="billing_fname">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="register-form" role="form">
                                                <div class="form-group">
                                                    <label class="info-title" for="billing_lname">Last Name
                                                        <span>*</span></label>
                                                        <input type="text" class="form-control unicase-form-control text-input"
                                                        id="billing_lname" name="billing_lname" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="register-form" role="form">
                                                    <div class="form-group">
                                                        <label class="info-title" for="billing_email">Email Address
                                                            <span>*</span></label>
                                                            <input type="email" class="form-control unicase-form-control text-input"
                                                            id="billing_email" name="billing_email" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="register-form" role="form">
                                                        <div class="form-group">
                                                            <label class="info-title" for="billing_phone">Phone No
                                                                <span>*</span></label>
                                                                <input type="tel" class="form-control unicase-form-control text-input"
                                                                id="billing_phone" name="billing_phone" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="register-form" role="form">
                                                            <div class="form-group">
                                                                <label class="info-title" for="billing_company_name">Company
                                                                    Name</label>
                                                                    <input type="text" class="form-control unicase-form-control text-input"
                                                                    id="billing_company_name" name="billing_company_name" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="register-form" role="form">
                                                                <div class="form-group">
                                                                    <label class="info-title" for="exampleInputComments">Address
                                                                        <span>*</span></label>
                                                                        <input type="text"
                                                                        class="form-control unicase-form-control text-input mb-3"
                                                                        id="billing_address_one" name="billing_address_one" placeholder="Address line 1">
                                                                        <input type="text" class="form-control unicase-form-control text-input"
                                                                        id="billing_adddress_two" name="billing_adddress_two" placeholder="Address line 2">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="register-form" role="form">
                                                                    <div class="form-group">
                                                                        <label class="info-title" for="billing_country">Country <span>*</span></label>
                                                                        <select type="text" class="form-control unicase-form-control text-input" id="billing_country" name="billing_country">
                                                                            <option value="">Select Country</option>
                                                                            @foreach($countries as $country)
                                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="register-form" role="form">
                                                                    <div class="form-group">
                                                                        <label class="info-title" for="billing_state">State <span>*</span></label>

                                                                        <select class="nice-select form-control unicase-form-control" id="billing_state" name="billing_state">
                                                                            <option value="">Select country first</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="register-form" role="form">
                                                                    <div class="form-group">
                                                                        <label class="info-title" for="billing_city">Town/City <span>*</span></label>
                                                                        <input type="text" class="form-control unicase-form-control text-input" id="billing_city" name="billing_city" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="register-form" role="form">
                                                                    <div class="form-group">
                                                                        <label class="info-title" for="billing_zipcode">Zip Code <span>*</span></label>
                                                                        <input type="tel" class="form-control unicase-form-control text-input"
                                                                        id="billing_zipcode" name="billing_zipcode" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                <div class="col-md-12">
                                                <div class="check-box-area">

                                        <div class="custom-control custom-checkbox mr-3">
                                            <input type="checkbox" class="custom-control-input" id="same_billing_shipping" name="same_billing_shipping" value="1">
                                            <label class="custom-control-label" for="same_billing_shipping">Ship to different
                                                Address</label>
                                            </div>
                                        </div>
                                        <div class="ship-add-div" style="display: none">
                                            <div class="cont-pg-head lv-msg">
                                                <div class="section-heading mb-2">
                                                    <h2>Shipping Address</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="register-form" role="form">
                                                        <div class="form-group">
                                                            <label class="info-title" for="shipping_fname">First Name
                                                                <span>*</span></label>
                                                                <input type="text"
                                                                class="form-control unicase-form-control text-input"
                                                                id="shipping_fname" name="shipping_fname" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="register-form" role="form">
                                                            <div class="form-group">
                                                                <label class="info-title" for="shipping_lname">Last Name
                                                                    <span>*</span></label>
                                                                    <input type="text"
                                                                    class="form-control unicase-form-control text-input"
                                                                    id="shipping_lname" name="shipping_lname" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="register-form" role="form">
                                                                <div class="form-group">
                                                                    <label class="info-title" for="shipping_email">Email
                                                                        Address <span>*</span></label>
                                                                        <input type="email"
                                                                        class="form-control unicase-form-control text-input"
                                                                        id="shipping_email" name="shipping_email" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="register-form" role="form">
                                                                    <div class="form-group">
                                                                        <label class="info-title" for="shipping_phone">Phone No
                                                                            <span>*</span></label>
                                                                            <input type="tel"
                                                                            class="form-control unicase-form-control text-input"
                                                                            id="shipping_phone" name="shipping_phone" placeholder="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="register-form" role="form">
                                                                        <div class="form-group">
                                                                            <label class="info-title" for="shipping_company_name">Company
                                                                                Name</label>
                                                                                <input type="text"
                                                                                class="form-control unicase-form-control text-input"
                                                                                id="shipping_company_name" placeholder="" name="shipping_company_name">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="register-form" role="form">
                                                                            <div class="form-group">
                                                                                <label class="info-title" for="exampleInputComments">Address
                                                                                    <span>*</span></label>
                                                                                    <input type="text"
                                                                                    class="form-control unicase-form-control text-input mb-3"
                                                                                    id="exampleInputTitle5" name="shipping_address_one" placeholder="Address line 1">
                                                                                    <input type="text"
                                                                                    class="form-control unicase-form-control text-input"
                                                                                    id="exampleInputTitle6" name="shipping_address_two" placeholder="Address line 2">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="register-form" role="form">
                                                                                <div class="form-group">
                                                                                    <label class="info-title" for="country_shipping">Country
                                                                                        <span>*</span></label>

                                                                                        <select name="country_shipping" id="country_shipping" class="form-control unicase-form-control text-input">
                                                                                            <option value="">Select Country</option>
                                                                                            @foreach($countries as $country)
                                                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="register-form" role="form">
                                                                                    <div class="form-group">
                                                                                        <label class="info-title" for="state_shipping">State
                                                                                            <span>*</span></label>

                                                                                            <select class="nice-select form-control unicase-form-control" id="state_shipping" name="state_shipping">
                                                                                                <option value="">Select country first</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="register-form" role="form">
                                                                                        <div class="form-group">
                                                                                            <label class="info-title" for="shipping_city">Town/City
                                                                                                <span>*</span></label>
                                                                                                <input type="text"
                                                                                                class="form-control unicase-form-control text-input"
                                                                                                id="shipping_city" name="shipping_city" placeholder="">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="register-form" role="form">
                                                                                            <div class="form-group">
                                                                                                <label class="info-title" for="shipping_zipcode">Zip Code
                                                                                                    <span>*</span></label>
                                                                                                    <input type="tel"
                                                                                                    class="form-control unicase-form-control text-input"
                                                                                                    id="shipping_zipcode" name="shipping_zipcode" placeholder="">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                    </div>

                                </div>
                                <!--  </form> -->
                            </div>


                        </div><!-- /.checkout-page -->
                    </div>
                </div>
                <div class="col-md-6 card">
                    <div class="cont-pg-head">
                        <div class="section-heading mb-2">
                            <h2>Cart Total</h2>
                        </div>
                    </div>
                    <div class="cont-add chk-prod-cartd mb-5" id="checkout_refresh">
                        @if(count($datums)>0)
                        <?php
                        $sub_total = number_format((float)$sub_total->order_total, 2, '.', '');
                        if($sub_total<$deliverCharge->max_delivery_charge){
                            $charge = $deliverCharge->delivery_amount;
                        }
                        else{
                            $charge = '0.00';
                        }
                        $total =  $sub_total+$charge;
                        $grand_total = number_format((float)$total, 2, '.', '');

                        ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h2>Product</h2>
                                <h2>Quantity</h2>
                                <h2>Price</h2>
                                <h2>Total</h2>
                                <h2>Action</h2>
                            </li>
                            @foreach($datums as $data)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$data->product_name}}
                                <span>{{$data->cart_quantity}}</span>
                                <span>
                                    <?php $price = number_format((float)$data->product_price, 2, '.', ''); ?>
                                    ${{$price}}</span>
                                    <span>
                                        <?php $total_price = number_format((float)$data->total_price, 2, '.', ''); ?>
                                        ${{$total_price}}</span>
                                        <p class="product-delete"><i class="far fa-trash-alt" title="Delete" onclick="CartItemDelete('<?php echo $data->id;?>')"></i></p>
                                    </li>
                             @endforeach
                            <li class="list-group-item d-flex justify-content-between align-items-center bd-none">
                            Sub Total
                            <span>

                                ${{$sub_total}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center bd-none">
                                Shipping Fee
                                <span>
                                    ${{$charge}}
                                </span>
                            </li>
                            <li class="bd-none list-group-item d-flex justify-content-between align-items-center bd-none">
                                <h2>Grand Total</h2>
                                <h2>${{$grand_total}}</h2>
                            </li>
                        </ul>
                        @else
                            <ul class="list-group list-group-flush " id="no_product_here">No product here</ul>
                        @endif
                    </div>
                    <div class="cont-pg-head">
                                    <div class="section-heading mb-2">
                                        <h2>Payment Method</h2>
                                    </div>
                                </div>
                        <div class="cont-add chk-prod-cartd">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="custom-control coustom-checkbox">
                                        <input type="radio" class="custom-control-input" id="customCheck5" name="payment_mode" value="1" checked>
                                        <label class="custom-control-label" for="customCheck5">Cash On Delivery</label>
                                    </div>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="custom-control coustom-checkbox">
                                        <input type="radio" class="custom-control-input" id="customCheck6" name="payment_mode" value="2">
                                        <label class="custom-control-label" for="customCheck6">Online Payment</label>
                                    </div>
                                </li>


                            </ul>
                            <span id="error_payment_mode"></span>

                        </div>
                        <div id="stripe_from" style="display: none;">
                            <label for="card-element">Credit or debit card</label>
                            <div id="card-element"></div>
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <button type="submit" class="btn btn-transparent btn-rounded btn-large mt-5 order_submit" >Place Order</button>
                    </div>
                </div>
     </form>


</div>
</div>

 <!-- <script type="text/javascript" src="{{url('/')}}/front/js/card.js"></script> -->
 <script>
    $(document).ready(function(){
        $('input:radio[name=payment_mode]').change(function() {
              var checked = $('input[name=payment_mode]:checked').val();
                //alert(checked);

        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#billing_country').change(function(){
          var country_id = $('#billing_country').val();
          //alert('state'+state);
          var select_state = $('#user_address_state_id').val();
          //alert(select_state);
            if(country_id != '')
            {
                $.ajax({
                  method:"POST",
                  url: "{{route('fetch_state')}}",
                  data:{country_id:country_id,select_state:select_state},
                  success:function(data)
                  {
                    $('#billing_state').html(data);
                  }
                });
            }
            else
            {
            $('#billing_state').html('<option value="">Select country first</option>');
            }
        });
        $('#country_shipping').change(function(){
          var country_id = $('#country_shipping').val();
          //alert(country_id);
            if(country_id != '')
            {
                $.ajax({
                  method:"POST",
                  url: "{{route('fetch_state')}}",
                  data:{country_id:country_id},
                  success:function(data)
                  {
                    $('#state_shipping').html(data);
                  }
                });
            }
            else
            {
            $('#state_shipping').html('<option value="">Select country first</option>');
            }
        });
    });
    $(function () {
        $('input:radio[name=address]').change(function(){
            var first_name = $(this).attr("data-fname");
            $('#billing_fname').val(first_name);
            var last_name = $(this).attr("data-lname");
            $('#billing_lname').val(last_name);
            var email = $(this).attr("data-email");
            $('#billing_email').val(email);
            var phone = $(this).attr("data-phone");
            $('#billing_phone').val(phone);
            var company_name = $(this).attr("data-company");
            $('#billing_company_name').val(company_name);
            var address1 = $(this).attr("data-address1");
            //alert(address1);
            $('#billing_address_one').val(address1);
            var address2 = $(this).attr("data-address2");
            $('#billing_address_two').val(address2);
            var city = $(this).attr("data-city");
            $('#billing_city').val(city);
            var zip = $(this).attr("data-zip");
            $('#billing_zipcode').val(zip);
            var country = $(this).attr("data-country");
            var state = $(this).attr("data-state");
            $('#user_address_state_id').val(state);
            $('#billing_country').val(country).change();
            //$('select.billing_country').find(':selected').val(country);
            //$('#user_address_county_id').val(country);

            $('#billing_state').val(state);
            var user_address_id = $(this).attr("data-id");
            $('#user_address_id').val(user_address_id);
        });

  });
  function UserAddressDelete(id) {
        var _token = '<?php echo csrf_token() ?>';
        $.ajax({
            type: "post",
            url: "{{ route('user_address_delete') }}",
            data: {
                _token: _token,id: id
            },
            before: function() {},
            success: function(data) {
                if (data == 1) {
                    toastr.success('User Address Deleted', 'User Address', {timeOut: 1000,progressBar:true,onHidden:function() {}
                        });
                    //window.location.reload();
                    setTimeout(function() {
                       window.location.reload();
                      }, 1000);
                    }
            }
        });
    }
$(document).ready(function() {
    $('body').on('click','.order_submit',function(){
        if($('#no_product_here').html() == "No product here"){
            $('.order_submit').prop('disabled', true);
        }
        $("#chechk_out_form").validate({
            rules: {
                "billing_fname": {
                    required: true,
                },
                "billing_lname": {
                    required: true,
                },
                "billing_email": {
                    required: true,
                    email: true
                },
                "billing_phone": {
                    required: true,
                    digits: true,
                    maxlength: 11,
                    minlength: 10
                },
                "billing_address_one": {
                    required: true
                },
                "billing_country": {
                    required: true
                },
                "billing_state": {
                    required: true
                },
                "billing_city": {
                    required: true
                },
                "billing_zipcode": {
                    required: true,
                    digits: true,
                    maxlength: 6,
                    minlength: 5
                },
                 "shipping_fname": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }

                },
                "shipping_lname": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                },
                "shipping_email": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    email: true
                },
                "shipping_phone": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    digits: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    maxlength: 11,
                    minlength: 10
                },
                "shipping_address_one": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                },
                "country_shipping": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                },
                "state_shipping": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                },
                "shipping_city": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                },
                "shipping_zipcode": {
                    required: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    digits: {
                        depends: function(element) {
                            if ($('input[name="same_billing_shipping"]:checked').val() == "1") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    maxlength: 6,
                    minlength: 5
                },
                "payment_mode":{
                    required: true
                }

            },
            messages: {
                "billing_fname": {
                    required: 'First name is required'
                },
                "billing_lname": {
                    required: 'Last name is required'
                },
                "billing_email": {
                    required: 'Email is required',
                    email: 'Email address is invalid'
                },
                "billing_phone": {
                    required: 'Phone number is required'
                },
                "billing_address_one": {
                    required: 'Address is required'
                },
                "billing_country":{
                    required: 'Country is required'
                },
                "billing_state": {
                    required: 'State is required'
                },
                "billing_city": {
                    required: 'City is required'
                },
                "billing_zipcode": {
                    required: 'Zipcode is required'
                },
                "shipping_fname": {
                    required: 'First name is required'
                },
                "shipping_lname": {
                    required: 'Last name is required'
                },
                "shipping_phone": {
                    required: 'Phone number is required'
                },
                "shipping_address_one": {
                    required: 'Address is required'
                },
                "country_shipping":{
                    required: 'Country is required'
                },
                "state_shipping": {
                    required: 'State is required'
                },
                "shipping_city": {
                    required: 'City is required'
                },
                "shipping_zipcode": {
                    required: 'Zipcode is required'
                },
                "payment_mode": {
                    required: "payment mode is required"
                }
            },
             errorPlacement: function(error, element) {
                if (element.attr("name") == "payment_mode") {
                    error.insertAfter("#error_payment_mode");
                } else {
                    error.insertAfter(element);
                }
            },
        });
    });
});
</script>


<script>

</script>

@endsection
