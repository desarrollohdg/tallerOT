<?php
ob_start();
require_once('../tallerOT/lib/nusoap.php');
ini_set('soap.wsdl_cache_ttl', 1);
$servicio="http://192.168.0.6:3427/ws_taller_serviavia/servicios_consulta_taller.asmx?WSDL"; //url del servicio
$parametros=array(); //parametros de la llamada que dejo vacío porque no hay nada
$client = new SoapClient($servicio,$parametros);
$result = $client->consultar_asignaciones();//llamamos al métdo que nos interesa con los parámetros
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Taller SERVIAVIA</title>
	<link rel="icon" href="/tallerOT/img/SERVIAVIA.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="/tallerOT/css/bootstrap.css">
	<link rel="stylesheet" href="/tallerOT/Plugin/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<Link rel="stylesheet" href="/tallerOT/Plugin/datatables-rowgroup/css/rowGroup.bootstrap4.min.css">
	<link rel="stylesheet" href="/tallerOT/dist/css/adminlte.min.css">
	 <link rel="stylesheet" href="/tallerOT/plugin/fontawesome-free/css/all.min.css">
  </head>

 <!-- <body class="hold-transition dark-mode sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed">-->
 <body class="hold-transition sidebar-collapse layout-top-nav">
 <div class="wrapper">
	  
	 <!--<nav class="main-header navbar navbar-expand-md navbar-dark">-->
	  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
	   <div class="container">
	   <a href="#" class="navbar-brand">
	   <img src="/tallerOT/img/logo_s.png" alt="SERVIAVIA Logo" class="brand-image img-circle elevation-3"  width="50" height="60" style="opacity: .8">
        <span class="brand-text font-weight-light">SERVIAVIA</span>
      </a>
	   
	   <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	   <div class="collapse navbar-collapse order-3" id="navbarCollapse">
			<ul class="navbar-nav">
				  <li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				  </li>
				  <li class="nav-item d-none d-sm-inline-block">
					<a href="consutar2.php" class="nav-link">Principal</a>
				  </li>
				 
			</ul>
			
			 <ul class="navbar-nav ml-auto">
				 <li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
					  <i class="fas fa-expand-arrows-alt"></i>
					</a>
				  </li>
			 </ul>
		</div>
		</div>
	 </nav>
	
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<a href="index.php" class="brand-link">
			<img src="/tallerOT/img/logo_s.png" alt="SERVIAVIA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">SERVIAVIA</span>
		</a>
			
		<div class="sidebar">
		 <nav class="mt-2">
		  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item menu-open">
					<a href="#" class="nav-link active">
						  <i class="nav-icon fas fa-tachometer-alt"></i>
						  <p>
							Ordenes de Trabajo
							<i class="right fas fa-angle-left"></i>
						  </p>
					</a>
					   <ul class="nav nav-treeview">
						  <li class="nav-item">
							<a href="./index.php" class="nav-link">
							  <i class="far fa-circle nav-icon"></i>
							  <p>Listado OT</p>
							</a>
						  </li>
				   
					</ul>
			</li>
		  </ul>
		  </nav>
		 </div>
		
		
	</aside>

	<div class="content-wrapper">
	
		<div class="content-header">
		  <div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6">
				<h1 class="m-0">Listado de Tecnicos Asignados</h1>
			  </div><!-- /.col -->
			  <div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				  <li class="breadcrumb-item active"><a href="#">Principal</a></li>
				  
				</ol>
			  </div><!-- /.col -->
			</div><!-- /.row -->
		  </div><!-- /.container-fluid -->
		</div>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
			 <div class="col-12">
			 <div class="card">
			 <div class="card-header">
                <h3 class="card-title">Tecnicos Asignados</h3>
              </div>
				<div class="card-body">
					<table id="tb_lista_asignacion" class="table table-striped table-bordered" style="width:100%">
				
					<thead>
						<tr>
							<!--<th>Serie OT</th>-->
							<th>Numero OT</th>
							<th>Fecha OT</th>
							<!--<th>Estado</th>-->
							<th>Tecnico Asignado</th>
							<th>Fecha Asignacion</th>
							<th>Personal que Asigno</th>
							<th>Matricula</th>
							<th>Fecha Hora Asignacion</th>
							<th>Entrega Aeronave</th>
							<th>Opcion</th>
						</tr>
					</thead>
					<tbody>
