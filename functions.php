<?php  



/*



Plugin Name: Voucher Tec - Integração de hotéis

Plugin URI: https://github.com/TravelTec/bookinghotels

GitHub Plugin URI: https://github.com/TravelTec/bookinghotels 

Description: Voucher Tec - Integração de hotéis é um plugin desenvolvido para agências e operadoras de turismo que precisam tratar diárias de hospedagem de fornecedores.

Version: 1.0.1

Author: Travel Tec

Author URI: https://traveltec.com.br

License: GPLv2



*/







/*



 * Plugin Update Checker



 * 



 * Note: If you're using the Composer autoloader, you don't need to explicitly require the library.



 * @link https://github.com/YahnisElsts/plugin-update-checker



 */



require_once 'plugin-update-checker-4.10/plugin-update-checker.php'; 

 
require_once plugin_dir_path(__FILE__) . 'includes/reserva-integracao-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/config-integracao-functions.php';








/*



 * Plugin Update Checker Setting



 *



 * @see https://github.com/YahnisElsts/plugin-update-checker for more details.



 */

class TTBookingIntegracao {

    function __construct() {
    $this->options = get_option( 'config_ttbookingintegracao' );
    $this->plugin_file = __FILE__;
    $this->plugin_basename = plugin_basename( $this->plugin_file ); 


    add_action( 'admin_init', array( &$this, 'integracao_update_checker_setting') );    
    add_shortcode('TTBOOKING_MOTOR_RESERVA', array( &$this, 'funcaoParaShortcodeIntegracao') );    
  }

/**
       * Get specific option from the options table
       *
       * @param string $option Name of option to be used as array key for retrieving the specific value
       * @return mixed
       * @since 0.1
       */
      function get_option( $option, $options = null ) {
        if ( is_null( $options ) )
          $options = &$this->options;
        if ( isset( $options[$option] ) )
          return $options[$option];
        else
          return false;
      }

    function integracao_update_checker_setting() {



        if ( ! is_admin() || ! class_exists( 'Puc_v4_Factory' ) ) { 

            return; 

        } 



        $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker( 

            'https://github.com/TravelTec/integracao-hoteis', 

            __FILE__, 

            'integracao-hoteis' 

        ); 



        // (Opcional) Set the branch that contains the stable release. 

        $myUpdateChecker->setBranch('main');



    }  



