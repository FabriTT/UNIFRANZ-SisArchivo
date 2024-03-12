<!DOCTYPE html>
<html>
<head>
    <title>Solicitud de recuperación de contraseña</title>
    <style>
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .codigo-container {
            background-color: black;
            color: white !important;
            padding: 10px;
            margin: 20px auto;
            display: inline-block;
        }
        .codigo {
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Solicitud de recuperación de contraseña</h1>
        <div class="codigo-container">
            <p>Tu código de verificación es: <br> <span class="codigo">{{ $codigo }}</span></p>
        </div>
    </div>
</body>
</html>
