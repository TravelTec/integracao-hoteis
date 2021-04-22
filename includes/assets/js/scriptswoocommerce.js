jQuery(document).ready(function(){ 
    jQuery(".demo_options").attr("style", "display:none"); 
    jQuery(".est_options").attr("style", "display:none"); 
    jQuery(".tar_options").attr("style", "display:none"); 
    jQuery(".acomodacao_options").attr("style", "display:none");  

    jQuery("#tar_valor_final_product_info2").attr("onKeyPress", "return(moeda(this,\".\",\",\",event))"); 

    jQuery("#tar_idade_crianca_product_info").mask("00");
    jQuery("#tar_idade_crianca_product_info1").mask("00");
    jQuery("#tar_idade_crianca_product_info2").mask("00");
    jQuery("#tar_idade_crianca_product_info3").mask("00");
    jQuery("#tar_idade_crianca_product_info4").mask("00");
    jQuery("#tar_idade_crianca_product_info5").mask("00");
    jQuery("#tar_idade_crianca_product_info6").mask("00");
    jQuery("#tar_idade_crianca_product_info7").mask("00");
    jQuery("#tar_idade_crianca_product_info8").mask("00");
    jQuery("#tar_idade_crianca_product_info9").mask("00");

    jQuery("#tar_qtd_limite").mask("00");
    jQuery("#tar_qtd_limite1").mask("00");
    jQuery("#tar_qtd_limite2").mask("00");
    jQuery("#tar_qtd_limite3").mask("00");
    jQuery("#tar_qtd_limite4").mask("00");
    jQuery("#tar_qtd_limite5").mask("00");
    jQuery("#tar_qtd_limite6").mask("00");
    jQuery("#tar_qtd_limite7").mask("00");
    jQuery("#tar_qtd_limite8").mask("00");
    jQuery("#tar_qtd_limite9").mask("00");

    jQuery("#tar_periodo_product_info").attr("autocomplete", "off");
    jQuery("#tar_periodo_final_product_info").attr("autocomplete", "off");
    jQuery("#tar_periodo_product_info1").attr("autocomplete", "off");
    jQuery("#tar_periodo_final_product_info1").attr("autocomplete", "off");
    jQuery("#tar_periodo_product_info2").attr("autocomplete", "off");
    jQuery("#tar_periodo_final_product_info2").attr("autocomplete", "off");
    jQuery("#tar_periodo_product_info3").attr("autocomplete", "off");
    jQuery("#tar_periodo_final_product_info3").attr("autocomplete", "off");
    jQuery("#tar_periodo_product_info4").attr("autocomplete", "off");
    jQuery("#tar_periodo_final_product_info4").attr("autocomplete", "off");
    jQuery("#tar_periodo_product_info5").attr("autocomplete", "off");
    jQuery("#tar_periodo_final_product_info5").attr("autocomplete", "off");
    jQuery("#tar_periodo_product_info6").attr("autocomplete", "off");
    jQuery("#tar_periodo_final_product_info6").attr("autocomplete", "off");

    jQuery('.valor').mask('00.000.000,00', {
    reverse: true
});
jQuery('#tar_valor_final_product_info1').mask('00.000.000,00', {
    reverse: true
});
jQuery('#tar_valor_final_product_info2').mask('00.000.000,00', {
    reverse: true
});
jQuery('#tar_valor_final_product_info3').mask('00.000.000,00', {
    reverse: true
});
jQuery('#tar_valor_final_product_info4').mask('00.000.000,00', {
    reverse: true
});
jQuery('#tar_valor_final_product_info5').mask('00.000.000,00', {
    reverse: true
}); 


jQuery('#valor_taxas').mask('00.000.000,00', {
    reverse: true
}); 
jQuery('#valor_taxas1').mask('00.000.000,00', {
    reverse: true
}); 
jQuery('#valor_taxas2').mask('00.000.000,00', {
    reverse: true
}); 
jQuery('#valor_taxas3').mask('00.000.000,00', {
    reverse: true
}); 
jQuery('#valor_taxas4').mask('00.000.000,00', {
    reverse: true
}); 
jQuery('#valor_taxas5').mask('00.000.000,00', {
    reverse: true
}); 
jQuery('#valor_taxas6').mask('00.000.000,00', {
    reverse: true
}); 
jQuery('#valor_taxas7').mask('00.000.000,00', {
    reverse: true
}); 

jQuery(document).on('focusout','#tar_valor_final_product_info',function(){
  if (jQuery('#tar_valor_final_product_info').val() == 0 || jQuery('#tar_valor_final_product_info').val() == '0,00') {
    alert("O valor da diária não pode ser zerado.");
  }
});

jQuery(document).on('focusout','#tar_valor_final_product_info1',function(){
  if (jQuery('#tar_valor_final_product_info1').val() == 0 || jQuery('#tar_valor_final_product_info1').val() == '0,00') {
    alert("O valor da diária não pode ser zerado.");
  }
});

jQuery(document).on('focusout','#tar_valor_final_product_info2',function(){
  if (jQuery('#tar_valor_final_product_info2').val() == 0 || jQuery('#tar_valor_final_product_info2').val() == '0,00') {
    alert("O valor da diária não pode ser zerado.");
  }
});

jQuery(document).on('focusout','#tar_valor_final_product_info3',function(){
  if (jQuery('#tar_valor_final_product_info3').val() == 0 || jQuery('#tar_valor_final_product_info3').val() == '0,00') {
    alert("O valor da diária não pode ser zerado.");
  }
});

jQuery(document).on('focusout','#tar_valor_final_product_info4',function(){
  if (jQuery('#tar_valor_final_product_info4').val() == 0 || jQuery('#tar_valor_final_product_info4').val() == '0,00') {
    alert("O valor da diária não pode ser zerado.");
  }
});

}); 



