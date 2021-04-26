<?php 

session_start();

$_SESSION['hostBanco'] = 'montenegroev_FrontOfficeMaiorca.sqlserver.dbaas.com.br';
$_SESSION['nomeBanco'] = 'montenegroev_FrontOfficeMaiorca';
$_SESSION['userBanco'] =  'montenegroev_FrontOfficeMaiorca';
$_SESSION['senhaBanco'] = 'Maiorca#2021'; 

require_once('v2/Functions/conexaoCliente.php');

function cron_job_maiorca(){
    try{
        $con = conectDB();
        $stmt = $con->prepare("EXEC FD_Executa_Todas_Procedures");
 
        if($stmt->execute()){
$stmt_exec = $con->prepare("EXEC FD_Executa_Todas_Procedures");
$stmt_exec->execute();
$stmt_exec1 = $con->prepare("EXEC FD_Executa_Todas_Procedures");
$stmt_exec1->execute();
$stmt_exec2 = $con->prepare("EXEC FD_Executa_Todas_Procedures");
$stmt_exec2->execute();

            $stmt = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184488'");
$stmt->execute();
$stmt2 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184285'");
$stmt2->execute();
$stmt3 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184284'");
$stmt3->execute();
$stmt4 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00183706'");
$stmt4->execute();
$stmt5 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00182899'");
$stmt5->execute();
$stmt6 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00183702'");
$stmt6->execute();
$stmt7 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184220'");
$stmt7->execute();
$stmt8 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184232'");
$stmt8->execute();
$stmt9 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184222'");
$stmt9->execute();
$stmt10 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184204'");
$stmt10->execute();
$stmt11 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184228'");
$stmt11->execute();
$stmt12 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184488'");
$stmt12->execute();
$stmt13 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184285'");
$stmt13->execute();
$stmt14 = $con->prepare("update fd_faturas set Excluir = 'SIM', Status = 'Recebida' WHERE Fatura = 'FT00184284'");
$stmt14->execute();
        }else{
            return false;
        }
    }catch (PDOException $e){
        echo "Error" . $e->getMessage();
    }

}

cron_job_maiorca();

?>