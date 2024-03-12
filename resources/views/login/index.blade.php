<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('login/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login/css/main.css')}}">

<!--===============================================================================================-->
</head>
<body >
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 ">
				<div class="login100-pic " data-tilt>
					<img src="{{ asset('login/images/img-02.png')}}" alt="IMG">
				</div>

				<form class="login100-form" name="frm_login" id="frm_login">
					@csrf
					<span class="login100-form-title">
						Inicio de sesion
					</span>

					<div class="wrap-input100">
						<input class="input100" type="text" name="email" id="email" placeholder="Correo">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						  <i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					  
					  
					<div class="wrap-input100">
						<div class="input-container">
							<input class="input100" type="password" name="pass" id="pass" placeholder="Contraseña">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
							<span class="toggle-password" onclick="Ver()">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</span>
						</div>
					</div>
					
					
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="button" onclick="login()">
							Iniciar
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Olvido su
						</span>
						<a class="txt2" href="{{ route('recuperar')}}">
							Contraseña?
						</a>
					</div>
					<div class="d-flex align-items-center error-container mt-3" id="divError"
                        name="divError" >
                        <p class="text-danger" id="error" name="error"></p>
                    </div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{{ asset('login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{ asset('login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>	
	<script src="{{ asset('login/js/login.js')}}"></script>
	
</body>
</html>