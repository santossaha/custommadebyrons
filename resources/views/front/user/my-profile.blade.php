@extends('front.layouts.MainLayout')
@section('title')
My Profile
@endsection
@section('content')
<link rel="stylesheet" href="{{url('/')}}/front/css/plugins/confirm/jquery-confirm.min.css">
<script src="{{url('/')}}/front/js/plugins/confirm/jquery-confirm.min.js"></script>
<section id="banner" class="inner-backg">
        <div class="inner-pg-banner">
            <img src="{{url('/')}}/front/images/blog-bg.jpg" alt="">
            <div class="inner-ban-head">
                <h1>My Profile</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
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
        <div class="col-md-8">
        	@include('front.common.Messages')
            <div>
                {{ Form::open(['route' => 'profile_update', 'method' => 'post', 'id' => 'updateprofile',' enctype'=>'multipart/form-data']) }}
                    <div class="row">
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{isset($users->name)?$users->name:''}}" id="name" name="name" placeholder="Name">
                          </div>
                      </div>
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{isset($users->email)?$users->email:''}}" readonly>
                          </div>
                      </div>
                      <div class="col-md-12 user-profile">
                        <label for="formGroupExampleInput custom-lebl">Gender</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="male" name="gender" class="custom-control-input" value="{{isset($users->gender)?$users->gender:'1'}}" @if($users->gender=='1') {{ 'checked' }} @endif >
                            <label class="custom-control-label" for="male">Male</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="female" name="gender" class="custom-control-input" value="{{isset($users->gender)?$users->gender:'2'}}" @if($users->gender=='2') {{ 'checked' }} @endif>
                            <label class="custom-control-label" for="female">Female</label>
                          </div>
                          <span id="error_gender"></span>
                      </div>
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{isset($users->pincode)?$users->pincode:''}}">
                          </div>
                      </div>
                      <div class="col-md-6 user-profile">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Phone Number" value="{{isset($users->phone)?$users->phone:''}}" name="phone">
                          </div>
                      </div>
                       <div class="col-md-12 user-profile">
                        <div class="form-group">
                            <label class="custom-file-label" for="img">Image upload</label>
                            <input type="file" class="form-control custom-file-input" name="img" placeholder="Choose file" id="img">
                            
                          </div>
                      </div>
                      <div class="col-md-12 user-profile">
                        <div class="form-group">
                            <div class="profile-picture">
                            @if($users->image!='')
                                <img src="{{url($users->image)}}" class="" id="blah" >
                            @else
                                <img src="{{url('/')}}/admin/img/No-Image.png" class="img-fluid rounded shadow" id="blah" alt="">
                            @endif
                            </div>
                          </div>

                      </div>
                      <div class="col-md-6">
                          <button type="submit" class="btn btn-primary submit-btm">Update</button>
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
     $('#img').change(function() {
        var i = $(this).prev('.file-name').clone();
        var file = $('#img')[0].files[0].name;
        $(this).prev('.custom-file-label').text(file);
    });
    
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#updateprofile").validate({
            rules: {
                name: {
                    required: true,
                },
                gender: {
                    required: true
                },
                pincode: {
                    required: true,
                    digits: true
                },
                phone: {
                    required: true,
                    digits: true
                },
            },
            messages: {
                name: {
                    required: "Enter your first name."
                },
                gender: {
                    required: "Select gender."
                },
                pincode: {
                    required: "Enter your pincode.",
                    digits: "Enter valid pincode."
                },
                phone: {
                    required: "Enter phone number.",
                    digits: "Enter valid phone number."
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "gender") {
                    error.insertAfter("#error_gender");
                } else {
                    error.insertAfter(element);
                }
            },

        });

    });
     function readURL(input) {
    if (input.files && input.files[0]) {
      var ext = input.files[0].name;
      extension = ext.substring(ext.lastIndexOf('.')+1);
      var reader = new FileReader();
      reader.onload = function(e) {
        if(extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'JPG' || extension == 'JPEG' || extension == 'PNG'){
          $('#blah').attr('src', e.target.result);
          $('#blah_url').attr('href', e.target.result);
        }else{
          $.alert({
            type:'red',
            title: 'Error!',
            content: 'You can upload JPG, JPEG, PNG files.',
            buttons: {
              ok: function () {

              }
            }
          });
          return false;
          $('#blah').attr('src', '');
                    $('#blah_url').attr('src', '');
        }

      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#img").change(function() {
    readURL(this);
  });

</script>
@endsection