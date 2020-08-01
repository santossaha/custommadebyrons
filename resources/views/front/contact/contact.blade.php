@extends('front.layouts.MainLayout')
@section('title')
Contact Us
@endsection
@section('content')
<section id="banner" class="inner-backg">
    <div class="inner-pg-banner">
        <img src="{{url('/')}}/front/images/cont-bg.jpg" alt="">
<div class="inner-ban-head">
    <h1>Contact Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
          </nav>
        </div>
    </div>

    </section>


<!-- Contact-page -->
{{--  <div class="map-area">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11975657.90532164!2d-107.22310455928354!3d41.038012622288875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sin!4v1581576672686!5m2!1sen!2sin" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </div>--}}

<div class="map-area" id="map" style="height:450px ;width:100% ">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5181656.197327509!2d-101.95806024289753!3d39.084047138830634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sin!4v1564634891845!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>







<!-- contact area -->
<div id="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="cont-pg-head lv-msg">
        <div class="section-heading mb-2">
            <h2>Leave Us A Message</h2>
        </div>
    </div>
        <div class="contact-page cont-l">
            <div class="row">
            	 <h2 id="msg"></h2>
                   <span id="error_msg"></span>

                <div class="col-md-12 contact-form">

                    <form id="contact_form" action="javascript:void(0);">
                        <div class="row">
                    <div class="col-md-4 ">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="con_name" placeholder="Your Name" name="con_name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="con_email" name="con_email" placeholder="Email Address">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputTitle">Phone No <span>*</span></label>
                                <input type="tel" class="form-control unicase-form-control text-input" id="con_phone" name="con_phone" placeholder="Phone Number">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputComments">Subject <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="con_sub" name="con_sub" placeholder="Subject">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputComments">Your Message <span>*</span></label>
                                <textarea class="form-control unicase-form-control" id="con_msg" name="con_msg"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 outer-bottom-small">
                        <button type="submit" class="btn btn-transparent btn-rounded btn-large" id="send_message">Send Message</button>
                    </div>
                </div>
                    </form>
                </div>


            </div><!-- /.contact-page -->
        </div>
    </div>

    <div class="col-md-4">
        <div class="cont-pg-head">
        <div class="section-heading mb-2">
            <h2>Our Address</h2>
        </div>
        </div>

     <div class="cont-add">
         <ul>
             <li>
                 <h3><i class="fas fa-map-marker-alt"></i> </h3>
                 <div class="con-r">
                    <span>Address</span>
                      <?php $setting = App\Helpers\SiteSettingHelper::SiteSetting();?>
                    <p>{{isset($setting->address)?$setting->address:''}}</p>
                 </div>

             </li>
             <li>
                <h3><i class="fas fa-envelope"></i></h3>
                <div class="con-r">
                    <span>Email</span>
                    <p> <a href="mailto:{{isset($setting->email)?$setting->email:''}}">{{isset($setting->email)?$setting->email:''}}</a></p>
                    <p> <a href="mailto:{{isset($setting->support_email)?$setting->support_email:''}}">{{isset($setting->support_email)?$setting->support_email:''}}</a></p>
                </div>

            </li>
            <li>
                <h3><i class="fas fa-phone"></i></h3>
                <div class="con-r">
                    <span>Phone</span>
                    <p>+{{isset($setting->phone)?$setting->phone:''}}</p>
                    <p>+{{isset($setting->mobile)?$setting->mobile:''}}</p>
                </div>

            </li>
         </ul>

     </div>

    </div>


    </div>
    </div>
</div>


@endsection
@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfwQIMbBbS_PPlvZlbhywFgHy2hL00DgU"></script>

    <script>
        localStorage.removeItem('page');
        $(document).ready(function () {
            initialize();
        });
        var labels = 'i';
        function initialize() {
            var lat='{{$latitude}}';
            var lng='{{$longitude}}';
            var latlng = new google.maps.LatLng(lat,lng);
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                center: latlng
            });

            google.maps.event.addListener(map, 'click', function(event) {
                addMarker(event.latlng, map);

            });
            addMarker(latlng, map);
        }
        function addMarker(location, map) {
            var marker = new google.maps.Marker({
                position: location,
                label: labels,
                map: map
            });
            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }
        var contentString = '<div id="content">'+
            '<h5>'+'{{isset($setting->address)?$setting->address:''}}'+'</h5>'+'</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
    </script>

@endpush