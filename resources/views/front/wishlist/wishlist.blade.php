@extends('front.layouts.MainLayout')
@section('title')
Wishlist
@endsection
@section('content')
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/cart-bg.jpg" alt="">
        <div class="inner-ban-head">
            <h1>Wishlist</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
        </div>
    </div>
</section>
<section class="user-dashboard">
    <div class="container-fluid">
        <div class="row">
            @include('front.common.leftsidebar')
            <div class="col-md-8 ">
                <div id="cart-page" class="row order-list">
                    <div class="col-md-12 cart-page theme-default-margin">
                        <form action="" method="post" novalidate="" class="cart">
                            <div class="row">
                              <div class="col-lg-12 col-12">
                                <div class="cart-table table-responsive mb-40">
                                  <table id="auto_refresh">
                                    <thead>
                                      <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-remove">Remove</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($datums)>0)
                                            <?php $i=1;?>
                                            @foreach($datums as $data)
                                              <tr>
                                                <td class="pro-thumbnail"><a href="{{url('product/'.$data->product_alias.'/'.$data->product_code)}}">
                                                    @if($data->product_image!='')
                                                        <img src="{{url($data->product_image)}}" alt="{{$data->product_name}}">
                                                    @else
                                                        <img src="{{url('/')}}/admin/img/No-Image.png" alt="{{$i}}.{{$data->product_name}}">
                                                    @endif
                                                </a></td>
                                                <td class="pro-title">
                                                  <a href="{{url('product/'.$data->product_alias.'/'.$data->product_code)}}">{{$i}}. {{$data->product_name}}</a>
                                                 <!--  <p><small>SKU: WSSBD145HF13006</small></p> -->
                                                </td>
                                                <?php
                                                    if($data->discount!=''){
                                                        $discount = isset($data->discount)?$data->discount:'0';
                                                        $org_price = isset($data->price)?$data->price:'0';
                                                        $dis_amt = ($org_price*$discount)/100;
                                                        $price_amt = ($org_price-$dis_amt);
                                                        $price = number_format((float)$price_amt, 2, '.', '');
                                                        $amount = ($data->quantity*$price_amt);
                                                        $total = number_format((float)$amount, 2, '.', '');

                                                    }else{
                                                        $price = number_format((float)$data->price, 2, '.', '');
                                                        $amount = ($data->quantity*$data->price);
                                                        $total = number_format((float)$amount, 2, '.', '');
                                                    }
                                                ?>
                                               
                                                <td class="pro-price"><span class="amount"><span class="money" data-currency-usd="${{$price}}"><strong>${{$price}}</strong></span></span></td>
                                                <td class="pro-quantity">
                                                     <div class="loader" style="display: none;"></div>
                                                    <div class="product-quantity qty plus-position">
                                                        <span class="pl-t quantity-decrement" id="quantity_decrement_{{$data->id}}"><i class="fas fa-minus"></i></span>
                                                        <input type="text" class="quantity" value="{{$data->quantity}}" name="quantity" id="quantity_{{$data->id}}" data-id="{{$data->id}}" data-pid="{{$data->product_id}}" data-price="{{$price}}" min="1" readonly>
                                                        <span class="pl-one quantity-increment" id="quantity_increment_{{$data->id}}"><i class="fas fa-plus"></i></span>
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal"><span class="money" id="item_cart_price_{{$data->id}}" data-currency-usd="${{$total}}"><strong>${{$total}}</strong></span>
                                                    <a class="btn theme-default-button btn-transparent wishlist-to-add-to-cart" style="text-decoration:none" href="javascript:void(0);" data-id="{{$data->id}}" data-product-quantity="{{$data->quantity}}" data-uid="{{$user_id}}" >Add to Cart</a>
                                                </td>
                                                <td class="pro-remove"><i class="far fa-trash-alt" title="Delete" onclick="WishlistItemDelete(<?php echo $data->id;?>)"></i></td>
                                              </tr>
                                              <?php $i++;?>
                                            @endforeach
                                        @else
                                            <tr><td class="pro-title" colspan="6">YOUR WISHLIST IS EMPTY</td></tr>
                                        @endif
                                    </tbody>
                                  </table>
                                  
                                </div>
                                    <div class="my-pagination">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                {{ $datums->links() }}
                                            </li>
                                        </ul>
                                    </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if($brands)
    <div class="brands" id="brands">
    <div class="container-fluid">


        <div class="section-heading mb-2">
            <h2>Our Sponcers</h2>
        </div>

        <ul>
       
            @foreach($brands as $brand)
                <li>
                    <div class="brand-sec">
                       @if($brand['brand_image']!='')
                      <a href="{{url($brand->brand_alias)}}"><img src="{{url($brand['brand_image'])}}" alt=""></a>
                    @else
                       <a href="{{url($brand->brand_alias)}}"><img src="{{url('/')}}/admin/img/No-Image.png" alt=""></a>
                    @endif

                    </div>
                </li>
            @endforeach
       
        </ul>

    </div>
