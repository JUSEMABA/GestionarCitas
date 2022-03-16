<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location:  login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$paciente =  $_POST['paciente'];

	$consultorio =  $_POST['consultorio'];
	$estado =  $_POST['estado'];

	$mensaje='';
	if(empty($fecha) or empty($hora)  or empty($paciente) or empty($consultorio) or empty($estado)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
		'INSERT INTO citas values(null, :fecha,:hora,:paciente,:consultorio,:estado)');

		$statement ->execute(array(
		':fecha'=>$fecha,
		':hora'=>$hora,
		':paciente'=>$paciente,

		':consultorio'=>$consultorio,
		':estado'=>$estado,

		));
		header('Location: citas.php');
	}
}
require 'vista/agregarcitas_vista.php';
?>
