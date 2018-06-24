<?php 

include "database.php";

if(!isset($_POST['enviar'])) {
	echo "AINDA NÃO EXISTE NENHUM DADO NO POST!";
	die;
}

if(isset($_POST['id']) && ($_POST['id'] != '' && $_POST['id'] != null)) {
	$sql = "UPDATE transacoes SET valor = {$_POST['valor']}, descricao = '{$_POST['descricao']}', data = '{$_POST['data']}', id_categoria = {$_POST['categoria']} WHERE id =  {$_POST['id']} ";
} else {
	$sql = "INSERT INTO transacoes VALUES (null, " . $_POST['valor'] . ", '" . $_POST['descricao'] . "', '" . $_POST['data'] . "','"  . $_POST['categoria'] . "' )";
}


if($conexao->query($sql)) {
	 $redirect = "http://localhost/iomoney/listagem.php";
	 header("location:$redirect");
} else {
	echo "NÃO FOI POSSÍVEL EXECUTAR A QUERY: \n" . $sql;
}

?>
