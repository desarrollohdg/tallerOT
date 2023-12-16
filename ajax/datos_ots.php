<?php

require_once('nusoap.php');
$servicio="http://192.168.0.6:3427/ws_taller_serviavia/servicios_consulta_taller.asmx?WSDL";
ini_set('soap.wsdl_cache_ttl', 1);
switch ($_GET['op']){
	case 'datos_tecnico':
		$codigotecnico=$_REQUEST['codigo_tecnico'];
		
		$parametros=array();
		$parametros['codigotecnico']=$codigotecnico;
		$client = new SoapClient($servicio,$parametros);
		$result = $client->consultar_tecnico($parametros);
		$rspta=$result->consultar_tecnicoResult;
		 echo json_encode($rspta);
        break;
	case 'lista_ots':
		$codigotecnico=$_REQUEST['codigo_tecnico'];
		$parametros=array();
		$parametros['codigotecnico']=$codigotecnico;
		$client = new SoapClient($servicio,$parametros);
		$respuesta = $client->lista_ots_tecnico($parametros);
		
		$respuest = obj2array($respuesta);
		$datos=$respuest['lista_ots_tecnicoResult']['listado_ots_tecnico'];
		$n=count($datos);
		
		if ($n==5){
			$rspta="True";
			echo $rspta ? "El Tecnico seleccionado solo esta asignado a una Orden de trabajo" : "";
		} else {
			
		
		
		for($i=0; $i<$n; $i++){
		
			$dato=$datos[$i];
			
				$fechaot=date('d/m/Y',strtotime($dato['fecha_ot']));
				$fecha_entrega_a=date('d/m/Y',strtotime($dato['fecha_entrega']));
				$d[]=array(
				"0"=>$dato['numero_ot'],
				"1"=>$dato['serie_ot'],
				"2"=>$fechaot,
				"3"=>$dato['matricula'],
				"4"=>$fecha_entrega_a
				);
				
			}
			$resultado=array(
						"sEcho"=>1,
						"iTotalRecords"=>count($d),
						"iTotalDisplayRecords"=> count($d),
						"aaData"=>$d
						);
						 echo json_encode($resultado);
		
			}			
						
        break;
}

function obj2array($obj) {
  $out = array();
  foreach ($obj as $key => $val) {
    switch(true) {
        case is_object($val):
         $out[$key] = obj2array($val);
         break;
      case is_array($val):
         $out[$key] = obj2array($val);
         break;
      default:
        $out[$key] = $val;
    }
  }
  return $out;
}
?>