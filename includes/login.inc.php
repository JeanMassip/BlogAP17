<?php
if(!isset($_SESSION["userID"])){
    if (isset($_POST['frmLogin'])) {
        $mail = $_POST['mail'] ?? "";
        $password = $_POST['password'] ?? "";
        $erreurs = array();
        $message = "";

        if ($mail == "") array_push($erreurs, "Veuillez saisir un mail");
        if ($password == "") array_push($erreurs, "Veuillez saisir un mot de passe");

        if (count($erreurs) > 0) {
            $message = "<ul>";

            for ($i = 0 ; $i < count($erreurs) ; $i++) {
                $message .= "<li>";
                $message .= $erreurs[$i];
                $message .= "</li>";
            }
            $message .= "</ul>";
            include "frmLogin.php";
        } else {
            //Injection en BDD
            $res = new Queries();
            $password = sha1($password);

            $sql = "SELECT * FROM t_users WHERE usepassword = '$password' AND usemail = '$mail'";
            $select = $res->select($sql);
            $fetch = $select->fetch();
            if($fetch != false) {
                $message = "Bienvenu(e) " . $fetch->useprenom . " " . $fetch->usenom . " !";
                $_SESSION["userId"] = $fetch -> id_users;
                $_SESSION["userName"] = $fetch -> usenom;
                $_SESSION["userFirstName"] = $fetch -> useprenom;
                $_SESSION["userGroup"] = $fetch -> id_groupes;
            } else {
                $message = "Erreur, mot de passe ou identifiants incorrect";
                include "frmLogin.php";
            }
        }

        echo $message;

    } else {
        include "frmLogin.php";
    }
} else {
    if(isset($_POST["action"])){
        switch ($_POST["action"]){
            case "Changer Mail":
                $newMail = $_POST["mail"];
                $newToken = uniqid(sha1(date('Y-m-d|H:m:s')), false);
                $sql = "UPDATE t_users SET usetoken = '$newToken'";
        }

    } else {
        include "frmAccountManagement.php";
    }
}
