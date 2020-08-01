@extends('front.layouts.MainLayout')
@section('title')
Home
@endsection
@section('content')

<section id="banner">
    <div class="owl-carousel owl-theme slide-ban">
      @foreach($banners as $key => $banner)
        <div class="item">
          @if($banner['image']!='')
            <img src="{{url($banner['image'])}}" alt="Slider{{$key}}">
          @else
            <img src="{{url('/')}}/admin/img/No-Image.png" alt="Slider{{$key}}">
          @endif
            <div class="cover">
                <div class="container">
                    <div class="header-content">
                        <div class="line"></div>
                        <h2>New Arrivals</h2>
                        <h1>{{$banner['title']}}</h1>
                        <a href="{{url('products')}}" class="btn btn-outline-secondary">Shop Now</a>
                    </div>
                </div>
             </div>
        </div>
      @endforeach
    </div>
    </section>

<!-- sec1 -->
<div class="sec1">
    <div class="container-fluid">
        <div class="sec1-inner">
        @if($discount_data)

        @foreach($discount_data as $data)
        <?php

            $new_arrival = isset($data->new_arrival)?$data->new_arrival:'';
            $latest_collection = isset($data->latest_collection)?$data->latest_collection:'';
            $best_selling = isset($data->best_selling)?$data->best_selling:'';
            if($new_arrival=='1'){
                $title = 'New Arrivals';
                $heading = 'Save';
                $discount = isset($data->discount)?$data->discount:'';
                $image = isset($data->product_image)?$data->product_image:'';
            }else if($latest_collection=='1'){
                $title = 'Best Selling';
                $heading = isset($data->sub_category_name)?$data->sub_category_name:'';
                $discount = isset($data->discount)?$data->discount:'';
                $image = isset($data->product_image)?$data->product_image:'';
            }else if($best_selling=='1'){
                 $title = 'Latest Collection';
                 $heading = 'Save';
                 $discount = isset($data->discount)?$data->discount:'';
                 $image = isset($data->product_image)?$data->product_image:'';
            }
        ?>
        <div class="sec1-l">
            @if($image!='')
                <img src="{{url($image)}}" alt="">
            @else
                <img src="{{url('/')}}/admin/img/No-Image.png" alt="">
            @endif

            <div class="sec1-content">
                <h2>{{$title}}</h2>
                <h3>{{$heading}} Up To <span>{{$discount}}% Off</span></h3>
                <a href="{{url('products')}}" class="btn btn-outline-secondary">Shop Now</a>
            </div>

        </div>
        @endforeach
        @endif
    </div>
    </div>

</div>

   <!--Shipping area start-->
  {{-- <div class="shipping_area">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="shipping_list d-flex justify-content-between">
                    <div class="single_shipping_box d-flex">
                        <div class="shipping_icon">
                            <img src="{{url('/')}}/front/images/s1.png" alt="shipping icon">
                        </div>
                        <div class="shipping_content">
                            <h6>Check Registration</h6>
                            <p>Free shipping on all order</p>
                        </div>
                    </div>
                    <div class="single_shipping_box one d-flex">
                        <div class="shipping_icon">
                            <img src="{{url('/')}}/front/images/s2.png" alt="shipping icon">
                        </div>
                        <div class="shipping_content">
                            <h6>Free Shipping</h6>
                            <p>Free shipping on all UK orders</p>
                        </div>
                    </div>
                    <div class="single_shipping_box two d-flex">
                        <div class="shipping_icon">
                            <img src="{{url('/')}}/front/images/s3.png" alt="shipping icon">
                        </div>
                        <div class="shipping_content">
                            <h6>Premium Support</h6>
                            <p>We support online 24 hours a day </p>
                        </div>
                    </div>
                    <div class="single_shipping_box d-flex">
                        <div class="shipping_icon">
                            <img src="{{url('/')}}/front/images/s4.png" alt="shipping icon">
                        </div>
                        <div class="shipping_content">
                            <h6>Free Exchange</h6>
                            <p>30 days return on all items</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>--}}
<!--Shipping area end-->

