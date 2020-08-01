@extends('front.layouts.MainLayout')
@section('title')
My Account
@endsection
@section('content')
<link href="{{url('/')}}/front/css/plugins/confirm/jquery-confirm.min.css" rel="stylesheet">
<script src="{{url('/')}}/front/js/plugins/confirm/jquery-confirm.min.js"></script>
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/blog-bg.jpg" alt="">
<div class="inner-ban-head">
    <h1>My Account</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
          </nav>
        </div>
    </div>

    </section>


<!--=====privacy & Policy page -content======-->
<section id="my-account">
	<div class="row">
		<div class="col-md-3"></div>
		 <div class="col-md-6">
			@include('front.common.Messages')
		</div>
	</div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 login-form-1">

                <h3>Login</h3>
                {{ Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginFrom']) }}
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName3">Your Email <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control" name="login_email" id="login_email" />
                        <span id="error_login_email"></span>
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName3">Your Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control" name="login_password" id="login_password" />
                        <span id="error_pass"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btnSubmit" value="Login" id="login_btn"> Login</button>
                    </div>
                    <div class="form-group">
                        <a href="#" class="ForgetPwd" data-toggle="modal" data-target="#bannerformmodal">Forget Password?</a>
                    </div>
                 {{ Form::close() }}
            </div>
            <div class="col-md-6 login-form-2">
                <h3>Register</h3>
                {{ Form::open(['url' => 'signup', 'method' => 'post', 'id' => 'signupFrom']) }}
                 {{csrf_field()}}
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName1">Name <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control" name="name" id="name" />
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName2">Your Email <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control" name="email" id="email" />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">Phone <span>*</span></label>
                                <input type="tel" class="form-control unicase-form-control" id="phone" name="phone" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName3">Pincode <span>*</span></label>
                                <input type="tel" class="form-control unicase-form-control" id="pincode" name="pincode" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName4">Your Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control" name="password" id="password" />
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName4">Confirm Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control" name="confirm_password" id="confirm_password" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btnSubmit" value="Sign Up" id="signup_btn"> Sign Up</button>
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
<div class="modal fade bannerformmodal" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true" id="bannerformmodal">
    <div class="modal-dialog">

              <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
                    <p>Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.</p>
                    </div>
                    <div class="modal-body">
                        <form id="resetpassForm">

                            <div class="form-group">
                                <label class="info-title" for="exampleInputName2">Username or Email <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control" id="forgot_email" name="forgot_email" />
                            </div>

                  <div class="modal-footer">
                      <p>Continue to <a href="{{route('my_account')}}">Sign In</a></p>
                    <button type="submit" class="btn btnSubmit" value="Reset Password" id="reset_pass_btn">Reset Password</button>
                  </div>
                   </form>
            </div>

          </div>
        </div>
<div class="modal fade bannerformmodal" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true" id="Resendemail">
    <div class="modal-dialog">
              <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Resend Email Verification</h4>
                    <p>Lost your email verification code? Please enter your username or email address. You will receive a link to active your account.</p>
                    </div>
                    <div class="modal-body">
                       <form id="resendemailForm">

                            <div class="form-group">
                                <label class="info-title" for="exampleInputName2">Email <span>*</span></label>
                               <input type="email" name="resend_email" id="resend_email" class="form-control">
                            </div>
                  <div class="modal-footer">
                      <p>Continue to <a href="{{route('my_account')}}">Sign In</a></p>
                    <button type="submit" class="btn btn-primary" id="resend_btn">Resend</button>
                  </div>
                </form>
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
        $("#loginFrom").validate({
            rules: {
                login_email: {
                    required: true,
                    email: true
                },
                login_password : {
                	required: true
                }
            },
            messages: {
                login_email: {
                    required: "Enter your email.",
                    email: "Entar valid email."
                },
                login_password: {
                	required: "Enter your password."
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "login_email") {
                    error.insertAfter("#error_login_email");
                }else if(element.attr("name") == "login_password"){
                	error.insertAfter("#error_pass");
                } else {
                    error.insertAfter(element);
                }
            }
        })

        $("#signupFrom").validate({
        rules: {
          name: {
            required: true,
          },
          email: {
            required: true,
            email: true,
            remote: {
               url: "{{ route('check_email_signup') }}",
               type: "post"
             }
          },
          phone: {
            required: true,
            digits: true,
          },
          pincode: {
          	required: true,
          	digits: true,
          },
          password:{
            required: true,
          },
          confirm_password:{
            required: true,
            equalTo : "#password"
          }
        },
        messages: {
          name: {
            required: "Enter your name."
          },
          email: {
            required: "Enter email address.",
            email: "Enter valid email address.",
            remote : "Email already exists."
          },
          phone: {
            required: "Enter mobile number.",
            digits: "Enter valid number."
          },
          pincode: {
          	required: "Enter your pincode.",
          	digits: "Enter valid pincode."
          },
          password: {
            required: "Enter password.",
          },
          confirm_password: {
            required: "Enter confirm password.",
            equalTo: "password does not match."
          }
        }
      });
    });
  function Email_verification(){
    $('#Resendemail').modal('show');
    
  }

  $("#resetpassForm").validate({
          rules:{
            forgot_email:{
              required: true,
              email: true,
              remote: {
                url: "{{ route('password_email_verification_check') }}",
                type: "post"
              }
            }
          },
          messages: {
            forgot_email: {
              required: "Enter your email.",
              email: "Enter valid email.",
              remote : "Email not registered"
            }
          },
         submitHandler: function (form){
              $.ajax({
                   type: "POST",
                   url: "{{ route('forget_pass_reset_link') }}",
                   data: $(form).serialize(),
                    beforeSend:function() {
                    $('#reset_pass_btn').html('Sending.....');
                    $('#reset_pass_btn').prop('disable', true)
                    },
                   success: function (data){
                    var json = jQuery.parseJSON(data);
                    if(json.success == 'true'){
                        $.confirm({
                            title: 'Success!',
                            content: 'Mail has been send with the password reset link.',
                            theme: 'material',
                            buttons:{
                                ok: function(){
                                    window.location.reload();
                                }
                            }
                        });
                     }else{
                        $.alert({
                            title: 'Error!',
                            content: 'Some Proble Occured , Please try again later',
                            theme: 'material',
                            buttons:{
                                ok: function(){

                                }
                            }
                        });
                     }

                   }
               });
               return false; // required to block normal submit since you used ajax
            }
        });
</script>

@endsection
