<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User verification</title>
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
		                            @if($data['logo'] !='')
									<img src="{{$data['logo']}}"  width="150px"/>
									@else
									<img src="{{url('/')}}/front/images/logo.png')}}"  width="150px"/>
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
								<p style="font-weight: 700;font-size: 16px; margin:0 auto 15px auto; text-align: center;">Hi,<b><?php echo (!empty($data['name'])?$data['name']:'User'); ?></b></p>
								
								
								

								<p align="center" style="margin-bottom: 30px;color: #636363;">
									You are just one step away form joining the <?php echo $data['title'];?> Website.<br/>
									Please verify your email address by clicking the below button
								</p>

									<p align="center"><a href="<?php echo (!empty($data['actual_link'])?$data['actual_link']:'#'); ?>" target="_blank" style="text-decoration: none; padding:10px 20px; background:#1da253; color: #fff; text-align: center; text-transform: uppercase; border-radius: 4px;">Verify Email</a></p>
										<p>&nbsp;</p>
										<p align="center" style="color: #636363;">If verify email button doesn't work, copy and paste the following link in your browser: </p>
										<p align="center"><a href="<?php echo (!empty($data['actual_link'])?$data['actual_link']:'#'); ?>" target="_blank" style="text-decoration: none; padding:10px 20px;color: #1da253; display: inline-block; text-align: center;font-size: 18px;"><?php echo (!empty($data['actual_link'])?$data['actual_link']:'#'); ?></a></p>
								
							</td>
						</tr>
						
						<tr>
							<td style="padding:15px; background:#f0f0f0; color: #636363; font-size: 12px; text-align: center;">
								If you have any comments or questions, please don't hesitate to reach us at <a href="" style="color:#000;"> <?php echo $data['admin_email'];?> </a> to hear from you.
							</td>
						</tr>
					</table>
				</td>
			</tr><!--end Body Section 1-->
			
			
			
			
			<!--This is the Footer Section-->
			<tr>
				<td>

					<table cellpadding="0" cellspacing="0" style=" width:100%;padding:15px; margin: 0 auto; border-bottom: #eee solid 2px; background:#293043; text-align: center;">
						<tr>
							<td style="color:#fff;">
								<span style=" color:#C5C5C5;font-size:10px;">{{$data['copyright']}}</span>
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
