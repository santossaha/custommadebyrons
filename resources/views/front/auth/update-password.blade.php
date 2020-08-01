@extends('front.layouts.MainLayout')
@section('title')
Update Password
@endsection
@section('content')

<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/blog-bg.jpg" alt="">
<div class="inner-ban-head">
    <h1>My Account</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Update Password</li>
            </ol>
          </nav>
        </div>
    </div>
   
    </section>

  
<!--=====privacy & Policy page -content======-->
<section id="my-account">
	<div class="row">
		 <div class="col-md-6">
			@include('front.common.Messages')
		</div>
	</div>
    <div class="container">
        <div class="row">
        	
            <div class="col-md-6 login-form-1">
            	
                <h3>Change Password</h3>
                {{ Form::open(['route' => 'create_reset_password', 'method' => 'post', 'id' => 'restFrom']) }}
                  <input type="hidden" name="email" value="{{$email}}">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName3">Your Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control" name="password" id="password" />
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName3">Your Confirm Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control" name="cpassword" id="cpassword" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btnSubmit" value="Change" id="change_btn"> Change Password</button> 
                    </div>
                 {{ Form::close() }}
            </div>
            
        </div>
    </div>
</section>






<!-- Brands section -->
<?php if(count($brands)>0){?>
<div class="brands">
    <div class="container-fluid">
        <div class="section-heading mb-2">
            <h2>Our Sponcers</h2>
        </div> 

        <ul>
        	<?php
        		foreach($brands as $brand){ 
        	?>
			<li>
				<div class="brand-sec">
					<a href="#">
						@if($brand['brand_image']!='')
							<img src="{{url($brand['brand_image'])}}" alt="">
						@else
							<img src="{{url('/')}}/admin/img/No-Image.png" alt="">
						@endif
					</a>
				</div>
			</li>
		<?php } ?>
        </ul>

    </div>
</div>
<?php } ?>


<script>
	$(document).ready(function() {
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#restFrom").validate({
            rules: {
                password: {
                    required: true,
                },
                cpassword : {
                	required: true,
                  equalTo: "#password",
                }
            },
            messages: {
                password: {
                    required: "Enter your password.",
                },
                cpassword: {
                	required: "Enter your confirm password.",
                  equalTo: "Password did not match.",
                }
            },
        })
        
    });
</script>

@endsection