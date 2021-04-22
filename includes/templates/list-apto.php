<?php 
   get_header(); 

   session_start();

   global $woocommerce;
      $woocommerce->cart->empty_cart();

      $_SESSION['teste'] = $_POST['periodo'];

   $_SESSION['valor_taxas'] = $_POST['valor_taxas'];
   
   $dados = explode(";", $_GET['param']);  
   
   $the_slug = $dados[2];
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
   
   	$thumb_id = get_post_thumbnail_id($id);
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
               'number'        => 50 //specify yours
           )
   );
   
   if( $cat_terms ){
      $contador = 0;
   
   foreach( $cat_terms as $term ) { 
   
   $args = array(
       'post_type'             => 'ttbooking',
       'posts_per_page'        => 50, //specify yours
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

            $contador++;
   			$servicos .= '<span style="background-color:#eaeaea;padding:5px"><i class="fa fa-info" style="font-size: 13px;"></i> <span style="margin-right:8px;margin-left: 6px;margin-top: -4px;font-size: 13px;">'.$term->name.'</span></span> '; 
            if (0 == ($contador % 6)){
               $servicos .= '<br>';
            }
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
   'key'   => 'demo_product_info',
   'value' => str_replace("-", " ", $dados[0]),
   ),
   )
   );
   
   $query = new WP_Query( $query_args );
   
   $apartamentos = [];
     
   $id_produto = $dados[1];
   
   $periodo_product_info_inicial = get_post_meta( $id_produto, 'periodo_product_info', true );  
   $tar_periodo_product_info_inicial = get_post_meta( $id_produto, 'tar_periodo_product_info', true );   
   $tar_periodo_final_product_info_inicial = get_post_meta( $id_produto, 'tar_periodo_final_product_info', true );
   $tar_valor_final_product_info_inicial = get_post_meta( $id_produto, 'tar_valor_final_product_info', true ); 
   
   $periodo_product_info2 = get_post_meta( $id_produto, 'periodo_product_info1', true );  
   $tar_periodo_product_info2 = get_post_meta( $id_produto, 'tar_periodo_product_info1', true );   
   $tar_periodo_final_product_info2 = get_post_meta( $id_produto, 'tar_periodo_final_product_info1', true );
   $tar_valor_final_product_info2 = get_post_meta( $id_produto, 'tar_valor_final_product_info1', true );
   
   $periodo_product_info3 = get_post_meta( $id_produto, 'periodo_product_info2', true );  
   $tar_periodo_product_info3 = get_post_meta( $id_produto, 'tar_periodo_product_info2', true );   
   $tar_periodo_final_product_info3 = get_post_meta( $id_produto, 'tar_periodo_final_product_info2', true ); 
   $tar_valor_final_product_info3 = get_post_meta( $id_produto, 'tar_valor_final_product_info2', true );

   $diarias .= '{ "start": "'.$tar_periodo_product_info_inicial.'", "end": "'.$tar_periodo_final_product_info_inicial.'", "valor": "'.str_replace(",", ".", str_replace(".", "", $tar_valor_final_product_info_inicial)).'" },';  
   $contador = 0;
   for ($i=0; $i < 10; $i++) { 

      $tar_periodo_product_info = get_post_meta( $id_produto, 'tar_periodo_product_info'.$i, true ); 
      $tar_periodo_final_product_info = get_post_meta( $id_produto, 'tar_periodo_final_product_info'.$i, true ); 
      $tar_valor_final_product_info = get_post_meta( $id_produto, 'tar_valor_final_product_info'.$i, true );  
      if (!empty(get_post_meta( $id_produto, 'tar_periodo_product_info'.$i, true ))) { 

         $diarias .= '{ "start": "'.$tar_periodo_product_info.'", "end": "'.$tar_periodo_final_product_info.'", "valor": "'.str_replace(",", ".", str_replace(".", "", $tar_valor_final_product_info)).'" },';  

      }

   } 
      $valores_datas = '['.$diarias.']'; 
    
   ?>
<!-- Blog Section with Sidebar -->
<style type="text/css"> 
   .page-builder, .error-section { display: none !important } 
   .page-title-section { display: none } 
   .attachment-post-thumbnail{    display: block;
   max-width: 100%;
   height: 250px;}
