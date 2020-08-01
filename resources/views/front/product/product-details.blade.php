@extends('front.layouts.MainLayout')
@section('title')
Products
@endsection
@section('content')
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/our_product_banner.jpeg" alt="">
        <div class="inner-ban-head">
            <h1>Product Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                </ol>
            </nav>
        </div>
    </div>

</section>


<!--product details-->
<section id="product-details">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div id="product-image">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators custom-img-height">
                        <?php
                            $i=1;
                            foreach($product_images as $key => $image){ ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="<?php if($i==1){ echo 'active';}?>">
                           @if($image->product_image!='')
                                <img src="{{url($image->product_image)}}" alt="0{{$key}}">
                            @else
                                <img src="{{url('/')}}/admin/img/No-Image.png" alt="0{{$key}}">
                            @endif
                        </li>
                        <?php $i++; } ?>
                    </ol>
                    <div class="carousel-inner">

                        <?php
                            foreach($product_images as $ikey => $inner_image){
                                $item_class = ($inner_image->default_image == 1) ? 'carousel-item active' : 'carousel-item';
                            ?>
                        <div class="carousel-item {{$item_class}}">

                            @if($inner_image->product_image!='')
                                <img src="{{url($inner_image->product_image)}}" class="d-block w-100" alt="0{{$ikey}}">
                            @else
                                <img src="{{url('/')}}/front/img/No-Image.png" class="d-block w-100" alt="0{{$ikey}}">
                            @endif

                        </div>
                        <?php } ?>


                                        </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                </div>

                <div class="product-add-to-cart">
                    <ul>

                        <li><a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-shopping-cart add-cart " data-product-id="{{$product_id}}" data-uid="{{ $user_id }}" data-product-quantity="1"> ADD TO CART </i> </a></li>
                       {{-- <li><a href="javascript:void(0);" class="shopping-bag"><i class="fa fa-shopping-bag"> BUY NOW</i> </a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details-text">
                    <h1>{{isset($data->product_name)?$data->product_name:''}}</h1>
                    <ul class="ul-ratings">
                        {{--<li class="star">3.5 <i class="fa fa-star"></i></li>
                        <li><a href="#">138 Ratings </a></li>--}}
                        {{--<li><a href="#">15 Reviews</a></li>--}}
                    </ul>
                    <div class="price">
                        {{--<ul>
                            <li><h3>Availability :</h3></li>
                            <li><a href="#"> In stock</a></li>
                        </ul>--}}
                    </div>
                    <div class="price-rs">
                        <ul>
                            <?php
                                $org_price = isset($data->price)?$data->price:'0';
                                $discount = isset($data->discount)?$data->discount:'';
                                $discount_amt = (($org_price*$discount)/100);
                                $price = ($org_price-$discount_amt);

                            ?>
                            <li><h2>${{$price}}</h2></li>
                             @if($data->discount)
                                <li>
                                    <del>${{$org_price}}</del>
                                </li>
                                <li><h4>{{$data->discount}}% off</h4></li>
                            @endif
                        </ul>
                    </div>
                    {{--@if(count($product_sizes)>0)
                        <div class="size">
                            <h3>Size</h3>
                            <ul>
                                @foreach($product_sizes as $size)
                                    <li><a href="javascript:void(0)">{{isset($size->product_size)?$size->product_size:''}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif--}}
                    <div class="delivery">
                        <h3>Delivery</h3>
                        <!-- Load icon library -->
                        <link rel="stylesheet"
                              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                        <!-- The form -->
                        <form class="example" id="delivery_check_form">
                            <input type="text" placeholder="Enter pincode" name="pincode" id="pincode">
                            <button type="submit" id="chk_btn">Check</button>
                            <span id="error_pincode"></span>
                        </form>

                    </div>


                    <div class="highlights-warranty">
                        @if($product_highlights)
                            <h3>Highlights</h3>
                            <ul>
                                @foreach($product_highlights as $highlight)
                                    <li><p><i class="fa fa-circle"></i>{{isset($highlight->highlights)?$highlight->highlights:''}}</p></li>
                                @endforeach

                            </ul>
                        @endif
                        @if($data->warranty)
                            <h3>Warranty</h3>
                            <p>{{isset($data->warranty)?$data->warranty:''}}</p>
                        @endif
                        @if($data->description)
                            <h3>Description</h3>
                            <p>{!! $data->description !!}</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(count($similar_products)>0)
    <section id="similar-products">
        <div class="container">
            <div class="section-heading mb-2">
                <h2>Similar Products</h2>
            </div>

            <div class="my-product">
                <div class="owl-carousel owl-theme" id="product_slider">
                    @foreach($similar_products as $product)
                        <div class="item">
                            <div class="gallery-item">
                                <figure class="ngo-gal">
                                    <div class="image">
                                        @if($product->product_image!='')
                                            <img src="{{url($product->product_image)}}" alt="">
                                        @else
                                            <img src="{{url('/')}}/admin/img/No-Image.png" alt="">
                                        @endif
                                        <div class="icons">
                                           <a href="javascript:void(0);"><i class="fas fa-shopping-cart add-cart" data-product-id="{{$data->id}}" data-uid="{{ $user_id }}" data-product-quantity="1" ></i></a>
                                            <a href="javascript:void(0);"> <i class="far fa-heart whish-list" data-product-id="{{$data->id}}" data-uid="{{ $user_id }}" data-product-quantity="1" ></i></a>
                                            <a href="{{url('product/'.$product->product_alias.'/'.$product->product_code)}}"> <i class="far fa-eye"></i></a>
                                        </div>
                                        <a href="javascript:void(0);" class="add-to-cart add-cart" data-product-id="{{$product->id}}" data-uid="{{ $user_id }}" data-product-quantity="1">Add to Cart</a>
                                    </div>
                                    <figcaption>
                                        <h2>{{isset($product->product_name)?$product->product_name:''}}</h2>

                                        <div class="price">

                                          {{--  <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                            </ul>--}}

                                            <p>
                                                <?php
                                                    $org_price = isset($product->price)?$product->price:'';
                                                    $discount = isset($product->discount)?$product->discount:'';
                                                    $discount_amt = (($org_price*$discount)/100);
                                                    $price = ($org_price-$discount_amt);
                                                ?>
                                                ${{$price}}<br>

                                                @if($product->discount)<span class="line-through">${{$org_price}}</span>@endif
                                            </p>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endif


<!--Brands section-->
{{--@if($brands)
    <div class="brands" id="brands">
        <div class="container-fluid">
            <div class="section-heading mb-2">
                <h2>Our Sponcers</h2>
            </div>

            <ul>
                @foreach($brands as $brand)
                    <li>
                        <div class="brand-sec">
                            <a href="{{url($brand->brand_alias)}}">
                            @if($brand->brand_image!='')
                                <img src="{{url($brand->brand_image)}}" alt="">
                            @else
                                <img src="{{url('/')}}/admin/img/No-Image.png" alt="">
                            @endif
                            </a>

                        </div>
                    </li>
                @endforeach

            </ul>

        </div>
    </div>
@endif--}}
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#delivery_check_form").validate({
            rules: {
                pincode: {
                    required: true,
                }
            },
            messages: {
                pincode: {
                    required: "Enter postal code.",
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "pincode") {
                    error.insertAfter("#error_pincode");
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var pincode = $('#pincode').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('product_delivered_checked')}}",
                    data: {pincode: pincode},
                    beforeSend: function() {
                        $('#chk_btn').html('Checking.....');
                        $('#chk_btn').prop('disable', true);
                         //$('.loader').show();
                    },
                    success: function(result) {
                        console.log(result);
                        $('#chk_btn').html('<button type="submit" id="chk_btn">Check</button>');
                        alert('succ');
                        $('.loader').hide();
                        setTimeout(function() {
                        $("#success_msg").html(result);
                        }, 2000);
                    }
                });
                return false
            }
        })

    });
</script>
@endsection
