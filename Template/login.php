<?php
session_start();
require_once ("../require/conexion.class.php");
require_once ("../require/user.class.php");


$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$usuarios = new users ();

$idUser = $usuarios->getUser ($usuario, $clave);
    
if ($idUser != 0  ){
    
    $_SESSION["idUser"]=$idUser;
	echo "<script type='text/javascript'>
			window.location.assign('index.php'); //DIRECCION DE ACCESO CONCEDIDO
			</script>";
} else {
    echo "<script type='text/javascript'>
			alert('El usuario o la clave son incorrectas, o estan deshabilitados porfavor vuelva a intentarlo o consulte con el administrador');
			window.location.assign('index.php'); // DIRECCION DE ACCESO DENEGADO
			</script>";
}

?>