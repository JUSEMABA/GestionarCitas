<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//SELECT PARA MEDICOS
$medicos = $conexion -> prepare("SELECT * FROM medicos");

$medicos ->execute();
$medicos = $medicos ->fetchAll();
if(!$medicos)
	$mensaje .= 'No hay medicos, por favor registre primero! <br />';
//SELECT PARA CONSULTORIOS
$consultorios = $conexion -> prepare("SELECT * FROM consultorios");

$consultorios ->execute();
$consultorios = $consultorios ->fetchAll();
if(!$consultorios)
	$mensaje .= 'No hay consultorios, por favor registre primero! <br />';
//SELECT PARA PACIENTES
$pacientes = $conexion -> prepare("SELECT * FROM pacientes");

$pacientes ->execute();
$pacientes = $pacientes ->fetchAll();
if(!$pacientes)
	$mensaje .= 'No hay pacientes, por favor registre primero! <br />';

?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Citas</h2>
						<label>Fecha:</label>
                        <input type="date" name="fecha" placeholder="Fecha:" required/>
                        <label>Hora:</label>
                        <input type="time" name="hora" value="11:45" max="20:30" min="08:00" step="60" required>
                        <label>Paciente:</label>
                        <select name="paciente" class="mayusculas" required>
	                        <?php foreach ($pacientes as $Sql2): ?>
							<?php echo "<option value='". $Sql2['pacNombre']. "'>". $Sql2['pacNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        
                        <label>Consultorios:</label>
                        <select name="consultorio" class="mayusculas" required>
													<option value="asignado">Odontologia</option>
                         	<option value="atendido">Consulta general</option>
													<option value="asignado">Pediatria</option>
													<option value="atendido">Examenes</option>
                        </select>
                        <label>Estado:</label required>
                        <select name="estado">
                        	<option value="asignado">Asignado</option>
                        	<option value="atendido">Atendido</option>
                        </select>
                        <label>Observaciones:</label>
                        <textarea placeholder="Observacion:" name="observaciones"></textarea>
						<input type="submit" name="enviar" value="Agregar Cita">
					</form>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>
