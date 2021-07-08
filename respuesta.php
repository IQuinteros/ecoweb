<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Respuesta</title>
</head>

<body>
  <ul>
    <li><a href="home.php">home</a></li>
    <li><a href="pedidos.php">pedidos</a>
    <li>
    <li><a href="Chats.php">Chats</a>
    <li>
    <li><a href="preguntas.php">preguntas</a>
    <li>
    <li><a href="valoraciones.php">valoraciones</a>
    <li>
    <li><a href="inventario.php">inventario</a>
    <li>
    <li><a href="reportes.php">reportes</a>
    <li>
    <li><a href="perfil.php">perfil</a>
    <li>
  </ul>
  <?php
  $id_question = $_GET['id_question']; //da error si se abre esta pagina directamente por que no recibe el dato de la pagina pregunta.php
  require_once('include.php');
  ini_set('display_errors', 1);
  error_reporting(~0);
  require_once __DIR__ . ('/api/query/answer.php');
  $answerConnection = new answer();
  ?>
  <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> method="POST">
    <label for="anwer">respuesta:</label>
    <textarea name="anwer" placeholder="mensaje" id="anwer"></textarea>

    <button value="submit" name="submit">enviar respuesta</button>
  </form>
  <?php
  if (isset($_POST['submit'])) {
    $answer = $_POST['anwer'];
    $objet = (json_decode(json_encode(array("answer" => $answer, "id_question" => $id_question))));

    $insert_answer = $answerConnection->insert_answer($objet);
  }
  ?>
</body>

</html>