<?php 
   get_header(); 
   
   $dados = explode(";", $_GET['param']);

   $destino = $dados[0];
   $data_inicio = $dados[1];
   $data_final = $dados[2];
   $adt = $dados[3];
   $chd = $dados[4];
   $qts = $dados[5]; 

   $pax_pesquisa_inicial = $adt;
   $pax_pesquisa_total = intval($adt)+intval($chd);

   if ($qts > 1) {
        $quartos = ', '.$qts.' quartos';
   }else{
    $quartos = ', '.$qts.' quarto';
   }

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
   $idade_crianca = ($valor_idades[0] >= '10' ? $valor_idades[0] : str_replace("0", "", $valor_idades[0]));
   $pax = $adt.' '.($adt > 1 ? 'adultos' : 'adulto').' '.$crianca;
   $propriedade = $dados[7]; 

   $data_inicio = new DateTime(implode("-", array_reverse(explode("-", $data_inicio))));
    $data_fim = new DateTime(implode("-", array_reverse(explode("-", $data_final))));

    // Resgata diferença entre as datas
    $diferenca_data = $data_inicio->diff($data_fim); 
    if ($diferenca_data->days == 1) {
        $diaria = '1 diária';
    }else{
        $diaria = (intval($diferenca_data->days)+1).' diárias';
    }
?>
<!-- Blog Section with Sidebar -->
<style type="text/css"> 
   .page-builder { display: none } 
   .page-title-section { display: none } 
   .attachment-post-thumbnail{    display: block;
   max-width: 100%;
   height: 250px;} 
.fotorama__wrap--css3 .fotorama__html, .fotorama__wrap--css3 .fotorama__stage .fotorama__img{
   width: 100% !important;
}   
.daterangepicker td.available{
   background-color: #eee
}
.fotorama__nav-wrap{
       background-color: #eee;
}
.fotorama__nav__frame{
   padding: 7px !important;
}
.fotorama__thumb-border{
   margin-top: 7px !important
}
</style>
<div class="page-builder2"> 
   <div class="page-title-section" style="display: block !important;">
      <div class="overlay">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-1 col-lg-1"></div>
               <div class="col-md-5 col-lg-5">
                  <div class="page-title">
                     <h1>Hotéis em <?= $destino ?></h1>
                  </div>
               </div>
               <div class="col-md-5 col-lg-5">
                  <ul class="page-breadcrumb">
                     <li><a href="/">Início</a> &nbsp; / &nbsp;</li>
                     <li class="active">Hotéis em <?= $destino ?></li>
                  </ul>
               </div>
               <div class="col-md-1 col-lg-1"></div>
            </div>
         </div>
      </div>
   </div>
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
   <div class="container-fluid">
      <br><br>