</div>
 @endif
<script>
    $(document).ready(function() {
        $('body').on("click",".quantity-increment",function() {
            // alert('dk');
            var quantity = $(this).parent(".qty").find(".quantity");
            var total_quantity = Number(quantity.val())+1;
            var id = parseInt(quantity.attr('data-id'));
            var pid = parseInt(quantity.attr('data-pid'));
            var act_price = parseFloat(quantity.attr('data-price'));
            if(total_quantity<=10){
                quantity.val(total_quantity);
                var total_price = (total_quantity*act_price).toFixed(2);
                 $('#item_cart_price_'+id).html('<strong>$'+total_price+'</strong>');
                QuantityUpdate(id,pid,total_quantity);
            }else{
                $("quantity_increment_"+id).attr("disabled", true);
            }
        });
        $('body').on("click",".quantity-decrement",function() {
            var quantity = $(this).parent(".qty").find(".quantity");
            var tot_qty = Number(quantity.val());
            if(tot_qty>1){
                var total_quantity = tot_qty-1;
                quantity.val(total_quantity);
                var id = parseInt(quantity.attr('data-id'));
                var pid = parseInt(quantity.attr('data-pid'));
                var act_price = parseFloat(quantity.attr('data-price'));
                var total_price = (total_quantity*act_price).toFixed(2);
               
                 $('#item_cart_price_'+id).html('<strong>$'+total_price+'</strong>');
                 QuantityUpdate(id,pid,total_quantity);
            }else{
               $("quantity_decrement_"+id).attr("disabled", true); 
            }
        });
        $('body').on('click', '.wishlist-to-add-to-cart', function() {
            //alert('dk');
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
            var id = $(this).attr("data-id");
            var user_id = $(this).attr("data-uid");
            var quantity = $(this).attr("data-product-quantity");
            if (user_id != '' && parseInt(user_id) > 0) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('wishlist_to_add_to_cart') }}",
                    data: {
                        id: id,user_id: user_id,quantity: quantity
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
                        $("#auto_refresh").load(location.href + " #auto_refresh");
                    }
                });
            } else {
                window.location.href = "{{ route('my_account') }}";
            }
        });
    });
    function WishlistItemDelete(id) {
        var _token = '<?php echo csrf_token() ?>';
        $.ajax({
            type: "post",
            url: "{{ route('wishlist_item_delete') }}",
            data: {
                _token: _token,id: id
            },
            before: function() {},
            success: function(data) {
                if (data == 1) {
                    toastr.success('Wishlist Item Deleted', 'Wishlist', {timeOut: 1000,progressBar:true,onHidden:function() {}
                        });
                    $("#auto_refresh").load(location.href + " #auto_refresh");
                }
            }
        });
    }
    function QuantityUpdate(id,pid,total_quantity){
        //alert(total_quantity);
        $.ajax({
            type: "post",
            url: "{{route('quantity_update')}}",
            data: {id:id,pid:pid,total_quantity:total_quantity},
            beforeSend: function() {
                 $('.loader').show();
            },
            success:function(d){
                 $('.loader').hide();
                toastr.success('Quantity Update Successfully', 'Quantity Update', {timeOut: 1000,progressBar:true,onHidden:function() {}
                        });
            },
           
        });
    }
</script>



@endsection