<?php 

include 'database.php';

$sql = "SELECT * FROM transacoes ORDER BY data desc";

$result = $conexao->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$matrizResultado[] = $row;
    }
} else {
	echo "Não existe transacoes cadastradas";
	die;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Extrato de Transações</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  </head>
  <body>
  	<h1>Extrato de Transações</h1>
    <table>
    	<thead>
		  <tr>
		    <th>Categoria</th>
		    <th>Valor</th>
		    <th>Descrição</th>
		    <th>Data</th>
		    <th>Ações</th>
		  </tr>
		</thead>

	  <?php
	  $saldoTotal = 0;
	  foreach ($matrizResultado as $valor) { $saldoTotal = calculaSaldo($saldoTotal, $valor['valor'], $valor['id_categoria']); ?>
		  <tr>
		    <td><?php echo ($valor["id_categoria"] == 1) ? "Entrada" : "Saída"; ?></td>
		    <td><?php echo $valor['valor']; ?></td>
		    <td><?php echo $valor['descricao']; ?></td>
		    <td><?php echo formataDataParaBr($valor['data']); ?></td>		   		   
 		    <td><a href="<?php echo 'http://localhost/iomoney/index.php?id=' . $valor['id']; ?>"><i class="far fa-edit"></i></a> | <a href="javascript:removerRegistro(<?php echo $valor['id']; ?>);"><i class="far fa-trash-alt"></i></a> </td>
		  </tr>
	  <?php } ?>

	  	<tfoot>
	      <tr>
	      	<td>Saldo</td>
	      	<td class="saldo <?php echo ($saldoTotal > 0) ? "positivo" : "negativo" ?>"><?php echo "R$ " . $saldoTotal; ?></td>
	      	<td></td>
	      	<td></td>
	      	<td></td>
	      </tr>
	   </tfoot>

	</table>

	<a href="http://localhost/iomoney/">Nova Transação</a>

  </body>
</html>

<?php
	function formataDataParaBr($data) {
		$novaData = date('d/m/Y', strtotime($data));
		return $novaData;
	}

	function calculaSaldo($saldoTotal, $valor, $categoria) {
		if ($categoria == 1) {
			$saldoTotal = $saldoTotal + $valor;
		} else {
			$saldoTotal = $saldoTotal - $valor;
		}
		return $saldoTotal;
	}

?>

<script type="text/javascript">
	
	function removerRegistro(id) {
		if(confirm("Tem certeza que deseja remover o registro?")) {
			document.location.href = "http://localhost/iomoney/transacao_delete.php?id=" + id;
		}
	}

</script>