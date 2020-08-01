@extends('front.layouts.MainLayout')
@section('title')
Add Address
@endsection
@section('content')
<link rel="stylesheet" href="{{url('/')}}/front/css/plugins/confirm/jquery-confirm.min.css">
<script src="{{url('/')}}/front/js/plugins/confirm/jquery-confirm.min.js"></script>
<section id="banner" class="inner-backg">
        <div class="inner-pg-banner">
            <img src="{{url('/')}}/front/images/blog-bg.jpg" alt="">
            <div class="inner-ban-head">
                <h1>Add Address</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Address</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="user-dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('front.common.leftsidebar')
                <div class="col-md-8">
                    <div class="row order-list">
        <div class="col-md-12">
        	@include('front.common.Messages')
            <div>
                {{ Form::open(['route' => 'update_user_address', 'method' => 'post', 'id' => 'user_address_form']) }}
                    <div class="row">
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$data['first_name']}}">
                          </div>
                      </div>
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$data['last_name']}}">
                          </div>
                      </div>
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$data['email']}}">
                          </div>
                      </div>
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="phone">Phone No</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$data['phone']}}">
                          </div>
                      </div>
                      <div class="col-md-12 user-profile">
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{$data['company_name']}}">
                          </div>
                      </div>
                       <div class="col-md-12 user-profile">
                        <div class="form-group">
                            <label for="address1">Address</label>
                            <input type="text" class="form-control" id="address1" name="address1" placeholder="Address line 1" value="{{$data['address_one']}}">
                          </div>
                      </div>
                      <div class="col-md-12 user-profile">
                        <div class="form-group">
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Address line 2" value="{{$data['address_two']}}">
                          </div>
                      </div>
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control" id="country" name="country">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country['id']}}" <?php if($data->country==$country->id){ echo 'selected';}?>>{{$country['name']}}</option>
                                @endforeach
                            </select>
                          </div>
                          <span id="error_country"></span>
                      </div>
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control" id="state" name="state">
                                <option value="">Select country first</option>
                                @foreach($states as $state)
                                  <option value="{{$state->id}}" <?php if($data->state==$state->id){ echo 'selected';}?>>{{$state->name}}</option>
                                @endforeach
                            </select>
                          </div>
                          <span id="error_state"></span>
                      </div>
                       <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="city">Town/City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{$data['city']}}">
                          </div>
                      </div>
                       <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="pincode">Zip Code</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" value="{{$data['pincode']}}">
                          </div>
                      </div>
                      <div class="col-md-12 user-profile">
                      
                            <label for="pincode">Make a Default Address</label>
                            <input type="checkbox" class="form-control" id="default_address" name="default_address" value="1" <?php if($data->default_address=='1'){ echo 'checked';}?>>
                      </div>
                      <div class="col-md-6">
                          <button type="submit" class="btn btn-primary submit-btm">Update Address</button>
                      </div>
                      
                    </div>
                  {{ Form::close() }}
            </div>
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#user_address_form").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                  required: true,
                  digits: true
                },
                address1: {
                  required: true
                },
                country: {
                  required: true
                },
                state: {
                  required: true
                },
                city: {
                  required: true
                },
                pincode: {
                  required: true,
                  digits: true
                }
            },
            messages: {
                first_name: {
                    required: "Enter your first name."
                },
                last_name: {
                    required: "Enter your last name."
                },
                email: {
                    required: "Enter email address.",
                    email: "Enter valid email address."
                },
                phone: {
                  required: "Enter phone number.",
                  digits: "Enter valid phone number."
                },
                address1: {
                  required: "Enter address."
                },
                country: {
                  required: "Select country."
                },
                state: {
                  required: "Select state."
                },
                city: {
                  required: "Enter city."
                },
                pincode: {
                  required: "Enter pincode.",
                  digits: "Enter valid pincode."
                }
            },
            errorPlacement: function(error, element){
                if(element.attr("name") == "country"){
                    error.insertAfter("#error_country");
                }else if(element.attr("name") == "state"){ 
                  error.insertAfter("#error_state");
                }else{
                    error.insertAfter(element);
                }
            },
        });
        $('#country').change(function(){
          var country_id = $('#country').val();
          var select_state = '';
          //alert(country_id);
            if(country_id != '')
            {
                $.ajax({
                  method:"POST",
                  url: "{{route('fetch_state')}}",
                  data:{country_id:country_id,select_state:select_state},
                  success:function(data)
                  {
                    $('#state').html(data);
                  }
                });
            }
            else
            {
            $('#state').html('<option value="">Select country first</option>');
            }
        });

    });
</script>

@endsection