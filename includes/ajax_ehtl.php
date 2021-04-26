<?php    

	$id_hotel = $_POST['id'];

	if ($_POST['chd'] > 0) { 
		for ($i=0; $i < $_POST['chd']; $i++) { 
			$idades = '12,';
		}
		$idades_chd = substr($idades, 0, -1);
		$pax = array(array('adt' => $_POST['adt'], 'idadeschd' => array($idades_chd)));
	}else{
		$pax = array(array('adt' => $_POST['adt']));
							
	}
	if ($_POST['chd'] == 0) {
       $crianca = ''; 
       $idades = 0;
   }else{
    if ($_POST['chd'] == 1) {
        $crianca = ' e '.$_POST['chd'].' criança';
    }else{
        $crianca = ' e '.$_POST['chd'].' crianças';
        for ($i=0; $i < $_POST['chd']; $i++) { 
        	$idade .= '12,';
        }
        $idades = substr($idade, 0, -1);
    } 
   } 
   $desc_pax = $_POST['adt'].' '.($_POST['adt'] > 1 ? 'adultos' : 'adulto').' '.$crianca; 

   $data_inicio = new DateTime(implode("-", array_reverse(explode("-", $_POST['data_inicio']))));
    $data_fim = new DateTime(implode("-", array_reverse(explode("-", $_POST['data_final']))));

    // Resgata diferença entre as datas
    $diferenca_data = $data_inicio->diff($data_fim);
    $qtd_diarias = $diferenca_data->days; 
    if ($diferenca_data->days == 1) {
        $diaria = '1 diária';
    }else{
        $diaria = (intval($diferenca_data->days)+1).' diárias';
    }

	$curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://quasar.e-htl.com.br/oauth/access_token",
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "username=91355&password=agenciaws@1055076466826202019",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache", 
        "x-detailed-error: "
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $itens = json_decode($response, true);
        $token = $itens["access_token"]; 
    }

    function tirarAcentos($string){
return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
} 

	$curl = curl_init(); 
    curl_setopt_array($curl, array( 
        CURLOPT_URL => 'https://quasar.e-htl.com.br/booking/hotels-availabilities', 
        CURLOPT_RETURNTRANSFER => true, 
        CURLOPT_ENCODING => "", 
        CURLOPT_MAXREDIRS => 10, 
        CURLOPT_TIMEOUT => 30, 
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
        CURLOPT_CUSTOMREQUEST => "POST", 
        CURLOPT_POSTFIELDS => '{"data": {"attributes": { "destinationId": "'.$_POST['destination'].'", "checkin": "'.implode("-", array_reverse(explode("-", $_POST['data_inicio']))).'", "nights": '.$qtd_diarias.', "roomsAmount": '.$_POST['qts'].', "rooms": [{"adults": '.$_POST['adt'].', "children": '.$_POST['chd'].', "childrenages": ['.$idades.']}], "signsInvoice": 0, "onlyAvailable": true}}}', 
        CURLOPT_HTTPHEADER => array( 
            "authorization: Bearer ".$token, 
            "cache-control: no-cache", 
            "content-type: application/json" 
        ), 
    ));

    $response = curl_exec($curl); 
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) { 
        echo "cURL Error #:" .
        $err; 
    } else { 
        $itens = json_decode($response, true);
        $hoteis = $itens['data'];   

    } 

$contador = 0;
for ($i=0; $i < count($hoteis); $i++) { 
	$id = $hoteis[$i]["id"];
	if ($id == $id_hotel) {
		$contador = 1;
				//nome, foto, descrição, preço 
				$foto = $hoteis[$i]["attributes"]["hotelImages"][0]; 
				$descricao = $hoteis[$i]["attributes"]["hotelDescription"]; 

				for ($x=0; $x < 9; $x++) {   

					$nome = $hoteis[$i]["attributes"]["hotelRooms"][$x]["roomsDetail"][0]["roomName"]; 
					$preco = $hoteis[$i]["attributes"]["hotelRooms"][$x]["roomsDetail"][0]["dailyPrices"][0]["price"]; 

					$dados_hoteis[] = array("id" => $id, "nome" => ucfirst(tirarAcentos(strtolower($nome))), "foto" => str_replace("/", "%u;", $foto),  "descricao" => tirarAcentos($descricao), "preco" => $preco, "fornecedor" => "Ehtl", "acomodacao" => ucfirst(tirarAcentos(strtolower($hoteis[$i]["attributes"]["hotelRooms"][$x]["roomsDetail"][0]["roomName"]))), "tipo" => ucfirst(tirarAcentos(strtolower($hoteis[$i]["attributes"]["hotelRooms"][$x]["roomsDetail"][0]["roomName"]))), "pax" => tirarAcentos($desc_pax), "regime" => ucfirst(tirarAcentos(strtolower($hoteis[$i]["attributes"]["hotelRooms"][$x]["roomsDetail"][0]["regime"]))), "checkin" => $_POST['data_inicio'], "checkout" => $_POST['data_final'], "diarias" => ucfirst(tirarAcentos(strtolower($diaria))));

				}
	}
}

if ($contador == 1) {
	echo str_replace("\"", "%s;", json_encode($dados_hoteis));
}else{
	echo "0";
}

?>