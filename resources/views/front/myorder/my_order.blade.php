@extends('front.layouts.MainLayout')
@section('title')
Wishlist
@endsection
@section('content')
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/cart-bg.jpg" alt="">
        <div class="inner-ban-head">
            <h1>Wishlist</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">My Order</li>
                    </ol>
                </nav>
        </div>
    </div>
</section>
<section class="user-dashboard">
    <div class="container-fluid">
        <div class="row">
            @include('front.common.leftsidebar')
            <div class="col-md-8 ">
                <div id="cart-page" class="row order-list">
                    <div class="col-md-12 cart-page theme-default-margin">
                        <form action="" method="post" novalidate="" class="cart">
                            <div class="row">
                              <div class="col-lg-12 col-12">
                                <div class="cart-table table-responsive mb-40">
                                  <table id="auto_refresh">
                                    <thead>
                                      <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-subtotal">Order Date</th>
                                        <th class="pro-subtotal">Payment Type</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($datums)>0)
                                            <?php $i=1;?>
                                            @foreach($datums as $data)
                                              <tr>
                                                <td class="pro-thumbnail"><a href="{{url('product/'.$data->product_alias.'/'.$data->product_code)}}">
                                                    @if($data->product_image!='')
                                                        <img src="{{url($data->product_image)}}" alt="{{$data->product_name}}">
                                                    @else
                                                        <img src="{{url('/')}}/admin/img/No-Image.png" alt="{{$i}}.{{$data->product_name}}">
                                                    @endif
                                                </a></td>
                                                <td class="pro-title">
                                                  <a href="{{url('product/'.$data->product_alias.'/'.$data->product_code)}}">{{$i}}. {{$data->product_name}}</a>
                                                </td>
                                                <td class="pro-price"><span class="amount"><span class="money" data-currency-usd="${{$data->product_price}}"><strong>${{$data->product_price}}</strong></span></span></td>
                                                <td class="pro-quantity">
                                                    <span class="money" id="item_cart_price_{{$data->id}}" data-currency-usd="{{$data->quantity}}"><strong>{{$data->quantity}}</strong>
                                                    </span>
                                                </td>
                                                <td class="pro-subtotal">
                                                    <span class="money" id="item_cart_price_{{$data->id}}" data-currency-usd="${{$data->product_price}}"><strong>${{$data->product_price}}</strong>
                                                    </span>
                                                </td>
                                                  <td class="pro-subtotal">
                                                    <span class="money" id="item_cart_price_{{$data->id}}" data-currency-usd="{{$data->created_at}}"><strong>{{date('m-d-Y', strtotime($data->created_at))}}</strong>
                                                    </span>
                                                  </td>
                                                  <td class="pro-subtotal">
                                                      @php $orderType = \App\Models\Admin\OrderStatus::where('order_id',$data->order_id)->value('order_type');
                                                        $value = '';
                                                      if($orderType == 'cod'){
                                                          $value = 'COD';
                                                      }else if ($orderType == 'online'){
                                                          $value = 'Online';
                                                      }
                                                      @endphp
                                                    <span class="order-type"  ><strong>{{$value}}</strong>
                                                    </span>
                                                  </td>
                                              </tr>
                                              <?php $i++;?>
                                            @endforeach
                                        @else
                                            <tr><td class="pro-title" colspan="6">YOUR ORDRE IS EMPTY</td></tr>
                                        @endif
                                    </tbody>
                                  </table>

                                </div>
                                    <div class="my-pagination">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                {{--{{ $datums->links() }}--}}
                                            </li>
                                        </ul>
                                    </div>
                              </div>
                            </div>
                        </form>
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

</script>



@endsection
