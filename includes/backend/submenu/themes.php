<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style type="text/css">
    body{
        background-color: #f1f1f1 !important;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 style="font-size: 22px">Visão geral do calendário</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="">
            <div style="">
                <a><button class="btn btn-default" style="margin-right: -5px;background-color: #797979;color: #fff;margin-bottom: -1px;border-radius: 5px 5px 0px 0px;padding: 5px 15px;font-size: 13px;"><i class="fa fa-fire"></i> <strong>Ações</strong></button></a> 
            </div>
        </div>
        <div class="col-lg-12" style="">
            <div style="padding: 10px;border: 1px solid #ccc;">
                <a onclick="diminui_mes()"><button class="btn btn-default btn_minus" style="margin-right: -5px;"><i class="fa fa-arrow-left"></i></button></a>
                <input type="text" name="" id="description_month" disabled="" style="text-align: center;height: 34px;width: 250px;font-size: 18px;font-weight: 600;position: relative;top: 2px;" value="Abril/2021">
                <a onclick="acrescenta_mes()"><button class="btn btn-default btn_plus" style="margin-left: -5px;"><i class="fa fa-arrow-right"></i></button></a>
                <input type="hidden" name="" id="month" value="4">
            </div>
        </div>
    </div>
    <br>
    
    <?php for ($x=1; $x < 13; $x++) {  ?>
        <?php 
            if ($x < 10) {
                $conta_mes = "0".$x;
            }else{
                $conta_mes = $x;
            }

            if ($conta_mes == "01") {
                $conta_dias = 32;
            }else if ($conta_mes == "02") {
                $conta_dias = 29;
            }else if ($conta_mes == "03") {
                $conta_dias = 32;
            }else if ($conta_mes == "04") {
                $conta_dias = 31;
            }else if ($conta_mes == "05") {
                $conta_dias = 32;
            }else if ($conta_mes == "06") {
                $conta_dias = 31;
            }else if ($conta_mes == "07") {
                $conta_dias = 32;
            }else if ($conta_mes == "08") {
                $conta_dias = 32;
            }else if ($conta_mes == "09") {
                $conta_dias = 31;
            }else if ($conta_mes == "10") {
                $conta_dias = 32;
            }else if ($conta_mes == "11") {
                $conta_dias = 31;
            }else if ($conta_mes == "01") {
                $conta_dias = 32;
            }
        ?>
        <div id="<?=$conta_mes?>" style="background-color: #fff;padding-bottom: 14px;<?=($conta_mes == date("m") ? 'display:block' : 'display: none')?>">
            <div id="head" style="background-color: #fff;padding-top: 10px">
                <div class="row" id="<?=$conta_mes?>" style="height: 35px">
                    <div class='col-lg-2' style="border-right: 2px solid #b90c0c;height: 35px;"></div>
                    <div class="col-lg-10">
                        <table>
                            <tbody>
                                <tr>
                                    <?php for ($y=1; $y < $conta_dias; $y++) { ?> 
                                        <td style="padding: 0px 7.2px;border: 1px solid #bbb;height: 35px;"><?=$y?></td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            <?php  
                $args = array( 
                    'post_type'   => 'shop_order', 
                    'post_status' => 'wc-completed, wc-processing',
                    'numberposts' => 100
                ); 
                $my_posts = new WP_Query( $args );  

                $contador = 0;

                if( $my_posts->have_posts() ) :
                    while( $my_posts->have_posts() ) : $my_posts->the_post();   

                        $post = get_post();  
                        $title = $post->post_title;
                        $id = $post->ID;   

                        $order = wc_get_order( $id );
                        $order_id  = $order->get_id();
                        $data = $order->get_data();

                        $dados = array_values($data['line_items'])[0]->get_data();
                        $meta_data = $dados['meta_data'];
                        for ($i=0; $i < count($meta_data); $i++) { 
                            $data = $meta_data[$i]->get_data();
                            if ($data['key'] == 'datas') {
                                $periodo = explode(" - ", $data['value']);

                                $data_inicial = explode("/", $periodo[0]);
                                $data_final = explode("/", $periodo[1]);
                            }
                        } 

                        if($data_inicial[1] == $conta_mes){
                            $contador++;
            ?>
                            <div class="row" style="height: 35px">
                                <div class='col-lg-2' style="border-right: 2px solid #b90c0c;height: 35px;">
                                    <a href="/wp-admin/post.php?post=<?=$id?>&action=edit"><h4 style="margin: 0;font-size: 18px;padding: 6px 10px;">Reserva nº <?=$id?></h4></a>
                                </div>
                                <div class="col-lg-10">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <?php for ($i=1; $i < $conta_dias; $i++) { ?>  
                                                    <?php if ($i >= intval($data_inicial[0]) && $i <= intval($data_final[0])) { ?>
                                                        <td style="padding: 0px 7.2px;border: 1px solid #3355fd;height: 35px;background-color: #3355fd;color: #3355fd;font-size: 14px;"><?=$i?></td>
                                                    <?php }else{ ?>
                                                        <td style="padding: 0px 7.2px;border: 1px solid #bbb;height: 35px;color: #d4d4d4;font-size: 14px;"><?=$i?></td>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
            <?php  
                        } 
                    endwhile;
                endif; 

                if ($contador == 0) { 
            ?>
                    <div class="row" style="height: 35px">
                        <div class='col-lg-12 text-center' style="height: 35px;">
                            <h5 style="margin-top: 15px">Nenhuma reserva encontrada para o mês selecionado.</h5>
                        </div> 
                    </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<script type="text/javascript">
    function acrescenta_mes(){
        var month = $("#month").val();
        
        $(".btn_minus").prop("disabled", false);
        $(".btn_plus").prop("disabled", false);

        if (month == "00" || month == "01") {
            $(".btn_minus").prop("disabled", true);
            $("#description_month").val("Janeiro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "02") {
            $("#description_month").val("Fevereiro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "03") {
            $("#description_month").val("Março/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "04") {
            $("#description_month").val("Abril/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "05") {
            $("#description_month").val("Maio/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "06") {
            $("#description_month").val("Junho/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "07") {
            $("#description_month").val("Julho/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "08") {
            $("#description_month").val("Agosto/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "09") {
            $("#description_month").val("Setembro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "10") {
            $("#description_month").val("Outubro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "11") {
            $("#description_month").val("Novembro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "12") {
            $(".btn_plus").prop("disabled", true);
            $("#description_month").val("Dezembro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
        }

        if (month == 0) { 
            $("#month").val("01");
        }else{
            if (month < 10) {
                month = parseInt(month)+1;
                $("#month").val("0"+month);
            }else{
                month = parseInt(month)+1;
                $("#month").val(month);
            }
        }
    }
    function diminui_mes(){
        var month = $("#month").val();
        
        $(".btn_minus").prop("disabled", false);
        $(".btn_plus").prop("disabled", false);

        if (month == "00" || month == "01") {
            $(".btn_minus").prop("disabled", true);
            $("#description_month").val("Janeiro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "02") {
            $("#description_month").val("Fevereiro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "03") {
            $("#description_month").val("Março/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "04") {
            $("#description_month").val("Abril/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "05") {
            $("#description_month").val("Maio/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "06") {
            $("#description_month").val("Junho/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "07") {
            $("#description_month").val("Julho/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "08") {
            $("#description_month").val("Agosto/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "09") {
            $("#description_month").val("Setembro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "10") {
            $("#description_month").val("Outubro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "11") {
            $("#description_month").val("Novembro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
        }else if (month == "12") {
            $(".btn_plus").prop("disabled", true);
            $("#description_month").val("Dezembro/2021");
            $("#01").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#02").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#03").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#04").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#05").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#06").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#07").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#08").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#09").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#10").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#11").attr("style", "background-color: #fff;padding-bottom: 14px;display:none");
            $("#12").attr("style", "background-color: #fff;padding-bottom: 14px;display:block");
        }

        if (month == 0) { 
            $("#month").val("01");
        }else{
            if (month < 10) {
                month = parseInt(month)-1;
                $("#month").val("0"+month);
            }else{
                month = parseInt(month)-1;
                $("#month").val(month);
            }
        }
    }
</script>










