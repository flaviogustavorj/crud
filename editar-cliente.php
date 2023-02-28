<?php

    include_once "autenticacao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title>Alteração de cliente</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">

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
                    <h1 class="h3 mb-4 text-gray-800">Editar Clientes</h1>

                    <p>Atualize os dados abaixo</p>

                    <!-- Resgata o "cod" declarado no html e decodifica -->
                    <?php

                    $cod = base64_decode($_GET["cod"]);
                    // echo $cod;

                    include_once "conexao.php";

                    $stmt = $con->prepare("SELECT * FROM cliente WHERE cod = ?");
                    $stmt->bindParam(1, $cod);

                    $stmt->execute();

                    $row = $stmt->fetch();

                    ?>

                    <!-- Dados do Form: Nome, E-mail, Cpf, Estado Civil -->
                    <form action="atualizar-cliente.php" method="post" class="w-25" autocomplete="off">

                        <input type="hidden" readonly name="cod" value="<?php echo base64_encode($row['cod']); ?>">


                        <input type="text" value="<?php echo $row['nome']; ?>" required name="nome" class="form-control mb-2" placeholder="Digite o Nome">
                        <input type="email" value="<?php echo $row['email']; ?>" required name="email" class="form-control mb-2" placeholder="Digite o E-mail">
                        <input type="text" value="<?php echo $row['cpf']; ?>" required maxlength="11" name="cpf" class="form-control mb-2" placeholder="Digite o CPF">

                        <select name="estadocivil" required class="form-control mb-2">
                            <option value="" disabled>Estado Civil</option>

                            <option value="Solteiro" <?php if ($row['estadocivil'] == 'Solteiro') {
                                                            echo 'selected';
                                                        } ?>>Solteiro</option>
                            <option value="Casado" <?php if ($row['estadocivil'] == 'Casado') {
                                                        echo 'selected';
                                                    } ?>>Casado</option>
                            <option value="Viuvo" <?php echo $row['estadocivil'] == 'Viuvo' ? 'selected' : ''; ?>>Viúvo</option>
                            <option value="Divorciado" <?php echo $row['estadocivil'] == 'Divorciado' ? 'selected' : ''; ?>>Divorciado</option>
                        </select>

                        <button type="submit" class="btn btn-dark">Atualizar Cadastro</button>
                    </form>

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



</body>

</html>