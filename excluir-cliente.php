<?php

    $cod = base64_decode($_GET["cod"]);

    include_once "conexao.php";

    $stmt=$con->prepare("DELETE FROM cliente WHERE cod = ?");

    $stmt->bindParam(1, $cod);

    if ($stmt->execute()) {
        $msg =  "Excluido com sucesso!!";
    } else {
        $msg = "Não foi possível excluir, tente novamente!";
    }

?>

<script>
    alert('<?php echo $msg; ?>'); //exibe a msg
    location.href='consultar-cliente.php'; // redireciona o usuário para o painel
</script>