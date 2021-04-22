jQuery(window).on("load", function () {
    atualiza_cadastro();

    
}); 

function atualiza_cadastro() {
    var email = jQuery("#email").val();
    var token = jQuery("#token").val();

    if (email == "") {
        swal({
            title: "Acesso não permitido.",
            text: "Você será redirecionado para a página inicial.",
            type: "warning",
        }).then((value) => {
            window.location.href = "/";
        });
    } else {
        var token = jQuery("#token").val();

        var settings = {
            async: true,
            crossDomain: true,
            url: "https://api.traveltec.com.br/serv/marketing/atualiza_cadastro",
            method: "POST",
            headers: {
                token: token,
                email: email,
                "cache-control": "no-cache",
            },
        };

        jQuery.ajax(settings).done(function (response) { 
                jQuery("#loader").attr("style", "display:none");
                jQuery("#message").attr("style", "display:block");

                setTimeout(function () {
                    window.location = "/";
                }, 6000); 
        });
    }
} 