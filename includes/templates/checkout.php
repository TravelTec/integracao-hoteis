<?php 
   get_header(); 
   
   $dados = explode(";", $_GET['param']);

   $destino = $dados[0];
   $data_inicio = $dados[1];
   $data_final = $dados[2];
   $adt = $dados[3];
   $chd = $dados[4];
   $qts = $dados[5]; 

   if ($chd == 0) {
       $crianca = '';
       $idades = '';
   }else{
    if ($chd == 1) {
        $crianca = ' e '.$chd.' criança';
    }else{
        $crianca = ' e '.$chd.' crianças';
    }
    $valor_idades = explode("-", $dados[6]);
    $idades .= '<br><strong>Idade das crianças: </strong><br>';
    for ($i=0; $i < $chd; $i++) { 
        $idades .= 'Criança '.($i+1).': '.$valor_idades[$i].' '.($valor_idades[$i] == 1 ? 'ano' : 'anos').'<br>';
    } 
   }
   $pax = $adt.' '.($adt > 1 ? 'adultos' : 'adulto').' '.$crianca;
   $propriedade = $dados[7]; 

   $data_inicio = new DateTime(implode("-", array_reverse(explode("-", $data_inicio))));
    $data_fim = new DateTime(implode("-", array_reverse(explode("-", $data_final))));

    // Resgata diferença entre as datas
    $diferenca_data = $data_inicio->diff($data_fim); 
    if ($diferenca_data->days == 1) {
        $diaria = '1 diária';
    }else{
        $diaria = $diferenca_data->days.' diárias';
    }
