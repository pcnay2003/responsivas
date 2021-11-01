<?php
  class Conexion
  {
    static public function conectar()
    {
      $link = new PDO("mysql:host=localhost;dbname=bd_responsivas",
                      "usuario_responsiva",
											"responsivas-2020");
			$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);											
			
			$mitz="America/Tijuana";
			$tz = (new DateTime('now', new DateTimeZone($mitz)))->format('P');
			$link->exec("SET time_zone='$tz';");
								
      $link->exec("set names utf8"); // Para caracteres en español
      return $link;
    }
  }
?>