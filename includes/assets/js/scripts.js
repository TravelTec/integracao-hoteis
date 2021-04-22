jQuery(document).ready(function(){
    jQuery("#shortcode").html('Shortcode para confirmação: <span><input type="text" value="[LGPD_NEWSLETTERS]" id="myInput" style="width: 36%;background-color: #ddd;font-weight: 700;border: none;cursor: not-allowed;color:#72777c;" onclick="return copy_text_lgpd()" placeholder="[LGPD_NEWSLETTERS]"> <button type="button"  onclick="return copy_text_lgpd()" class="button button-secondary btn_copy_text">Copiar</button> </span>'); 
}); 

function copy_text_lgpd() { 

  jQuery("#myInput").select();  
  document.execCommand("copy");

  /* Alert the copied text */
  jQuery(".btn_copy_text").html("<i class='fa fa-check'></i> Copiado"); 
  jQuery("#myInput").attr("style", "width: 36%;background-color: #ddd;font-weight: 700;border: none;cursor: not-allowed;color:#72777c"); 
  setTimeout(function(){
  jQuery(".term-name-wrap").removeClass("form-invalid");
    }, 10);
  setTimeout(function(){
  jQuery(".btn_copy_text").html("Copiar"); 
  jQuery("#myInput").attr("style", "width: 36%;background-color: #ddd;font-weight: 700;border: none;cursor: not-allowed;color:#72777c"); 
    }, 2000);

} 