?>
<!-- Blog Section with Sidebar -->
<style type="text/css"> 
   .page-builder { display: none } 
   .page-title-section { display: none } 
   .attachment-post-thumbnail{    display: block;
   max-width: 100%;
   height: 250px;}
   .collapse { 
    padding: 0;
    height: 0px
}
   .collapse.in { 
    padding: 20px;
    height: 168px
}
</style>
<div class="page-builder2" style="background-color: #eaeaea">  
   <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   <style type="text/css">
      .input-group{
      position: relative;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      -webkit-box-align: stretch;
      -ms-flex-align: stretch;
      align-items: stretch;
      width: 100%;
      }
      .input-group-prepend {
      margin-right: -1px;
      }
      .input-group-append, .input-group-prepend {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      }
      .input-group-text {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      padding: .375rem .75rem;
      margin-bottom: 0;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      text-align: center;
      white-space: nowrap;
      background-color: #e9ecef;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      }
      .input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control {
      position: relative;
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      width: 1%;
      margin-bottom: 0;
      }
      @media(max-width: 800px){
      .navbar-brand img{
      height: 42px
      }
      .img-div-responsive{
      padding: 0 0px 9px 0px !important;
      }
      .exibirComputador{
      display: none !important;
      }
      .exibirCelular{
      display: block !important;
      }
      .titulo{
      font-size: 1.5rem !important;
      font-weight: 700 !important;
      }
      .subtitulo{
      font-size: 1.0rem !important; 
      }
      .carousel{
      margin: 10px !important
      }
      .filtro{
      padding-right: 15px !important
      }
      .hotel{
      padding: 14px
      }
      .centeri{
      text-align: center;
      }
      .borderC{
      border: 1px solid #ddd;
      margin: 0px 17px 0px 14px;
      height: auto !important;
      }
      }
      .exibirComputador{
      visibility: initial;
      }
      .exibirCelular{
      display: none;
      }
      .titulo{
      font-size: 2.8rem;font-weight: 400;
      }
      .subtitulo{
      font-size: 1.4rem;font-weight: 400
      }
      .font{
      font-family: 'Raleway', sans-serif !important;
      }
      .nofont{
      font-family: 'Arial', sans-serif !important;
      } 
      .carousel{
      margin-left: 10px;margin-right: -12px;margin-top: 10px;
      }
      .btn-primary{
      background-color: #2f4050 !important;
      border-color: #2f4050 !important;
      }
      .btn-primary:hover{
      background-color: #fff !important;
      border-color: #2f4050 !important;
      color: #2f4050 !important;
      }
      .filtro{
      padding-right: 0
      } 
      .infoBox { 
      background-color: #FFF; 
      width: 300px; 
      font-size: 14px; 
      border: 1px solid #3fa7d8; 
      border-radius: 3px; 
      margin-top: 10px 
      }
      .infoBox p { 
      padding: 6px 
      }
      .infoBox:before { 
      border-left: 10px solid transparent; 
      border-right: 10px solid transparent; 
      border-bottom: 10px solid #3fa7d8; 
      top: -10px; 
      content: ""; 
      height: 0; 
      position: absolute; 
      width: 0; 
      left: 138px 
      }
      html {
      position: relative;
      min-height: 100%;
      }
      body {
      /* Margin bottom by footer height */
      margin-bottom: 60px;
      }
      .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      height: 50px;
      line-height: 46px; /* Vertically center the text there */
      background-color: #585858;
      border-top: 4px solid;border-color: #999;
      }
      .text-muted{
      color: #999999 !important;font-size:16px;
      }
      .esconde{
      display: none;
      }
      .exibe{
      display: block;
      }
      @media(max-width: 959px){
      .imgHotel{
      width: 93%;
      }      
      }
      @media(min-width: 960px) and (max-width: 961px){
      .imgHotel{
      width: 97%;
      }      
      }
      @media(min-width: 411px) and (max-width: 559px){
      .footer {
      text-align: center !important;
      line-height: 20px;
      }
      .text-muted{
      text-align: center !important;
      }
      .exibeCelular{
      bottom: auto !important;
      }
      }
      @media(max-width: 400px){
      .footer {
      text-align: center !important;
      line-height: 20px;
      }
      .text-muted{
      text-align: center !important;
      }
      .exibeCelular{
      bottom: auto !important;
      }
      }
      @media(min-width: 600px){
      .text-muted{
      float: right;
      }
      .exibirComputador{
      display: block !important;
      }
      }
      .navbar-light .navbar-nav .nav-link {
      color: rgba(0,0,0,.5) !important;
      }
      #google_translate_element {
      display: none;
      }
      .goog-te-banner-frame {
      display: none !important;
      }
      .exibirComputador{
      display: none;
      }
      .tooltip.show {
      opacity: .9;
      z-index: 0;
      margin-left: 5px;
      }
      .qty .count, .qty .count_child, .qty .count_quartos {
      color: #000;
      display: inline-block;
      vertical-align: top;
      font-size: 22px;
      font-weight: 700;
      line-height: 30px;
      padding: 0 2px
      ;min-width: 35px;
      text-align: center;
      margin-top: -11px;
      }
      .qty .plus, .qty .plus_child, .qty .plus_quartos {
      cursor: pointer;
      display: inline-block;
      vertical-align: top;
      color: white;
      width: 26px;
      height: 26px;
      font: 25px/1 Arial,sans-serif;
      text-align: center;
      border-radius: 50%;
      }
      .qty .minus, .qty .minus_child, .qty .minus_quartos {
      cursor: pointer;
      display: inline-block;
      vertical-align: top;
      color: white;
      width: 26px;
      height: 26px;
      font: 25px/1 Arial,sans-serif;
      text-align: center;
      border-radius: 50%;
      background-clip: padding-box;
      }
      .minus, .minus_child, .minus_quartos{
      background-color: #aaa !important;
      }
      .plus, .plus_child, .plus_quartos{
      background-color: #aaa !important;
      } 
      .minus:hover, .minus_child:hover, .minus_quartos:hover{
      background-color: #e8b90d !important;
      }
      .plus:hover, .plus_child:hover, .plus_quartos:hover{
      background-color: #e8b90d !important;
      } 
      /*Prevent text selection*/
      span{
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      }
      .input_number{  
      border: 0;
      width: 2%;
      }
      nput::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
      }
      input:disabled{
      background-color:white;
      }
      .xpi__content__wrappergray {
      background: #f5f5f5;
      }
      .xpi__content__wrapper {
      background: #002f72;
      margin-bottom: 24px;
      border-bottom: 1px solid #e6e6e6;
      }
      .xpi__searchbox {
      padding: 44px 5px;
      position: relative;
      }
      .xpi__searchbox {
      max-width: 1110px;
      padding: 40px 5px 16px;
      margin: 0 auto;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      }
      .xpi__content__wrappergray .xpi__searchbox .sb-searchbox__title, .xpi__content__wrappergray .xpi__searchbox .sb-searchbox__subtitle-text {
      color: #333;
      }
      .xpi__searchbox .sb-searchbox__title {
      font-size: 24px;
      line-height: 32px;
      font-weight: 600;
      font-weight: 600;
      }
      .sb-searchbox__title {
      margin: 0;
      padding: 0;
      font-size: 26px;
      font-weight: normal;
      }
      .xpi__content__wrappergray .xpi__searchbox .sb-searchbox__title, .xpi__content__wrappergray .xpi__searchbox .sb-searchbox__subtitle-text {
      color: #333;
      }
      .xpi__searchbox .sb-searchbox__title {
      font-size: 24px;
      line-height: 32px;
      font-weight: 600;
      font-weight: 600;
      }
      .xpi__searchbox .sb-searchbox__subtitle-text {
      font-size: 14px;
      line-height: 20px;
      font-weight: 400;
      }
      .sb-searchbox--painted {
      font-size: 14px;
      line-height: 20px;
      font-weight: 400;
      background: 0;
      border-radius: 0;
      border: 0;
      padding: 0;
      }
      .xp__fieldset {
      color: #333;
      border: 0;
      display: table;
      background-color: #febb02;
      padding: 4px;
      border-radius: 4px;
      margin: 24px 0 16px;
      position: relative;
      width: 100%;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      }
      @media(max-width: 320px){
      .marginGallery{
      margin: 0px 9px 0px -4px !important;
      } 
      .imgWidth{
      width: 160% !important;
      }
      .tituloHotel{
      font-size: 1.5rem !important;
      margin-top: 16px!important;
      }
      .paddingRow{
      padding: 0 15px 0 15px !important;
      }
      .fontSizeP{
      font-size: 14px !important; 
      }
      .fontSizePreco{
      font-size: .805rem !important; 
      }
      .paddingCelular{
      padding-left: 4px !important;;
      }
      .colNomeCelular {
      margin: 0 -7px 0 -14px !important;
      }
      .col1Celular{
      margin: 0 -9px 0 -14px !important;
      }
      .col2Celular{
      margin: 0 9px 0 4px !important;
      }
      .borderCelular{
      border-right: none !important;
      }
      }
      @media (min-width: 350px) and (max-width: 414px){ 
      .imgWidth{
      width: 130% !important;
      }
      .marginGallery {
      margin: 0px 8px 0px -4px !important;
      }
      .tituloHotel{
      font-size: 1.5rem !important;
      margin-top: 16px!important;
      }
      .paddingRow{
      padding: 0 15px 0 15px !important;
      }
      .fontSizeP{
      font-size: .805rem !important; 
      }
      .fontSizePreco{
      font-size: .805rem !important; 
      }
      .paddingCelular{
      padding-left: 8px !important;
      }
      .colNomeCelular{
      margin: 0 -4px 0 -5px !important;
      }
      }
      @media(min-width: 1650px){
      .imgHotel{
      width: 100% !important;
      height: 252px !important;
      }
      .imgWidth{
      width: 130% !important;
      }
      }
      .marginGallery{
      margin: 0px -3px 0px -4px;
      }
      .imgWidth{
      width: 160%;
      }
      .tituloHotel{
      font-size: 2rem;
      margin-top: 4px;
      }
      .paddingRow{
      padding: 0;
      }
      .fontSizeP{
      font-size: 14px; 
      }
      .fontSizePreco{
      font-size: 14px;
      }
      .borderCelular{
      border-right: 1px solid #ddd;
      }
      .centerizar{
      display: -webkit-flex !important;
      display: flex !important;
      -webkit-align-items: center !important;
      align-items: center !important;
      }
      .row {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      margin-right: -15px;
      margin-left: -15px;
      }
      .justify-content-center {
      -ms-flex-pack: center!important;
      justify-content: center!important;
      }
   </style>
   <div class="container">
      <br><br> 
    <div class="row justify-content-center font hotel" >
        <div class="col-lg-9 col-xs-12">
        	<h4><strong>Falta pouco! Complete seus dados e finalize sua compra.</strong></h4>
        	<div style="background-color: #fff;padding: 20px">	
        		<h4><strong>Complete com os dados do cartão</strong></h4>
        		<div class="row">
        			<div class="col-lg-6 col-xs-12">
        				<label style="font-size: 13px;color: #0b0b0b"><strong>NÚMERO</strong></label>
        				<input type="text" class="form-control numero_cartao" placeholder="Número do cartão" name="" maxlength="20">
        			</div>
        			<div class="col-lg-6 col-xs-12">
        				<label style="font-size: 13px;color: #0b0b0b"><strong>TITULAR</strong></label>
        				<input type="text" class="form-control titular" placeholder="Como aparece no cartão" name="">
        			</div>
        		</div>
        		<br>
        		<div class="row">
        			<div class="col-lg-3 col-xs-6">
        				<label style="font-size: 13px;color: #0b0b0b"><strong>VENCIMENTO</strong></label>
        				<input type="text" class="form-control vencimento_cartao" placeholder="MM/AA" name="" maxlength="5">
        			</div>
        			<div class="col-lg-3 col-xs-6">
        				<label style="font-size: 13px;color: #0b0b0b"><strong>CÓD. SEGURANÇA</strong></label>
        				<input type="password" class="form-control cod_cartao" placeholder="" name="" maxlength="4">
        			</div>
        			<div class="col-lg-6 col-xs-12">
        				<label style="font-size: 13px;color: #0b0b0b"><strong>CPF</strong></label>
        				<input type="text" class="form-control cpf_cartao" placeholder="Ex. 123.456.789-00" name="" maxlength="14">
        			</div>
        		</div>
        		<br>
        		<hr>
        		<div class="row">
        			<div class="col-lg-12 col-xs-12">
		        		<div class="accordion" id="accordionExample" style="    background-color: #ddd;">
						  <div class="card">
						    <div class="card-header" id="headingOne">
						      <h2 class="" style="margin-bottom: 0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: #7f7f7f">
						          <strong>Selecione em quantas parcelas você quer pagar</strong>
						        </button>
						      </h2>
						    </div>

						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
						      <div class="card-body">
						        <input type="radio" name="check_parcelas" value="0" style="margin-right: 6px"> <strong style="color: #7f7f7f">A vista</strong>
						        <hr style="margin-top: 4px;margin-bottom: 4px">
						        <input type="radio" name="check_parcelas" value="1" style="margin-right: 6px"> <strong style="color: #7f7f7f">1x de 0.00</strong>
						        <hr style="margin-top: 4px;margin-bottom: 4px">
						        <input type="radio" name="check_parcelas" value="2" style="margin-right: 6px"> <strong style="color: #7f7f7f">2x de 0.00</strong>
						        <hr style="margin-top: 4px;margin-bottom: 4px">
						        <input type="radio" name="check_parcelas" value="3" style="margin-right: 6px"> <strong style="color: #7f7f7f">3x de 0.00</strong>
						      </div>
						    </div>
						  </div> 
						</div>
					</div>
				</div>
        	</div>

        	<br>

        	<div style="background-color: #fff;padding: 20px">	
        		<h4><strong>Quem será o titular da reserva?</strong></h4>
        		<div class="row">
        			<div class="col-lg-7 col-xs-12">
        				<h5 style="margin-bottom: 0">Adulto 1</h5>
        				<small>Será o responsável por fazer check-in e check-out na hospedagem.</small>
        				<br>
        				<label style="font-size: 13px;color: #0b0b0b"><strong>NOME</strong></label>
        				<input type="text" class="form-control" placeholder="Insira o nome do passageiro" name="" maxlength="30" style="margin-bottom: 8px">
        				<label style="font-size: 13px;color: #0b0b0b"><strong>ÚLTIMO SOBRENOME</strong></label>
        				<input type="text" class="form-control" placeholder="Insira o último sobrenome do passageiro" name="" maxlength="30">
        			</div> 
        		</div> 
        	</div> 

        	<div class="row" style="padding: 19px;">
        		<div class="col-lg-12 col-xs-12" style="color: #3a3a3a;">
        			<input type="checkbox" name="" style="margin-right: 8px"> Li e aceito a política de privacidade.
        		</div>
        	</div>

        </div>
        <div class="col-lg-3 col-xs-12">
        	<div style="color: #3a3a3a;background-color: #fff;padding: 16px">

        		<strong style="color: #3a3a3a">Dados da sua reserva</strong>
        		
        		<div class="row" style="margin-top: 9px;margin-bottom: 9px">
        			<div class="col-lg-6 col-xs-12" style="border-right: 1px solid #aaa;color: #3a3a3a;font-size: 14px;line-height: 1.5;">
        				<small>Entrada</small><br>
        				<strong>ter, 28 de abr de 2021</strong><br>
        				14:00 - 22:00
        			</div>
        			<div class="col-lg-6 col-xs-12" style="color: #3a3a3a;font-size: 14px;line-height: 1.5;">
        				<small>Saída</small><br>
        				<strong>sex, 23 de abr de 2021</strong><br>
        				08:00 - 12:00
        			</div>
        		</div>

        		<small>Duração total da hospedagem</small><br>
        		<small><strong>3 diárias</strong></small>

        		<hr style="margin-top: 15px;margin-bottom: 15px">

        		<small><strong>Você selecionou:</strong></small><br>
        		<small>Quarto duplo standard</small>

        		<hr style="margin-top: 15px;margin-bottom: 15px">

        		<small><strong>Resumo do preço</strong></small><br>
        		
        		<div class="row" style="margin-top: 9px;margin-bottom: 9px">
        			<div class="col-lg-8 col-xs-8" style="color: #3a3a3a;font-size: 14px;line-height: 1.5;">
        				<small>Quarto duplo standard</small><br>
        				<small>5% ISS</small><br>
        			</div>
        			<div class="col-lg-4 col-xs-4" style="color: #3a3a3a;font-size: 14px;line-height: 1.5;text-align: right;">
        				<small style="font-size: 14px">250,00</small><br>
        				<small style="font-size: 14px">12,50</small><br>
        			</div>
        		</div>
        		
        		<div class="row" style="margin-top: 9px;margin-bottom: 9px;background-color: #d7ebff;padding-top: 10px;padding-bottom: 10px;">
        			<div class="col-lg-8 col-xs-8" style="color: #3a3a3a;font-size: 14px;line-height: 1.5;">
        				<small><strong>Preço</strong></small><br>
        				<small>(2 hóspedes e 3 diárias)</small><br>
        			</div>
        			<div class="col-lg-4 col-xs-4" style="color: #3a3a3a;font-size: 14px;line-height: 1.5;text-align: right;">
        				<small style="font-size: 14px"><strong>262,50</strong></small><br> 
        			</div>
        		</div>

        	</div>
        </div>
    </div> 

