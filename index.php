<?php
include "conexao.php";

$nome = "";
$email = "";
$area_interesse = "";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $area_interesse = trim($_POST["area_interesse"] ?? "");

    if ($nome === "" || $email === "" || $area_interesse === "") {
        $mensagem = "Preencha todos os campos, incluindo a Área de Interesse.";
    } else {
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, area_interesse) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $area_interesse);
            if ($stmt->execute()) {
                $mensagem = "Inscrição realizada com sucesso no Hackathon SENAI!";
                $nome = "";
                $email = "";
                $area_interesse = "";
            } else {
                $mensagem = "Erro ao salvar no banco: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensagem = "Erro na estrutura do banco: " . $conexao->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackathon SENAI - Inscrição</title>
    <style>
        body {
            background-color: #111111;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #1a1a1a;
            border: 2px solid #ff0000;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            width: 100%;
            max-width: 360px;
        }

        h1 {
            color: #ff0000;
            text-align: center;
            margin-top: 0;
            font-size: 28px;
            letter-spacing: 1px;
            text-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
        }

        h2 {
            color: #aaaaaa;
            text-align: center;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .msg {
            background-color: rgba(255, 0, 0, 0.2);
            border: 1px solid #ff0000;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select {
            background-color: #262626;
            border: 1px solid #444444;
            border-radius: 4px;
            color: #ffffff;
            padding: 12px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #ff0000;
            box-shadow: 0 0 8px rgba(255, 0, 0, 0.5);
        }

        option {
            background-color: #1a1a1a;
        }

        button {
            background-color: #ff0000;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #b30000;
            box-shadow: 0 0 12px rgba(255, 0, 0, 0.6);
        }

        .btn-ver-tabela {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #aaaaaa;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-ver-tabela:hover {
            color: #ff0000;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Hackathon SENAI</h1>
        <h2>Inscrição de Competidores</h2>
        
        <?php if ($mensagem !== "") { ?>
            <div class="msg"><strong><?php echo htmlspecialchars($mensagem); ?></strong></div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" value="<?php echo htmlspecialchars($nome); ?>" required>
            
            <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>" required>
            
            <select name="area_interesse" required>
                <option value="" disabled <?php echo $area_interesse === "" ? "selected" : ""; ?>>Selecione sua Área de Interesse</option>
                <option value="Front-end" <?php echo $area_interesse === "Front-end" ? "selected" : ""; ?>>Front-end</option>
                <option value="Back-end" <?php echo $area_interesse === "Back-end" ? "selected" : ""; ?>>Back-end</option>
                <option value="Full-stack" <?php echo $area_interesse === "Full-stack" ? "selected" : ""; ?>>Full-stack</option>
                <option value="Data Science" <?php echo $area_interesse === "Data Science" ? "selected" : ""; ?>>Data Science / IA</option>
            </select>

            <button type="submit">Registrar Competidor</button>
        </form>

        <a href="usuarios.php" class="btn-ver-tabela">Ver Usuários Cadastrados →</a>
    </div>

</body>
</html>
