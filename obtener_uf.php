<?php 
function nombreMes($mes){
  
  $mesArray = array( 
          1 => "Enero",
          2 => "Febrero",
          3 => "Marzo",
          4 => "Abril", 
          5 => "Mayo",
          6 => "Junio", 
          7 => "Julio", 
          8 => "Agosto",
          9 => "Septiembre", 
          10 => "Octubre", 
          11 => "Noviembre", 
          12 => "Diciembre", 
          13 => "Todos"
        );
        
  return $mesArray[intval($mes)];
}
function imprimirUF($mes_usr, $anio){

  $contenido = file_get_contents("http://www.sii.cl/valores_y_fechas/uf/uf".$anio.".htm");
  $dom = new DOMDocument;
  $dom->loadHTML($contenido);
  $tables = $dom->getElementById('table_export');

  foreach($dom->getElementById('table_export')->getElementsByTagName("tr") as $meses => $tr){
    foreach($tr->getElementsByTagName('td') as $dias => $td){
      $valores_por_mes[$dias][$meses] = $td->nodeValue;
    }
  }
  
  $array_uf = array();
  foreach($valores_por_mes as $meses => $arreglo_dias){
    
    $mes = intval($meses+1);
    if(strlen($mes)==1){ 
      $mes = "0".$mes; 
    }else{ 
      $mes; 
    }   
    
    foreach($arreglo_dias as $dias => $valor){      
      if($mes == $mes_usr || $mes_usr == 13){     
        if (strpos($valor,'.') !== false) {         
          if(strlen($dias)==1){ $dias = "0".$dias; }else{ $dias; }
          $fecha = $dias."-".$mes."-".$anio;
          $array_uf[$fecha] = $valor;
        }       
      }
    }   
  } 
  
  echo nombreMes($mes_usr);
  echo "<br>";
  echo json_encode($array_uf);
}
?>