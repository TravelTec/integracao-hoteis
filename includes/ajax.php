<?php   
	
	require('Trend.php');
	$trendHotel = new Trend();
	$testar_cancelamento = false;
	$pegar_destinos = false;
	/////////////////////////////////////
	///////// manageToken /////////////
	/////////////////////////////////////
	if($trendHotel->manageToken() === true)
	{
		if($pegar_destinos == true)
		{
			$trendHotel->productSearchFilterDestines();
			echo '<br><b>trend productSearchFilterDestines :</b><br>';
			for ($i=0; $i < count($trendHotel->response->Body->DestinationListResponse->Destination); $i++) { 
				echo $trendHotel->response->Body->DestinationListResponse->Destination[$i]->attributes()[0].' - '.$trendHotel->response->Body->DestinationListResponse->Destination[$i]->attributes()[1].'<br>';
			}
		} 
	}  

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
   }else{
    if ($_POST['chd'] == 1) {
        $crianca = ' e '.$_POST['chd'].' criança';
    }else{
        $crianca = ' e '.$_POST['chd'].' crianças';
    } 
   } 
   $desc_pax = $_POST['adt'].' '.($_POST['adt'] > 1 ? 'adultos' : 'adulto').' '.$crianca; 

   $data_inicio = new DateTime(implode("-", array_reverse(explode("-", $_POST['data_inicio']))));
    $data_fim = new DateTime(implode("-", array_reverse(explode("-", $_POST['data_final']))));

    // Resgata diferença entre as datas
    $diferenca_data = $data_inicio->diff($data_fim); 
    if ($diferenca_data->days == 1) {
        $diaria = '1 diária';
    }else{
        $diaria = (intval($diferenca_data->days)+1).' diárias';
    }

	$args = [
		'destination' => $_POST['destination'],		// '5238' = 'SAO'
		'checkin'	  => implode("-", array_reverse(explode("-", $_POST['data_inicio']))),
		'checkout'	  => implode("-", array_reverse(explode("-", $_POST['data_final']))),
		'quartos'	  => $pax
	];

	$trendHotel->productSearch($args);  
	$response = json_decode(json_encode($trendHotel), true);
	$hoteis = $response["response"]["Body"]["ProductSearchRS"]["ProductSearchResult"]["HotelResult"]["ListHotelGroup"]["HotelGroup"]["Hotel"]; 

	if (count($hoteis) >= 1) { 

		function tirarAcentos($string){
	        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
	    }

		for ($i=0; $i < count($hoteis); $i++) { 
			$id = $hoteis[$i]["HotelInfo"]["@attributes"]["Id"];
			if ($id == $id_hotel) { 
				//nome, foto, descrição, preço 
				$foto = $hoteis[$i]["HotelInfo"]["@attributes"]["ThumbImage"]; 
				$descricao = $hoteis[$i]["HotelInfo"]["Description"]; 

				for ($x=0; $x < count($hoteis[$i]["ListRoom"]["Room"]); $x++) {   

					$nome = $hoteis[$i]["ListRoom"]["Room"][$x]["RoomInfo"]["@attributes"]["Description"]; 
					$preco = $hoteis[$i]["ListRoom"]["Room"][$x]["RoomComlInfo"]["@attributes"]["AvrNightPrice"]; 

					$dados_hoteis[] = array("id" => $id, "nome" => tirarAcentos($nome), "foto" => str_replace("/", "-", $foto),  "descricao" => tirarAcentos($descricao), "preco" => $preco, "fornecedor" => "Trend", "acomodacao" => tirarAcentos($hoteis[$i]["ListRoom"]["Room"][$x]["RoomInfo"]["@attributes"]["AccomodationTypeDescription"]), "tipo" => tirarAcentos($hoteis[$i]["ListRoom"]["Room"][$x]["RoomInfo"]["@attributes"]["RoomTypeDescription"]), "pax" => tirarAcentos($desc_pax), "regime" => tirarAcentos($hoteis[$i]["ListRoom"]["Room"][$x]["RoomInfo"]["@attributes"]["BoardBaseDescription"]), "checkin" => $_POST['data_inicio'], "checkout" => $_POST['data_final'], "diarias" => tirarAcentos($diaria));

				}

				
			}
		}  
	 	
		echo str_replace("\"", "%s;", json_encode($dados_hoteis));

	}else{
		echo '0';
	}

?>