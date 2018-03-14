<?php
if (isset($_POST['frmLogin'])) {
    $mail = $_POST['mail'] ?? "";
    $password = $_POST['password'] ?? "";

    $erreurs = array();

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

    echo $message;
    include "frmLogin.php";
    } else {
        //Injection en BDD
        $res = new Queries();
        $password = sha1($password);

        $sql = "SELECT * FROM t_users WHERE usepassword = '$password' AND usemail = '$mail'";
        $select = $res->select($sql);
        if($select != 0){
            $fetch = $select->fetch();
        }
        $message = "Bienvenu(e) ". $fetch['usename'] . " !";
    }
} else {
    include "frmLogin.php";
}