<?php
					  foreach($result->consultar_asignacionesResult->lista_tecnicos_asignados as $table) 
					  {
						$fechaot=date('d/m/Y',strtotime($table->fecha_ot));
						$fechaas=date('d/m/Y',strtotime($table->fecha_asignacion));
						$fecha_entrega_a=date('d/m/Y',strtotime($table->fecha_entrega));?>
						<!--print_r("<tr><td>$table->serie_ot</td><td>$table->numero_ot</td><td>$fechaot</td><td>$table->estado_ot</td><td>$table->nombre_tecnico_a</td><td>$fechaas</td><td>$table->persona_asigna</td><td>$table->matricula</td><td>$table->fecha_hora_asignacion</td></tr>");-->
						<tr>
							<td><?=$table->numero_ot;?></td>
							<td><?=$fechaot;?></td>
							<td style="font-weight: bold;"><?=$table->nombre_tecnico_a;?></td>
							<td><?=$fechaas;?></td>
							<td><?=$table->persona_asigna;?></td>
							<td style="font-weight: bold;"><?=$table->matricula;?></td>
							<td><?=$table->fecha_hora_asignacion;?></td>
							<td><?=$fecha_entrega_a;?></td>
							<td><button class="btn btn-info btn-sm" onclick="mostrar(<?=$table->codigo_tecnico;?>)"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar Boleta"></i>Lista OTs</button></td>
							
						</tr>
					<?php 
					  }
?>
					</tbody>
					<tfoot>
						<tr>
							<!--<th>Serie OT</th>-->
							<th>Numero OT</th>
							<th>Fecha OT</th>
							<!--<th>Estado</th>-->
							<th>Tecnico Asignado</th>
							<th>Fecha Asignacion</th>
							<th>Personal que Asigno</th>
							<th>Matricula</th>
							<th>Fecha Hora Asignacion</th>
							<th>Entrega Aeronave</th>
							<th>Opcion</th>
						</tr>
					</tfoot>
				</table>
				</div>
			</div>
			</div>
			</div>
		</div>
	</section>
	</div>
	
	<div class="modal" id="getmodal_ots_tecnico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
				<div class="modal-header">
				  <p class="modal-title" id="titulo" name="titulo"></p>
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  
				</div>
			<div class="modal-body">
			<input type="hidden" id="codigotecnio" name="codigotecnio">
              <input type="hidden" id="nombretecnico" name="nombretecnico"></input>
			   <div class="box box-sucess">
					<div class="card">
						<div class="card-body">
							<div class="panel-body table-responsive" id="listado_ots_t">
								<table id="tbllistado_ots_tecnico" class="table table-striped table-bordered">
									<thead>
									<th>No. OT</th>
									<th>Serie OT</th>
									<th>Fecha OT</th>
									<th>Matricula</th>
									<th>Fecha Entrega</th>
									</thead>
									 <tbody id="table_datac">
							
                                     </tbody>
								</table>
							
							</div>
						</div>
					</div>
			   </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
              
            </div>
		</div>
		</div>
	</div>
	
	
	<aside class="control-sidebar control-sidebar-dark"></aside>
    <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="http//cambrantech.com"> lcambran</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
  
 

	<script src="/tallerOT/Plugin/jquery.min.js"></script>
	<script src="/tallerOT/Plugin/jquery.dataTables.min.js"></script>
	<script src="/tallerOT/Plugin/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/tallerOT/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/tallerOT/Plugin/datatables-rowgroup/js/dataTables.rowGroup.min.js"></script>
	<script src="/tallerOT/dist/js/adminlte.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.10/dayjs.min.js"></script>

	<script>
		$(document).ready(function() {
			
    var groupColumn = 0;
    var table = $('#tb_lista_asignacion').DataTable({
		
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'desc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color:#9ACCF8;color:#0000ff"><td colspan="8">Orden No: '+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#tb_lista_asignacion tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            table.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            table.order( [ groupColumn, 'asc' ] ).draw();
        }
    } );
} );

const actualizar=()=> {  
	const date = dayjs(new Date());
	if (dayjs(date).minute() % 5 == 0 && dayjs(date).second() == 0) {
		location.reload(true)
	}else {
			return;
  	}
	
};

setInterval("actualizar()",1000);
</script>
<script src="/tallerOT/scripts/funciones.js"></script>
 </body>
</html>
<?php
ob_end_flush();
?>