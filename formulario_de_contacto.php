<?php
//CABECERAS CORS
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	$method = $_SERVER['REQUEST_METHOD'];
	if($method == "OPTIONS") {
	    die();
	}

$name = $email = $tel = $comment = "";

if (!isset($_GET['correo']) || !isset($_GET['nombre']) || !isset($_GET['mensaje'])) {
    header('Location: index.html'); 
}else{
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if($_GET['caja'] === 'true') {
    	    echo "<script>alert('¡Mensaje recibido!');</script>";
            header('Location: index.html');
        }else {
            if (!empty($_GET['nombre'])) {
                $name = test_input($_GET['nombre']);
            }
            if (!empty($_GET['correo'])) {
                $email = test_input($_GET['correo']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  echo "-2";
                }
            }
            if (!empty($_GET['telefono'])) {
                $tel = test_input($_GET['telefono']);
            }
            if (!empty($_GET['mensaje'])) {
                $comment = test_input($_GET['mensaje']);
            }
            if (!empty($_GET['nombre']) && !empty($_GET['correo']) && !empty($_GET['mensaje'])) {
                $mensaje="<!DOCTYPE html>
                    <html>
                    <head></head>
                    <body>
                        <h3>Mensaje del formulario de contacto</h3>
                        <p>Nombre: ". $name."</p>
                        <p>Email: ".$email."</p>
                        <p>Teléfono: ".$tel."</p>
                        <p>Mensaje: ".$comment."</p>
                    </body>
                    </html>";
                    
                $destino= "info@thetreehousestudio.es";
                $asunto = "Mensaje enviado por: ".$name;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'FROM: '.$email. "\r\n";
                mail($destino,$asunto,$mensaje,$headers);
            }else {
                echo "-1"; 
            }
        }
    }
}

?>