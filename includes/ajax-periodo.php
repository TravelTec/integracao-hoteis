<?php  
	session_start();
	unset($_SESSION['teste']);
	$_SESSION['teste'] = '<span style="font-weight: 500"> Período: '.$_POST['start'].' a '.$_POST['end'].'</span>';
	$_SESSION['datas'] = $_POST['start'].' - '.$_POST['end'];
	echo $_SESSION['teste'];
	session_write_close();
?>