</style>
<div class="page-builder2"> 
   <input type='hidden' id='diarias' value='[<?=substr($diarias, 0, -1)?>]'>
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
      /***
Bootstrap Line Tabs by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

/* Tabs panel */ 

/* Default mode */
.tabbable-line > .nav-tabs {
  border: none;
  margin: 0px;
}
.tabbable-line > .nav-tabs > li {
  margin-right: 2px;
}
.tabbable-line > .nav-tabs > li > a {
  border: 0;
  margin-right: 0;
  color: #737373;
}
.tabbable-line > .nav-tabs > li > a > i {
  color: #a6a6a6;
}
.tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
  border-bottom: 4px solid #fbcdcf;
}
.tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {
  border: 0;
  background: none !important;
  color: #333333;
}
.tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
  color: #a6a6a6;
}
.tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
  margin-top: 0px;
}
.tabbable-line > .nav-tabs > li.active {
  border-bottom: 4px solid #f3565d;
  position: relative;
}
.tabbable-line > .nav-tabs > li.active > a {
  border: 0;
  color: #333333;
}
.tabbable-line > .nav-tabs > li.active > a > i {
  color: #404040;
}
.tabbable-line > .tab-content {
  margin-top: -3px;
  background-color: #fff;
  border: 0; 
  padding: 15px 0;
}
.portlet .tabbable-line > .tab-content {
  padding-bottom: 0;
}

/* Below tabs mode */

.tabbable-line.tabs-below > .nav-tabs > li {
  border-top: 4px solid transparent;
}
.tabbable-line.tabs-below > .nav-tabs > li > a {
  margin-top: 0;
}
.tabbable-line.tabs-below > .nav-tabs > li:hover {
  border-bottom: 0;
  border-top: 4px solid #fbcdcf;
}
.tabbable-line.tabs-below > .nav-tabs > li.active {
  margin-bottom: -2px;
  border-bottom: 0;
  border-top: 4px solid #f3565d;
}
.tabbable-line.tabs-below > .tab-content {
  margin-top: -10px;
  border-top: 0;
  border-bottom: 1px solid #eee;
  padding-bottom: 15px;
}
.daterangepicker{
   display: block !important;
}
.datepicker-inline{
   margin: 0 auto !important
}
.datepicker-panel > ul > li:not(.disabled){
   background-color: #1ab394 !important;
    color: #fff !important; 
    border-radius: 4px !important;
}
.datepicker-panel > ul > li{ 
   font-size: 14px !important
}
.datepicker-panel > ul[data-view="week"] > li, .datepicker-panel > ul[data-view="week"] > li:hover {
    background-color: #fff !important;
    color: #aaa !important;
    }
