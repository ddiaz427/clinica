<?php
use App\Models\Peaje;

/**
 * CAlcula la tarifa total de una oferta
 *
 * @return Array
 */
function calcularTarifa($data, $dias, $P, $E){
	$data = (array) $data;
	$id=$data['codigo_unico'];
	$total = array_sum($E);
	global $conn;
	
	$tarifa = array(
		'oferta' => "3.0",
		'oferta1' => "2.1",
		'oferta2' => "2.0",
		'oferta3' => "3.1",
	);
	$peajes = Peaje::all();
	$peaje = $peajes->last();
	
	$peaje_punta['oferta'] = $peaje->peaje_punta_15;
	$peaje_llano['oferta'] = $peaje->peaje_llano_15;
	$peaje_valle['oferta'] = $peaje->peaje_valle_15;
	$peaje_punta['oferta1'] = $peaje->peaje_punta_10_1;
	$peaje_punta_1['oferta1'] = $peaje->peaje_punta_10_2;
	$peaje_llano['oferta1'] = $peaje->peaje_llano_10;
	$peaje_punta['oferta2'] = $peaje->peaje_punta_0_1;
	$peaje_punta_1['oferta2'] = $peaje->peaje_punta_0_2;
	$peaje_llano['oferta2'] = $peaje->peaje_llano_0;
	$peaje_punta['oferta3'] = $peaje->peaje_punta_15n;
	$peaje_llano['oferta3'] = $peaje->peaje_llano_15n;
	$peaje_valle['oferta3'] = $peaje->peaje_valle_15n;
	$resultado = $row = $data;

	//Costo Energia
	if(isset($row['diferencia'])){
		if($row['diferencia'] == 1){
			if($row['precio_peaje'] != 1){
				$resultado['p_e_punta_c_peaje'] = $row['p_e_punta_s_peaje'] + $peaje_punta_1[$row['dato']];
				$resultado['p_e_llano_c_peaje'] = $row['p_e_llano_s_peaje'] + $peaje_llano[$row['dato']];
				$resultado['p_e_valle_c_peaje'] = 0;
			}
			else{
				$resultado['p_e_punta_c_peaje'] = $row['p_e_punta_s_peaje'];
				$resultado['p_e_llano_c_peaje'] = $row['p_e_llano_s_peaje'];
				$resultado['p_e_valle_c_peaje'] = 0;
			}
		}
		else{
			if($row['precio_peaje'] != 1){
				$resultado['p_e_punta_c_peaje'] = $row['p_e_punta_s_peaje'] + $peaje_punta[$row['dato']];
				$resultado['p_e_llano_c_peaje'] = 0;
				$resultado['p_e_valle_c_peaje'] = 0;
			}
			else{
				$resultado['p_e_punta_c_peaje'] = $row['p_e_punta_s_peaje'];
				$resultado['p_e_llano_c_peaje'] = 0;
				$resultado['p_e_valle_c_peaje'] = 0;
			}
		}
	}
	else{
		if($row['precio_peaje'] != 1){
			$resultado['p_e_punta_c_peaje'] = $row['p_e_punta_s_peaje'] + $peaje_punta[$row['dato']];
			$resultado['p_e_llano_c_peaje'] = $row['p_e_llano_s_peaje'] + $peaje_llano[$row['dato']];
			$resultado['p_e_valle_c_peaje'] = $row['p_e_valle_s_peaje'] + $peaje_valle[$row['dato']];
		}
		else{
			$resultado['p_e_punta_c_peaje'] = $row['p_e_punta_s_peaje'];
			$resultado['p_e_llano_c_peaje'] = $row['p_e_llano_s_peaje'];
			$resultado['p_e_valle_c_peaje'] = $row['p_e_valle_s_peaje'];
		}
	}
	
	$resultado['E1'] = $E[0];
	$resultado['E2'] = $E[1];
	$resultado['E3'] = $E[2];

	$resultado['P1'] = $P[0];
	$resultado['P2'] = $P[1];
	$resultado['P3'] = $P[2];

	$resultado['dias'] = $dias;


	$resultado['coste_energia_punta'] = $resultado['p_e_punta_c_peaje'] * $E[0];
	$resultado['coste_energia_llano'] = $resultado['p_e_llano_c_peaje'] * $E[1];
	if(isset($resultado['p_e_valle_c_peaje'])){
		$resultado['coste_energia_valle'] = $resultado['p_e_valle_c_peaje'] * $E[2];
	}
	else{
		$resultado['coste_energia_valle'] = 0;
		$resultado['valle_final_dto'] = 0;
	}
	$resultado['subtotal_coste_energia'] = $resultado['coste_energia_punta'] + $resultado['coste_energia_llano'] + $resultado['coste_energia_valle'];
	$resultado['descuento'] = ($resultado['subtotal_coste_energia']/100)*$row['descuento'];
	$resultado['total_coste_energia'] = $resultado['subtotal_coste_energia'] - $resultado['descuento'];
	$resultado['descuento'] = number_format($resultado['descuento'],2,",",".");

	//Costo Potencia					
	$resultado['coste_potencia_punta'] = $row['p_p_punta'] * $dias * $P[0];
	$resultado['coste_potencia_llano'] = $row['p_p_llano'] * $dias * $P[1];
	$resultado['coste_potencia_valle'] = $row['p_p_valle'] * $dias * $P[2];
	$resultado['total_coste_potencia'] = $resultado['coste_potencia_punta'] + $resultado['coste_potencia_llano'] + $resultado['coste_potencia_valle'];
	$resultado['total_potencia_energia'] = $resultado['total_coste_potencia'] + $resultado['total_coste_energia'] + $resultado['exceso_potencia'] + $resultado['ajustes'] + $resultado['energia_reactiva'];
	$resultado['total_coste_energia'] = number_format($resultado['total_coste_energia'],2,",",".");
	$resultado['total_coste_potencia'] = number_format($resultado['total_coste_potencia'],2,",",".");
	$resultado['iee'] = $resultado['total_potencia_energia'] * 0.0510851124;
	$resultado['total_sin_iva'] = $resultado['total_sin_iva1'] = $resultado['total_potencia_energia'] + $resultado['iee'];
	$resultado['total_sin_iva'] += $resultado['alquiler_equipo'];
	$resultado['total_sin_iva'] += $resultado['otros'];
	if($resultado['provincia'] == 5){
		$resultado['iva'] = round($resultado['total_sin_iva'] * 0.04,2);
	}
	else{
		$resultado['iva'] = round($resultado['total_sin_iva'] * 0.21,2);
	}
	$resultado['total_con_iva'] = round($resultado['total_sin_iva'] + $resultado['iva'],2);
	$resultado['total_sin_iva'] = number_format(round($resultado['total_sin_iva'],2),2,",",".");
	$resultado['total_sin_iva1'] = number_format(round($resultado['total_sin_iva1'],2),2,",",".");
	$resultado['iva'] = number_format(round($resultado['iva'],2),2,",",".");
	//$resultado['total_con_iva'] = number_format(round($resultado['total_con_iva'],2),2,",",".");
	$resultado['rango_consumo'] = round($row['rango1'],0).' '.round($row['rango2'],0);
	$resultado['punta'] = number_format( round($row['p_e_punta_s_peaje'],6),6,",",".");
	$resultado['llano'] = number_format( round($row['p_e_llano_s_peaje'],6),6,",",".");
	$resultado['valle'] =  number_format(round($row['p_e_valle_s_peaje'],6),6,",",".");
	$resultado['cepunta'] = number_format(round($resultado['coste_energia_punta'],2),2,",",".");
	$resultado['cellano'] =  number_format(round($resultado['coste_energia_llano'],2),2,",",".");
	$resultado['cevalle'] =  number_format(round($resultado['coste_energia_valle'],2),2,",",".");
	$resultado['cedto'] =  number_format(round($resultado['descuento'],2),2,",",".");
	$resultado['ppunta'] = $resultado['p_e_punta_c_peaje'] = number_format($resultado['p_e_punta_c_peaje'],6,",",".");
	$resultado['pllano'] = $resultado['p_e_llano_c_peaje'] = number_format($resultado['p_e_llano_c_peaje'],6,",",".");
	if(isset($resultado['p_e_valle_c_peaje'])){
		$resultado['pvalle'] = $resultado['p_e_valle_c_peaje'] = number_format($resultado['p_e_valle_c_peaje'],6,",",".");
	}
	$resultado['iee'] = number_format(round($resultado['iee'],2),2,",",".");
	$resultado['dto'] = round($row['descuento'],0);
	$resultado['total'] = number_format(round($resultado['total_sin_iva'],2),2,",",".");
	
	$resultado['cppunta'] = number_format($row['p_p_punta'],6,",",".");
	$resultado['cpllano'] = number_format($row['p_p_llano'],6,",",".");
	$resultado['cpvalle'] = number_format($row['p_p_valle'],6,",",".");
	$resultado['cptotalpunta'] = number_format(round($resultado['coste_potencia_punta'],2),2,",",".");
	$resultado['cptotalllano'] = number_format(round($resultado['coste_potencia_llano'],2),2,",",".");
	$resultado['cptotalvalle'] = number_format(round($resultado['coste_potencia_valle'],2),2,",",".");
	$resultado['scsubtotal'] = number_format(round($resultado['total_potencia_energia'],2),2,",",".");
	/** este dato no contiene relacion, siendo 1 entonces:'Url Sitio' sino 'Archivo'  **/
	if($row['idtipoenlace']==1){
		
		$resultado['tipoenlace'] = 'Url Sitio';  
		$resultado['linkcontrato'] = 'http://'.$row['linkcontrato'];
	}
	elseif($row['idtipoenlace']==2){
		
	   $resultado['tipoenlace'] = 'Archivo';  
	   $resultado['linkcontrato'] = URL::to('/')."documentos/contratos/".$row['linkcontrato'];
	}
	elseif($row['idtipoenlace']==3){
		
	   $resultado['tipoenlace'] = 'Contrataci&oacute;n Online';  
	   $resultado['linkcontrato'] = URL::to('/')."contratacion/".$row['codigo_unico'];
	}
	$resultado['nombre_comerc'] = $row['nombre_comercial'];
	$resultado['tipooferta'] = $row['tipo_oferta'];
	$resultado['valido'] = (($row['valido']==1)?"Nuevo aviso":implode('/', array_reverse(explode('-', $row['valido_fecha']))));
	$resultado['comentarios'] = $row['comentarios'];
	$resultado['link'] = (isset($row['link']))?$row['link']:'';
	$resultado['rango1'] = round($row['rango1'],0);
	$resultado['botoncontrato'] = $row['botoncontrato'];
	$resultado['imagen1'] = $row['imagen1'];
	$resultado['dato'] = $row['dato'];
	if(isset($row['diferencia'])){
		$resultado['diferencia'] = $row['diferencia'];
	}
	if($resultado['energia_reactiva'] != ""){
		$resultado['energia_reactiva'] = number_format(round($row['energia_reactiva'],2),2,",",".");
	}
	if($resultado['ajustes'] != ""){
		$resultado['ajustes'] = number_format(round($row['ajustes'],2),2,",",".");
	}
	if($resultado['alquiler_equipo'] != ""){
		$resultado['alquiler_equipo'] = number_format(round($row['alquiler_equipo'],2),2,",",".");
	}
	if($resultado['exceso_potencia'] != ""){
		$resultado['exceso_potencia'] = number_format(round($row['exceso_potencia'],2),2,",",".");
	}
	if($resultado['otros'] != ""){
		$resultado['otros'] = number_format(round($row['otros'],2),2,",",".");
	}
	/*$sqlTer1="SELECT nombre
			 FROM territorio
			 WHERE id='".$territorio[0]."'";
	$resultTer = mysql_query($sqlTer1,$conn);
	$nombre_territorio = array();
	while($rowTer1 = mysql_fetch_array($resultTer)){
		$nombre_territorio[]=$rowTer1['nombre'];
	}
	$resultado['nombre_territorio'] = implode(",",$nombre_territorio);*/
	return $resultado;
}
function encriptar($cadena){
    $key='crm-dario';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted; //Devuelve el string encriptado
 
}
 
function desencriptar($cadena){
     $key='crm-dario';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
     $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;  //Devuelve el string desencriptado
}
 
function botones(){
     $key='crm-dario';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
     $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;  //Devuelve el string desencriptado
}