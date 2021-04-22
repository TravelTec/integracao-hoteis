<?php 
   get_header(); 
   
   $dados = explode("/", $_SERVER['REQUEST_URI']);
   
   $categoria = $dados[1];
   $slug = $dados[2];
   $descricao_slug = ucwords(str_replace("-", " ", $dados[2]));
   if (!empty($dados[3])) {
   	$descricao_slug = ucwords(str_replace("-", " ", $dados[2])).' — '.ucwords(str_replace("-", " ", $dados[3]));
   	$slug = $dados[3];
   }
   
   
   $the_slug = $slug;
   $args = array(
     'name'        => $the_slug,
     'post_type'   => 'ttbooking',
     'post_status' => 'publish',
     'numberposts' => 1
   );
   $my_posts = get_posts($args);
   
   	$title = $my_posts[0]->post_title;
   	$description = $my_posts[0]->post_content;
   	$id = $my_posts[0]->ID; 
   
   	$thumb_id = get_post_thumbnail_id();
   $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
   $url = $thumb_url[0];  
   
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
                                           ),
                   'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
               );
           $_posts = new WP_Query( $args ); 
   
           if( $_posts->have_posts() ) :
               while( $_posts->have_posts() ) : $_posts->the_post();  
               $post = get_post(); 
               		if ($post->ID == $id) {
               			$localizacao .= '<i class="fa fa-map"></i> <span style="margin-right:8px;">'.$term->name.'</span>'; 
               		}
               ?> 
<?php
   endwhile;
   endif;
   wp_reset_postdata(); //important  
   
   }
   }
   
   /************************************************************************/ 
   
   $servicos = '';
   
   $cat_terms = get_terms(
       array('servicos'),
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
                                       'taxonomy' => 'servicos',
                                       'field'    => 'slug',
                                       'terms'    => $term->slug,
                                   ),
                               ),
       'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
   );
   $_posts = new WP_Query( $args ); 
   
   if( $_posts->have_posts() ) :
   while( $_posts->have_posts() ) : $_posts->the_post();  
   $post = get_post(); 
   		if ($post->ID == $id) {
   			$servicos .= '<i class="fa fa-info" style="font-size: 13px;"></i> <span style="margin-right:8px;margin-left: 6px;margin-top: -4px;font-size: 13px;">'.$term->name.'</span><br>'; 
   		}
   ?> 
<?php
   endwhile;
   endif;
   wp_reset_postdata(); //important  
   
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
   if ($meta_pessoas_acomodacao == 1) {
   $tipo = 'Single';
   }else if ($meta_pessoas_acomodacao == 2) {
   $tipo = 'Duplo';
   }else if ($meta_pessoas_acomodacao == 3) {
   $tipo = 'Triplo';
   }
   $meta_valor_inicial_acomodacao = get_post_meta( $id_produto, 'tar_valor_final_product_info', true );
   
   $apartamentos[] = array("nome" => $nome_apartamento, "acomodacao" => $meta_acomodacao, "tipo" => $tipo, "pax" => $meta_pessoas_acomodacao, "valor" => $meta_valor_inicial_acomodacao, "id_produto" => $id_produto);
   }
   } 
   ?>
<!-- Blog Section with Sidebar -->
<style type="text/css"> 
   .page-builder { margin: 0px; padding: 0; } 
   .attachment-post-thumbnail{    display: block;
   max-width: 100%;
   height: 250px;}