.datepicker-panel > ul > li.picked, .datepicker-panel > ul > li.picked:hover {
    color: #fff !important;
    background-color: #1ab394;
}
.datepicker-panel > ul > li[data-view="years prev"], .datepicker-panel > ul > li[data-view="year prev"], .datepicker-panel > ul > li[data-view="month prev"], .datepicker-panel > ul > li[data-view="years next"], .datepicker-panel > ul > li[data-view="year next"], .datepicker-panel > ul > li[data-view="month next"], .datepicker-panel > ul > li[data-view="next"] { 
    background-color: #e8e8e8 !important;
    color: #000 !important;
}
.datepicker-panel > ul > li[data-view="day disabled"], .datepicker-panel > ul > li[data-view="day disabled"], .datepicker-panel > ul > li[data-view="day disabled"] { 
    color: #ccc !important;
}
.datepicker-panel > ul > li[data-view="years current"], .datepicker-panel > ul > li[data-view="year current"], .datepicker-panel > ul > li[data-view="month current"] { 
    background-color: #e8e8e8 !important;
    color: #737373 !important;
}  
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
.daterangepicker .drp-calendar.right {
   display: none !important;
}

   </style>
   <div class="container">
      <br><br>
      <div class="row justify-content-center font hotel" >
         <div class="col-lg-9 col-12">
            <h3><?= ucwords(str_replace("-", " ", $dados[0])) ?> <small style="font-size: 13px"><?=$localizacao?></small></h3>
            <div> 
               <button class="btn btn-md btn-primary" style="font-weight: 700"><i class="fa fa-money" style="margin-right: 8px"></i> <?=$tar_valor_final_product_info_inicial?> <small style="font-size: 11px;margin-left: 10px;"><?=$periodo_product_info_inicial ?></small></button>
               <?php if (!empty($tar_valor_final_product_info2)) { ?>
               <button class="btn btn-md btn-info" style="font-weight: 700"><i class="fa fa-money" style="margin-right: 8px"></i> <?=$tar_valor_final_product_info2?> <small style="font-size: 11px;margin-left: 10px;"><?=$periodo_product_info2?></small></button>
            <?php } ?>
               <?php if (!empty($tar_valor_final_product_info3)) { ?>
               <button class="btn btn-md btn-warning" style="font-weight: 700"><i class="fa fa-money" style="margin-right: 8px"></i> <?=$tar_valor_final_product_info3?> <small style="font-size: 11px;margin-left: 10px;"><?=$periodo_product_info3?></small></button>
            <?php } ?>
            </div>
            <br>
            <div  class="fotorama" data-nav="thumbs"
     data-thumbwidth="90"
     data-thumbheight="90">
            <img src="<?=$url?>" style="width: 100%"> 
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
          <div class="" style="padding-top: 10px">
            <?=$description;?>
         </div>
            <br>
            <div class="tabbable-panel">
            <div class="tabbable-line">
               <ul class="nav nav-tabs ">
                  <li class="active">
                     <a href="#tab_default_1" data-toggle="tab">
                     Serviços </a>
                  </li> 
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="tab_default_1">
                     <p style="line-height: 2.3;">
                        <?=$servicos?>
                     </p> 
                  </div>  
               </div>
            </div>
         </div>
         </div>
         <div class="col-lg-3 col-12" style="border: 1px solid #ddd;padding:0"> 
            <div style="text-align: center;"> 
               <h5 style="margin: 13px"><strong>Valores</strong></h5>
               <div style="height: 50px;background-color: #c9f3e1;padding: 15px 0px;">
                  <h4><strong><?=get_woocommerce_currency_symbol ();?> <?=$tar_valor_final_product_info_inicial?></strong> <small style="font-size: 13px">por dia</small></h4>
                  <br>
                  <div id="div_date">
                     <input type="text" id="select-delivery-date-input" style="height: 2px;border: none;color:#fff"> 
                  </div>
               </div>
            </div>
 
            <div style="text-align: right;margin-top: 125%;padding: 0px 10px;">
               <span style="float: left;font-size: 13px"><strong style="font-size: 13px">Período: </strong><?=$_POST['periodo']?></span>
                                <?php $woocommerce_currency = get_post_meta( $id_produto, 'woocommerce_currency', true);   ?>
               <?php 

                  $_SESSION['texto_descritivo'] = '<br><strong style="float: left;font-size: 17px;">'.$_POST['acomodacao'].'</strong><br><strong style="float: left;color: green;font-weight: 500;">'.$_POST['regime'].'</strong><br><span style="font-weight: 500;">'.$_POST['pax'].'</span><br>';
                ?>
                                <br>
                                <strong style="float: left"><?=$_POST['acomodacao']?></strong><br>
                                <?php if (!empty($_POST['regime'])) { ?>
                                    <strong style="float: left;color: green"><?=$_POST['regime']?></strong><br>
                                <?php } ?>
                                <br> 
                                <span id="validacao_diaria" style="color:red;display:none"><strong>Período não encontrado.</strong></span>
                                <span id="diarias_exibicao"><?=$_POST['diaria']?></span> <br><?=$_POST['pax']?> 
                                <br>
                                <?php $woocommerce_currency = get_post_meta( $id_produto, 'woocommerce_currency', true);   ?>
                                <span id="exibicao_valor" style="font-size: 22px"> <?=$woocommerce_currency?> <?=$_POST['valor']?></span>
                                <br>
                                <?=$_POST['taxas']?>
                                <br>

                                <strong style="font-size: 13px;<?=($_POST['qtd_quartos'] <= 5 ? 'color:red' : '')?>"><?=$_POST['qtd_quartos']?> quartos disponíveis</strong>
                                <br>
                                <br>
                                <input type="hidden" id="id_produto" value="<?=$id_produto?>" name="">
                                <input type="hidden" id="diarias_int" value="2" name="">
              <button class="btn btn-primary btn-checkout single_add_to_cart_button" style="width: 100%">Reservar</button>
            </div>

            <br>
            <div style="padding: 0px 10px;">
            <?php 
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo'); 
             ?>
            <h4 style="border-bottom: 1px solid #ddd;padding-bottom: 7px;">PERÍODOS</h4> 
            <strong><?=$periodo_product_info_inicial?></strong><br>
            <span>De <?= strftime('%d de %B', strtotime(implode("-", array_reverse(explode("/", $tar_periodo_product_info_inicial))))) ?> a <?=strftime('%d de %B', strtotime(implode("-", array_reverse(explode("/", $tar_periodo_final_product_info_inicial)))))?></span>

            <?php if (!empty($periodo_product_info2)) { ?>
               <br>
               <br>

            <strong><?=$periodo_product_info2?></strong><br>
            <span>De <?=strftime('%d de %B', strtotime(implode("-", array_reverse(explode("/", $tar_periodo_product_info2)))))?> a <?=strftime('%d de %B', strtotime(implode("-", array_reverse(explode("/", $tar_periodo_final_product_info2)))))?></span>
            <?php } ?>

            <?php if (!empty($periodo_product_info3)) { ?>
               <br>
               <br>

            <strong><?=$periodo_product_info3?></strong><br>
            <span>De <?=strftime('%d de %B', strtotime(implode("-", array_reverse(explode("/", $tar_periodo_product_info3)))))?> a <?=strftime('%d de %B', strtotime(implode("-", array_reverse(explode("/", $tar_periodo_final_product_info3)))))?></span>
            <?php } ?>
         </div>
            <br>
            <div style="padding: 0px 10px;">
            <h4 style="border-bottom: 1px solid #ddd;padding-bottom: 7px;">TERMOS DE RESERVA</h4> 
            <?php 

            $cat_terms = get_terms(
       array('termos'),
       array(
               'hide_empty'    => false,
               'orderby'       => 'name',
               'order'         => 'ASC',
               'number'        => 50 //specify yours
           )
   );
   
   if( $cat_terms ){
   
   foreach( $cat_terms as $term ) { 
   
   $args = array(
       'post_type'             => 'ttbooking',
       'posts_per_page'        => 50, //specify yours
       'post_status'           => 'publish',
       'tax_query'             => array(
                                   array(
                                       'taxonomy' => 'termos',
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
            echo $post->post_content.'<hr>';
         }
   ?> 
<?php
   endwhile;
   endif;
   wp_reset_postdata(); //important  

}
}
    ?>
            </div>
         </div>
      </div>
      <br>
   </div>
   <br><br>
   <input type="hidden" id="inicio_calendario" value="<?=$tar_periodo_product_info_inicial?>" name="">
   <input type="hidden" id="fim_calendario" value="<?=$tar_periodo_final_product_info_inicial?>" name="">
   <input type="hidden" id="valor_calendario" value="<?=str_replace(",", ".", str_replace(".", "", $tar_valor_final_product_info_inicial))?>" name="">
   <input type="hidden" id="currency" value="<?=get_woocommerce_currency_symbol ();?>" name="">
</div>
<input type="hidden" id="uri" name="" value="<?=$_SERVER['REQUEST_URI']?>">
<script src="<?=plugins_url( '../assets/js/mask.js', __FILE__ )?>"></script>
<script type="text/javascript">
   function show_div_count(){
   jQuery(".dropdown").toggle(500);
   }
         jQuery("#telefone").mask('(00) 00000-0000');
         jQuery("#chegada").mask('00/00/0000');
         jQuery("#saida").mask('00/00/0000');
   
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
<?php session_write_close(); ?>
<?php get_footer(); ?>