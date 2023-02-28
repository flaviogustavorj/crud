<?php

// gravação no em banco de dados

// 1 - Resgatar os dados do form
$nome = $_POST["nome"];
$email = $_POST["email"];
$cpf = $_POST["cpf"];
$estadocivil = $_POST["estadocivil"];

include_once "conexao.php";

// 3 - Preparar a instrução de gravação
//stmt -> statement
$stmt = $con->prepare("INSERT INTO cliente VALUES(NULL, ?, ?, ?, ?)");
$stmt->bindParam(1, $nome);
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $cpf);
$stmt->bindParam(4, $estadocivil);

// 4 - Executar a instrução
if ($stmt->execute()) {
    $msg =  "Cliente cadastrado com sucesso!";
} else {
    $msg = "Não foi possível cadastrar, tente novamente!";
}
?>

<script>
    alert('<?php echo $msg ?>'); // exibe a msg
    location.href='cadastrar-cliente.php'; // redireciona o usuário para o painel
</script>