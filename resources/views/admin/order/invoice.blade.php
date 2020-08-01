
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INVOICE</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link href="//fleetcart.envaysoft.com/modules/order/admin/css/print.css?v=2.0.2" rel="stylesheet">
</head>

<body class="ltr">
<!--[if lt IE 8]>
<p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="container">
    <div class="invoice-wrapper clearfix">
        <div class="row">
            <div class="invoice-header clearfix">
                <div class="col-md-3">
                    <div class="store-name">
                        <h1>Simonrustic Designs</h1>
                    </div>
                </div>

                <div class="col-md-9 clearfix">
                    <div class="invoice-header-right pull-right">
                        <span class="title">INVOICE</span>

                        <div class="invoice-info clearfix">
                            <div class="invoice-id">
                                <label for="invoice-id">Invoice ID:</label>
                                <span>{{isset($order->order_id) ? $order->order_id : ''}}</span>
                            </div>

                            <div class="invoice-date">
                                <label for="invoice-date">Date:</label>
                                <span>{{date('Y / m / d')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-body clearfix">
            <div class="invoice-details-wrapper">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="invoice-details">
                            <h5>Order Details</h5>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{isset($userDetails->name) ? $userDetails->name : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>{{isset($userDetails->email) ? $userDetails->email : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td>{{isset($userDetails->phone) ? $userDetails->phone : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Method:</td>
                                        <td>Free Shipping</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="invoice-address">
                            <h5>Shipping Address</h5>


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


                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="invoice-address">
                            <h5>Billing Address</h5>


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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="cart-list">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Line Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @php  $subtotal = 0.00; @endphp
                                @foreach($listOrders as $listOrder)
                                    @php
                                        $subtotal  += $listOrder->total_price;
                                    @endphp

                                <td>
                                    <span>{{isset($listOrder->product_name) ? $listOrder->product_name : ''}}</span>

                                </td>
                                <td>
                                    <label class="visible-xs">Unit Price:</label>
                                    <span>${{number_format((float)$listOrder->total_price, 2, '.', '')}}</span>
                                </td>
                                <td>
                                    <label class="visible-xs">Quantity:</label>
                                    <span>{{isset($listOrder->quantity) ? $listOrder->quantity : 0}}</span>
                                </td>
                                <td>
                                    <label class="visible-xs">Line Total:</label>
                                    <span>${{number_format((float)$listOrder->total_price, 2, '.', '')}}</span>
                                </td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="total pull-right">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td>${{number_format((float)$subtotal, 2, '.', '')}}</td>
                        </tr>

                        <tr>
                            <td>Free Shipping</td>
                            <td>${{number_format((float)$order->shipping_charge, 2, '.', '')}}</td>
                        </tr>



                        <tr>
                            <td>Total</td>
                            <td>${{number_format((float)$order->total_amount, 2, '.', '')}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>
</body>
</html>
