<?php
		
	function invertirFecha($fecha){
	  return implode("-", array_reverse( preg_split( "/\D/", $fecha)));
	}
        //echo implode( "-", array_reverse( preg_split( "/\D/", '27/07/2017' )));

	function _json($data)
	{
		echo json_encode($data);
		exit();	
	}

	function _printr($data)
	{
		print_r($data);
	}

	function _dd($data)
	{
		dd($data);
	}

	function fechaseteada($date)
	{
		$dia = explode("-", $date, 3);
		$year = $dia[0];
		$month = (string)(int)$dia[1];
		$day = (string)(int)$dia[2];

		$dias = array("domingo","lunes","martes","miercoles" ,"jueves","viernes","sabado");
		$tomadia = $dias[intval((date("w",mktime(0,0,0,$month,$day,$year))))];
		$meses = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

		return $day." de ".$meses[$month]." de ".$year;
	}

	function calcularedad($fecha){

       $date = date_create($fecha); 
       $fechaseteada = date_format($date, 'Y-m-d');

           $fechanacimiento = $fechaseteada;
            list($ano,$mes,$dia) = explode("-",$fechanacimiento);
            $ano_diferencia  = date("Y") - $ano;
            $mes_diferencia = date("m") - $mes;
            $dia_diferencia   = date("d") - $dia;
            if ($dia_diferencia < 0 || $mes_diferencia < 0)
                $ano_diferencia--;
            echo  $ano_diferencia;
    }

?>