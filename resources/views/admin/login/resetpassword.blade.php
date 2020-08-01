<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    {{--<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">--}}
    <title>E-commerce - Admin</title>
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
       {{ Form::open(['url' => ['/admin-password/reset-pass'], 'method' => 'post', 'id' => 'changepasswordFrom', 'class' => 'form-login']) }}
               {!! Form::hidden('token', $token, array('class' => 'form-control placeholder-no-fix', 'placeholder' => 'Token')) !!}
            <h2 class="form-login-heading">Change Password</h2>
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
                <input type="password" name="password" id="password" class="form-control profile" placeholder="New Password" autofocus required>
                <br>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control profile" placeholder="Confirm Password" required>
                <br>
                <button class="btn btn-theme btn-block"  type="submit">Change Password</button>
            </div>
             {!! Form::close() !!}
       
    </div>
</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{url('/')}}/admin/lib/jquery/jquery.min.js"></script>
<script src="{{url('/')}}/admin/lib/bootstrap/js/bootstrap.min.js"></script>
<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="{{url('/')}}/admin/lib/jquery.backstretch.min.js"></script>
<script>
    $.backstretch("{{url('/')}}/admin/img/back-image.jpg", {
        speed: 500
    });
</script>
</body>

</html>
