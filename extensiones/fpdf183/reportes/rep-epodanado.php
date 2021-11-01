<?php
	
//ob_start();
  //ob_clean();
  require_once('../fpdf.php');
	require_once('../../../controladores/productos.controlador.php');
	require_once('../../../modelos/productos.modelo.php');
	require_once('../../../controladores/almacen.controlador.php');
	require_once('../../../modelos/almacen.modelo.php');
	require_once('../../../controladores/perifericos.controlador.php');
	require_once('../../../modelos/perifericos.modelo.php');
	require_once('../../../controladores/modelos.controlador.php');
	require_once('../../../modelos/modelos.modelo.php');

	
  while (ob_get_level())
  ob_end_clean();
	
	header("Content-Encoding: UTF8", true);
	
	// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
	$fecha = date("m-Y-d");
	//$fecha_devol = date("Y-m-d",strtotime($_POST["nuevaFechaDevolucion"]));

	
	//print_r($valor);
	// IMPORTANTE SE DEBE GENERAR LAS CONSULTAS PARA LOS REPORTES, YA QUE ESTE VALOR DEBE RETORNAR:
	// return $stmt->fetchAll(); YA QUE COMO SE CONSULTA PARA UN SOLO VALOR SE DEBE COLOCAR "ALL"
	$tabla = "t_Productos";
	$item = null;
	$valor = null;
	$orden = "nombre";
	$productos = ModeloProductos::mdlMostrarProdDanado($tabla,$item,$valor,$orden);
	

	class PDF extends FPDF
  {

    // Definiendo la cabecera
    function Header()
    {
      //Cell(Ancho,Alto,Texto,Border=1,SigLinea=1 0=SinSaltoLinea,'Centrado,Left,Right',Relleno 0=Sin 1=Con)
  
      $this->SetFont('Arial','B',12);
			$this->Cell(60);
			
      // Este valor "135" es para centrar, independiente del texto escrito
      $this->Cell(135,10,'REPORTE EQUIPOS DANADOS',0,0,'C');
			$this->Ln(10);
						
      //$this->Cell(10,5,'ID',1,0,'C',0);
      $this->Cell(30,5,'PERIFERICO',1,0,'C',0);			
			$this->Cell(38,5,'SERIAL',1,0,'C',0);
			$this->Cell(20,5,'MARCA',1,0,'C',0);      
			$this->Cell(35,5,'MODELO',1,0,'C',0);  			
			$this->Cell(40,5,'UBICACION',1,0,'C',0); // 1,1 = Salto de Linea
			$this->Cell(100,5,'COMENTARIO',1,1,'C',0); // 1,1 = Salto de Linea
    }
    function Footer()
    {
      $this->SetY(-15);
      $this->SetFont('Arial','I',8);
      $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
    }
  }
  // 'L' = Horizontal(Acostada), 'P' = Vertical (Normal)
  // $pdf = new PDF('L','cm','Letter');
  $pdf = new PDF('L','mm','Letter');
  $pdf->AliasNbPages(); // Para determinar el número total de hojas.
  $pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	
		//Cell(Ancho,Alto,Texto,Border=1,SigLinea=1 0=SinSaltoLinea,'Centrado,Left,Right',Relleno 0=Sin 1=Con)
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
  for ($n=0;$n<count($productos);$n++)
  {
    //$pdf->Cell(10,5,$datos2[$n]['id_refaccion'],0,0,'L',0);
		$pdf->Cell(30,5,$productos[$n]['Periferico'],0,0,'L',0);
		$pdf->Cell(38,5,$productos[$n]['Serial'],0,0,'L',0);
		$pdf->Cell(20,5,$productos[$n]['Marca'],0,0,'L',0);
		$pdf->Cell(35,5,$productos[$n]['Modelo'],0,0,'L',0);
		$pdf->Cell(40,5,$productos[$n]['Almacen'],0,0,'L',0);
		$pdf->Cell(100,5,$productos[$n]['comentarios'],0,1,'L',0);
		

		/*
    // MultiCell(Ancho,AltoFuente(puntos),'Texto Largo',1=Border 0=SinBorder,'Alineacion',Fondo(0=SinFondo))
		//$pdf->MultiCell(60,5,$datos2[$n]['observaciones'],0,'L',0);
		*/

	}

  $pdf->Output();
  ob_end_flush();
  
?>

