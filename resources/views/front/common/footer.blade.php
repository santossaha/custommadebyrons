 <!-- footer start -->
   <footer class="footer footer_two pt-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!--Single Footer-->
                <div class="single_footer widget">
                    <div class="single_footer_widget_inner">
                     <?php $setting = App\Helpers\SiteSettingHelper::SiteSetting();?>
                        <div class="footer_logo">
                            <a href="{{url('/')}}">
                                @if($setting->logo!='')
                                    <img src="{{url($setting->logo)}}" alt="">
                                @else
                                    <img src="{{url('/')}}/front/images/logo.png" alt="">
                                @endif
                            </a>
                        </div>
                        <div class="footer_content">
                            <p>Address: {{isset($setting->address)?$setting->address:''}}</p>
                            <p>Phone: +{{isset($setting->phone)?$setting->phone:''}}</p>
                            <p>Email: <a href="mailto:{{isset($setting->email)?$setting->email:''}}">{{isset($setting->email)?$setting->email:''}}</a></p>
                        </div>
                        <div class="footer_social">
                            <h4>Get in Touch:</h4>
                            <div class="footer_social_icon">
                                <a href="{{isset($setting->twitter)?$setting->twitter:''}}"><i class="fab fa-twitter"></i></a>
                                <a href="{{isset($setting->google_plus)?$setting->google_plus:''}}"><i class="fab fa-google-plus-g"></i></a>
                                <a href="{{isset($setting->facebook)?$setting->facebook:''}}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{isset($setting->youtube)?$setting->youtube:''}}"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Single Footer-->
            </div>
            <div class="col-lg-6">
                <div class="footer_menu_list d-flex justify-content-between">
                    <!--Single Footer-->
                    <div class="single_footer widget">
                        <div class="single_footer_widget_inner">
                            <div class="footer_title">
                                <h2>My Account</h2>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="#">My Orders</a></li>
                                    <li><a href="#"> Order History</a></li>
                                    <li><a href="#"> Wishlist</a></li>
                                    <li><a href="#"> My Addresses</a></li>
                                    <li><a href="#"> My Personal Info</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Single footer end-->
                    <!--Single footer start-->
                    <div class="single_footer widget">
                        <div class="single_footer_widget_inner">
                            <div class="footer_title">
                                <h2>Information</h2>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                                    <li><a href="{{url('our-store')}}"> Our Store</a></li>
                                    <li><a href="#"> Delivery Information</a></li>
                                    <li><a href="{{url('about-us')}}"> About us</a></li>
                                    <li><a href="{{url('privacy-policy')}}"> Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Single Footer end-->
                    <!--Single footer start-->
                    <div class="single_footer widget">
                        <div class="single_footer_widget_inner">
                            <div class="footer_title">
                                <h2> Opening Time </h2>
                            </div>
                            <div class="footer_menu">
                                <?php $value =  \App\Models\Admin\OpeningTime::first();
                                ?>
                                <ul>
                                    @if($value->mon_to_fri_opening !== NULL && $value->mon_to_fri_closing !== NULL)
                                    <li>Mon – Fri: {{ date('h:i A', strtotime($value->mon_to_fri_opening))}}–{{ date('h:i A', strtotime($value->mon_to_fri_closing))}}</li>
                                    @else
                                        <li>Mon – Fri: Closed</li>
                                    @endif
                                    @if($value->opening_sat !== NULL && $value->closing_sat !== NULL)
                                    <li>Sat: {{ date('h:i A', strtotime($value->opening_sat))}}-{{ date('h:i A', strtotime($value->closing_sat))}}</li>
                                     @else
                                     <li>Sat: Closed</li>
                                     @endif
                                    @if($value->opening_sun !== NULL && $value->closing_sun !== NULL)
                                     <li>Sun: {{ date('h:i A', strtotime($value->opening_sun))}}-{{ date('h:i A', strtotime($value->closing_sun))}}</li>
                                        @else
                                    <li>Sun: Closed</li>
                                        @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Single Footer end-->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer_title">
                    <h2> Join Our Newsletter Now </h2>
                </div>
                <div class="footer_news_letter">
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <div class="newsletter_form">
                        <form action="javascript:void(0);" id="subscribe_from">
                            <input type="email" placeholder="Your Email Address" name="sub_email" id="sub_email">
                            <span id="msg" style="color: green; font-size: 13px;"></span>
                            <span id="error_msg" style="color: red; font-size: 13px;"></span>
                            <span id="error_sub_email"></span>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            <input type="submit" value="Subscribe" id="newsletter-submit">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



