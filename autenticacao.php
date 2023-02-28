<?php

session_start();

    //(!) negação -> se NÃO existir a sessão nome
    if(!isset($_SESSION["nome"])) {
        session_destroy();
        $msg = "Acesso negado!!!";
        header("location:index.php?msg=".$msg);
    }

    elseif($_SESSION["tempo"] + 5 < time()) {
        session_destroy();

        $msg = "Sessão expirada";
        header("location:index.php?msg=".$msg);
    } else {
        $_SESSION["tempo"] = time();
        
    }
    
    // 35
?>