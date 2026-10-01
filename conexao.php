<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "cadastro_kenj";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$conexao->set_charset("utf8");
?>
