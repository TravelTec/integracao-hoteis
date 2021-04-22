
   var date = new Date();
var currentMonth = date.getMonth();
var currentDate = date.getDate();
var currentYear = date.getFullYear();
$('#sandbox-container').daterangepicker({
  startDate: moment(date).add(1,'days'),
  minDate: moment(date).add(1,'days'), 
        locale: {
            format: 'DD/MM/YYYY',
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar",
    "fromLabel": "De",
    "toLabel": "Até",
    "customRangeLabel": "Custom",
    "daysOfWeek": [
        "Dom",
        "Seg",
        "Ter",
        "Qua",
        "Qui",
        "Sex",
        "Sáb"
    ],
    "monthNames": [
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro"
    ],
        } 
}).on("input change", function (e) { 
    jQuery('#validar_data').val(e.target.value);
    }).on("input focus", function (e) { 
      if (jQuery("#destino_pesquisa").val() == '') {
        jQuery("#destino").val(''); 
      }
    remove_drop_destino();
    }).val('');

   function show_div_count(){
   jQuery(".dropdown").toggle(500);

  if (jQuery("#destino_pesquisa").val() == '') {
        jQuery("#destino").val(''); 
      }
   remove_drop_destino();
   }

   jQuery(document).ready(function(){ 
    

    jQuery(".daterangepicker").addClass('show-calendar'); 
    jQuery('#select-delivery-date-input').trigger('click')

    jQuery("#div_date").show(); 

   		    jQuery('.count').prop('disabled', true);
      			jQuery(document).on('click','.plus',function(){
   				var valor = parseInt(jQuery('.count').val()) + 1;
   				jQuery('.count').val(valor);
          jQuery("#count_adultos").html("<strong>"+valor+" adultos</strong>");
          jQuery("#pax_adt").html(valor+" adultos");
       		});
           	jQuery(document).on('click','.minus',function(){
   				var valor = parseInt(jQuery('.count').val()) - 1;
       			jQuery('.count').val(valor);
   			
   				jQuery("#count_adultos").html("<strong>"+valor+" adultos</strong>");
       				if (jQuery('.count').val() == 0 || jQuery('.count').val() == 1) {
   						jQuery('.count').val(1);
   				jQuery("#count_adultos").html("<strong>1 adulto</strong>");
          jQuery("#pax_adt").html("1 adulto");
   					}
       	    	});
   
   
   
   		    jQuery('.count_child').prop('disabled', true);
      			jQuery(document).on('click','.plus_child',function(){
   				var valor = parseInt(jQuery('.count_child').val()) + 1;
   				jQuery('.count_child').val(valor);
          jQuery("#crianca"+valor).attr("style", "");
          jQuery("#count_criancas").html("<strong>"+valor+" crianças</strong>");
          jQuery("#pax_chd").html(valor+" crianças");
   if (jQuery('.count_child').val() == 1) {
   						jQuery('.count_child').val(1);
   				jQuery("#count_criancas").html("<strong>1 criança</strong>");
   					}
       		});
           	jQuery(document).on('click','.minus_child',function(){
   				var valor = parseInt(jQuery('.count_child').val()) - 1;
       			jQuery('.count_child').val(valor);
          jQuery("#crianca"+parseInt(jQuery('.count_child').val())).attr("style", "display:none");
   			
   				jQuery("#count_criancas").html("<strong>"+valor+" crianças</strong>");
          jQuery("#pax_chd").html(valor+" crianças");
       				if (jQuery('.count_child').val() == 0) {
          jQuery("#crianca1").attr("style", "display:none");
          jQuery("#crianca2").attr("style", "display:none");
          jQuery("#crianca3").attr("style", "display:none");
          jQuery("#crianca4").attr("style", "display:none");
          jQuery("#crianca5").attr("style", "display:none");
          jQuery("#crianca6").attr("style", "display:none");
          jQuery("#crianca7").attr("style", "display:none");
          jQuery("#crianca8").attr("style", "display:none");
          jQuery("#crianca9").attr("style", "display:none"); 

   						jQuery('.count_child').val(0);
   				jQuery("#count_criancas").html("<strong>0 criança</strong>");
          jQuery("#pax_chd").html("0 criança");
   					}
   if (jQuery('.count_child').val() == 1) {
   						jQuery('.count_child').val(1);
   				jQuery("#count_criancas").html("<strong>1 criança</strong>");
          jQuery("#pax_chd").html("0 criança");
   					}
       	    	});
   
   		    jQuery('.count_quartos').prop('disabled', true);
      			jQuery(document).on('click','.plus_quartos',function(){
   				var valor = parseInt(jQuery('.count_quartos').val()) + 1;
   				jQuery('.count_quartos').val(valor);
          jQuery("#count_quartos").html("<strong>"+valor+" quartos</strong>");
          jQuery("#pax_qts").html(valor+" quartos");
       		});
           	jQuery(document).on('click','.minus_quartos',function(){
   				var valor = parseInt(jQuery('.count_quartos').val()) - 1;
       			jQuery('.count_quartos').val(valor);
   			
   				jQuery("#count_quartos").html("<strong>"+valor+" quartos</strong>");
       				if (jQuery('.count_quartos').val() == 0 || jQuery('.count_quartos').val() == 1) {
   						jQuery('.count_quartos').val(1);
   				jQuery("#count_quartos").html("<strong>1 quarto</strong>");
          jQuery("#pax_qts").html("1 quarto");
   					}
       	    	});
   
    		});