jQuery(document).on('change','#product-type',function(){
    var tipo = jQuery("#product-type").val();

    if (tipo == "demo") {
        jQuery(".general_options").attr("style", "display:none");
        jQuery(".shipping_options").attr("style", "display:none");
        jQuery(".linked_product_options").attr("style", "display:none");
        jQuery(".attribute_options").attr("style", "display:none"); 
        jQuery(".advanced_options").attr("style", "position: absolute;top: 123px;z-index: 1;width: 100%;"); 

    jQuery(".demo_options").attr("style", ""); 
    jQuery(".est_options").attr("style", ""); 
    jQuery(".tar_options").attr("style", ""); 
    jQuery(".acomodacao_options").attr("style", "");  
        jQuery(".demo_options").addClass("active"); 

        // Panels
        jQuery("#general_product_data").attr("style", "display:none"); 
        jQuery("#inventory_product_data").attr("style", "display:none"); 
        jQuery("#variable_product_options").attr("style", "display:none"); 
        jQuery("#advanced_product_data").attr("style", "display:none"); 
        jQuery("#product_attributes").attr("style", "display:none"); 
        jQuery("#linked_product_data").attr("style", "display:none"); 
        jQuery("#shipping_product_data").attr("style", "display:none");    
        jQuery("#demo_product_options").attr("style", "display:block");  
    }
} );

function exibe_div_table(){
    jQuery(".div_dias").toggle(2200);
}
function exibe_div_table_append(contador){
    jQuery(".div_dias"+contador).toggle(2200);
}
function remove_div(contador){
    jQuery(".dados_tarifario"+contador).remove();
}

function adicionar_tarifa(){
    var iti_index =
            0 < jQuery("#table_append_repeater").length
                ? jQuery("#table_append_repeater").length + 1
                : 1;

                var template = wp.template("wc-add-tarifa-row"); 

    jQuery("#table_append_repeater_holder").append(
        template({ key: iti_index })
    ); 



    jQuery("#tar_valor_final_product_info"+iti_index).addClass("valor");

    jQuery('#tar_periodo_product_info'+iti_index)
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
        onSelect: function (selectedDate) {
            //Limpamos a segunda data, para evitar problemas do usuário ficar trocando a data do primeiro datepicker e acabar burlando as regras definidas.
            jQuery.datepicker._clearDate(jQuery("#tar_periodo_final_product_info"+iti_index));
            //Aqui está a "jogada" para somar os 7 dias para o próximo datepicker.
            var data = jQuery.datepicker.parseDate('dd/mm/yy', selectedDate); 
            jQuery("#tar_periodo_final_product_info"+iti_index).datepicker("option", "minDate", data); //Aplica a data
        }
    });
    jQuery('#tar_periodo_final_product_info'+iti_index)
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info'+iti_index).mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info'+iti_index).mask("00/00/0000");  

    jQuery('#tar_valor_final_product_info'+iti_index).mask('00.000.000,00', {
    reverse: true
}); 
    jQuery("#tar_idade_crianca_product_info"+iti_index).mask("00");

    jQuery("#tar_qtd_limite"+iti_index).mask("00");


        ++iti_index;
}
 