</style>
<div class="page-builder">
   <div class="page-title-section" style="display: block !important;">
      <div class="overlay">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-1 col-lg-1"></div>
               <div class="col-md-5 col-lg-5">
                  <div class="page-title">
                     <h1><?= $descricao_slug; ?></h1>
                  </div>
               </div>
               <div class="col-md-5 col-lg-5">
                  <ul class="page-breadcrumb">
                     <li><a href="https://wp02.montenegroev.com.br">Início</a> &nbsp; / &nbsp;</li>
                     <li class="active"><?= $descricao_slug; ?></li>
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
      <div class="row justify-content-center font hotel" >
         <div class="col-md-10 col-lg-10">
            <div class="row gallery0" style="background-color: #fff;box-shadow: 7px 14px 8px #ccc;border-radius: 8px;border: 1px solid #ccc;">
               <div class="col-lg-4 centeri img-div-responsive" style="
                  text-align: center;
                  padding: 0 0px 9px 15px;
                  ">
                  <a class="imggallery0 vai" href=""><img src="<?=$url?>" class="img-responsive img-fluid imgHotel" style="margin:11px;display: none"></a>
                  <img src="<?=$url?>" class="img-responsive img-fluid imgHotel" style="margin-top: 11px;">
                  <br> 
               </div>
               <div class="col-lg-4" style="">
                  <h3 class="tituloHotel" style="color: #0069a7!important;font-weight: 400;margin-bottom: 0;font-size: 28px;margin-top:6px"> <?=$title?> <br class="exibirCelular"></h3>
                  <span><small style="font-size: 12px;color: #424242"><?=$localizacao?></small></span> <span class="exibirComputador" style="margin-right: 7px;margin-left: 7px;border-right: 1px solid #ccc;"></span>    <br class="exibirCelular">   
                  <hr style="margin-bottom: 5px;margin-top: 5px;">
                  <p style="line-height: 1.6;text-align: justify;"> 
                     <?=$description?> 
                  </p>
                  <?php if (!empty($servicos)) { ?>
                  <p style="font-weight: 700;font-size: 12px;margin-bottom: 0">SERVIÇOS DO HOTEL </p>
                  <div class="row" style="margin-left: -1px;margin-bottom: 11px;"> 
                     <?=$servicos?>
                  </div>
                  <?php } ?>
               </div>
               <div class="col-lg-4 borderC" style="/* padding-top: 24px; */margin-top: 11px;">
                  <br class="exibirComputador">
                  <p class="exibirComputador" style="margin-bottom: 9px;"><br></p>
                  <div class="row" style="margin-bottom: 5px;font-size: 13px;border-top: 1px solid #e5e5e5;padding-top: 6px;">
                     <div class="col-lg-1 col-1 paddingCelular" style="margin-right: -7px;"></div>
                     <div class="col-lg-5 col-4 borderCelular col1Celular"><strong>Apto</strong></div>
                     <div class="col-lg-2 col-2 borderCelular col2Celular"><strong>Tipo</strong></div>
                     <div class="col-lg-1 col-2 borderCelular text-center"><strong>Pax</strong></div>
                     <div class="col-lg-2 col-3" style="padding-right: 0;float: right;text-align: right;padding-left: 5px;"><strong>A partir de</strong></div>
                  </div>
                  	<?php if (!empty($apartamentos)) { ?>
                  		<?php for ($i=0; $i < count($apartamentos); $i++) { ?>
		                  <div class="row" style="margin-bottom: 8px;padding-top: 4px;padding-bottom: 3px;background-color: #eee;">
		                     <div class="col-lg-1 col-1 paddingCelular" style="margin-right: -7px;">
		                        <p style="font-size: .875rem; margin-bottom: 0;"><input type="radio" name="nameHotel" id="nameHotel<?=$i?>" value="<?=str_replace(" ", "-", $apartamentos[$i]['acomodacao']);?>;<?=$apartamentos[$i]['id_produto'];?>;<?=$dados[2]?>" onchange="AtribuiValorHotel('<?=$i?>')"> </p>
		                     </div>
		                     <div class="col-lg-5 col-4 colNomeCelular" style="border-right: 1px solid #ddd;">
		                        <p class="fontSizeP" style="margin-bottom: 0;"> <?=$apartamentos[$i]['acomodacao'];?>  </p>
		                     </div>
		                     <div class="col-lg-2 col-3" style="border-right: 1px solid #ddd;">
		                        <p class="fontSizeP" style="margin-bottom: 0;"> <?=$apartamentos[$i]['tipo'];?></p>
		                     </div>
		                     <div class="col-lg-1 col-1" style="border-right: 1px solid #ddd;">
		                        <p class="fontSizeP" style="margin-bottom: 0;text-align: center"> <?=$apartamentos[$i]['pax'];?></p>
		                     </div>
		                     <div class="col-lg-2 col-3" style="padding-right: 0;float: right;text-align: right;padding-left: 5px;">
		                        <p class="fontSizePreco" style="margin-bottom: 0;"><small style="font-size: 10px;"> </small><?=$apartamentos[$i]['valor'];?></p>
		                     </div>
		                  </div>
		                <?php } ?>
		                <?php } ?>
                  <small>Valor da diária por apartamento.</small>
                  <br> <br>
                  <button class="btn btn-primary" style="float: right;width: 100%;font-size: 25px;text-transform: uppercase;margin-bottom: 14px;" onclick="enviarFormTodos();"><i class="fas fa-calendar-alt"></i> Reservar</button> 
                  <br><br>
               </div>
            </div>
         </div>
      </div>
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

   		jQuery("#uri").val('/apto?param='+dados[0]+';'+dados[1]+';'+dados[2]);
   	}

   	function enviarFormTodos(){
   		var uri = jQuery("#uri").val();
   		window.location.href = uri;
   	}
    		
</script>
<!-- /Blog Section with Sidebar -->
<?php get_footer(); ?>