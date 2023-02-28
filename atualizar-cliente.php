<?php

// Atualização no em banco de dados

// 1 - Resgatar os dados do form
$cod = base64_decode($_POST["cod"]);
$nome = $_POST["nome"];
$email = $_POST["email"];
$cpf = $_POST["cpf"];
$estadocivil = $_POST["estadocivil"];

include_once "conexao.php";

// 3 - Preparar a instrução de gravação
//stmt -> statement
$stmt = $con->prepare("UPDATE cliente SET nome = ?, email = ?, cpf = ?, estadocivil = ? WHERE cod = ?");
$stmt->bindParam(1, $nome);
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $cpf);
$stmt->bindParam(4, $estadocivil);
$stmt->bindParam(5, $cod);

// 4 - Executar a instrução
if ($stmt->execute()) {
    $msg =  "Cliente atualizado com sucesso!";
} else {
    $msg = "Não foi possível atualizar, tente novamente!";
}
?>

<script>
    alert('<?php echo $msg ?>'); // exibe a msg
    location.href='cadastrar-cliente.php'; // redireciona o usuário para o painel
</script>