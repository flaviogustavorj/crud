<?php

include_once "autenticacao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title>Sistema CRUD</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https//cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include "layout/sidebar.php";
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include "layout/topbar.php";
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Consulta de Clientes</h1>
                    <p>Digite para pesquisar</p>

                    <form action="consultar-cliente.php" method="get" class="form-inline" autocomplete="off">

                        <input type="text" class="form-control mr-2" name="busca" placeholder="Nome, email ou cpf">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                        <!-- <button type="submit" class="btn btn-dark ml-2"><i class="fas fa-eraser"></i></button> -->

                    </form>

                    <?php
                    //Resgatando o dado que veio pelo método get
                    //isset() -> verifica se a variável existe e é diferente de null
                    if (isset($_GET["busca"])) {
                        $busca = $_GET["busca"];

                        include_once "conexao.php";

                        $stmt = $con->prepare("SELECT * FROM cliente WHERE nome LIKE ? '%' OR email = ? OR cpf = ? ORDER BY nome ");
                        $stmt->bindParam(1, $busca);
                        $stmt->bindParam(2, $busca);
                        $stmt->bindParam(3, $busca);

                        // executa a busca
                        $stmt->execute();

                        //verifica se a busca retornou algum registro
                        if ($stmt->rowCount() >= 1) {
                            // echo "Encontrou";
                    ?>
                            <table class="table mt-3 text-center">
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>CPF</th>
                                    <th>Estado Civil</th>
                                    <th>Editar</th>
                                    <?php

                                        if($_SESSION["perfil"] == "adm") {

                                    
                                    ?>
                                    <th>Excluir</th>

                                    <?php
                                        }
                                    ?>
                                </tr>

                                <?php
                                while ($row = $stmt->fetch()) {
                                    //var_dump($row);

                                ?>
                                    <tr>
                                        <td><?php echo $row['nome']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['cpf']; ?></td>
                                        <td><?php echo $row['estadocivil']; ?></td>
                                        <td class="text-center"><a href="editar-cliente.php?cod=<?php echo base64_encode($row['cod']); ?>"><i class="fas fa-user-edit text-info"></i></a></td>
                                        <?php

                                        if($_SESSION["perfil"] == "adm") {
                                            
                                        ?>
                                        <td class="text-center"><a href="#" onclick="confirmarExclusao('<?php echo base64_encode($row['cod']); ?>', '<?php echo $row['nome']; ?>')"><i class="fas fa-trash-alt text-danger"></i></a></td>
                                        <?php 
                                    }
                                        ?>


                                    </tr>

                                <?php } //Fim do loop 
                                ?>

                            </table>
                    <?php
                        } else {
                            echo "Nenhum cliente encontrado!";
                        }
                    }

                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include "layout/footer.php";
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
    include "layout/modal.php";
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        function confirmarExclusao(cod, nome) {
            if (confirm('Deseja realmente excluir o usuário? ' + nome + '?')) {
                location.href = 'excluir-cliente.php?cod=' + cod;
            };
        }
    </script>



</body>

</html>