<br>
   </div>
   <br><br>
</div>
<input type="hidden" id="uri" name="" value="<?=$_SERVER['REQUEST_URI']?>">
<script src="<?=plugins_url( '../assets/js/mask.js', __FILE__ )?>"></script>
<script type="text/javascript">
   function show_div_count(){
   jQuery(".dropdown").toggle(500);
   }


      jQuery(".numero_cartao").mask("0000 0000 0000 0000");
      jQuery(".vencimento_cartao").mask("00/00");
      jQuery(".cod_cartao").mask("000");
      jQuery(".cpf_cartao").mask("000.000.000-00");
   
    jQuery(document).ready(function(){

            jQuery('.count').prop('disabled', true);
                jQuery(document).on('click','.plus',function(){
                var valor = parseInt(jQuery('.count').val()) + 1;
                jQuery('.count').val(valor);
                jQuery("#count_adultos").html("<strong>"+valor+" adultos</strong>");
            });
            jQuery(document).on('click','.minus',function(){
                var valor = parseInt(jQuery('.count').val()) - 1;
                jQuery('.count').val(valor);
            
                jQuery("#count_adultos").html("<strong>"+valor+" adultos</strong>");
                    if (jQuery('.count').val() == 0 || jQuery('.count').val() == 1) {
                        jQuery('.count').val(1);
                jQuery("#count_adultos").html("<strong>1 adulto</strong>");
                    }
                });
   
   
   
            jQuery('.count_child').prop('disabled', true);
                jQuery(document).on('click','.plus_child',function(){
                var valor = parseInt(jQuery('.count_child').val()) + 1;
                jQuery('.count_child').val(valor);
                jQuery("#count_criancas").html("<strong>"+valor+" crianças</strong>");
   if (jQuery('.count_child').val() == 1) {
                        jQuery('.count_child').val(1);
                jQuery("#count_criancas").html("<strong>1 criança</strong>");
                    }
            });
            jQuery(document).on('click','.minus_child',function(){
                var valor = parseInt(jQuery('.count_child').val()) - 1;
                jQuery('.count_child').val(valor);
            
                jQuery("#count_criancas").html("<strong>"+valor+" crianças</strong>");
                    if (jQuery('.count_child').val() == 0) {
                        jQuery('.count_child').val(1);
                jQuery("#count_criancas").html("<strong>0 criança</strong>");
                    }
   if (jQuery('.count_child').val() == 1) {
                        jQuery('.count_child').val(1);
                jQuery("#count_criancas").html("<strong>1 criança</strong>");
                    }
                });
   
            jQuery('.count_quartos').prop('disabled', true);
                jQuery(document).on('click','.plus_quartos',function(){
                var valor = parseInt(jQuery('.count_quartos').val()) + 1;
                jQuery('.count_quartos').val(valor);
                jQuery("#count_quartos").html("<strong>"+valor+" quartos</strong>");
            });
            jQuery(document).on('click','.minus_quartos',function(){
                var valor = parseInt(jQuery('.count_quartos').val()) - 1;
                jQuery('.count_quartos').val(valor);
            
                jQuery("#count_quartos").html("<strong>"+valor+" quartos</strong>");
                    if (jQuery('.count_quartos').val() == 0 || jQuery('.count_quartos').val() == 1) {
                        jQuery('.count_quartos').val(1);
                jQuery("#count_quartos").html("<strong>1 quarto</strong>");
                    }
                });
   
            });

    function AtribuiValorHotel(id){
        var dados = jQuery("#nameHotel"+id).val();
        var uri = jQuery("#uri").val();
        dados = dados.split(";");

        jQuery("#uri").val('/apto/?param=Comfort-Vista-Mar;343;hotel-copacabana-palace');
    }

    function enviarFormTodos(){
        var uri = jQuery("#uri").val();
        window.location.href = uri;
    }
            
</script>
<!-- /Blog Section with Sidebar -->
<?php get_footer(); ?>