<!-- Featured products -->
<div class="gallery">

    <div class="container-fluid">


        <div class="section-heading mb-2">
            <h2>New arrivals</h2>
        </div>

        <div class="gallery-wrap">
            <div class="gallery-menu">
                <ul>

                    @if($subcategories)
                        @foreach($subcategories as $val)
                            <li><a href="javascript:void(0)" onclick="SearchProduct('<?php echo $val->sub_cat_id?>')">{{isset($val->sub_category_name)?$val->sub_category_name:''}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
          <div class="loader" style="display: none;"></div>
            <div class="grid" id="new_arrival_search_product">
            @if($new_arrival_products)
              @foreach($new_arrival_products as $pro)
                  <div class="grid-item">
                      <div class="gallery-item">
                          <figure class="ngo-gal">
                              <div class="image">
                                @if($pro['product_image'][0]->product_image!='')
                                  <img src="{{url($pro['product_image'][0]->product_image)}}" alt=""/>
                                @else
                                  <img src="{{url('/')}}/admin/img/No-Image.png" alt=""/>
                                @endif
                                <div class="icons">
                                  <a href="javascript:void(0);"><i class="fas fa-shopping-cart add-cart" data-product-id="{{$pro->id}}" data-uid="{{ $user_id }}" data-product-quantity="1" ></i></a>
                                  <a href="javascript:void(0);"> <i class="far fa-heart whish-list" data-product-id="{{$pro->id}}" data-uid="{{ $user_id }}" data-product-quantity="1" ></i></a>
                                  <a href="{{url('product/'.$pro->product_alias.'/'.$pro->product_code)}}"> <i class="far fa-eye"></i></a>
                                </div>
                                <a href="javascript:void(0);" class="add-to-cart add-cart" data-product-id="{{$pro->id}}" data-uid="{{ $user_id }}" data-product-quantity="1">Add to Cart</a>
                              </div>
                              <figcaption>
                                  <a href="{{url('product/'.$pro->product_alias.'/'.$pro->product_code)}}"> <h2>{{ isset($pro->product_name)?$pro->product_name:'' }}</h2></a>

                                  <div class="price">
                                       {{-- <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                        </ul>--}}

                                        <p>
                                            <?php
                                                $discount = isset($pro->discount)?$pro->discount:'';
                                                $org_price = isset($pro->price)?$pro->price:'';
                                                $dis_amt = ($org_price*$discount)/100;
                                                $dis_price = ($org_price-$dis_amt);
                                            ?>
                                            ${{$dis_price}} <span class="line-through">${{$org_price}}</span>
                                        </p>
                                    </div>
                                </figcaption>
                            </figure>
                      </div>
                  </div>
              @endforeach
            @endif



            </div>
        </div>


<div class="prod-btn mx-auto  text-center justify-content-center align-self-center"><a href="{{url('products')}}" class="btn btn-outline-secondary">View All</a></div>

    </div>
</div>


<!-- Latest Collections -->
<div class="sec1 latest-collection">
    <div class="container-fluid">
        <div class="section-heading mb-2">
            <h2>Our Latest Collections</h2>
        </div>

        <div class="sec1-inner">
        @if($latests)
            @foreach($latests as $value)
                <div class="sec1-l">
                    @if($value['product_image'][0]->product_image!='')
                        <img src="{{url($value['product_image'][0]->product_image)}}" alt="">
                    @else
                        <img src="{{url('/')}}/admin/img/No-Image.png" alt="">
                    @endif
                    <div class="sec1-content">
                        <h2>Latest Collection</h2>
                        <h3>{{isset($value->product_name)?$value->product_name:''}}</span></h3>
                        <p>

                            Lorem ipsum dolor sit amet, consectetur adipiscing magna. Mauris sed coqut odio.
                        </p>
                        <a href="{{url('product/'.$value->product_alias.'/'.$value->product_code)}}" class="btn btn-outline-secondary">Shop Now</a>
                    </div>

                </div>
            @endforeach
        @endif
    </div>


<div class="product-collection gallery">
    <div class="owl-carousel owl-theme collect">
      @if($products)
        @foreach($products as $val)
          <div class="item">
              <figure class="ngo-gal">
                  <div class="image">
                  <?php $image = isset($val['product_image'][0]->product_image)?$val['product_image'][0]->product_image:'';?>
                     @if($image!='')
                        <img src="{{url($image)}}" alt=""/>
                      @else
                        <img src="{{url('/')}}/admin/img/No-Image.png" alt=""/>
                      @endif
                    <div class="icons">
                      <a href="javascript:void(0);"><i class="fas fa-shopping-cart add-cart" data-product-id="{{$val->id}}" data-uid="{{ $user_id }}" data-product-quantity="1"></i></a>
                      <a href="javascript:void(0);"> <i class="far fa-heart whish-list" data-product-id="{{$val->id}}" data-uid="{{ $user_id }}" data-product-quantity="1" ></i></a>
                      <a href="{{url('product/'.$val->product_alias.'/'.$val->product_code)}}"> <i class="far fa-eye"></i></a>
                    </div>
                    <a href="{{url('product/'.$val->product_alias.'/'.$val->product_code)}}" class="add-to-cart">Shop Now</a>
                  </div>
                  <figcaption>
                      <h2>{{ isset($val->product_name)?$val->product_name:'' }}</h2>

                      <div class="price">
                       {{-- <ul>
                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                            <li><a href="#"><i class="far fa-star"></i></a></li>
                        </ul>--}}
                        <p>
                            <?php
                                $discount = isset($val->discount)?$val->discount:'0';
                               //s echo $discount;
                                $org_price = isset($val->price)?$val->price:'0';
                                $dis_amt = (($org_price*$discount)/100);
                                $dis_price = ($org_price-$dis_amt);
                            ?>
                            ${{isset($dis_price)?$dis_price:''}} <span class="line-through">${{isset($org_price)?$org_price:''}}</span>
                        </p>
                    </div>
                    </figcaption>
                </figure>
          </div>
        @endforeach
      @endif
    </div>
</div>

    </div>

</div>



<!-- contact area -->
<div id="contact-area">
    <div class="container-fluid">
        <div class="section-heading mb-2">
            <h2>Contact Us Via Form</h2>
        </div>
        <div class="contact-page">
            <div class="row">
                <div class="col-md-12 contact-form">
                   <span id="msg"></span>
                   <span id="error_msg"></span>
                    <form id="contact_form" action="javascript:void(0);">
                        <div class="row">
                    <div class="col-md-4 ">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="con_name" placeholder="Your Name" name="con_name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="con_email" name="con_email" placeholder="Email Address">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputTitle">Phone No <span>*</span></label>
                                <input type="tel" class="form-control unicase-form-control text-input" id="con_phone" name="con_phone" placeholder="Phone Number">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputComments">Subject <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="con_sub" name="con_sub" placeholder="Subject">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputComments">Your Message <span>*</span></label>
                                <textarea class="form-control unicase-form-control" id="con_msg" name="con_msg"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 outer-bottom-small">
                        <button type="submit" class="btn btn-transparent btn-rounded btn-large" id="send_message">Send Message</button>
                    </div>
                </div>
                    </form>
                </div>


            </div><!-- /.contact-page -->
        </div>
    </div>
</div>

<!-- Brands section -->
{{--<div class="brands">
    <div class="container-fluid">
        <div class="section-heading mb-2">
            <h2>Our Sponcers</h2>
        </div>
        <ul>
          @if($brands)
            @foreach($brands as $brand)
              <li>
                  <div class="brand-sec">
                    @if($brand['brand_image']!='')
                      <a href="{{url($brand['brand_alias'])}}"><img src="{{url($brand['brand_image'])}}" alt=""></a>
                    @else
                       <a href="{{url($brand['brand_alias'])}}"><img src="{{url('/')}}/admin/img/No-Image.png" alt=""></a>
                    @endif
                </div>
              </li>
            @endforeach
          @endif
        </ul>

    </div>
</div>--}}
<script>
    function SearchProduct(sub_cat_id){
       var _token = '<?php echo csrf_token() ?>';
            $.ajax({
                type: "post",
                url: "{{ route('new_arrival_product_search') }}",
                data: {
                    _token: _token,
                    sub_cat_id: sub_cat_id
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(result) {
                    $('.loader').hide();
                    $("#new_arrival_search_product").html(result);
                    // }, 1000);
                }
            });
    }
</script>
@endsection