</footer>
<div class="copyright">
    <div class="container">
        <div class="row cr-inner">
            <div class="col-lg-8 col-md-8">
                <div class="copyright_text">
                    <p>{{isset($setting->copyright)?$setting->copyright:''}}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="footer_mastercard">
                    <ul>
                        <li><a href="#"><i class="fab fa-cc-visa"></i></a>
                        </li>
                        <li><a href="#"><i class="fab fa-cc-stripe"></i></a></li>
                        <li><a href="#"><i class="fab fa-cc-paypal"></i></a></li>
                        <li><a href="#"><i class="fab fa-cc-mastercard"></i></a></li>
                        <li><a href="#"><i class="fab fa-cc-amex"></i></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#subscribe_from").validate({
            rules: {
                sub_email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{ route('check_subscribe_email') }}",
                        type: "post"
                    }
                }
            },
            messages: {
                sub_email: {
                    required: "Enter your email",
                    email: "Entar valid email",
                    remote: "Email already subscribe!"
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "sub_email") {
                    error.insertAfter("#error_sub_email");
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var sub_email = $('#sub_email').val();
                //alert(sub_email);
                $.ajax({
                    type: "POST",
                    url: "{{ route('newsletter') }}",
                    data: {
                        sub_email: sub_email
                    },
                    beforeSend: function() {
                        $('#newsletter-submit').html('Processing.....');
                        $('#newsletter-submit').prop('disable', true)
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#subscribe_from")[0].reset();
                            $('#msg').html('Subscribed successfully.');
                        } else {
                            $("#subscribe_from")[0].reset();
                           $('#error_msg').html('Something went wrong');
                        }
                    }
                });
                return false
            }
        })
        $("#contact_form").validate({
            rules: {
                con_name: {
                    required: true
                },
                con_email: {
                    required: true,
                    email: true
                },
                con_phone :{
                    required: true,
                    digits: true

                },
                con_sub: {
                    required: true
                },
                con_msg: {
                    required: true
                }
            },
            messages: {
                con_name: {
                    required: "Enter your name."
                },
                con_email: {
                    required: "Enter your email.",
                    emai: "Enter valid email."
                },
                con_phone: {
                    required: "Enter phone number.",
                    digits: "Enter valid phone number."
                },
                con_sub: {
                    required: "Enter subject."
                },
                con_msg:{
                    required: "Enter Message."
                }

            },

            submitHandler: function(form) {
                var con_name = $('#con_name').val();
                var con_email = $('#con_email').val();
                var con_phone = $('#con_phone').val();
                var con_sub = $('#con_sub').val();
                var con_msg = $('#con_msg').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('save_contact_us') }}",
                    data: {
                        con_name: con_name,con_email:con_email,con_phone:con_phone,con_sub:con_sub,con_msg:con_msg
                    },
                    beforeSend: function() {
                        $('#send_message').html('Processing.....');
                        $('#send_message').prop('disable', true)
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            $("#contact_form")[0].reset();
                            $('#send_message').html('<button type="submit" class="btn btn-transparent btn-rounded btn-large" id="send_message">Send Message</button>');
                            $('#msg').html('Thank you for your enquiry.Your message has been sent successfully.');
                        } else {
                            $("#contact_form")[0].reset();
                           $('#error_msg').html('Something went wrong');
                        }
                    }
                });
                return false
            }
        })
        $('body').on('click', '.whish-list', function() {
            //alert('ok');
            var product_id = $(this).attr("data-product-id");
            var user_id = $(this).attr("data-uid");
            var quantity = $(this).attr("data-product-quantity");
            if (user_id != '' && parseInt(user_id) > 0) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('add_to_wishlist') }}",
                    data: {
                        product_id: product_id,user_id: user_id,quantity: quantity
                    },
                    beforeSend: function() {
                    },
                    success: function(data) {
                       var j = $.parseJSON(data);
                       if(j.status==1){
                        toastr.success(j.msg, 'Wishlist', {timeOut: 1000,progressBar:true,onHidden:function() {}
                        });
                       }
                       else if(j.status==3){
                        toastr.error('Product Already Added', 'Wishlist failed', {timeOut: 2000,closeButton:true,progressBar:true});
                       }
                        //alert(j.status);
                    }
                });
            } else {
                window.location.href = "{{ route('my_account') }}";
            }
        });
        $('body').on('click', '.add-cart', function() {
            var b = 0;
            var cart_count = $("#cartitemCount").text();
            if (cart_count == 0) {
                $('.cartitemCount').css('display', 'none');
            }
            var cart_counts = parseInt(cart_count) + parseInt(b);
            cart_counts += +1;
            if (cart_counts == 0) {
                //$("#cartitemCount").css("display", "block");
                $('.cartitemCount').css('display', 'none');
            } else {
                $('.cartitemCount').css('display', 'block');
                $(".cartitemCount").animate({
                    opacity: 1
                }, 300, function() {
                    $(this).text(cart_counts);
                });
            }
            var product_id = $(this).attr("data-product-id");
            var user_id = $(this).attr("data-uid");
            var quantity = $(this).attr("data-product-quantity");
            if (user_id != '' && parseInt(user_id) > 0) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('add_to_cart') }}",
                    data: {
                        product_id: product_id,user_id: user_id,quantity: quantity
                    },
                    beforeSend: function() {
                    },
                    success: function(data) {
                       var j = $.parseJSON(data);
                       if(j.status==1){
                        toastr.success(j.msg, 'Cart', {timeOut: 1000,progressBar:true,onHidden:function() {}
                        });
                       }
                        else if(j.status==3){
                        toastr.error('Product Already Added', 'Cart failed', {timeOut: 2000,closeButton:true,progressBar:true});
                       }
                        $("#cart_refresh").load(location.href + " #cart_refresh");
                    }
                });
            } else {
                window.location.href = "{{ route('my_account') }}";
            }
        });
        $('body').on("click",".cart-quantity-increment",function() {
            var quantity = $(this).parent(".cart_qty").find(".cart_quantity");
            var total_quantity = Number(quantity.val())+1;
            var id = parseInt(quantity.attr('data-id'));
            var pid = parseInt(quantity.attr('data-pid'));
            var act_price = parseFloat(quantity.attr('data-price'));
            if(total_quantity<=10){
                quantity.val(total_quantity);
                var total_price = (total_quantity*act_price).toFixed(2);
                 $('#cart_price_'+id).html('$'+total_price);
                CartQuantityUpdate(id,pid,total_quantity);
            }else{
                $("cart_quantity_increment_"+id).attr("disabled", true);
            }
        });
        $('body').on("click",".cart-quantity-decrement",function() {
            var quantity = $(this).parent(".cart_qty").find(".cart_quantity");
            var tot_qty = Number(quantity.val());
            if(tot_qty>1){
                var total_quantity = tot_qty-1;
                quantity.val(total_quantity);
                var id = parseInt(quantity.attr('data-id'));
                var pid = parseInt(quantity.attr('data-pid'));
                var act_price = parseFloat(quantity.attr('data-price'));
                var total_price = (total_quantity*act_price).toFixed(2);

                 $('#cart_price_'+id).html('$'+total_price);
                 CartQuantityUpdate(id,pid,total_quantity);
            }else{
               $("cart_quantity_decrement_"+id).attr("disabled", true);
            }
        });
    });
 function CartQuantityUpdate(id,pid,total_quantity){
        $.ajax({
            type: "post",
            url: "{{route('cart_quantity_update')}}",
            data: {id:id,pid:pid,total_quantity:total_quantity},
            beforeSend: function() {
            },
            success:function(d){
                toastr.success('Quantity Update Successfully', 'Cart Quantity Update', {timeOut: 1000,progressBar:true,onHidden:function() {}
                        });
                $("#sub_total_cart_price").load(location.href + " #sub_total_cart_price");
            },

        });
    }
  function CartItemDelete(id) {
        var d = 0;
        var cart_count = $("#cartitemCount").text();
            if (cart_count == 0) {
                $('.cartitemCount').css('display', 'none');
            }
        var cart_counts = parseInt(cart_count) + parseInt(d);
        cart_counts += -1;
            if (cart_counts == 0) {
            //$("#cartitemCount").css("display", "block");
                $('.cartitemCount').css('display', 'none');
            } else {
                $('.cartitemCount').css('display', 'block');
                $(".cartitemCount").animate({
                    opacity: 1
                    }, 300, function() {
                    $(this).text(cart_counts);
                    });
            }
        var _token = '<?php echo csrf_token() ?>';
        $.ajax({
            type: "post",
            url: "{{ route('cart_item_delete') }}",
            data: {
                _token: _token,id: id
            },
            before: function() {},
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Cart Item Deleted', 'Cart', {timeOut: 1000,progressBar:true,onHidden:function() {}
                        });
                    $("#cart_refresh").load(location.href + " #cart_refresh");
                    $("#checkout_refresh").load(location.href + " #checkout_refresh");
                    //$(".order_submit").addAttachmentClass('disabled');
                }
            }
        });
    }
</script>
</body>
</html>