if ($("#diarias").val() != '') {
var dados = new Array();
    var dados_date = new Array();
    var ranges = jQuery.parseJSON($("#diarias").val()); 

    for(var i=0; i<ranges.length; i++) {
        start = (ranges[i].start).split("/");
            end = (ranges[i].end).split("/");

            year_start = start[2];
            //($inicio[1] == '01' ? 0 : preg_replace("@0+@","",($inicio[1]-1)))
            month_start = (start[1] == '01' ? 0 : (start[1]-1));
            //($termino[1] == '01' ? 0 : preg_replace("@0+@","",($termino[1]-1)))
            day_start = (start[0] < '10' ? start[0].substr(1) : start[0]);

            year_end = end[2];
            //($inicio[1] == '01' ? 0 : preg_replace("@0+@","",($inicio[1]-1)))
            month_end = (end[1] == '01' ? 0 : (end[1]-1));
            //($termino[1] == '01' ? 0 : preg_replace("@0+@","",($termino[1]-1)))
            day_end = (end[0] < '10' ? end[0].substr(1) : end[0]);

            dados[i] = new Array();
            dados[i].push(new Date(year_start, month_start, day_start)); 
            dados[i].push(new Date(year_end, month_end, day_end));  
            dados[i].push(ranges[i].valor);  
    } 
}

    var date = new Date();
