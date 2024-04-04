<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mensaje</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['enviar_mensaje'])) {
        sendEmailContacto($_POST);
    } else {
        echo '<script>
        Swal.fire({
            title: "No pudimos encontrar los datos del formulario",
            text: "",
            icon: "error",
            timer: 4000,
            timerProgressBar: true,
            backdrop: false
        }).then(function() {
            history.back(); // Regresa a la página anterior
        });
    </script>';
    }
} else {
    echo '<script>
                Swal.fire({
                    title: "El formulario no se ha enviado correctamente",
                    text: "",
                    icon: "error",
                    timer: 4000,
                    timerProgressBar: true,
                    backdrop: false
                }).then(function() {
                    history.back(); // Regresa a la página anterior
                });
            </script>';
}


function sendEmailContacto($request)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prestamoscuentadante';
        $mail->Password = 'ztui cdky tjcy gozi';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($request['email'], $request['nombre']);
        $mail->addAddress('prestamoscuentadante@gmail.com', 'Cuentadantes');
        $asunto="Nueva solicitud de equipo";
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solititud de equipo</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0a67a3;
            padding: 20px;
            text-align: center;
            color: #fff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            color: #333;
        }
        .content p {
            margin: 10px 0;
        }
        .footer {
            background-color: #0a67a3;
            padding: 20px;
            text-align: center;
            color: #fff;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
            <h1>Cuentadantes</span></h1>
            </div>
            <div class="content">
                <p><b>Nombre:</b> ' . $request['nombre']. '</p>
                <p><b>Apellido:</b> ' . $request['apellido']. '</p>
                <p><b>Identificación:</b> ' . $request['identificacion'] . '</p>
                <p><b>Dependencia:</b> ' . $request['dependencia'] . '</p>
                <p><b>Correo:</b> ' . $request['email'] . '</p>
                <p><b>Teléfono:</b> ' . $request['telefono'] . '</p>
                <p><b>Sede:</b> ' . $request['sede'] . '</p>
                <p><b>Mensaje:</b></p>
                <p>' . nl2br($request['asunto']) . '</p>
            </div>
            <div class="footer">
            <p>Contacto: <a href="mailto:prestamoscuentadante@gmail.com" style="color: #fff; text-decoration: none;">prestamoscuentadante@gmail.com</a> | Teléfono: 311-311-4455</p>
            </div>
        </div>
    </body>
    </html>';

        $mail->send();
        echo '<script>
                Swal.fire({
                    title: "Mensaje enviado. Pronto atenderemos tu solicitud",
                    text: "",
                    icon: "success",
                    timer: 4000,
                    timerProgressBar: true,
                    backdrop: false
                }).then(function() {
                    history.back(); // Regresa a la página anterior
                });
            </script>';
    } catch (Exception $e) {
        echo '<script>
        Swal.fire({
            title: "No pudimos enviar el mensaje",
            text: "",
            icon: "error",
            timer: 4000,
            timerProgressBar: true,
            backdrop: false
        }).then(function() {
            history.back(); // Regresa a la página anterior
        });
    </script>';
    }
}
?>
</body>
</html>