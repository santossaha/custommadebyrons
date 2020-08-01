@extends('front.layouts.MainLayout')
@section('title')
Products
@endsection
@section('content')



<!--Our Product-->
<section id="search-results" class="one-way-flight congain">
    <div class="container">
        <div class="row">
           <div class="col-md-3"></div>
           <!-- @include('front.common.Messages') -->
            <div class="col-md-12">
                <div class="my-product">
                    <div class="jumbotron text-center">
                        <h1>Order has been Cancel</h1>
                        <hr>

                        <p class="lead">
                            <a class="btn btn-primary btn-sm" href="{{route('home')}}" role="button">Continue to homepage</a>
                        </p>
                    </div>
                    <div class="row">
                <div class="mobile-filter hidden-desktop visible-mobile"
                     style="position: fixed; right: 16px; bottom: 16px;">
                    <a href="javascript:void(0)" class="open-filter"> <i class="fas fa-sort-up"></i> Filter</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Our Product end-->

@endsection
