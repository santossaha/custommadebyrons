<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <style type="text/css">
        .email a{color: #ffffff;};
    </style>
    
</head>
<body style="width: 100%; height: 100%;min-height: 100%; padding: 0; margin: 0; font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,'sans-serif' ; line-height: 18px; color: #212121; font-size: 12px; background: #f0f0f0;">

<table cellpadding="0" cellspacing="0" style=" width:100%;height: 100%; min-height: 100%; border-spacing: 0px;">
<tr>
    <td>


        <table cellpadding="0" cellspacing="0" style=" width:100%; height: 100%; min-height: 100%; min-width: 300px;max-width: 600px; border-spacing: 0px; background: #fff; margin: 60px auto; border-radius: 2px; box-shadow: rgba(0,0,0,0.1) 0 5px 30px;">
            <!--This is the Header Section-->
            <tr>
                <td>

                    <table cellpadding="0" cellspacing="0" style=" width:100%;padding:10px; margin: 0 auto; border-bottom: #eee solid 2px;">
                        <tr>
                            <td style="text-align: center;">
                                     @if($content['logo']!='')
                                      <img alt="" src="{{$content['logo']}}"  width="150px"/>
                                    @else
                                      <img alt="" src="{{url('front/images/logo.png')}}"  width="150px"/>
                                    @endif
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr><!--end Header Section-->
            
            <!--This is the Body Section 1-->
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" style="width:100%; font-size: 14px; padding: 20px;">
                        <tr>
                            <td>
                                <p align="center">
                                     <img alt="" src="{{url('front/images/Icons_V2-01.png')}}"  width="150px"/>
                                </p>

                                    <p align="center"><a href="<?php echo URL::to('/').'/user-password-reset?tn='.$content['token'].'&me='.$content['email'] ?>" target="_blank" style="text-decoration: none; padding:10px 20px; background:#ef5350; color: #fff; text-align: center; text-transform: uppercase;">Reset Password</a></p>
                                        <p>&nbsp;</p>
                                        <p>If verify email button doesn't work, copy and paste the following link in your browser: </p>
                                        <p><a href="<?php echo URL::to('/').'/user-password-reset?tn='.$content['token'].'&me='.$content['email'] ?>" target="_blank" style="text-decoration: none; padding:10px 20px;color: #1da253; display: inline-block; text-align: center;font-size: 12px;"><?php echo URL::to('/').'/user-password-reset?tn='.$content['token'].'&me='.$content['email'] ?></a></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="padding:15px; background:#f0f0f0; color: #636363; font-size: 12px; text-align: center;">
                                If you have any comments or questions, please don't hesitate to reach us at <a href="" style="color:#000;"> <?php echo $content['admin_email'];?> </a> to hear from you.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!--end Body Section 1-->
            
            
            
            
            <!--This is the Footer Section-->
            <tr>
                <td>

                    <table cellpadding="0" cellspacing="0" style=" width:100%;padding:15px; margin: 0 auto; border-bottom: #eee solid 2px; background:#263238; text-align: center;">
                        <tr>
                            <td style="color:#fff;">
                                <span style=" color:#C5C5C5;font-size:10px;">{{ $content['copyright']}}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!--end Footer Section-->
            
            
            
        </table>


    </td>
</tr>
</table>

</body>

</html>
