<?php include 'conexao.php';

  if (isset($_GET["estado"]) && !empty($_GET["estado"])) {

    $sql_uf = "SELECT * FROM estados ORDER BY nome";
    
    $query_uf = $conn->query($sql_uf) or die($conn->error);
    
    $estado = $conn->escape_string($_GET["estado"]);

    $sql_cidade = "SELECT * FROM cidades WHERE id_estado = '$estado' ORDER BY nome";
    
    $query_cidade = $conn->query($sql_cidade) or die($conn->error);
  }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Cidades</title>
</head>
<body>
  
  <form action="" method="get">
    <select name="estado" required>
      <option value="">Selecione um Estado:</option>
      <?php while ($estado = $query_uf->fetch_assoc()) { ?>
        <option value="<?php echo $estado['id']; ?>"
          <?php if (isset($_GET['estado']) && $_GET['estado'] == $estado['id']) echo "selected" ?>
        >
          <?php echo utf8_decode($estado['nome']); ?>
        </option>
      <?php } ?>
    </select>

    <button type="submit">Avançar</button>

    <?php if(isset($_GET['estado'])) { ?>
      <select name="cidade">
        <option value="">Selecione uma cidade</option>
          <?php while ($cidade = $query_cidade->fetch_assoc()) { ?>
            <option value="<?php echo $cidade['id']; ?>">
              <?php echo utf8_decode($cidade['nome']); ?>
            </option>
          <?php } ?>
      </select>
    <?php } ?>
  </form>
</body>
</html>