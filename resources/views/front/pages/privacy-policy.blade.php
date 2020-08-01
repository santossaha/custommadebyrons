@extends('front.layouts.MainLayout')
@section('title')
Privacy Policy
@endsection
@section('content')
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/blog-bg.jpg" alt="">
<div class="inner-ban-head">
    <h1>{{isset($pages['page_name'])?$pages['page_name']:''}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{isset($pages['page_name'])?$pages['page_name']:''}}</li>
            </ol>
          </nav>
        </div>
    </div>

    </section>


<!--=====privacy & Policy page -content======-->
<section id="privacy-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-12">
        <h3>{{isset($pages['page_title'])?$pages['page_title']:''}}</h3>

            <ul>{!! $pages['description'] !!}</ul>

            </div>
        </div>
    </div>
</section>

@endsection
