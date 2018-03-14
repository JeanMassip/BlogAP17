<?php
    $res = new Queries();
    $message = "<p>Erreur,lien incomplet, assurez vous d'avoir bien selectioner le lien recu par mail</p>";
    if(isset($_GET['token']) && $_GET['token'] != null){
        $usetoken = $_GET['token'];
        $sql = "SELECT id_users FROM t_users WHERE usetoken = '$usetoken'";
        $fetch = $res->select($sql);
        $id = $fetch->fetch();
        if($id !=false){
            $sql = "UPDATE t_users SET usemailvalid = '1' WHERE id_users = '$id->id_users'";
            $res->insert($sql);
            $message = "<p>E-Mail Valide avec succes !</p>";
        } else {
            $message = "<p>Erreur, lien incorrect, vous pouvez generer un nouveau lien dans l'onglet mon compte</p>";
        }
    }


    echo $message;