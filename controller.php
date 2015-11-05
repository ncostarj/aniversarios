<?php
$inputs = $_POST;

// Array ( [data_inicio] => 14/07/2015 [data_fim] => 17/09/2015 [data_nascimento] => [site] => 1 [tipoData] => 1 )

function getConnectionString($site)
{	

	$str_con = array();

	switch($site)
	{										
		case 1: $str_con['host'] = 'mysql.shopalltrends.com.br';$str_con['banco'] = 'shopalltrends_com_br_1';$str_con['usuario'] = 'shopalltren1';$str_con['senha'] = '!soft123'; break;
		case 2: $str_con['host'] = 'bm102.webservidor.net';$str_con['banco'] = 't1063400_b2c-opencart';$str_con['usuario'] = 't1063400_admin';$str_con['senha'] = 'namaste6066';break;
		case 3: $str_con['host'] = '200.187.69.180';$str_con['banco'] = 'shop_lennyniemeyer_com';$str_con['usuario'] = 'shoplenny';$str_con['senha'] = 'KAbpBKnxCilI4fg'; break;
		case 4: $str_con['host'] = 'mysql.nidas.com.br';$str_con['banco'] = 'nidas_com_br';$str_con['usuario'] = 'nidas';$str_con['senha'] = 'BOgHx7fx0z'; break;
		case 5: $str_con['host'] = '200.187.64.242';$str_con['banco'] = 'queridopetshop_com_br';$str_con['usuario'] = 'queridopetsh';$str_con['senha'] = 'Y#8fTLss5i'; break;
	}

	return $str_con;
}

function listarClientes($inputs = array())
{	

	extract($inputs);

	if(isset($data_inicio) && isset($data_fim)) {

		$data_inicio = explode('/', $inputs['data_inicio']);
		$data_fim    = explode('/', $inputs['data_fim']);

		if(isset($inputs['tipoData'])){

			if($inputs['tipoData'] == 1) {
				$data_inicio = $data_inicio[2] . '-' . $data_inicio[1] . '-' . $data_inicio[0];
				$data_fim    = $data_fim[2]    . '-' . $data_fim[1]    . '-' . $data_fim[0];
			} else {
				$data_inicio = $data_inicio[1] . '-' . $data_inicio[0];
				$data_fim    = $data_fim[1]    . '-' . $data_fim[0];
			}
		}

	}

	$sql  = "select customer_id, firstname, lastname, email, data_nascimento, date_format(date_added, '%Y-%m-%d')";
	$sql .= " from oc_customer";
	$sql .= " where";

	if(isset($inputs['tipoData']) && $inputs['tipoData'] == 1) {
		$sql .= " date_format(date_added, '%Y-%m-%d')";		
		$ord = ' date_added';
	}
	else
	{
		$sql .= " date_format(data_nascimento, '%m-%d')";		
		$ord = ' data_nascimento';
	}

	$sql .= " between '$data_inicio' and '$data_fim'";
	$sql .= "order by $ord";	

	//$con = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
	$str_con = getConnectionString($inputs['site']);

	$con = new PDO("mysql:host=" . $str_con['host'] . ";dbname=" . $str_con['banco'] . ";charset=utf8", $str_con['usuario'], $str_con['senha']);

	$con->exec("SET CHARACTER SET utf8");

	$rs = $con->query($sql);

	$clientes = $rs->fetchAll();	

	return json_encode($clientes);
}

echo listarClientes($inputs);

//header('Location: index.php');