var currentMonth = date.getMonth();
var currentDate = date.getDate();
var currentYear = date.getFullYear();
  $('#select-delivery-date-input').daterangepicker({
  startDate: $("#inicio_calendario").val(),
  minDate: $("#inicio_calendario").val(), 
    autoApply: true, 
  linkedCalendars: false,
  opens: "center",// or monday
  getValue: function()
  {
    return $(this).val();
  },
        locale: {
            format: 'DD/MM/YYYY',
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar",
    "fromLabel": "De",
    "toLabel": "Até",
    "customRangeLabel": "Custom",
    "daysOfWeek": [
        "Dom",
        "Seg",
        "Ter",
        "Qua",
        "Qui",
        "Sex",
        "Sáb"
    ],
    "monthNames": [
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro"
    ],
        } 
  });

  function formatReal(numero) {
    var tmp = numero + '';
    var neg = false;

    if (tmp - (Math.round(numero)) == 0) {
        tmp = tmp + '00';        
    }

    if (tmp.indexOf(".")) {
        tmp = tmp.replace(".", "");
    }

    if (tmp.indexOf("-") == 0) {
        neg = true;
        tmp = tmp.replace("-", "");
    }

    if (tmp.length == 1) tmp = "0" + tmp

    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");

    if (tmp.length > 6)
        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

    if (tmp.length > 9)
        tmp = tmp.replace(/([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2,$3");

    if (tmp.length = 12)
        tmp = tmp.replace(/([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2.$3,$4");

    if (tmp.length > 12)
        tmp = tmp.replace(/([0-9]{3}).([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2.$3.$4,$5");

    if (tmp.indexOf(".") == 0) tmp = tmp.replace(".", "");
    if (tmp.indexOf(",") == 0) tmp = tmp.replace(",", "0,");

    return (neg ? '-' + tmp : tmp);
}

  $('#select-delivery-date-input').on('apply.daterangepicker', function(ev, picker) { 
    var start = $('#select-delivery-date-input').data('daterangepicker').startDate._d; 
    var end = $('#select-delivery-date-input').data('daterangepicker').endDate._d;

    $("#periodo_datas_selec").html(moment(start).format('DD/MM/YYYY')+' a '+moment(end).format('DD/MM/YYYY'));

    var contador = 0;

    for(var i=0; i<dados.length; i++) { 
      if(moment(dados[i][0],"DD/MM/YYYY") <= moment(start,"DD/MM/YYYY") && moment(dados[i][1],"DD/MM/YYYY") >= moment(end,"DD/MM/YYYY")){
        contador++;
$("#regime").val(dados[i][3]);
$("#regime").val(dados[i][4]);

        $("#validacao_diaria").attr("style", "color:red;display:none");
        $("#diarias_exibicao").attr("style", "");
        $("#exibicao_valor").attr("style", "font-size: 22px");
        $(".btn-checkout").prop("disabled", false);

        var diff = moment(end,"DD/MM/YYYY HH:mm:ss").diff(moment(start,"DD/MM/YYYY HH:mm:ss"));
var dias = (moment.duration(diff).asDays())+1;  

       var price=parseFloat(dados[i][2]).toFixed(2);
       var quantity=parseFloat(dias).toFixed(2);
       var total=parseFloat(price*quantity);

$("#exibicao_valor").html($("#currency").val()+' '+formatReal(total));
if (dias.toFixed(0) > 1) {
  var exibe_diarias = 'diárias';
}else{
  var exibe_diarias = 'diária';
}
$("#diarias_exibicao").html(dias.toFixed(0) +' '+exibe_diarias);
$("#diarias_int").val(dias.toFixed(0));

$.ajax({
    type: "POST",
    url: "/wp-content/plugins/bookinghotels/includes/ajax-periodo.php",
    data: {start:moment(start).format('DD/MM/YYYY'), end:moment(end).format('DD/MM/YYYY')}, 
    success: function(result){ 
        console.log(result);
    }
});

      }
    }
 
if (contador == 0) {
        $("#validacao_diaria").attr("style", "color:red;display:block");
        $("#diarias_exibicao").attr("style", "display:none");
        $("#exibicao_valor").attr("style", "font-size: 22px;display:none");
        $(".btn-checkout").prop("disabled", true);
}

}); 


function redirect_hotel(){

      if (jQuery("#destino_pesquisa").val() == '') {
        jQuery("#valida_campo_destino").attr('style', 'display:block;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;');
      }else if (jQuery("#validar_data").val() == '') {
        jQuery("#valida_campo_data").attr('style', 'display:block;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;');
      }else{
        jQuery("#valida_campo_destino").attr('style', 'display:none;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;');
        jQuery("#valida_campo_data").attr('style', 'display:none;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;');
        jQuery(".btn_pesquisa_aereo").attr('style', 'width:100%;height: 45px;border-radius:0;background-color: #fff !important;');
        jQuery(".btn_pesquisa_aereo").html('<img src="https://admin.montenegrodigital.com.br/img/loader.gif" style="height: 43px;margin-top: -6px;">');

        var propriedade = jQuery("#propriedade").val();
        var destino = jQuery("#destino_pesquisa").val();
        var id = jQuery("#id_hotel").val();
        var data = jQuery("#validar_data").val();
        data = data.split(" - ");
        var data_inicio = data[0].replace("/", "-").replace("/", "-");
        var data_final = data[1].replace("/", "-").replace("/", "-");
        var adt = jQuery(".count").val()
        var chd = jQuery(".count_child").val()
        var qts = jQuery(".count_quartos").val()

        var idade1 = jQuery("#idade_crianca1").val()
        var idade2 = jQuery("#idade_crianca2").val()
        var idade3 = jQuery("#idade_crianca3").val()
        var idade4 = jQuery("#idade_crianca4").val()
        var idade5 = jQuery("#idade_crianca5").val()
        var idade6 = jQuery("#idade_crianca6").val()


      jQuery("#dados").attr("style", "display:none; position: absolute;width: 100%;top: 48px;background-color: #fff;"); 
   jQuery(".dropdown").attr("style", "display:none;position: relative; top:-2px; background-color: #fff; padding: 16px; box-shadow: 0px 0px 5px #868585;z-index: 99999999;width: 100%;"); 
 

    var data = {
        action: 'my_action',
        id: id,
        destination: jQuery("#id_destination_hotel").val(),
        data_inicio:data_inicio, 
        data_final:data_final, 
        adt:adt, 
        chd:chd, 
        qts:qts, 
        idade1:idade1, 
        idade2:idade2, 
        idade3:idade3, 
        idade4:idade4,  
        nonce: my_ajax_object.nonce, 
        destino: destino, 
        taxonomy: 'product_cat',
        whatever: 1234
    }; 

    jQuery.post(my_ajax_object.ajax_url, data, function(response) { 

      var slug = response;

        jQuery.post("/wp-content/plugins/integracao-hoteis/includes/ajax.php", data, function(response) { 

            var data = {
              action: 'my_actiondados',
              slug: slug,
              resposta: response
            }; 

            $.ajax({
              type: "POST",
              url: my_ajax_object.ajax_url,
              data: data, 
              dataType: 'json',
              success: function(result){ 
                  window.location.href = '/produto-tag/'+result;
              }
          });
 
        });

    });
 

}
}

function seleciona_cidade(destino){
  jQuery("#destino").val(destino);
  jQuery("#destino_pesquisa").val(destino);
  jQuery("#destino_hotel").val('');
      jQuery("#dados").attr("style", "display:none; position: absolute;width: 100%;top: 48px;background-color: #fff;z-index: 999;");
}
function seleciona_hotel(nomehotel, destino, id, destination){
  jQuery("#destino").val(nomehotel);
  jQuery("#destino_pesquisa").val(nomehotel);
  jQuery("#destino_hotel").val(nomehotel);
  jQuery("#id_hotel").val(id);
  jQuery("#id_destination_hotel").val(destination);
      jQuery("#dados").attr("style", "display:none; position: absolute;width: 100%;top: 48px;background-color: #fff;z-index: 999;");
}

function limpar_campo(){
  jQuery("#destino").val('');
  jQuery("#valida_campo_destino").attr('style', 'display:none;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;');
      jQuery("#dados").attr("style", "display:none; position: absolute;width: 100%;top: 48px;background-color: #fff;z-index: 999;");

}
function replaceSpecialChars(str) {
    str = str.replace(/[Ã€ÃÃ‚ÃƒÃ„Ã…]/, "A");
    str = str.replace(/[ÃÃ¡Ã¢Ã£Ã¤Ã¥]/, "a");
    str = str.replace(/[ÃˆÃ‰ÃŠÃ‹]/, "E");
    str = str.replace(/[Ã‡]/, "C");
    str = str.replace(/[Ã§]/, "c");

    // o resto

    return str;
}
function strpos (haystack, needle, offset) {
  var i = (haystack+'').indexOf(needle, (offset || 0));
  return i === -1 ? false : true;
}
function exibe_destino(){
  jQuery("#destino_pesquisa").val('');
  if (jQuery("#destino").val().trim().length >= 3){

    var destinos_motor = JSON.parse(jQuery("#destinos_motor").val()); 

    var dados = '';
    console.log(replaceSpecialChars(jQuery("#destino").val().toUpperCase()));

    jQuery(destinos_motor).each(function (i, item) {
            var codigo_pesquisar = replaceSpecialChars(item.name_local.toUpperCase());

            var valor_pesquisado = replaceSpecialChars(jQuery("#destino").val().toUpperCase());
            console.log(strpos(replaceSpecialChars(item.name_hotel.toUpperCase()), valor_pesquisado));

            if (strpos(codigo_pesquisar, valor_pesquisado) === true) {

              if (item.name_hotel === '') { 

                dados += '<li style="list-style: none;border-bottom: 1px solid #ddd;font-size:13px;cursor:pointer;padding: 6px 15px;color: #495057;" onclick="seleciona_cidade(\''+item.name_local+'\')"><i class="fa fa-map"></i> '+item.name_local+'</li>';

              }else{

                dados += '<li style="list-style: none;border-bottom: 1px solid #ddd;font-size:13px;cursor:pointer;padding: 6px 15px;color: #495057;" onclick="seleciona_hotel(\''+item.name_hotel+'\', \''+item.name_local+'\', \''+item.id+'\', \''+item.destination+'\')"><i class="fa fa-bed"></i> '+item.name_hotel+' - '+item.name_local+'</li>';

              }
            }else if (strpos(replaceSpecialChars(item.name_hotel.toUpperCase()), valor_pesquisado) === true) {

              if (item.name_hotel === '') { 

                dados += '<li style="list-style: none;border-bottom: 1px solid #ddd;font-size:13px;cursor:pointer;padding: 6px 15px;color: #495057;" onclick="seleciona_cidade(\''+item.name_local+'\')"><i class="fa fa-map"></i> '+item.name_local+'</li>';

              }else{

                dados += '<li style="list-style: none;border-bottom: 1px solid #ddd;font-size:13px;cursor:pointer;padding: 6px 15px;color: #495057;" onclick="seleciona_hotel(\''+item.name_hotel+'\', \''+item.name_local+'\', \''+item.id+'\', \''+item.destination+'\')"><i class="fa fa-bed"></i> '+item.name_hotel+' - '+item.name_local+'</li>';

              }
            }

    });

    jQuery("#dados").html(dados);
    jQuery("#dados").attr("style", "display:block; position: absolute;width: 100%;top: 48px;background-color: #fff;z-index: 999;");

  }
}

function remove_drop_destino(){ 
      jQuery("#dados").attr("style", "display:none; position: absolute;width: 100%;top: 48px;background-color: #fff;");
}
function remove_drop_pax(){  
  jQuery("#valida_campo_destino").attr('style', 'display:none;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;');
        jQuery("#valida_campo_data").attr('style', 'display:none;margin: 0 !important;padding: 3px 10px;font-size: 10px;color: #fff;background-color: #ab0808;top: 34px;position: absolute;z-index: 99999;');
   jQuery(".dropdown").attr("style", "display:none;position: relative; top:-2px; background-color: #fff; padding: 16px; box-shadow: 0px 0px 5px #868585;z-index: 99999999;width: 100%;");
}

function send_request_woocommerce(){
  var idproduto = jQuery("#id_produto").val();

  var wp_ajax_url="<?php echo site_url();?>/wp-admin/admin-ajax.php";
            var data = {
                action: 'getCheckoutPageContent',
                product_id: idproduto,
                quantity: 1
            };

            jQuery.post( wp_ajax_url, data, function(content) {
                window.location.href = '/finalizar-compra';

            });
}