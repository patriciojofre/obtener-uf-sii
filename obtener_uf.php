<?php 
error_reporting(0);

function nombreMes($numero_mes){

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
				
	return $mesArray[$numero_mes];
}

function imprimirUF($mes_usr,$anio){

	$contenido = file_get_contents("http://www.sii.cl/pagina/valores/uf/uf".$anio.".htm");

	$dom = new DOMDocument;
	$dom->loadHTML($contenido);

	foreach($dom->getElementsByTagName('tr') as $meses => $tr){

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
	
	echo '<pre>';
	echo '<p> ' . nombreMes($mes_usr) . '</p>';
	echo json_encode($array_uf);
	echo '</pre>';
}
?>