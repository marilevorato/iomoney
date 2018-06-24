<?php

include "database.php";

if(isset($_GET['id'])) {
	$sql = "SELECT * FROM transacoes WHERE id = " . $_GET['id'];
	$result = $conexao->query($sql);
	if($result->num_rows > 0) {
		$transacao = $result->fetch_assoc();

	}
}	

?>

<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Extrato</title>
  </head>
  <body>
    <h1>Extrato</h1>
    <form action="transacao_form.php" method="post">
    	<input type="hidden" value="<?php echo (isset($transacao)) ? $transacao["id"] : ""; ?>" name="id">
		<label for="categoria">Categoria</label>
		<select name="categoria" required>
		  <option value=""></option>
		  <option <?php echo (isset($transacao) && $transacao["id_categoria"] == 1) ? 'selected' : ''; ?> value="1">Entrada</option>
		  <option <?php echo (isset($transacao) && $transacao["id_categoria"] == 2) ? 'selected' : ''; ?> value="2">Saída</option>
		</select><br><br>
		<label for="valor">Valor</label>
		<input type="number" step="0.01" name="valor" value="<?php echo (isset($transacao)) ? $transacao["valor"] : ""; ?>" required><br><br>
		<label for="descricao">Descrição</label>
		<input type="text" name="descricao" value="<?php echo (isset($transacao)) ? $transacao["descricao"] : ""; ?>" required><br><br>
		<label for="data">Data</label>
		<input type="date" name="data" value="<?php echo (isset($transacao)) ? $transacao["data"] : ""; ?>" required><br><br>
		<input type="submit" name="enviar" value="Enviar">
    </form>
    <br>
    <a href="http://localhost/iomoney/listagem.php"> Todas as Transações </a>

  </body>
</html>
