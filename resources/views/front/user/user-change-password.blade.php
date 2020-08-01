@extends('front.layouts.MainLayout')
@section('title')
Change Password
@endsection
@section('content')
<link rel="stylesheet" href="{{url('/')}}/front/css/plugins/confirm/jquery-confirm.min.css">
<script src="{{url('/')}}/front/js/plugins/confirm/jquery-confirm.min.js"></script>
<section id="banner" class="inner-backg">
        <div class="inner-pg-banner">
            <img src="{{url('/')}}/front/images/blog-bg.jpg" alt="">
            <div class="inner-ban-head">
                <h1>Change Password</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="user-dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('front.common.leftsidebar')
                <div class="col-md-8">
                    <div class="row order-list">
        <div class="col-md-12">
        	@include('front.common.Messages')
            <div>
                {{ Form::open(['route' => 'password_update', 'method' => 'post', 'id' => 'updatepassword']) }}
                    <div class="row">
                      <div class="col-md-12 user-profile">
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
                          </div>
                      </div>
                      <div class="col-md-12 user-profile">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                          </div>
                      </div>
                     
                      <div class="col-md-12 user-profile">
                        <div class="form-group">
                            <label for="confirm_password">Pincode</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                          </div>
                      </div>
                     
                      <div class="col-md-6">
                          <button type="submit" class="btn btn-primary submit-btm">Change Password</button>
                      </div>
                      
                    </div>
                  {{ Form::close() }}
            </div>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#updatepassword").validate({
            rules: {
                old_password: {
                    required: true
                },
                password: {
                    required: true
                },
                confirm_password: {
                    equalTo: "#password"
                }
            },
            messages: {
                old_password: {
                    required: "Enter your old password."
                },
                password: {
                    required: "Enter new password."
                },
                confirm_password: {
                    equalTo: "Password and confirm password did not match."
                }
            },
        });

    });
</script>
@endsection