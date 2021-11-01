<?php
// Solo el administrador puede entrar a Reportes
	// Se realiza para que no entren desde la URL de la barra de direcciones
	if ($_SESSION["perfil"] == "Operador" || $_SESSION["perfil"] == "Supervisor")
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
	
//ob_start();
  //ob_clean();
  require_once('../fpdf.php');
	require_once('../../../controladores/productos.controlador.php');
	require_once('../../../modelos/productos.modelo.php');
	require_once('../../../controladores/perifericos.controlador.php');
	require_once('../../../modelos/perifericos.modelo.php');
	require_once('../../../controladores/empleados.controlador.php');
	require_once('../../../modelos/empleados.modelo.php');
	require_once('../../../controladores/marcas.controlador.php');
	require_once('../../../modelos/marcas.modelo.php');
	require_once('../../../controladores/modelos.controlador.php');
	require_once('../../../modelos/modelos.modelo.php');

	
  while (ob_get_level())
  ob_end_clean();
	
	header("Content-Encoding: None", true);
	
	
		
	// Imprimir los datos.
	$item = "id_linea"; 

	// Este valor se mando desde reportes.js, en “windows.open (extensiones…….)
	$por_linea = $_GET["num_Linea"];
	if ($por_linea == 1)
	{
		$por_linea = null;
	}
	
	//print_r($valor);
	// IMPORTANTE SE DEBE GENERAR LAS CONSULTAS PARA LOS REPORTES, YA QUE ESTE VALOR DEBE RETORNAR:
	// return $stmt->fetchAll(); YA QUE COMO SE CONSULTA PARA UN SOLO VALOR SE DEBE COLOCAR "ALL"
	
	$item = "id_linea";
	$valor = $por_linea;
	
	$Perif_Linea = ControladorProductos::ctrMostrarProductosLineas($item,$valor);
	//var_dump($Perif_Linea);

	$fecha_actual = date('m-d-Y');

	class PDF extends FPDF
  {

    // Definiendo la cabecera
    function Header()
    {
      //Cell(Ancho,Alto,Texto,Border=1,SigLinea=1 0=SinSaltoLinea,'Centrado,Left,Right',Relleno 0=Sin 1=Con)
  
      $this->SetFont('Arial','B',12);
			$this->Cell(60);
			
      // Este valor "135" es para centrar, independiente del texto escrito
      $this->Cell(135,10,'REPORTE PERIFERICOS EN LINEA DE PRODUCCION',0,0,'C');
			$this->Ln(5);
			
			$this->Cell(135,5,$fecha_actual,0,1,'C',0);
      //$this->Cell(10,5,'ID',1,0,'C',0);
			//$this->Cell(22,5,'MARCA',1,0,'C',0);
      $this->Cell(25,5,'MODELO',1,0,'C',0);
			$this->Cell(42,5,'SERIAL',1,0,'C',0);      
			$this->Cell(35,5,'LINEA',1,0,'C',0);  
			$this->Cell(35,5,'UBICACION',1,0,'C',0);  
			$this->Cell(40,5,'ASSET',1,0,'C',0);
			$this->Cell(25,5,'NPA',1,0,'C',0); 
			$this->Cell(18,5,'LOFT',1,0,'C',0); 
			//$this->Cell(58,5,'ESTACION',1,0,'C',0); 
			$this->Cell(38,5,'IP',1,1,'C',0); // 1,1 = Salto de Linea
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
	$pdf->SetFont('Arial','B',14);
	//$pdf->Cell(30,5,$Por_almacen[0]['Almacen'],0,1,'L',0);
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',11);
  for ($n=0;$n<count($Perif_Linea);$n++)
  {
    //$pdf->Cell(10,5,$datos2[$n]['id_refaccion'],0,0,'L',0);
		$pdf->Cell(25,5,$Perif_Linea[$n]['Modelo'],0,0,'L',0);		
		$pdf->Cell(42,5,$Perif_Linea[$n]['num_serie'],0,0,'L',0);
		$pdf->Cell(35,5,$Perif_Linea[$n]['Linea'],0,0,'L',0);
		$pdf->Cell(35,5,$Perif_Linea[$n]['Ubicacion'],0,0,'L',0);
		$pdf->Cell(40,5,$Perif_Linea[$n]['asset'],0,0,'L',0);
		$pdf->Cell(25,5,$Perif_Linea[$n]['npa'],0,0,'L',0);
		$pdf->Cell(18,5,$Perif_Linea[$n]['lofware'],0,0,'L',0);
		$pdf->Cell(38,5,$Perif_Linea[$n]['num_ip'],0,1,'L',0);
		
    // MultiCell(Ancho,AltoFuente(puntos),'Texto Largo',1=Border 0=SinBorder,'Alineacion',Fondo(0=SinFondo))
		//$pdf->MultiCell(60,5,$datos2[$n]['observaciones'],0,'L',0);				
	}
	
  $pdf->Output();
  ob_end_flush();


?>

