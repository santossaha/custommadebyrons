@extends('front.layouts.MainLayout')
@section('title')
Products
@endsection
@section('content')
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
       <img src="{{url('/')}}/front/images/our_product_banner.jpeg" alt="">
        <div class="inner-ban-head">
            <h1>Our Product</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Our Product</li>
                </ol>
            </nav>
        </div>
    </div>

</section>


<!--Our Product-->
<section id="search-results" class="one-way-flight congain">
    <div class="container">
        <div class="row">
           @include('front.common.productSidebar')
            <div class="col-md-9">
                <div class="my-product">
                     <div class="loader" style="display: none;"></div>
                    <div class="row" id="search_result">
                    @include('front.ajax.pagination-search-product')

                    </div>

                </div>
                <div class="mobile-filter hidden-desktop visible-mobile"
                     style="position: fixed; right: 16px; bottom: 16px;">
                    <a href="javascript:void(0)" class="open-filter"> <i class="fas fa-sort-up"></i> Filter</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Our Product end-->


<!--Brands section-->
{{--<div class="brands" id="brands">
    <div class="container-fluid">


        <div class="section-heading mb-2">
            <h2>Our Sponcers</h2>
        </div>

        <ul>
        @if($brands)
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
        @endif
        </ul>

    </div>
</div>--}}
<script>
$(document).ready(function(){
    $(document).on('click', '#search_result .pagination a',function(event){
        //alert('test');
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var myurl = $(this).attr('href');
      // console.log($(this).attr('href').split('page='));
        var page=$(this).attr('href').split('page=')[1];
        ProductBandSearch(page);
        ProductSubcategorySearch(page);
        ProductDiscountSearch(page)

      });
});

</script>
@endsection
