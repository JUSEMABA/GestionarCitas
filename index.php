<?php session_start();
if (isset($_SESSION['usuario'])){
	header('Location: Inicio.php');
}else{
	header('Location: login.php');
}
?>
