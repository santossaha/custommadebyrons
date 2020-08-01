<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Simonrusticdesigns | {{isset($pageTitle)?$pageTitle:''}}</title>
    <!-- Favicons -->
    <link href="{{url('/')}}/admin/img/favicon.png" rel="icon">
    <link href="{{url('/')}}/admin/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Bootstrap core CSS -->
    <link href="{{url('/')}}/admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="{{url('/')}}/admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/admin/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/admin/lib/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="{{url('/')}}/admin/css/style.css" rel="stylesheet">
    <link href="{{url('/')}}/admin/css/myStyle.css" rel="stylesheet">
    <link href="{{url('/')}}/admin/css/style-responsive.css" rel="stylesheet">
    <script src="{{url('/')}}/admin/lib/chart-master/Chart.js"></script>
    <link rel="stylesheet" href="{{url('/')}}/admin/lib/advanced-datatable/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css">
</head>
<body>
<section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        @if(Auth::user()->role=='Admin')
        <a href="{{route('admin::dashboard')}}" target="_blank" class="logo"><b>E-<span>Commerce</span></b></a>
        <!--logo end-->
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="{{route('admin::logout')}}">Logout</a></li>
            </ul>
        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout fancybox fancybox.iframe" href="{{route('admin::profile',['id'=>Auth::user()->id])}}">Profile</a></li>
            </ul>
        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout fancybox fancybox.iframe" href="{{route('admin::changePassForm')}}">Change Password</a></li>
            </ul>
        </div>
        @endif


    </header>
    @include('admin.layouts.leftmenu');
    @yield('content')
    <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete Parmanently</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure about this ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="" class="btn btn-danger" id="confirm_del">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end page container -->
<!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            <p>
                &copy; Copyrights <strong>Swadesh Software</strong>. All Rights Reserved
            </p>
            <div class="credits">
            </div>
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{url('/')}}/admin/lib/jquery/jquery.min.js"></script>

<script src="{{url('/')}}/admin/lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="{{url('/')}}/admin/lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{url('/')}}/admin/lib/jquery.scrollTo.min.js"></script>
<script src="{{url('/')}}/admin/lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="{{url('/')}}/admin/lib/jquery.sparkline.js"></script>

<script type="text/javascript" src="{{url('/')}}/admin/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
{{--<script type="text/javascript" src="{{url('/')}}/admin/lib/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="{{url('/')}}/admin/lib/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="{{url('/')}}/admin/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>--}}
<script type="text/javascript" src="{{url('/')}}/admin/lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<!--common script for all pages-->
<script src="{{url('/')}}/admin/lib/common-scripts.js"></script>
<script type="text/javascript" src="{{url('/')}}/admin/lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="{{url('/')}}/admin/lib/gritter-conf.js"></script>
<!--script for this page-->
<script src="{{url('/')}}/admin/lib/sparkline-chart.js"></script>
<script src="{{url('/')}}/admin/lib/zabuto_calendar.js"></script>

{{--<script type="text/javascript" language="javascript" src="{{url('/')}}/admin/lib/advanced-datatable/js/jquery.dataTables.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/admin/lib/advanced-datatable/js/DT_bootstrap.js"></script>
<!---------------------------------------------------------------------------  Fancybox Scripts Start--------------------------------------------------------------------------->
<script src="{{url('/')}}/admin/plugins/fancybox/jquery.fancybox.js"></script>
<link rel="stylesheet" href="{{url('/')}}/admin/plugins/fancybox/jquery.fancybox.css">

<script type="application/javascript">
    $(document).ready(function() {
        $("#date-popover").popover({
            html: true,
            trigger: "manual"
        });
        $("#date-popover").hide();
        $("#date-popover").click(function(e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function() {
                return myDateFunction(this.id, false);
            },
            action_nav: function() {
                return myNavFunction(this.id);
            },
            today:true,
//            legend: [{
//                type: "text",
//                label: "Special event",
//                badge: "00"
//            },
//                {
//                    type: "block",
//                    label: "Regular event",
//                }
//            ]
        });
    });

    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).find('.fancybox').fancybox({
            type: 'iframe',
            width: 800,
            height: 600,
            fitToView: true,
            iframe : {
                preload : false
            },
            openEffect: 'elastic',
            afterClose : function() {
                window.location.reload();
            }
        });
        $(document).find('.details_fancybox').fancybox({
            type: 'iframe',
            width: 800,
            height: 600,
            fitToView: true,
            iframe : {
                preload : false
            },
            openEffect: 'elastic'
        });
        $(document).on('click','.sorting_1',function(){
            $(document).find('.fancybox').fancybox({
                type: 'iframe',
                width: 800,
                height: 600,
                fitToView: true,
                iframe : {
                    preload : false
                },
                openEffect: 'elastic',
                afterClose : function() {
                    window.location.reload();
                }
            });
            $(document).find('.details_fancybox').fancybox({
                type: 'iframe',
                width: 800,
                height: 600,
                fitToView: true,
                iframe : {
                    preload : false
                },
                openEffect: 'elastic'
            });
        });
    });
</script>
<!---------------------------------------------------------------------------  Fancybox Scripts Start--------------------------------------------------------------------------->
<script>
    function getDeleteRoute($route)
    {
        $('#confirm_del').attr('href',$route);
    }
</script>
@stack('scripts')
</body>

</html>
