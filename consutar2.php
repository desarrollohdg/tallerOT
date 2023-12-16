<?php
require_once('../tallerOT/lib/nusoap.php');
ini_set('soap.wsdl_cache_ttl', 1);
$servicio="http://192.168.0.6:3427/ws_taller_serviavia/servicios_consulta_taller.asmx?WSDL"; //url del servicio
$parametros=array(); //parametros de la llamada que dejo vacío porque no hay nada
$client = new SoapClient($servicio,$parametros);

$result = $client->consultar_asignaciones();//llamamos al métdo que nos interesa con los parámetros
//var_dump($result->consultar_asignacionesResult->lista_tecnicos_asignados);
 ?>
 	<table id="tb_lista_asignacion" class="table table-striped table-bordered" style="width:100%">
				
					<thead>
						<tr>
							<th>Serie OT</th>
							<th>Numero OT</th>
							<th>Fecha OT</th>
							<th>Estado</th>
							<th>Tecnico Asignado</th>
							<th>Fecha Asignacion</th>
							<th>Personal que Asigno</th>
							<th>Matricula</th>
							<th>Fecha Hora Asignacion</th>
							<th>Fecha Entrega
						</tr>
					</thead>
<tbody>
<?php
  foreach($result->consultar_asignacionesResult->lista_tecnicos_asignados as $table) 
  {
    	print_r("<tr><td>$table->serie_ot</td><td>$table->numero_ot</td><td>$table->fecha_ot</td><td>$table->estado_ot</td><td>$table->nombre_tecnico_a</td><td>$$table->fecha_asignacion</td><td>$table->persona_asigna</td><td>$table->matricula</td><td>$table->fecha_hora_asignacion</td><td>$table->fecha_entrega</td></tr>");

  }
  
		$parametros=array();
		$parametros['codigotecnico']=20;
		$client = new SoapClient($servicio,$parametros);
		
		$result = $client->lista_ots_tecnico($parametros);
		var_dump($result);
		
?>	
<tbody>
</table>

