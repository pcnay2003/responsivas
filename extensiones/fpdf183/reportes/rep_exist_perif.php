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
	
  while (ob_get_level())
  ob_end_clean();
	
	header("Content-Encoding: None", true);
	
	// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
	$fecha = date("m-Y-d");
	//$fecha_devol = date("Y-m-d",strtotime($_POST["nuevaFechaDevolucion"]));

	// Imprimir los datos.
	$item = null; 
	$valor = null; 
	
	//print_r($valor);
	// IMPORTANTE SE DEBE GENERAR LAS CONSULTAS PARA LOS REPORTES, YA QUE ESTE VALOR DEBE RETORNAR:
	// return $stmt->fetchAll(); YA QUE COMO SE CONSULTA PARA UN SOLO VALOR SE DEBE COLOCAR "ALL"
	
	$exist_perif = ControladorProductos::ctrMostrarProductosExistPerif($item,$valor);
	//var_dump($tel_Asignados);

	class PDF extends FPDF
  {

    // Definiendo la cabecera
    function Header()
    {
      //Cell(Ancho,Alto,Texto,Border=1,SigLinea=1 0=SinSaltoLinea,'Centrado,Left,Right',Relleno 0=Sin 1=Con)
  
      $this->SetFont('Arial','B',12);
			$this->Cell(60);
			
      // Este valor "75" es para centrar, independiente del texto escrito
      $this->Cell(75,10,'REPORTE EXISTENCIA DE PERIFERICOS',0,0,'C');
			$this->Ln(5);
			
			$this->Cell(135,5,date(),0,1,'C',0);
      //$this->Cell(10,5,'ID',1,0,'C',0);
			$this->Cell(35,5,'PERIFERICO',1,0,'C',0);
			$this->Cell(40,5,'EXISTENCIA',1,1,'C',0);  // 1,1 = Salto de Linea
			
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
	// L Horizontal ; ancho 135
	// P Vertical ; Ancho 
  $pdf = new PDF('P','mm','Letter');
  $pdf->AliasNbPages(); // Para determinar el número total de hojas.
  $pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	
		//Cell(Ancho,Alto,Texto,Border=1,SigLinea=1 0=SinSaltoLinea,'Centrado,Left,Right',Relleno 0=Sin 1=Con)
	
	$pdf->SetFont('Arial','',12);

  for ($n=0;$n<count($exist_perif);$n++)
  {
		//$pdf->Cell(10,5,$datos2[$n]['id_refaccion'],0,0,'L',0);
		$pdf->Cell(35,5,$exist_perif[$n]['Nom_perif'],0,0,'C',0);
		$pdf->Cell(40,5,$exist_perif[$n]['Existencia'],0,1,'C',0);
		
		/*
    // MultiCell(Ancho,AltoFuente(puntos),'Texto Largo',1=Border 0=SinBorder,'Alineacion',Fondo(0=SinFondo))
		//$pdf->MultiCell(60,5,$datos2[$n]['observaciones'],0,'L',0);
		*/

	}

  $pdf->Output();
  ob_end_flush();
  
?>