jQuery(function() {
    jQuery('#tar_periodo_product_info')
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
        onSelect: function (selectedDate) {
            //Limpamos a segunda data, para evitar problemas do usuário ficar trocando a data do primeiro datepicker e acabar burlando as regras definidas.
            jQuery.datepicker._clearDate(jQuery("#tar_periodo_final_product_info"));
            //Aqui está a "jogada" para somar os 7 dias para o próximo datepicker.
            var data = jQuery.datepicker.parseDate('dd/mm/yy', selectedDate); 
            jQuery("#tar_periodo_final_product_info").datepicker("option", "minDate", data); //Aplica a data
        }
    });
    jQuery('#tar_periodo_final_product_info')
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info').mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info').mask("00/00/0000");



    jQuery('#tar_periodo_product_info1')
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
        onSelect: function (selectedDate) {
            //Limpamos a segunda data, para evitar problemas do usuário ficar trocando a data do primeiro datepicker e acabar burlando as regras definidas.
            jQuery.datepicker._clearDate(jQuery("#tar_periodo_final_product_info1"));
            //Aqui está a "jogada" para somar os 7 dias para o próximo datepicker.
            var data = jQuery.datepicker.parseDate('dd/mm/yy', selectedDate); 
            jQuery("#tar_periodo_final_product_info1").datepicker("option", "minDate", data); //Aplica a data
        }
    });
    jQuery('#tar_periodo_final_product_info1')
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info1').mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info1').mask("00/00/0000");



    jQuery('#tar_periodo_product_info2')
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
        onSelect: function (selectedDate) {
            //Limpamos a segunda data, para evitar problemas do usuário ficar trocando a data do primeiro datepicker e acabar burlando as regras definidas.
            jQuery.datepicker._clearDate(jQuery("#tar_periodo_final_product_info2"));
            //Aqui está a "jogada" para somar os 7 dias para o próximo datepicker.
            var data = jQuery.datepicker.parseDate('dd/mm/yy', selectedDate); 
            jQuery("#tar_periodo_final_product_info2").datepicker("option", "minDate", data); //Aplica a data
        }
    });
    jQuery('#tar_periodo_final_product_info2')
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info2').mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info2').mask("00/00/0000");




    jQuery('#tar_periodo_product_info3')
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
        onSelect: function (selectedDate) {
            //Limpamos a segunda data, para evitar problemas do usuário ficar trocando a data do primeiro datepicker e acabar burlando as regras definidas.
            jQuery.datepicker._clearDate(jQuery("#tar_periodo_final_product_info3"));
            //Aqui está a "jogada" para somar os 7 dias para o próximo datepicker.
            var data = jQuery.datepicker.parseDate('dd/mm/yy', selectedDate); 
            jQuery("#tar_periodo_final_product_info3").datepicker("option", "minDate", data); //Aplica a data
        }
    });
    jQuery('#tar_periodo_final_product_info3')
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info3').mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info3').mask("00/00/0000");



    jQuery('#tar_periodo_product_info4')
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
        onSelect: function (selectedDate) {
            //Limpamos a segunda data, para evitar problemas do usuário ficar trocando a data do primeiro datepicker e acabar burlando as regras definidas.
            jQuery.datepicker._clearDate(jQuery("#tar_periodo_final_product_info4"));
            //Aqui está a "jogada" para somar os 7 dias para o próximo datepicker.
            var data = jQuery.datepicker.parseDate('dd/mm/yy', selectedDate); 
            jQuery("#tar_periodo_final_product_info4").datepicker("option", "minDate", data); //Aplica a data
        }
    });
    jQuery('#tar_periodo_final_product_info4')
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info4').mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info4').mask("00/00/0000");



    jQuery('#tar_periodo_product_info5')
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
        onSelect: function (selectedDate) {
            //Limpamos a segunda data, para evitar problemas do usuário ficar trocando a data do primeiro datepicker e acabar burlando as regras definidas.
            jQuery.datepicker._clearDate(jQuery("#tar_periodo_final_product_info5"));
            //Aqui está a "jogada" para somar os 7 dias para o próximo datepicker.
            var data = jQuery.datepicker.parseDate('dd/mm/yy', selectedDate); 
            jQuery("#tar_periodo_final_product_info5").datepicker("option", "minDate", data); //Aplica a data
        }
    });
    jQuery('#tar_periodo_final_product_info5')
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info5').mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info5').mask("00/00/0000");



    jQuery('#tar_periodo_product_info6')
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
        onSelect: function (selectedDate) {
            //Limpamos a segunda data, para evitar problemas do usuário ficar trocando a data do primeiro datepicker e acabar burlando as regras definidas.
            jQuery.datepicker._clearDate(jQuery("#tar_periodo_final_product_info6"));
            //Aqui está a "jogada" para somar os 7 dias para o próximo datepicker.
            var data = jQuery.datepicker.parseDate('dd/mm/yy', selectedDate); 
            jQuery("#tar_periodo_final_product_info6").datepicker("option", "minDate", data); //Aplica a data
        }
    });
    jQuery('#tar_periodo_final_product_info6')
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info6').mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info6').mask("00/00/0000");




    jQuery('#tar_periodo_product_info7')
    .datepicker({
      language: 'pt-BR',
      minDate: new Date(),
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_final_product_info7')
    .datepicker({
      language: 'pt-BR', 
      autoClose: true,
      dateFormat: 'dd/mm/yy',
    });
    jQuery('#tar_periodo_product_info7').mask("00/00/0000");
    jQuery('#tar_periodo_final_product_info7').mask("00/00/0000");

});



        function moeda(a, e, r, t) {
            let n = ""
              , h = j = 0
              , u = tamanho2 = 0
              , l = ajd2 = ""
              , o = window.Event ? t.which : t.keyCode;
              a.value = a.value.replace('R$ ','');            
            if (n = String.fromCharCode(o),
            -1 == "0123456789".indexOf(n))
                return !1;
            for (u = a.value.replace('R$ ','').length,
            h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
                ;
            for (l = ""; h < u; h++)
                -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
            if (l += n,
            0 == (u = l.length) && (a.value = ""),
            1 == u && (a.value = "0" + r + "0" + l),
            2 == u && (a.value = "0" + r + l),
            u > 2) {
                for (ajd2 = "",
                j = 0,
                h = u - 3; h >= 0; h--)
                    3 == j && (ajd2 += e,
                    j = 0),
                    ajd2 += l.charAt(h),
                    j++;
                for (a.value = "",
                tamanho2 = ajd2.length,
                h = tamanho2 - 1; h >= 0; h--)
                    a.value += ajd2.charAt(h);
                a.value += r + l.substr(u - 2, u)
            }
            return !1
        } 
function toggle_input_valor_taxa(){
  jQuery("#valor_taxas").toggle(1500);
}
function toggle_input_valor_taxa1(){
  jQuery("#valor_taxas1").toggle(1500);
}
function toggle_input_valor_taxa2(){
  jQuery("#valor_taxas2").toggle(1500);
}
function toggle_input_valor_taxa3(){
  jQuery("#valor_taxas3").toggle(1500);
}
function toggle_input_valor_taxa4(){
  jQuery("#valor_taxas4").toggle(1500);
}
function toggle_input_valor_taxa5(){
  jQuery("#valor_taxas5").toggle(1500);
}
function toggle_input_valor_taxa6(){
  jQuery("#valor_taxas6").toggle(1500);
}
function toggle_input_valor_taxa7(){
  jQuery("#valor_taxas7").toggle(1500);
}