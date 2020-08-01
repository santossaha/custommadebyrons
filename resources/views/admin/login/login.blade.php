<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    {{--<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">--}}
    <title>Admin | Simonrusticdesigns</title>
    <!-- Favicons -->
    <link href="{{url('/')}}/admin/img/favicon.png" rel="icon">
    <link href="{{url('/')}}/admin/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Bootstrap core CSS -->
    <link href="{{url('/')}}/admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="{{url('/')}}/admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{url('/')}}/admin/css/style.css" rel="stylesheet">
    <link href="{{url('/')}}/admin/css/myStyle.css" rel="stylesheet">
    <link href="{{url('/')}}/admin/css/style-responsive.css" rel="stylesheet">
</head>

<body>
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<div id="login-page">
    <div class="container">
        <form class="form-login" action="{{route('adminlogin')}}" id="loginform">
            <h2 class="form-login-heading">Admin Login</h2>
            @if(Session::has('logout'))
                <div class="alert alert-success" style="text-align: center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>{{Session::get('logout')}}</strong>
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>{{Session::get('error')}}</strong>
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>{{Session::get('success')}}</strong>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <div class="login-wrap">
                <input type="text" name="username" id="username" class="form-control profile" placeholder="Email Address" autofocus>
                <br>
                <input type="password" name="password" id="password" class="form-control profile" placeholder="Password">
                <label class="checkbox" style="padding-left: 20px;">
                    <input type="checkbox" id="remember-me" name="remember-me" value="remember-me" checked="true"> Remember me
                    <span class="pull-right">
                        <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                    </span>
                </label>
                <button class="btn btn-theme btn-block"  type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
            </div>
             </form>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                  <span class="alert-inner--text"><strong>Error!</strong>{{Session::get('error')}}</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               @endif
              @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-inner--text">{{Session::get('success')}}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
                     {{ Form::open(['url' => ['/admin-forgot-password'], 'method' => 'post', 'id' => 'ForgotpasswordFrom', 'class' => 'form-add']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            {{--<h4 class="modal-title">Forgot Password ?</h4>--}}
                        </div>
                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            
                            <input type="email" name="email" placeholder="Email" class="form-control placeholder-no-fix">
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <input type="submit" name="submit" value="Submit" class="btn btn-theme">
                            
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
            <!-- modal -->
       
    </div>
</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{url('/')}}/admin/lib/jquery/jquery.min.js"></script>
<script src="{{url('/')}}/admin/lib/bootstrap/js/bootstrap.min.js"></script>
<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="{{url('/')}}/admin/lib/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script>
    $.backstretch("{{url('/')}}/admin/img/back-image.jpg", {
        speed: 500
    });
</script>
<script type="text/javascript">
        $(document).ready(function() {
          var remember = $.cookie('remember-me');
        if (remember == 'true') 
        {
            var username = $.cookie('username');
            var password = $.cookie('password');
            // autofill the fields
            $('#username').val(username);
            $('#password').val(password);
        }
    $("#loginform").submit(function() {
        if ($('#remember-me').is(':checked')) {
            var username = $('#username').val();
            var password = $('#password').val();
            // set cookies to expire in 20*365 days
            $.cookie('username', username, { expires: 20*365 });
            $.cookie('password', password, { expires: 20*365 });
            $.cookie('remember-me', true, { expires: 20*365 }); 
        }
        else
        {
            // reset cookies
            $.cookie('username', null);
            $.cookie('password', null);
            $.cookie('remember-me', null);
        }
  });
      
});
</script>
</body>

</html>
