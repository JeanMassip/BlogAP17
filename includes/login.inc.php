<?php
$res = new Queries();
if(!isset($_SESSION["userId"])){
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
                $sql = "UPDATE t_users 
                        SET usetoken = '$newToken', usemailvalid = '0', usemail = '$newMail' 
                        WHERE id_users = '" . $_SESSION["userId"] . "'";
                $res->insert($sql);
                $message = "<h1>Barderwun !</h1>";
                $message .= "<p>Votre mail a ete modifié !</p>";
                $message .= "<p>Merci de cliquer sur le lien pour valider : </p>";
                $message .= "<p><a href='http://localhost/CESI/Blog_AP17/index.php?";
                $message .= "page=validationInscription&amp;token=";
                $message .= $newToken;
                $message .= "' target='_blank'>Lien</a>";

                mail($newMail, "Modification Mail", $message);
                echo "<p>Modification reussie !</p>";
                break;
            case "Changer Mot de Passe":
                $sql = "SELECT usepassword FROM t_users WHERE id = '" . $_SESSION["userId"] . "'";
                $query = $res->select($sql);
                $fetch = $query->fetch();
                if($fetch->usepassword == sha1($_POST["oldPassword"])){
                    $sql = "UPDATE t_users SET usepassword = '". $_POST["newPassword"] ."'";
                    $res->insert($sql);
                    echo "<p>Modification reussie !</p>";
                }
                break;
            case "Logo out":
                session_unset();
                session_destroy();
                echo "<p>Logged out !</p>";
                break;
        }
    } else {
        include "frmAccountManagement.php";
    }
}