<?php
   
   
   $the_slug = $slug;
   $args = array( 
     'post_type'   => 'ttbooking',
     'post_status' => 'publish',
     'numberposts' => 100
   ); 
   $my_posts = new WP_Query( $args );    

            $local = strtolower(str_replace(" ", "-", $destino));

            $localizacao = '';
   
           $cat_terms = get_terms(
                   array('localizacao'),
                   array(
                           'hide_empty'    => false,
                           'orderby'       => 'name',
                           'order'         => 'ASC',
                           'number'        => 6 //specify yours
                       )
               );
   
   if( $cat_terms ){
   
       foreach( $cat_terms as $term ) { 
   
           $args = array(
                   'post_type'             => 'ttbooking',
                   'posts_per_page'        => 10, //specify yours
                   'post_status'           => 'publish',
                   'tax_query'             => array(
                                               array(
                                                   'taxonomy' => 'localizacao',
                                                   'field'    => 'slug',
                                                   'terms'    => $term->slug,
                                               ),
                                               array(
                                                   'taxonomy' => 'tipo_propriedades',
                                                   'field'    => 'slug',
                                                   'terms'    => $propriedade,
                                               ),
                                           ),
                   'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
               );
           $_posts = new WP_Query( $args ); 
   
           if( $_posts->have_posts() ) :
               while( $_posts->have_posts() ) : $_posts->the_post();  
               $post = get_post();  
               $title = $post->post_title;
               $slug = $post->post_name;
               $id = $post->ID;  
    $description = $post->post_content; 
   
    $thumb_id = get_post_thumbnail_id();
   $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
   $url = $thumb_url[0];  
                     if ($term->slug === $local) {
                        $localizacao = '<i class="fa fa-map"></i> <span style="margin-right:8px;">'.$term->name.'</span>'; 

                        $servicos = '';
   
   $cat_terms1 = get_terms(
       array('servicos'),
       array(
               'hide_empty'    => false,
               'orderby'       => 'name',
               'order'         => 'ASC',
               'number'        => 100 //specify yours
           )
   );
   
   if( $cat_terms1 ){
      $contador = 0;
   
   foreach( $cat_terms1 as $term1 ) { 
   
   $args1 = array(
       'post_type'             => 'ttbooking',
       'posts_per_page'        => 10, //specify yours
       'post_status'           => 'publish',
       'tax_query'             => array(
                                   array(
                                       'taxonomy' => 'servicos',
                                       'field'    => 'slug',
                                       'terms'    => $term1->slug,
                                   ),
                               ),
       'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
   );
   $_posts1 = new WP_Query( $args1 ); 
   
   if( $_posts1->have_posts() ) :
   while( $_posts1->have_posts() ) : $_posts1->the_post();  
   $post1 = get_post(); 
        if ($post1->ID == $id) {

            $contador++;
            $servicos .= ' <span style="background-color:#eaeaea;padding:5px;"><i class="fa fa-info" style="font-size: 13px;"></i> <span style="margin-right:8px;margin-left: 6px;margin-top: -4px;font-size: 13px;">'.$term1->name.'</span></span>'; 
            if (0 == ($contador % 3)){
               $servicos .= '<br>';
            }
        } 
   endwhile;
   endif; 
   
   }
   }

                        $query_args = array(
   'post_type'  => 'product',
   'meta_query' => array(
   array(
   'key'   => 'est_product_info',
   'value' => $title,
   ),
   )
   );
   
   $query = new WP_Query( $query_args );
   
   $apartamentos = [];
   
   if ( $query->posts ) {
   foreach ( $query->posts as $key => $post_id ) { 

    $nome_apartamento = $post_id->post_title;
   $id_produto = $post_id->ID;
   
   $meta_acomodacao = get_post_meta( $id_produto, 'demo_product_info', true );  
   $meta_pessoas_acomodacao = get_post_meta( $id_produto, 'pessoas_demo_product_info', true ); 
   $apto_demo_product_info = get_post_meta( $id_produto, 'apto_demo_product_info', true ); 

   $tar_periodo_inicio_product_info = get_post_meta( $id_produto, 'tar_periodo_product_info', true ); 
   $tar_periodo_final_product_info = get_post_meta( $id_produto, 'tar_periodo_final_product_info', true ); 
   if ($meta_pessoas_acomodacao == 1) {
   $tipo = 'Single';
   }else if ($meta_pessoas_acomodacao == 2) {
   $tipo = 'Duplo';
   }else if ($meta_pessoas_acomodacao == 3) {
   $tipo = 'Triplo';
   }
   $meta_valor_inicial_acomodacao = get_post_meta( $id_produto, 'tar_valor_final_product_info', true );
   $tar_periodo_product_info = get_post_meta( $id_produto, 'periodo_product_info', true );
   //regime_product_info
   $regime_product_info = get_post_meta( $id_produto, 'regime_product_info', true ); 
   $check_taxas = get_post_meta( $id_produto, 'check_taxas', true );
        $valor_taxas_exibicao = get_post_meta( $id_produto, 'valor_taxas', true );
        $valor_taxas = get_post_meta( $id_produto, 'valor_taxas', true ); 
   if (empty($valor_taxas) || $valor_taxas == 0 || $valor_taxas == "0,00") { 
       $taxas = 'Valor das taxas inclusas';
   }else{
        $taxas = '+ '.get_woocommerce_currency_symbol ().' '.$valor_taxas.' em taxas e impostos';
   } 
   
   if ($meta_pessoas_acomodacao == $pax_pesquisa_inicial || $meta_pessoas_acomodacao == $pax_pesquisa_total) { 
      $apartamentos[] = array("nome" => $nome_apartamento, "acomodacao" => $meta_acomodacao, "tipo" => $tipo, "pax" => $meta_pessoas_acomodacao, "valor" => $meta_valor_inicial_acomodacao, "id_produto" => $id_produto, "regime" => $regime_product_info, 'taxas' => $taxas, "nome_hotel" => $title, "descricao_hotel" => $description, "foto" => $url, "servicos" => $servicos, "qtd_quartos" => $apto_demo_product_info, "periodo" => $tar_periodo_product_info, "data_inicial" => implode("-", array_reverse(explode("/", $tar_periodo_inicio_product_info))), "data_fim" => implode("-", array_reverse(explode("/", $tar_periodo_final_product_info))), "valor_taxas_exibicao" => $valor_taxas_exibicao, "slug" => $slug);
   }

   if ($chd > 0) { 

   for ($i=1; $i < 30; $i++) {  
    
   $meta_valor_inicial_acomodacao = get_post_meta( $id_produto, 'tar_valor_final_product_info'.$i, true );
   $regime_product_info = get_post_meta( $id_produto, 'regime_product_info'.$i, true ); 
   $check_taxas = get_post_meta( $id_produto, 'check_taxas'.$i, true );
        $valor_taxas = get_post_meta( $id_produto, 'valor_taxas'.$i, true );
        $tar_periodo_product_info = get_post_meta( $id_produto, 'periodo_product_info'.$i, true );
        $valor_taxas_exibicao = get_post_meta( $id_produto, 'valor_taxas'.$i, true ); 
   if (empty($valor_taxas) || $valor_taxas == 0 || $valor_taxas == "0,00") { 
    $valor_taxas = 0;
       $taxas = 'Valor das taxas incluso';
   }else{
        $taxas = '+ '.get_woocommerce_currency_symbol ().' '.$valor_taxas.' em taxas e impostos';
   } 
   $tar_periodo_inicio_product_info = get_post_meta( $id_produto, 'tar_periodo_product_info'.$i, true ); 
   $tar_periodo_final_product_info = get_post_meta( $id_produto, 'tar_periodo_final_product_info'.$i, true ); 

   $tar_check_crianca_product_info = get_post_meta( $id_produto, 'tar_check_crianca_product_info'.$i, true ); 
   $tar_idade_crianca_product_info = get_post_meta( $id_produto, 'tar_idade_crianca_product_info'.$i, true );  

   if (!empty($meta_valor_inicial_acomodacao)) { 
      if ($meta_pessoas_acomodacao == $pax_pesquisa_inicial || $meta_pessoas_acomodacao == $pax_pesquisa_total) { 

         if ($tar_check_crianca_product_info === "on") {
            if ($tar_idade_crianca_product_info >= $idade_crianca) { 
               $apartamentos[] = array("nome" => $nome_apartamento, "acomodacao" => $meta_acomodacao, "tipo" => $tipo, "pax" => $meta_pessoas_acomodacao, "valor" => $meta_valor_inicial_acomodacao, "id_produto" => $id_produto, "regime" => $regime_product_info, 'taxas' => $taxas, "nome_hotel" => $title, "descricao_hotel" => $description, "foto" => $url, "servicos" => $servicos, "qtd_quartos" => $apto_demo_product_info, "periodo" => $tar_periodo_product_info, "data_inicial" => implode("-", array_reverse(explode("/", $tar_periodo_inicio_product_info))), "data_fim" => implode("-", array_reverse(explode("/", $tar_periodo_final_product_info))), "valor_taxas_exibicao" => $valor_taxas_exibicao, "slug" => $slug);
            }
         }


      }
}
}
}else{
   for ($i=1; $i < 30; $i++) {  
    
   $meta_valor_inicial_acomodacao = get_post_meta( $id_produto, 'tar_valor_final_product_info'.$i, true );
   $regime_product_info = get_post_meta( $id_produto, 'regime_product_info'.$i, true ); 
   $check_taxas = get_post_meta( $id_produto, 'check_taxas'.$i, true );
        $valor_taxas = get_post_meta( $id_produto, 'valor_taxas'.$i, true );
        $tar_periodo_product_info = get_post_meta( $id_produto, 'periodo_product_info'.$i, true );
        $valor_taxas_exibicao = get_post_meta( $id_produto, 'valor_taxas'.$i, true ); 
   if (empty($valor_taxas) || $valor_taxas == 0 || $valor_taxas == "0,00") { 
    $valor_taxas = 0;
       $taxas = 'Valor das taxas incluso';
   }else{
        $taxas = '+ '.get_woocommerce_currency_symbol ().' '.$valor_taxas.' em taxas e impostos';
   } 
   $tar_periodo_inicio_product_info = get_post_meta( $id_produto, 'tar_periodo_product_info'.$i, true ); 
   $tar_periodo_final_product_info = get_post_meta( $id_produto, 'tar_periodo_final_product_info'.$i, true ); 

   $tar_check_crianca_product_info = get_post_meta( $id_produto, 'tar_check_crianca_product_info'.$i, true ); 
   $tar_idade_crianca_product_info = get_post_meta( $id_produto, 'tar_idade_crianca_product_info'.$i, true );  

   if (!empty($meta_valor_inicial_acomodacao)) { 
      if ($meta_pessoas_acomodacao == $pax_pesquisa_inicial) { 
 
               $apartamentos[] = array("nome" => $nome_apartamento, "acomodacao" => $meta_acomodacao, "tipo" => $tipo, "pax" => $meta_pessoas_acomodacao, "valor" => $meta_valor_inicial_acomodacao, "id_produto" => $id_produto, "regime" => $regime_product_info, 'taxas' => $taxas, "nome_hotel" => $title, "descricao_hotel" => $description, "foto" => $url, "servicos" => $servicos, "qtd_quartos" => $apto_demo_product_info, "periodo" => $tar_periodo_product_info, "data_inicial" => implode("-", array_reverse(explode("/", $tar_periodo_inicio_product_info))), "data_fim" => implode("-", array_reverse(explode("/", $tar_periodo_final_product_info))), "valor_taxas_exibicao" => $valor_taxas_exibicao, "slug" => $slug); 


      }
}
}
}



}

$contador = 0;

    for ($x=0; $x < count($apartamentos); $x++) {  ?>

        <?php if(strtotime(implode("-", array_reverse(explode("-", $dados[1])))) >= strtotime($apartamentos[$x]['data_inicial']) && strtotime(implode("-", array_reverse(explode("-", $dados[2])))) <= strtotime($apartamentos[$x]['data_fim'])){ ?>
            <?php $contador++; ?>
        <div class="row justify-content-center font hotel" >
         <div class="col-md-10 col-lg-10 col-xs-12">
            <div class="row gallery0" style="background-color: #fff;box-shadow: 7px 14px 8px #ccc;border-radius: 8px;border: 1px solid #ccc;">
               <div class="col-lg-4 col-xs-12 centeri img-div-responsive" style="
                  text-align: center;
                  padding: 0 0px 9px 15px;
                  ">
                  <a class="imggallery0 vai" href=""><img src="<?=$apartamentos[$x]['foto']?>" class="img-responsive img-fluid imgHotel" style="margin:11px;display: none"></a>
                  <div  class="fotorama" data-nav="thumbs" data-thumbwidth="40" data-thumbheight="40" style="margin-top: 12px !important">
                  <img src="<?=$apartamentos[$x]['foto']?>" class="img-responsive img-fluid imgHotel" style="margin-top: 11px;">
                   <?php  
            //an array with all the images (ba meta key). The same array has to be in custom_postimage_meta_box_save($post_id) as well.
             $meta_keys = array('featured_image0','featured_image1','featured_image2','featured_image3','featured_image4','featured_image5','featured_image6','featured_image7','featured_image8','featured_image9','featured_image10','featured_image11','featured_image12','featured_image13','featured_image14','featured_image15','featured_image16','featured_image17','featured_image18','featured_image19','featured_image20');

             foreach($meta_keys as $meta_key){
                 $image_meta_val=get_post_meta( $id, $meta_key, true);  

                 if (!empty($image_meta_val)) { 
                 ?> 
                     <a href="<?=wp_get_attachment_image_src( $image_meta_val, 'full' )[0]?>"><img src="<?=wp_get_attachment_image_src( $image_meta_val, 'full' )[0]?>" alt="" width="90" height="90" data-thumbwidth="90" data-thumbheight="90"></a>
                  <?php } ?>
             <?php } ?>
                    </div>
               </div>
               <div class="col-lg-5 col-xs-12" style="">
                  <h3 class="tituloHotel" style="color: #0069a7!important;font-weight: 400;margin-bottom: 0;font-size: 28px;margin-top:6px"> <?=$apartamentos[$x]['nome_hotel']?> <br class="exibirCelular"></h3>
                  <span><small style="font-size: 12px;color: #424242"><?=$localizacao?></small></span> <span class="exibirComputador" style="margin-right: 7px;margin-left: 7px;border-right: 1px solid #ccc;"></span>    <br class="exibirCelular">   
                  <hr style="margin-bottom: 5px;margin-top: 5px;">
                  <p style="line-height: 1.6;text-align: justify;"> 
                     <?=$apartamentos[$x]['descricao_hotel']?> 
                  </p>
                  <?php if (!empty($apartamentos[$x]['servicos'])) { ?>
                  <p style="font-weight: 700;font-size: 12px;margin-bottom: 0">SERVIÇOS DO HOTEL </p>
                  <div class="row" style="margin-left: -1px;margin-bottom: 11px;"> 
                    <p style="line-height: 2.3;">
                     <?=$servicos?>
                 </p>
                  </div>
                  <?php } ?>
               </div>
               <div class="col-lg-3 col-xs-12 borderC" style="/* padding-top: 24px; */margin-top: 11px;">
                  <br class="exibirComputador">
                  <p class="exibirComputador" style="margin-bottom: 9px;"><br></p> 
                          <div class="row" style="margin-bottom: 8px;padding-top: 4px;padding-bottom: 3px;">
                             <div class="col-lg-12 col-xs-12 paddingCelular" style="margin-right: -7px;text-align: right;">
                                <span style="float: left;font-size: 13px"><strong style="font-size: 13px">Período: </strong><?=str_replace("-", "/", $dados[1]) ?> a <?=str_replace("-", "/", $dados[2])?></span>
                                <br>
                                <strong style="float: left"><?=$apartamentos[$x]['acomodacao']?></strong><br>
                                <?php if (!empty($apartamentos[$x]['regime'])) { ?>
                                    <strong style="float: left;color: green"><?=$apartamentos[$x]['regime']?></strong><br>
                                <?php } ?>
                                <br> 
                                <?=$diaria?> <br>
                                <?=$pax?><?=$quartos?>
                                <?= $idades?>
                                <br>
                                <?php 
                                    $valor_diaria = str_replace(",", ".", str_replace(".", "", $apartamentos[$x]['valor']));
                                    $valor_total_sem_taxa = (intval($diferenca_data->days)+1)*floatval($valor_diaria);
                                ?> 
                                <span style="font-size: 22px"><?=get_woocommerce_currency_symbol ();?>  <?=number_format($valor_total_sem_taxa, 2, ',', '.') ?></span>
                                <br>
                                <?=$apartamentos[$x]['taxas']?>
                                <br>

                                <strong style="font-size: 13px;<?=($apartamentos[$x]['qtd_quartos'] <= 5 ? 'color:red' : '')?>"><?=$apartamentos[$x]['qtd_quartos']?> quartos disponíveis</strong>
                             </div> 
                          </div>  
                  <br> 
                  <form action="/apto/?param=<?=str_replace(" ", "-", $apartamentos[$x]['acomodacao'])?>;<?=$apartamentos[$x]['id_produto']?>;<?=strtolower($apartamentos[$x]['slug'])?>" method="POST">

                        <input type="hidden" name="periodo" value="<?=str_replace("-", "/", $dados[1]) ?> a <?=str_replace("-", "/", $dados[2])?>">
                        <input type="hidden" name="acomodacao" value="<?=$apartamentos[$x]['acomodacao']?>">
                        <input type="hidden" name="regime" value="<?=$apartamentos[$x]['regime']?>">
                        <input type="hidden" name="diaria" value="<?=$diaria?>">
                        <input type="hidden" name="por_dia" value="<?= $apartamentos[$x]['valor']?>">
                        <input type="hidden" name="pax" value="<?=$pax?><?=$quartos?>"> 
                        <input type="hidden" name="valor" value="<?=get_woocommerce_currency_symbol ();?> <?=number_format($valor_total_sem_taxa, 2, ',', '.')?>">
                        <input type="hidden" name="valor_calendario_sem_formatacao" value="<?=$apartamentos[$x]['valor']?>">
                        <input type="hidden" name="taxas" value="<?=$apartamentos[$x]['taxas']?>">
                        <input type="hidden" name="valor_taxas" value="<?=$apartamentos[$x]['valor_taxas_exibicao']?>">
                        <input type="hidden" name="qtd_quartos" value="<?=$apartamentos[$x]['qtd_quartos']?>"> 

                        <button class="btn btn-primary" style="float: right;width: 100%;font-size: 17px;margin-bottom: 14px;"><i class="fas fa-calendar-alt"></i> Ver disponibilidade</button>
                      
                  </form>
                  <br><br>
               </div>
            </div>
         </div>
      </div>
      <br>
  <?php  } 
                    }
                }
                    }
                 endwhile;
   endif; 
}
} 

  if ($contador == 0) { ?>
    <div class="row justify-content-center font hotel" >
        <h4>Nenhum resultado disponível.</h4>
    </div>
    <?php
  }



?>

<br>
   </div>
   <br><br>
</div>
<input type="hidden" id="uri" name="" value="<?=$_SERVER['REQUEST_URI']?>">
<script type="text/javascript">
   function show_div_count(){
   jQuery(".dropdown").toggle(500);
   }
   
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