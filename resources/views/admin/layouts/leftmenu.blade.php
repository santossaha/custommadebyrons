<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <?php
        $segment= Request::segment(2);
        ?>
        <ul class="sidebar-menu" id="nav-accordion">
            @if(Auth::user()->role == 'Admin')
            <p class="centered"><a class="logout fancybox fancybox.iframe" href="{{route('admin::profile',['id'=>Auth::user()->id])}}">
                @if(Auth::user()->image!='')
                    <img src="{{url('/')}}/admin/img/admin_profile/{{Auth::user()->image}}" class="img-circle" width="70px" height="70px">
                @else
                    <img src="{{url('/')}}/admin/img/No-Image.png" class="img-circle" width="70px" height="70px">
                @endif
            </a></p>
            <h5 class="centered">{{Auth::user()->name}}</h5>
            <li class="mt">
                <a class="<?php if($segment == 'dashboard') {echo 'active';} ?>" href="{{route('admin::dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sub-menu">
                <a class="<?php if($segment=='manage-admin' || $segment=='manage-user'){ echo 'active';}?>" href="javascript:void(0);">
                    <i class="fa fa-users"></i>
                    <span>Manage Users</span>
                </a>
                <ul class="sub">
                    <li class="<?php if($segment == 'manage-admin') {echo 'active';} ?>"><a href="{{route('admin::manage_admin')}}"><i class="fa fa-users"></i>Admins</a></li>
                    <li class="<?php if($segment == 'manage-user'){ echo 'active';}?>"><a href="{{route('admin::manage_user')}}"><i class="fa fa-users"></i>Users</a></li>
                </ul>
            </li>
             <li class="sub-menu">
                <a href="<?php if($segment=='manage-category' || $segment=='manage-sub-category' || $segment== 'manage-product' || $segment== 'manage-size'|| $segment== 'manage-delivery-charge'){ echo 'active';}?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Manage Product</span>
                </a>
                <ul class="sub">
                    <li class="<?php if($segment == 'manage-category') {echo 'active';} ?>"><a href="{{route('admin::manage_category')}}"><i class="fa fa-list"></i>Categories</a></li>
                    <li class="<?php if($segment == 'manage-sub-category') {echo 'active';} ?>"><a href="{{route('admin::manage_subcategory')}}"><i class="fa fa-list"></i>Sub Categories</a></li>
                    <li class="<?php if($segment == 'manage-size') {echo 'active';} ?>"><a href="{{route('admin::manage_size')}}"><i class="fa fa-list"></i>Product Sizes</a></li>
                    <li class="<?php if($segment == 'manage-product') {echo 'active';} ?>"><a href="{{route('admin::manage_product')}}"><i class="fa fa-list"></i>Products</a></li>
                    <li class="<?php if($segment == 'manage-delivery-charge') {echo 'active';} ?>"><a href="{{route('admin::manageDeliveryCharge')}}"><i class="fa fa-list"></i>Delivery Charge</a></li>
                </ul>
            </li>
                <li class="mt">
                    <a class="<?php if($segment == 'manage-order') {echo 'active';} ?>" href="{{route('admin::manage_order')}}">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        <span>Manage Order</span>
                    </a>
                </li>
             <li class="sub-menu">
                <a class="<?php if($segment=='manage-banner' || $segment=='manage-brand' || $segment=='manage-page' || $segment=='manage-setting' || $segment=='manage-testimonial' ||$segment == 'manage-opening-time'||$segment == 'manage-contact'){ echo 'active';}?>" href="javascript:;">
                    <i class="fa fa-dashboard"></i>
                    <span>Manage CMS</span>
                </a>
                <ul class="sub">
                    <li class="<?php if($segment == 'manage-opening-time') {echo 'active';} ?>"><a href="{{route('admin::OpeningTime')}}"><i class="fa fa-list"></i>Opening Time</a></li>
                    <li class="<?php if($segment == 'manage-banner') {echo 'active';} ?>"><a href="{{route('admin::manage_banner')}}"><i class="fa fa-list"></i>Banner</a></li>
                    <li class="<?php if($segment == 'manage-testimonial') {echo 'active';} ?>"><a href="{{route('admin::manage_testimonial')}}"><i class="fa fa-list"></i>Testimonial</a></li>
                    <li class="<?php if($segment == 'manage-page') {echo 'active';} ?>"><a href="{{route('admin::manage_page')}}"><i class="fa fa-list"></i>Pages</a></li>
                    <li class="<?php if($segment == 'manage-contact') {echo 'active';} ?>"><a href="{{route('admin::manageContact')}}"><i class="fa fa-list"></i>Contact Us</a></li>
                    <li class="<?php if($segment == 'manage-setting') {echo 'active';} ?>"><a href="{{route('admin::manage_setting')}}"><i class="fa fa-list"></i>Setting</a></li>
                </ul>
            </li>

            @endif
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
