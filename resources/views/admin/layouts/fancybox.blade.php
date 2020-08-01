<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Dashio - Bootstrap Admin Template</title>
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
    <link href="{{url('/')}}/admin/css/myStyle.css" rel="stylesheet">

    <link href="{{url('/')}}/admin/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{url('/')}}/admin/plugins/select2/select2.min.css" rel="stylesheet">
     <link href="{{url('/')}}/admin/css/jquery-confirm.min.css" rel="stylesheet">
    <!-- =======================================================
      Template Name: Dashio
      Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
      Author: TemplateMag.com
      License: https://templatemag.com/license/
    ======================================================= -->
</head>

<style>
    .content {
        margin-left: 0px !important;
    }
</style>
<body>
<!-- begin #page-loader -->
{{--<div id="page-loader" class="fade in"><span class="spinner"></span></div>--}}
<!-- end #page-loader -->

<!-- begin #page-container -->
@yield('content')

<!---------------------------------------------------------------------------  Fancybox Scripts Start--------------------------------------------------------------------------->
<script src="{{url('/')}}/admin/lib/jquery/jquery.min.js"></script>
<script src="{{url('/')}}/admin/lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="{{url('/')}}/admin/lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{url('/')}}/admin/lib/jquery.scrollTo.min.js"></script>
<script src="{{url('/')}}/admin/lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="{{url('/')}}/admin/lib/jquery.sparkline.js"></script><!--common script for all pages-->
<script src="{{url('/')}}/admin/lib/common-scripts.js"></script>
<script type="text/javascript" src="{{url('/')}}/admin/lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="{{url('/')}}/admin/lib/gritter-conf.js"></script><!--script for this page-->
<script src="{{url('/')}}/admin/lib/sparkline-chart.js"></script>
<script src="{{url('/')}}/admin/lib/zabuto_calendar.js"></script>

<script src="{{url('/')}}/admin/plugins/summernote/summernote.min.js"></script>
<script src="{{url('/')}}/admin/plugins/select2/select2.min.js"></script>
<script src="{{url('/')}}/admin/js/jquery-confirm.min.js"></script>
<script>
    $('[data-fancybox]').fancybox({
        buttons : [
            'zoom',
            'close'
        ]
    });
</script>
<script>
    // jQuery ".Class" SELECTOR.
    $(document).ready(function() {
        $('.number').keypress(function (event) {
            return isNumber(event, this)
        });
        $(".summernote").summernote({
            placeholder: 'Enter Description',
            tabsize: 2,
            height: 250
        });
    });
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-53034621-1', 'auto');
    ga('send', 'pageview');

</script>
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
    $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

    $("#image").change(function() {
    readURL(this);
    });
    </script>
    <script>
        $(document).ready(function(){
           $('#category_name').keyup(function(e) {
            //alert('hi');
                    var Text = $(this).val();
                    Text = Text.toLowerCase();
                    var regExp = /\s+/g;
                    Text = Text.replace(regExp,'-');
                    $('#category_alias').val(Text);
                });
           $('#sub_category_name').keyup(function(e) {
            //alert('hi');
                    var Text = $(this).val();
                    Text = Text.toLowerCase();
                    var regExp = /\s+/g;
                    Text = Text.replace(regExp,'-');
                    $('#sub_category_alias').val(Text);
                });
            $('#page_name').keyup(function(e) {
            //alert('hi');
                    var Text = $(this).val();
                    Text = Text.toLowerCase();
                    var regExp = /\s+/g;
                    Text = Text.replace(regExp,'-');
                    $('#page_alias').val(Text);
                });
            $('#product_title').keyup(function(e) {
            //alert('hi');
                    var Text = $(this).val();
                    Text = Text.toLowerCase();
                    var regExp = /\s+/g;
                    Text = Text.replace(regExp,'-');
                    $('#product_alias').val(Text);
                });
                $('#brand_name').keyup(function(e) {
            //alert('hi');
                    var Text = $(this).val();
                    Text = Text.toLowerCase();
                    var regExp = /\s+/g;
                    Text = Text.replace(regExp,'-');
                    $('#brand_alias').val(Text);
                });
                $('.dynamic').change(function(){
                    if($(this).val() != '')
                    {
                        var select = $(this).attr("id");
                        var value = $(this).val();
                        var dependent = $(this).data('dependent');
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url:'{{route('admin::fetch_category_subcategory')}}',
                            method:"POST",
                            data:{select:select, value:value, _token:_token, dependent:dependent},
                            success:function(result)
                            {
                                $('#'+dependent).html(result);
                            }

                        })
                    }
                });

                $('#category_id').change(function(){
                    $('#sub_cat_id').val('');
                });

            $('.select2').select2();
            $('.js-example-basic-multiple').select2();
        });
        function img_default_function(id,product_id){
            var _token = '<?php echo csrf_token() ?>';
            $.ajax({
                type: "POST",
                url:'{{route('admin::product_image_default')}}',
                data: {_token: _token,id:id,product_id:product_id},
                before:function(){
                },
                success: function (data) {
                    if(data == 1){
                        $.alert({
                            title: 'Success!',
                            content: 'Your product default image successfully set.',
                            theme: 'material',
                            buttons: {
                                ok: function () {
                                    window.location.reload();
                                }
                            }
                        }); 
                    }
                }
            });
        }
        function product_image_delete(id){
            $.confirm({
                type:'red',
                title: 'Confirm!',
                content: 'Are you sure to delete?',
                buttons: {
                    confirm: function () {
                        var _token = '<?php echo csrf_token() ?>';
                        $.ajax({
                            type: "POST",
                             url:'{{route('admin::product_image_delete')}}',
                            data: {_token: _token,id:id},
                            before:function(){
                            },
                            success: function (data) {
                                if(data == 1){
                                window.location.reload();
                                }else{
                                $.alert({
                                    title: 'Error!',
                                    content: 'Please change your default image',
                                    buttons: {
                                        ok: function () {
                                            window.location.reload();
                                        }
                                    }
                                });
                                }
                            }
                        });
                    },
                    cancel: function () {

                    }
                }
            });
        }
    </script>
     <script>
           // var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $("#input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                //if(x < max_fields){ //max input box allowed
                // $(wrapper).append('<div class="form-group col-md-8" id="highlight_div_'+x+'"><input type="text" name="highlight[]" id="highlight_'+x+'" class="form-control"></div><div class="form-group col-md-4"><a href="#" class="btn btn-danger remove_field" data-no="'+x+'">Remove</a></div>');

                 $(wrapper).append('<div class="col-sm-9 margin-bt" id="highlight_div_'+x+'"><div class="form-group"><input type="text" name="highlight[]" id="highlight_'+x+'" class="form-control"></div></div><div class="col-sm-3 margin-bt"><a href="#" class="btn btn-danger remove_field" data-no="'+x+'">Remove</a></div>'); //add input box
                //}
                 x++; //text box increment
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); 
                $(this).parent('div').remove();
                var num = $(this).attr('data-no');
                $('#highlight_div_'+num).remove();
                x--;
            })
    </script>
@stack('scripts')
</body>
</html>
