@extends('front.layouts.MainLayout')
@section('title')
About Us
@endsection
@section('content')
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        @if($pages->background_image!='')
            <img src="{{url($pages->background_image)}}" alt="">
        @else
            <img src="{{url('/')}}/front/images/about-bg.jpg" alt="">
        @endif
<div class="inner-ban-head">
    <h1>About Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
          </nav>
        </div>
    </div>

    </section>


<!-- About-us-area -->
<div class="about-us">
    <div class="container">
        <div class="about-inner">
        	@if($pages['image']!='')
            	<img src="{{url($pages['image'])}}" alt="">
            @else
            	<img src="{{url('/')}}/admin/img/No-Image.png" alt="">
            @endif
            <div class="about-content">
                <div class="section-heading mb-2">
                    <h2>{{isset($pages['page_title'])?$pages['page_title']:''}}</h2>
                </div>
                <p>{!! isset($pages['description'])?$pages['description']:'' !!}</p>
<div class="row">
    <div class="col-md-4">
    </div>
</div>
            </div>
        </div>
    </div>
</div>

@if($testimonials)
<div class="testimonial">
    <div class="container-fluid">
        <div class="section-heading mb-2">
            <h2>Our Testimonials</h2>
        </div>
        <div class="owl-carousel owl-theme  client">
        	@foreach($testimonials as $val)
	            <div class="item">
	                <figure class="feedbck">
	                	<?php
								$name = isset($val->name)?$val->name:'';
								$name = explode(' ', $name);

								$firstName = $name[0];
								//$lastName = (isset($name[count($name)-1])) ? $name[count($name)-1] : '';
	                	?>
	                    <blockquote>{{$firstName}}: {!! isset($val->description)?$val->description:'' !!}
	                      <div class="arrow"></div>
	                    </blockquote>
	                    @if($val->image!='')
	                    	<img src="{{url($val->image)}}" alt="">
	                    @else
	                    	<img src="{{url('/')}}/admin/img/No-Image.png" alt="">
	                    @endif
	                    <div class="author">
	                      <h5> {!! isset($val->name)?$val->name:'' !!}</h5>
	                      <span> {!! isset($val->designation)?$val->designation:'' !!}</span>
	                    </div>
	                  </figure>
	            </div>
            @endforeach


        </div>



    </div>

</div>
@endif




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



@endsection
