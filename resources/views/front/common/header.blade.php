
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <?php $setting = App\Helpers\SiteSettingHelper::SiteSetting();?>
                @if($setting->logo!='')
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{url($setting->logo)}}" class="img-fluid" alt=""></a>
                @else
                     <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('/')}}/front/images/logo.png" class="img-fluid" alt=""></a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse nav-menu-area" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories <span><i class="fa fa-chevron-down"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                            <?php
                                $categories = App\Helpers\CategoryHelper::CategoryWithSubcategory();
                                foreach ($categories as $key => $catv) {
                                    if(count($catv->submenu)){
                            ?>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{url($catv->category_alias)}}">{{$catv->category_name}} &nbsp;<i class="fas fa-caret-right"></i></a>
                                    <ul class="dropdown-menu">
                                        @foreach($catv->submenu as $subcat)
                                            <li><a class="dropdown-item" href="{{url($subcat->sub_category_alias)}}">{{$subcat->sub_category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            <?php } } ?>
                            </ul>

                        </li>

                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Brands <span><i class="fa fa-chevron-down"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                                $brnads = App\Helpers\BrandHelper::Brands();
                                    foreach ($brnads as $bkey => $brand) {?>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{url($brand->brand_alias)}}">{{$brand->brand_name}} &nbsp;</a>

                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('about-us')}}">About us</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('contact-us')}}">Contact Us</a>
                        </li>
                    </ul>





                    </div>
               <div class="head-right">

                    <div class="icon-area">
                        <a href="#" class="my-2 my-lg-0"><i class="fas fa-search"></i></a>
                        <a href="{{route('wishlist')}}" class="my-2 my-lg-0"><i class="far fa-heart"></i></a>
                        @if(!Auth::guard('web')->user())
                            <a href="{{route('my_account')}}" class="my-2 my-lg-0"><i class="far fa-user"></i></a>
                        @else
                              @php $userNAme = Auth::user()->name; @endphp
                            <a href="javascript:void(0);" class="my-2 my-lg-0 click-one"><i class="fa fa-power-off" aria-hidden="true"></i>{{$userNAme}}
                            <div class="p-hide">
                                <a href="{{route('myOrder')}}">My Orders</a>
                                <a href="{{route('my_profile')}}">My Profile</a>
                                <a href="{{route('user_address')}}">My Address</a>
                                <a href="{{route('user_change_password')}}">Change Password</a>
                                <a href="{{route('user_logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();">Logout</a>
                                <form id="logout-form2" action="{{route('user_logout')}}" method="POST" style="display: inline;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        @endif

                </div>
                    <div class="cart-sec" id="cart_refresh">
                        <div class="dropdown">
                            @if(Auth::guard('web')->user())
                            <?php $cart_count = App\Http\Controllers\Controller::CartCount();?>
                            <button type="button" class="btn btn-info cart-btn-click" data-toggle="dropdown">
                             <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                                <span class="badge badge-pill badge-danger cartitemCount" id="cartitemCount">{{$cart_count}}
                                </span>
                            </button>
                            @else
                            	<a href="{{route('my_account')}}" class="btn btn-info">
                             		<i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                            	</a>
                            @endif
                            @if(Auth::guard('web')->user())
                            <?php
                            	$cart_count = App\Http\Controllers\Controller::CartCount();
                            	$cart_total_data = App\Http\Controllers\Controller::GetCartSum();
                            	$datums = App\Http\Controllers\Controller::GetCartData();
                            	$count = count($datums);
                            	if($count>0){
                            ?>
                            <div class="dropdown-menu cart-item">
                                <div class="row total-header-section">
                                      <div class="col-lg-6 col-sm-6 col-6">
                                          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                          <span class="badge badge-pill badge-danger cartitemCount" id="cartitemCount">{{$cart_count}}
                                          </span>
                                      </div>
                                      <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                          <p id="sub_total_cart_price">Total: <span class="text-info">
                                          	<?php
                                          		$cart_total = number_format((float)$cart_total_data->cart_total, 2, '.', '');
                                          	?>
                                          	${{$cart_total}}</span></p>
                                      </div>
                                </div>
                                <?php foreach ($datums as $data){?>
                                    <div class="row cart-detail">
                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        	@if($data->product_image!='')
                                        		<img src="{{url($data->product_image)}}" alt="img{{$data->id}}">
                                        	@else
                                            	<img src="{{url('/')}}/admin/img/No-Image.png" alt="img">
                                            @endif
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                            <p><a href="{{url('product/'.$data->product_alias.'/'.$data->product_code)}}">{{$data->product_name}}</a></p>
                                            <span class="price text-info" id="cart_price_{{$data->id}}">
                                            	<?php
                                            		$price = number_format((float)$data->total_price, 2, '.', '');
                                            	?>
                                            	${{$price}}
                                        	</span>
                                        	<!-- <div class="loader" style="display: none;"></div> -->
                                            <div class="product-qtn-info cart_qty">
                                                 <span class="count"> Quantity:</span><span class="product-dec cart-quantity-decrement" id="cart_quantity_decrement_{{$data->id}}"> <i class="fas fa-minus"></i></span>
                                                 <span class="product-count"><input type="text" class="cart_quantity" value="{{$data->cart_quantity}}" name="cart_quantity" id="cart_quantity_{{$data->id}}" data-id="{{$data->id}}" data-pid="{{$data->product_id}}" data-price="{{$data->product_price}}" min="1" readonly></span>
                                            <span class="product-dec cart-quantity-increment" id="cart_quantity_increment_{{$data->id}}"> <i class="fas fa-plus"></i> </span>
                                            </div>
                                            <p class="product-delete"><i class="far fa-trash-alt" title="Delete" onclick="CartItemDelete('<?php echo $data->id;?>')"></i></p>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                        <a href="{{route('checkout')}}" class="btn btn-primary btn-block">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        	<?php }else{?>
                                <div class="dropdown-menu">
                                    <div class="row cart-detail">
                                        <div class="col-lg-12">Cart is Empty</div>
                                    </div>
                                </div>

                            <?php } ?>
                            @endif
                        </div>
                            </div>

                    </div>

            </nav>
        </div>
        <script>
			$(document).ready(function(){
			$(".cart-item").hide();
			  $(".cart-btn-click").click(function(){
			    $(".cart-item").toggle();
			  });
			});

		</script>
        <script>
            $(document).ready(function(){
                $(".p-hide").hide();
              $(".click-one").click(function(){
                $(".p-hide").toggle(200);
              });
            });
        </script>

    </header>
