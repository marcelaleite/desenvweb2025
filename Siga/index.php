<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siga</title>
</head>
<body>
    <ul>
        <li><a href="Atividade/">Atividade</a></li>
        <li><a href="Atividade/lista_atividade.php">Lista Atividade</a></li>
        <li><a href="Usuario/">Usuário</a></li>
        <li><a href="Usuario/lista_usuario.php">Lista Usuários</a></li>
        <li><a href="Disciplina/">Disciplina</a></li>
        <li><a href="Disciplina/lista_disciplina.php">Lista Disciplinas</a></li>
    </ul>
  
    <form action="Login/logout.php" method="post">
        <input type="submit" value="Sair">
    </form>
</body>
</html>