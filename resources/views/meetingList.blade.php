<!DOCTYPE html>
<html lang="en">
<head>
	<title>Xelpmoc Zoom Meeting</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="{{asset('public/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/meetingList.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
			<span class="contact100-form-title">
					<center><h3>Meeting List</h3></center></br>
				</span>
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Date and Time</th>
                                <th class="column2">Meeting Id</th>
                                <th class="column3">Topic</th>
                                <th class="column4" style="text-align: center !important">Duration</th>
                                <th class="column6">Action</th>
							</tr>
						</thead>
						<tbody>
                                @foreach ($meetings as $item)
                                <tr>
                                    <td class="column1">{{$item->start_time}}</td>
                                    <td class="column2">{{$item->id}}</td>
                                    <td class="column3">{{$item->topic}}</td>
                                    <td class="column4" style="text-align: center !important">{{$item->duration}}</td>
                                    <td class="column6">
                                        <div>
                                            <a href="/meeting?nickname=User&meetingId={{$item->id}}&password={{substr($item->join_url, strpos($item->join_url, '=') + 1)}}&role=1" target="_blank">Join</a>
                                            /
                                            <a style="color: rgb(206, 114, 114) !important" href="/delete/{{$item->id}}">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
						</tbody>
					</table>
				</div>
				<center><div style="float: right; padding: 20px">
                    <a href="/">Back to Home</a>
                    <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </div>
				</center>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>