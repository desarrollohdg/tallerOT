var tabla2;

init();

function init(){
	tabla2=$('#tbllistado_ots_tecnico').dataTable({});
}

function llenarTabla_listaOts_tecnicos(val){
	tabla2=$('#tbllistado_ots_tecnico').dataTable({
		 "aPrecessing":true,
        "aServerSide":true,
        "ajax":{
			url:"/tallerOT/ajax/datos_ots.php?op=lista_ots",
			type: "POST",
			data: {codigo_tecnico:val},
			dataType:"Json",
			error:function(d){
				$('#getmodal_ots_tecnico').modal('hide')
				alert(d.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":10,
        "order":[[0,"desc"]]//ordenar (columna, orden)
	}).dataTable();
}

function mostrarmodal(){
    var Nombre_tecnico=$('#nombretecnico').val();
  
     $('#titulo').html('Listado de ordenes de trabajo Tecnico: ' + Nombre_tecnico);
  
	 $('#getmodal_ots_tecnico').modal('toggle');
}

function mostrar(val){

	$("#codigotecnio").val(val);
	$.post("/tallerOT/ajax/datos_ots.php?op=datos_tecnico",{codigo_tecnico:val},function (datostecnico){
		var nombre =datostecnico;
		$("#nombretecnico").val(nombre);
		llenarTabla_listaOts_tecnicos(val);
		mostrarmodal();
		
	}
	);
	
}