    function funcaoParaShortcodeIntegracao($atts){ 
        $propriedade = $atts['propriedade'];

        $tipo_propriedade = [];
   
           $cat_terms = get_terms(
                   array('tipo_propriedades_integracao'),
                   array(
                           'hide_empty'    => false,
                           'orderby'       => 'name',
                           'order'         => 'ASC',
                           'number'        => 50 //specify yours
                       )
               );
   
   if( $cat_terms ){
   
       foreach( $cat_terms as $term ) { 
   
           $propriedades[] = array("tipo_propriedade" => $term->slug);
   
   }
   }   

   for ($i=0; $i < count($propriedades); $i++) { 
       if ($propriedade == $propriedades[$i]["tipo_propriedade"]) {
           $texto_motor = $this->get_option( 'texto_motor'.$i );
           $chechbox_motor = $this->get_option( 'chechbox_motor'.$i );
           $tipo_motor = $propriedades[$i]["tipo_propriedade"];
       }
   }

        $localizacao = [];
   
           $cat_terms = get_terms(
                   array('localizacao_integracao'),
                   array(
                           'hide_empty'    => false,
                           'orderby'       => 'name',
                           'order'         => 'ASC',
                           'number'        => 50 //specify yours
                       )
               );
   
   if( $cat_terms ){
   
       foreach( $cat_terms as $term ) { 
   
           $locais[] = array("name_local" => $term->name, "name_hotel" => "", "id" => "", "destination" => "");
   
   }
   }   

   $dados = get_option( 'config_ttbookingintegracao' ); 
                for ($i=0; $i < 21; $i++) { 
                  if(!empty($dados['hotel_trend_nh'.$i])){
                    $hotelaria[] = array("name_local" => "", "name_hotel" => $dados['hotel_trend_nh'.$i], "id" => $dados['id_hotel_trend_nh'.$i], "destination" => $dados['destination_hotel_trend_nh'.$i]);
                  }
                }   

                if (empty($locais)) {
                  $total = $hotelaria;
                }else if (empty($hotelaria)) {
                  $total = $locais;
                }else{
                  $total = array_merge($locais, $hotelaria); 
                }

    
        echo "<input type='hidden' id='destinos_motor' value='".json_encode($total)."'>";
        echo "<input type='hidden' id='propriedade' value='".$propriedade."'>";
        echo "<input type='hidden' id='tipo_motor' value='".$tipo_motor."'>";
        echo "<input type='hidden' id='chechbox_motor' value='".$chechbox_motor."'>";
        echo "<input type='hidden' id='hotelaria_motor' value='".$hotelaria_motor."'>";

        $options = $this->options;

        $retorno = '';

        $retorno .= '<div class="row font hotel" style="background-color: '.(empty($options['cor_fundo_texto']) ? "#fff" : $options['cor_fundo_texto']).';min-height: 100px;padding-top: 20px;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <h4 style="margin-bottom: 17px !important;margin-left: -15px !important;font-size: 23px;color: '.(empty($options['cor_texto']) ? "#000" : $options['cor_texto']).' !important">'.$texto_motor.'</h4>
<div class="row grid" style="
    
">';
if($chechbox_motor == "on"){ }else{
     $retorno .= '<div class="col-lg-4 col-xs-12" style="padding: 0;border: 3px solid '.(empty($options['cor_bordas']) ? "#ddd" : $options['cor_bordas']).';">
        <div class="input-group" style="height:45px;border-radius: 0;">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="
            background-color: #fff;
            border-color: transparent;
        "><i class="fa fa-bed" style="font-size:15px"></i></span>
          </div>
          <input type="hidden" name="destino_pesquisa" id="destino_pesquisa" value="">
          <input type="hidden" name="id_hotel" id="id_hotel" value="">
          <input type="hidden" name="id_destination_hotel" id="id_destination_hotel" value="">
          <input type="hidden" name="destino_hotel" id="destino_hotel" value="">
          <input type="text" class="form-control" id="destino" placeholder="Para onde você vai?" style="
            border-radius: 0;
            border: none;
            font-size: 13px;
            font-weight: 700;
            height: 45px
        " onkeypress="exibe_destino()" onclick="limpar_campo()" onfocus="remove_drop_pax()" autocomplete="off">
        <div id="valida_campo_destino" style="display:none;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;">
        <p style="
            margin: 0 !important;
            font-size: 10px;
            color: #fff;
        ">É necessário informar um destino para efetuar a pesquisa.</p>
        </div>
        <div id="dados" style="display:none;
            position: absolute;
            width: 100%;
            top: 48px;
            background-color: #fff;">
        <ul style="
            padding: 0px 10px;
        ">
        </ul>
        </div>
        </div> 
    </div>';
}
     $retorno .= '<div class="'.($chechbox_motor == "on" ? "col-lg-3" : "col-lg-2").' col-xs-12" style="box-shadow: 0px 0px 7px #888585;padding: 0;border: 3px solid '.(empty($options['cor_bordas']) ? "#ddd" : $options['cor_bordas']).';">
<div class="input-group" style="height:45px;border-radius: 0;">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1" style="
    background-color: #fff;
    border-color: transparent;
"><i class="fa fa-calendar" style="font-size:15px"></i></span>
  </div>
  <input type="hidden" name="validar_data" id="validar_data" value="">
  <input type="text" id="sandbox-container" class="form-control" placeholder="Check-in - Check-out" style="border-radius: 0;border: none;font-size: 13px;font-weight: 700;height: 45px" onfocus="remove_drop_pax()" autocomplete="off">
<div id="valida_campo_data" style="display:none;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;">
<p style="
    margin: 0 !important;
    font-size: 10px;
    color: #fff;
">Necessário informar a data.</p>
</div>
</div>    
    </div>
    <div class="col-lg-4 col-xs-12" style="box-shadow: 0px 0px 7px #888585;padding: 0;border: 3px solid '.(empty($options['cor_bordas']) ? "#ddd" : $options['cor_bordas']).';">
<div class="input-group" style="height:45px;border-radius: 0;background-color:#fff" onfocusout="remove_drop_pax()" >
  <div class="input-group-prepend" style="" onclick="show_div_count()" onfocusout="remove_drop_pax()" >
    <span class="input-group-text" id="basic-addon1" style="
    background-color: #fff;
    border-color: transparent;
    height: 45px;
" onfocusout="remove_drop_pax()" ><i class="fa fa-user" style="font-size:15px"></i></span>
  </div>
  <div style="
    padding: 13px;
    font-size: 13px;
" onclick="show_div_count()">
<span id="count_adultos"><strong style="color:#aaa">2 adultos</strong></span>
</div>
  <div style="
    padding: 13px;
    font-size: 13px;
" onclick="show_div_count()">
<span id="count_criancas"><strong style="color:#aaa">0 criança</strong></span>
</div>
  <div style="
    padding: 13px;
    font-size: 13px;
" onclick="show_div_count()">
<span id="count_quartos"><strong style="color:#aaa">1 quarto</strong></span>
</div>
<div style="
    padding: 13px;
    font-size: 13px;
" onclick="show_div_count()">
    
</div>
<div style="
    padding: 13px;
    font-size: 13px;
" onclick="show_div_count()">
<strong><i class="fa fa-arrow-down"></i></strong>
</div>
<div class="dropdown" style="
display:none;
    position: relative;
    top:-2px;
    background-color: #fff;
    padding: 16px;
    box-shadow: 0px 0px 5px #868585;
    z-index: 99999999;
    width: 100%;
">
<div class="row" style="height:40px">
<div class="col-lg-6 col-xs-6 text-left">
<strong style="font-size:14px;color: #444444;">Adultos</strong>
</div>
<div class="col-lg-6 col-xs-6 text-right">
<div class="qty">
                        <span class="minus bg-dark">-</span>
                        <input type="number" class="count input_number" name="qty" value="2" disabled="">
                        <span class="plus bg-dark">+</span>
                    </div>
</div>
</div>
<div class="row" style="height:40px">
<div class="col-lg-6 col-xs-6 text-left">
<strong style="font-size:14px;color: #444444;">Crianças</strong>
</div>
<div class="col-lg-6 col-xs-6 text-right">
<div class="qty">
                        <span class="minus_child bg-dark">-</span>
                        <input type="number" class="count_child input_number" name="qty" value="0" disabled="">
                        <span class="plus_child bg-dark">+</span>
                    </div>
</div>
</div>
<div class="row" style="height:40px">
<div class="col-lg-6 col-xs-6 text-left">
<strong style="font-size:14px;color: #444444;">Quartos</strong>
</div>
<div class="col-lg-6 col-xs-6 text-right">
<div class="qty">
                        <span class="minus_quartos bg-dark">-</span>
                        <input type="number" class="count_quartos input_number" name="qty" value="1" disabled="">
                        <span class="plus_quartos bg-dark">+</span>
                    </div>
</div>
</div>

<div class="row" id="crianca1" style="display:none">
<div class="col-lg-12 col-xs-12">
<strong style="font-size:14px;color: #444444;">Idade das crianças</strong>
<select class="form-control" id="idade_crianca1">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>

<div class="row" id="crianca2" style="display:none">
<div class="col-lg-12 col-xs-12"> 
<select class="form-control" id="idade_crianca2">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>

<div class="row" id="crianca3" style="display:none">
<div class="col-lg-12 col-xs-12"> 
<select class="form-control" id="idade_crianca3">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>

<div class="row" id="crianca4" style="display:none">
<div class="col-lg-12 col-xs-12"> 
<select class="form-control" id="idade_crianca4">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>

<div class="row" id="crianca5" style="display:none">
<div class="col-lg-12 col-xs-12"> 
<select class="form-control" id="idade_crianca5">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>

<div class="row" id="crianca6" style="display:none">
<div class="col-lg-12 col-xs-12" id="idade_crianca6"> 
<select class="form-control">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>

<div class="row" id="crianca7" style="display:none">
<div class="col-lg-12 col-xs-12"> 
<select class="form-control">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>

<div class="row" id="crianca8" style="display:none">
<div class="col-lg-12 col-xs-12"> 
<select class="form-control">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>

<div class="row" id="crianca9" style="display:none">
<div class="col-lg-12 col-xs-12"> 
<select class="form-control">
<option value="">Idade na data do check-out</option>
<option value="0">0 anos de idade</option>
<option value="1">1 ano de idade</option>
<option value="2">2 anos de idade</option>
<option value="3">3 anos de idade</option>
<option value="4">4 anos de idade</option>
<option value="5">5 anos de idade</option>
<option value="6">6 anos de idade</option>
<option value="7">7 anos de idade</option>
<option value="8">8 anos de idade</option>
<option value="9">9 anos de idade</option>
<option value="10">a0 anos de idade</option>
<option value="11">11 anos de idade</option>
<option value="12" selected>12 anos de idade</option>
<option value="13">13 anos de idade</option>
<option value="14">14 anos de idade</option>
<option value="15">15 anos de idade</option>
<option value="16">16 anos de idade</option>
<option value="17">17 anos de idade</option> 
</select>
</div>
</div>








</div>
</div>
        
    </div>
    <div class="col-lg-2 col-xs-12" style="box-shadow: 0px 0px 7px #888585;padding: 0;border: 3px solid '.(empty($options['cor_bordas']) ? "#ddd" : $options['cor_bordas']).';">
        <a onclick="redirect_hotel()"><button class="btn btn-primary btn_pesquisa_aereo" style="width:100%;height: 45px;border-radius:0;background-color:'.(empty($options['cor_botao']) ? "#1ab394" : $options['cor_botao']).' !important;border-color: '.(empty($options['cor_botao']) ? "#1ab394" : $options['cor_botao']).' !important">Pesquisar</button></a>
    </div>
</div>
<div class="div_resultados" style="display:none;
    background-color: #eee;
" class="row">
    <h4 style="
    margin: 0px !important;
    padding: 14px;
">Nenhum resultado encontrado com os critérios informados.</h4>
</div>
<br> 
                </div>
                <div class="col-lg-1"></div>
            </div>';

            return $retorno;
    } 




}

new TTBookingIntegracaoAdmin();


 