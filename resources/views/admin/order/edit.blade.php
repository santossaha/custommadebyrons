@extends('admin.layouts.adminlayout')
@section('content')
    <style>
        .order-heading{width: 100%; position: relative; padding: 15px 0 20px !important; border-bottom: 1px solid #000; margin-bottom: 20px;}
        .order-heading h2{font-size: 30px !important; text-transform: capitalize; font-weight: 600;}
    </style>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="clearfix pull-right" style="display: flex">
                <a href="{{url('/admin/print-order/')}}/{{$order->id}}" class="btn btn-default" target="_blank" data-toggle="tooltip" title="" data-original-title="Print">
                    <i class="fa fa-print" aria-hidden="true"></i>
                </a>

                <form method="POST" action="#">
                    <button type="submit" class="btn btn-default" data-toggle="tooltip" title="" data-loading="" data-original-title="Send Email">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <!-- /row -->
            <div class="col-lg-12 mt">
                <div class="row content-panel">
                    <div class="col-lg-12">
                        <div class="invoice-body">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="order-heading">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-md-6">
                                        <div class="order clearfix">
                                            <h4>Order Information</h4>
                                            <div class="">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        @if(isset($order->created_at))
                                                        <td>Order Date</td>
                                                        <td>{{$order->created_at}}</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Order Status</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-lg-9 col-md-10 col-sm-10">
                                                                    <select id="order-status" class="form-control custom-select-black" data-id="1">
                                                                        <option value="canceled">Canceled</option>
                                                                        <option value="completed" selected="">Completed</option>
                                                                        <option value="on_hold">On Hold</option>
                                                                        <option value="pending">Pending</option>
                                                                        <option value="processing">Processing</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if(isset($order->order_type))
                                                    <tr>
                                                        <td>Payment Method</td>
                                                        <td>{{$order->order_type}}</td>
                                                    </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="account-information">
                                            <h4>Account Information</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        @if(isset($userDetails->name))
                                                        <td>Customer Name</td>
                                                        <td>{{isset($userDetails->name) ? $userDetails->name : ''}}</td>
                                                            @endif
                                                    </tr>
                                                    <tr>
                                                        @if(isset($userDetails->email))
                                                        <td>Customer Email</td>
                                                        <td>{{isset($userDetails->email) ? $userDetails->email : ''}}</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        @if(isset($userDetails->phone))
                                                        <td>Customer Phone</td>
                                                        <td>{{isset($userDetails->phone) ? $userDetails->phone : ''}}</td>
                                                        @endif
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="order-heading">
                                   {{-- <h2>order information</h2>--}}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="pull-left">
                                    <h4>Billing Address</h4>
                                    <address>
                                        @if(isset($billingAddress->company_name))
                                            <b>Company Address: </b><strong>{{$billingAddress->company_name}}</strong><br>
                                        @endif

                                        @if(isset($billingAddress->email))
                                                <b>Email: </b><a href="mailto:{{$billingAddress->email}}">{{$billingAddress->email}}</a><br>
                                        @endif
                                            @if(isset($billingAddress->phone))
                                                <b>Phone No: </b><a href="tel:{{$billingAddress->phone}}">{{$billingAddress->phone}}</a><br>
                                            @endif

                                        @if(isset($billingAddress->address_one))
                                                <b>Address One: </b><strong>{{$billingAddress->address_one}}</strong><br>
                                        @endif
                                        @if(isset($billingAddress->address_two))
                                                <b>Address two: </b><strong>{{$billingAddress->address_two}}</strong><br>
                                        @endif
                                        @if(isset($billingAddress->country_id))
                                            @php $countryName =  \App\Models\Front\Country::where('id',$billingAddress->country_id)->value('name'); @endphp
                                            <b>Country Name: </b><strong>{{$countryName}}</strong><br>
                                        @endif
                                        @if(isset($billingAddress->state_id))
                                            @php $stateName =  \App\Models\Front\State::where('id',$billingAddress->state_id)->value('name'); @endphp
                                            <b>State Name: </b><strong>{{$stateName}}</strong><br>
                                        @endif
                                        @if(isset($billingAddress->city))
                                            <b>City Name: </b><strong>{{$billingAddress->city}}</strong><br>
                                        @endif
                                            @if(isset($billingAddress->zipcode))
                                                <b>zipCode : </b><strong>{{$billingAddress->zipcode}}</strong><br>
                                            @endif

                                    </address>
                                </div>
                                <div class="pull-right">
                                    <h4>Shipping Address</h4>
                                    <address>
                                        @if(isset($shippingAddress->company_name))
                                            <b>Company Address: </b><strong>{{$shippingAddress->company_name}}</strong><br>
                                        @endif

                                        @if(isset($shippingAddress->email))
                                            <b>Email: </b><a href="mailto:{{$shippingAddress->email}}">{{$shippingAddress->email}}</a><br>
                                        @endif
                                        @if(isset($shippingAddress->phone))
                                            <b>Phone No: </b><a href="tel:{{$shippingAddress->phone}}">{{$shippingAddress->phone}}</a><br>
                                        @endif

                                        @if(isset($shippingAddress->address_one))
                                            <b>Address One: </b><strong>{{$shippingAddress->address_one}}</strong><br>
                                        @endif
                                        @if(isset($shippingAddress->address_two))
                                            <b>Address two: </b><strong>{{$shippingAddress->address_two}}</strong><br>
                                        @endif
                                        @if(isset($shippingAddress->country_id))
                                            @php $countryName =  \App\Models\Front\Country::where('id',$shippingAddress->country_id)->value('name'); @endphp
                                            <b>Country Name: </b><strong>{{$countryName}}</strong><br>
                                        @endif
                                        @if(isset($shippingAddress->state_id))
                                            @php $stateName =  \App\Models\Front\State::where('id',$shippingAddress->state_id)->value('name'); @endphp
                                            <b>State Name: </b><strong>{{$stateName}}</strong><br>
                                        @endif
                                        @if(isset($shippingAddress->city))
                                            <b>City Name: </b><strong>{{$shippingAddress->city}}</strong><br>
                                        @endif
                                        @if(isset($shippingAddress->zipcode))
                                            <b>zipCode : </b><strong>{{$shippingAddress->zipcode}}</strong><br>
                                        @endif

                                    </address>
                                </div>
                            </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <!-- /col-md-9 -->
                                <div class="col-md-3 pull-right">
                                    <br>
                                    <div>
                                        <div class="pull-left"> ORDER NO : </div>
                                        <div class="pull-right"> {{isset($order->order_id) ? $order->order_id : ''}} </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div>
                                        <!-- /col-md-3 -->
                                        <div class="pull-left"> ORDER DATE : </div>
                                        <div class="pull-right"> {{date('m/d/Y', strtotime($order->created_at))}} </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!-- /row -->
                                    <br>

                                </div>
                                <!-- /invoice-body -->
                            </div>

                            <!-- /col-lg-10 -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:60px" class="text-center">QTY</th>
                                    <th class="text-left">DESCRIPTION</th>
                                    <th style="width:140px" class="text-right">UNIT PRICE</th>
                                    <th style="width:90px" class="text-right">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $subtotal = 0.00;
                                @endphp
                                    @foreach($listOrders as $listOrder)
                                        @php
                                            $subtotal  += $listOrder->total_price;
                                        @endphp
                                <tr>
                                    <td class="text-center">{{isset($listOrder->quantity) ? $listOrder->quantity : 0}}</td>
                                    <td>{{isset($listOrder->product_name) ? $listOrder->product_name : ''}}</td>
                                    <td class="text-right">${{number_format((float)$listOrder->product_price, 2, '.', '')}}</td>
                                    <td class="text-right">${{number_format((float)$listOrder->total_price, 2, '.', '')}}</td>
                                </tr>
                                    @endforeach

                                <tr>
                                    <td colspan="2" rowspan="4">
                                    </td><td class="text-right"><strong>Subtotal</strong></td>
                                    <td class="text-right">${{number_format((float)$subtotal, 2, '.', '')}}</td>
                                </tr>

                                <tr>
                                    <td class="text-right no-border"><strong>Shipping</strong></td>
                                    <td class="text-right">${{number_format((float)$order->shipping_charge, 2, '.', '')}}</td>
                                </tr>

                                <tr>
                                    <td class="text-right no-border">
                                        <div class="well well-small green"><strong>Total</strong></div>
                                    </td>
                                    <td class="text-right"><strong>${{number_format((float)$order->total_amount, 2, '.', '')}}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                        </div>
                        <!--/col-lg-12 mt -->
                    </div></div></div>

        </section>
    </section>

@endsection
