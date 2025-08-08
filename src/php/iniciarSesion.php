<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "sesionUser";

if (
    !isset($_POST['nombre_usuario']) ||
    !isset($_POST['edad_usuario']) ||
    !isset($_POST['correo']) ||
    !isset($_POST['contrasena'])
) {
    echo "<script>alert('❌ Faltan datos del formulario.'); window.history.back();</script>";
    exit();
}

$conn = new mysqli($servidor, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
    echo "<script>alert('❌ Error de conexión: " . $conn->connect_error . "'); window.history.back();</script>";
    exit();
}

$nombre_usuario = $_POST['nombre_usuario'];
$edad_usuario = $_POST['edad_usuario'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$sql = "INSERT INTO userRegistrados (nombre_usuario, edad_usuario, correo, contrasena) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "<script>alert('❌ Error en la consulta: " . $conn->error . "'); window.history.back();</script>";
    exit();
}

$stmt->bind_param("siss", $nombre_usuario, $edad_usuario, $correo, $contrasena);

if ($stmt->execute()) {
    // Mensaje bonito y redirección automática
    echo '
    <html>
    <head>
        <title>Registro exitoso</title>
        <style>
            .mensaje-exito {
                background-color: #519c90ff;
                color: #155724;
                border: 1px solid #c3e6cb;
                padding: 20px;
                margin: 50px auto;
                width: 350px;
                text-align: center;
                font-size: 1.2rem;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            }
            body {
                background: #03346E;
            }
        </style>
        <script>
            setTimeout(function() {
                document.querySelector(".mensaje-exito").style.display = "none";
                window.location.href = "/Registro-pruebas/index.html";
            }, 2500);
        </script>
    </head>
    <body>
        <div class="mensaje-exito">
            ✅ Usuario creado correctamente.
        </div>
    </body>
    </html>
    ';
    exit();
} else {
    echo "<script>alert('❌ Error al registrar: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>