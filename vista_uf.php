<p>Seleccione mes</p>
<form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
	<select name="mes" onchange="">
		<option value="13">Todos</option>
		<option value="01">Enero</option>
		<option value="02">Febrero</option>
		<option value="03">Marzo</option>
		<option value="04">Abril</option>
		<option value="05">Mayo</option>
		<option value="06">Junio</option>
		<option value="07">Julio</option>
		<option value="08">Agosto</option>
		<option value="09">Septiembre</option>
		<option value="10">Octubre</option>
		<option value="11">Noviembre</option>
		<option value="12">Diciembre</option>
	</select>
	<input type="submit" value="enviar">
</form>

<?php
if($_POST["mes"]){
	require 'obtener_uf.php';
	return imprimirUF($_POST["mes"],date("Y"));
}
?>