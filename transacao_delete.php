<?php

include "database.php";

if(isset($_GET['id'])) {
	$sql = "DELETE FROM transacoes WHERE id = {$_GET['id']}";

	if($conexao->query($sql)) {
		echo "REGISTRO REMOVIDO COM SUCESSO!\n";
	} else {
		echo "NÃO FOI POSSÍVEL REMOVER O REGISTRO, TENTE NOVAMENTE MAIS TARDE!\n";
	}

	echo "<a href='http://localhost/iomoney/listagem.php'>Todas as Transações</a>";
}

?>