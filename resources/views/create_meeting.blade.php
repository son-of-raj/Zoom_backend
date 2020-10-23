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
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
            <form action="/" method="POST" class="contact100-form validate-form">
                @csrf
				<center><div class="card-header"><h5 style="color:white;">Create Meeting</h5></div></center>
				</br>
				<div class="wrap-input100 validate-input">
					<label class="label-input100" for="topic">TOPIC</label>
					<input id="topic" class="input100" type="text" name="topic" placeholder="Enter Meeting Topic" autocomplete="off">
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input100 validate-input">
					<label class="label-input100" for="date">DATE</label>
					<input id="date" class="input100" type="date" name="date">
					<span class="focus-input100"></span>
				</div>

                <div class="wrap-input100 validate-input">
					<label class="label-input100" for="time">TIME</label>
					<input id="time" class="input100" type="time" name="time">
					<span class="focus-input100"></span>
                </div>
                
                <div class="wrap-input100 validate-input">
					<label class="label-input100" for="duration">DURATION</label>
					<input id="duration" class="input100" type="number" name="duration" placeholder="Enter duration of Meeting">
					<span class="focus-input100"></span>
                </div>
                
                <!-- <div class="wrap-input100 validate-input">
					<label class="label-input100" for="password">PASSWORD</label>
					<input id="password" class="input100" type="text" name="password" placeholder="Enter topic..." autocomplete="off">
					<span class="focus-input100"></span>
				</div> -->

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						Create Meeting
					</button>
                </div>
			</form>
			<div class="contact100-more flex-col-c-m" style="background-image: url('public/images/bg-01.jpg');">
			<br><br><br><br><span class="contact100-form-title">
				Xelpmoc Zoom Meeting
				</span>
				<div style="float: right; padding: 20px">
                    <a href="/meetings-list">View Meetings</a>
                    <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </div>
				<center><button type=button class="contact100-form-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</button>
 				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
                </form></center>
			</div>
		</div>
		
	</div>





<!--===============================================================================================-->
	<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
		$(".js-select2").each(function(){
			$(this).on('select2:open', function (e){
				$(this).parent().next().addClass('eff-focus-selection');
			});
		});
		$(".js-select2").each(function(){
			$(this).on('select2:close', function (e){
				$(this).parent().next().removeClass('eff-focus-selection');
			});
		});

	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
	<style>
	.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: #77c09e;
    border-bottom: 1px solid rgba(0,0,0,.125);
}
</style>
</body>
</html>
