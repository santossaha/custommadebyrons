<div class="col-md-4 side-nav">
    <div class="heading">
        <?php $users = Auth::guard('web')->user();?>
        @if($users->image!='')
            <img src="{{url($users->image)}}" alt="">
        @else
            <img src="{{url('/')}}/admin/img/No-Image.png" alt="">
        @endif

        <div class="info">
            <h3><a href="{{route('my_profile')}}">{{isset($users->name)?$users->name:''}}</a></h3>
            <p><a href="mailto:{{isset($users->email)?$users->email:''}}">{{isset($users->email)?$users->email:''}}</a></p>
            <p>{{isset($users->phone)?$users->phone:''}}</p>
        </div>
    </div>
    <ul class="categories">
        <li class="<?php if(Request::segment(1)=='my-order'){ echo 'active';}?>"><i class="fab fa-first-order"></i><a href="{{route('myOrder')}}"> My Order</a></li>
        <li class="<?php if(Request::segment(1)=='my-profile'){ echo 'active';}?>"><i class="fa fa-user" aria-hidden="true"></i><a href="{{route('my_profile')}}">Profile Information</a></li>
        <li class="<?php if(Request::segment(1)=='user-address'){ echo 'active';}?>"><i class="far fa-address-card"></i><a href="{{route('user_address')}}">Manage Addresses</a></li>
        <li class="<?php if(Request::segment(1)=='wishlist'){ echo 'active';}?>"><i class="fas fa-heart"></i><a href="{{route('wishlist')}}"> My Wishlist</a></li>
        <li class="<?php if(Request::segment(1)=='user-change-password'){ echo 'active';}?>"><i class="fa fa-unlock"></i><a href="{{route('user_change_password')}}"> Change Password</a></li>
        <li><i class="fas fa-sign-out-alt"></i><a href="{{route('user_logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();"> Log Out</a></li>
        <form id="logout-form2" action="{{route('user_logout')}}" method="POST" style="display: inline;">
            {{ csrf_field() }}
        </form>
    </ul>
</div>
