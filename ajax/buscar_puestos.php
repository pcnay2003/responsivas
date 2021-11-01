<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
	// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/empleados.controlador.php";
	require_once "../modelos/empleados.modelo.php";


//echo "Entre a -buscar_puestos.php ";
$salida = "";

	$buscar_puesto = new ControladorEmpleados();
	$puestos = $buscar_puesto->ctrBuscarPuesto($_POST['buscar']);
	//var_dump($puestos);

	if (!empty($puestos))
	{
		// class="table table-bordered table-striped dt-responsive tablas" width="100%">
		$salida .= "<table class='table table-bordered table-striped dt-responsive tablas width='.'100%'>
			<thead>
				<td>Id</td>
				<td>Descripcion</td>
				<td>Acciones</td>
			</thead>
			<tbody>";


			// Se tiene que convertir de Entero a Cadenas, de lo contrario no asigna el valor a la idPuestoSelecc
			for ($n=0;$n<count($puestos);$n++)
  		{
				// 
				//"nombrePuesto = .$puestos[$n]['descripcion']. 

				$salida .= "<tr>
					<td>".$puestos[$n]['id_puesto']."</td>
					<td>".$puestos[$n]['descripcion']."</td>
					<td>"."<div class='btn-group'><button class= 'btn btn-warning btnSeleccPuesto' idPuestoSelecc=".strval($puestos[$n]['id_puesto'])."><i class='fa fa-pencil'></i></button></div></td>
					
					</tr>";
			}
		$salida .= "</tbody></table>";
			
	}
	else
	{
		$salida .= "No hay Datos";
	}

	echo $salida;


?>