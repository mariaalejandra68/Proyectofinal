
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <?php
    if (isset($_POST['administrador_log']) && isset($_POST['clave_log'])) {
        require_once "./controladores/loginControlador.php";
        $reg_login = new loginControlador();
        echo $reg_login->iniciar_sesion_controladores();
    }
    ?>

    <script>
        function mostrarContraseña() {
            var x = document.getElementById("contraseña");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <style>
        body {
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .login-box {
            background-color: rgba(255, 255, 255, 0.8); 
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            animation: fadeIn 1s ease;
        }
        .login-box img {
            width: 100px;
            margin-bottom: 20px;
        }
        .logo-font {
            font-size: 18px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn1-outline-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: all 0.3s ease;
        }
        .btn1-outline-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: translateY(-3px);
        }
        .colorsito {
            color: #333333;
            font-size: 14px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

<section class="body1">
    <div class="container">
        <div class="login-box">
            <div class="col-sm-12 text-center">
                <div class="logo1">
                    <span class="logo-font">Bienvenido al sistema de préstamos del SENA</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form action="" class="login-form" autocomplete="off" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control mb-4" maxlength="10" name="administrador_log" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <input type="password" id="contraseña" class="form-control" name="clave_log" placeholder="Contraseña">
                        </div>
                        <div class="mx-2">
                            <input type="checkbox" onclick="mostrarContraseña()">
                            <label class="colorsito">Ver Contraseña</label>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn1-outline-success btn-block">Ingresar</button>
                            <button type="button" onclick="window.location.href='<?php echo SERVERURL; ?>registrar-login/';" class="btn btn1-outline-success btn-block">Registrarse</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

