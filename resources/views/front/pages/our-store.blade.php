@extends('front.layouts.MainLayout')
@section('title')
Our Store
@endsection
@section('content')
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/our_product_banner.jpeg" alt="">
        <div class="inner-ban-head">
            <h1>{{$pages['page_name']}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$pages['page_name']}}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section id="our-store">
    <div class="container">
        <div class="row">
            {!! $pages['description'] !!}
        </div>
    </div>
</section>
@endsection
