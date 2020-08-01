@extends('front.layouts.MainLayout')
@section('title')
User Address
@endsection
@section('content')

    <section id="banner" class="inner-backg">
        <div class="inner-pg-banner">
            <img src="{{url('/')}}/front/images/blog-bg.jpg" alt="">
            <div class="inner-ban-head">
                <h1>My Address</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Address</li>
                    </ol>
                </nav>
            </div>
        </div>

    </section>

    <!--=====privacy & Policy page -content======-->

    <section class="user-dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('front.common.leftsidebar')
                <div class="col-md-8">
                    <div class="row order-list custom-address-height" id="defult_address">
                       <div class="col-md-12">
                       @include('front.common.Messages')
                           <div class="user-manage-address">
                           @if(count($user_address)>0)
                               <div class="">
                                   <span class="save-add">Saved Addresses</span>
                                   <span class="new-add"><i class="fas fa-long-arrow-alt-right"></i> <a href="{{route('add_user_address')}}">Add New Address</a></span>
                               </div>
                               @foreach($user_address as $data)
                               <div class="defult-address">
                                   <div class="dflt-ad">
                                    <?php
                                      $name = $data->first_name.' '.$data->last_name;
                                    ?>
                                       <p>{{$name}}</p>
                                       <span>{{isset($data->address_one)?$data->address_one:''}}</span>
                                       @if($data->address_two!='')
                                       <span>{{isset($data->address_two)?$data->address_two:''}}</span>
                                       @endif
                                       <span>{{isset($data->city)?$data->city:''}} - {{isset($data->pincode)?$data->pincode:''}}</span>
                                       <span>{{isset($data->state_name)?$data->state_name:''}}, {{isset($data->country_name)?$data->country_name:''}}</span>
                                       <span>Mobile: {{isset($data->phone)?$data->phone:''}}</span>
                                       <div>
                                           @if($data->default_address=='1')
                                            <a href="javascript:;">Make This Default</a>
                                           @else
                                            <a href="javascript:;">Other Address</a>
                                           @endif
                                       </div>
                                   </div>
                                   @if($data->default_address=='1')
                                   <div class="address-edit-remove" >
                                       <span class="address-edit"><a href="{{route('edit_user_address')}}">Edit</a></span>
                                       <span class="edit-line"></span>
                                       <span class="address-remove"><a href="javascript:;" onclick="UserAddressDelete(<?php echo $data->id;?>)">Remove</a></span>
                                   </div>
                                   @endif
                               </div>
                               @endforeach
                               @else
                               <div class="emty-address">
                                    <span><i class="fas fa-map-marker-alt"></i></span>
                                    <span>Save Your Address Now</span>
                                   <span class="new-add"><i class="fas fa-long-arrow-alt-right"></i> <a href="{{route('add_user_address')}}">Add New Address</a></span>
                               </div>
                               @endif
                               {{ $user_address->links() }}
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
  function UserAddressDelete(id) {
        var _token = '<?php echo csrf_token() ?>';
        $.ajax({
            type: "post",
            url: "{{ route('user_address_delete') }}",
            data: {
                _token: _token,id: id
            },
            before: function() {},
            success: function(data) {
                if (data == 1) {
                    toastr.success('User Address Deleted', 'User Address', {timeOut: 1000,progressBar:true,onHidden:function() {}
                        });
                    //window.location.reload();
                    setTimeout(function() {
                       window.location.reload();
                      }, 1000);
                    }
            }
        });
    }
</script>
@endsection