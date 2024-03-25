<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recuperar contraseña</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('login/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/main.css') }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 ">
                <div class="login100-pic " data-tilt>
                    <img src="{{ asset('login/images/img-02.png') }}" alt="IMG">
                </div>

                <form class="login100-form" name="frm_login" id="frm_login">
                    @csrf
                    <span class="login100-form-title">
                        Recuperar contraseña
                    </span>

                    <div class="wrap-input100" id="divEmail">
                        <div class="input-warning-icon" id="error1">!</div>
                        <div class="warning-message">No se aceptan campos vacíos</div>
                        <input class="input100" type="text" name="email" id="email" placeholder="Correo">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100" style="display:none" name='divCodigo' id="divCodigo">
                        <div class="input-warning-icon" id="error2">!</div>
                        <div class="warning-message">No se aceptan campos vacíos</div>
                        <input class="input100" type="text" name="codigo" id="codigo"
                            placeholder="Codigo de seguridad">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-hashtag" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100" style="display:none" name='divContra' id="divContra">
                        <div class="input-warning-icon" id="error3">!</div>
                        <div class="warning-message">No se aceptan campos vacíos</div>
                        <div class="input-container">
                            <input class="input100" type="password" name="pass" id="pass"
                                placeholder="Contraseña">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            <span class="toggle-password" name='icon' id="icon" onclick="Ver()">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>


                    <div class="wrap-input100" style="display:none" name='divContra2' id="divContra2">
                        <div class="input-warning-icon" id="error4">!</div>
                        <div class="warning-message">No se aceptan campos vacíos</div>
                        <div class="input-container">
                            <input class="input100" type="password" name="pass2" id="pass2"
                                placeholder="Contraseña">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            <span class="toggle-password" name='icon2' id="icon2" onclick="Ver2()">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>






                    <div class="container-login100-form-btn" name='btnCorreo' id='btnCorreo'>
                        <button class="login100-form-btn" type="button"
                            onclick="Correo('{{ route('validarCorreo') }}')">
                            Verificar correo
                        </button>
                    </div>

                    <div class="container-login100-form-btn" style="display:none" name='btnCodigo' id='btnCodigo'>
                        <button class="login100-form-btn" type="button"
                            onclick="Codigo('{{ route('validarCodigo') }}')">
                            Verificar codigo
                        </button>
                    </div>

                    <div class="container-login100-form-btn" style="display:none" name='btnContra' id='btnContra'>
                        <button class="login100-form-btn" type="button"
                            onclick="Actualizar('{{ route('actualizarContraseña') }}')">
                            Actualizar contraseña
                        </button>
                    </div>

                    <div class="d-flex align-items-center error-container mt-3" id="divError"
                        name="divError">
                        <p class="text-danger" id="error" name="error"></p>
                    </div>

                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{ asset('login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('propio/recuperar.js') }}"></script>

</body>

</html>
