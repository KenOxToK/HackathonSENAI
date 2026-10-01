<?php
include "conexao.php";
$resultado = $conexao->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cadastros - Hackathon SENAI</title>
    <style>
        body {
            background-color: #111111;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
        }

        .voltar {
            display: inline-block;
            margin-bottom: 25px;
            text-decoration: none;
            color: #ff0000;
            font-weight: bold;
            transition: 0.3s;
        }

        .voltar:hover {
            text-shadow: 0 0 8px rgba(255, 0, 0, 0.6);
        }

        h1 {
            color: #ff0000;
            letter-spacing: 1px;
            text-shadow: 0 0 5px rgba(255, 0, 0, 0.4);
            margin-bottom: 30px;
        }

        .table-container {
            background-color: #1a1a1a;
            border: 1px solid #ff0000;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.2);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1a1a1a;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #333333;
        }

        th {
            background-color: #262626;
            color: #ff0000;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:hover {
            background-color: #222222;
        }

        td {
            color: #dddddd;
            font-size: 15px;
        }

        .sem-registro {
            text-align: center;
            color: #888888;
            padding: 30px;
        }
    </style>
</head>
<body>

    <a href="index.php" class="voltar">← Voltar para o Formulário</a>

    <h1>Competidores Cadastrados</h1>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Área de Interesse</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($resultado && $resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) { 
                ?>
                    <tr>
                        <td style="color: #ff0000; font-weight: bold;"><?php echo htmlspecialchars($linha['id']); ?></td>
                        <td><?php echo htmlspecialchars($linha['nome']); ?></td>
                        <td><?php echo htmlspecialchars($linha['email']); ?></td>
                        <td><?php echo htmlspecialchars($linha['area_interesse']); ?></td>
                    </tr>
                <?php 
                    } 
                } else { 
                ?>
                    <tr>
                        <td colspan="4" class="sem-registro">Nenhum participante cadastrado até o momento.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
