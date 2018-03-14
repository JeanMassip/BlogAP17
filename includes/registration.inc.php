<h1>Inscription</h1>
<?php
ini_set("smtp_port", 1025);
if (isset($_POST['frmRegistration'])) {
    $name = $_POST['name'] ?? "";
    $firstName = $_POST['firstName'] ?? "";
    $mail = $_POST['mail'] ?? "";
    $password = $_POST['password'] ?? "";
    $regex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$";

    $erreurs = array();

    if ($name == "") array_push($erreurs, "Veuillez saisir un nom");
    if ($firstName == "") array_push($erreurs, "Veuillez saisir un prénom");
    if ($mail == "") array_push($erreurs, "Veuillez saisir un mail");
    if ($password == "") array_push($erreurs, "Veuillez saisir un mot de passe");
    if(preg_match($regex, $password) == 0){
        array_push($erreurs, "Le mot de passe doit avoir 8 characteres, contenir une majuscule, 
        une minuscule, un chiffre et un charactere special ('@$!%*?&')");
    }

    if (count($erreurs) > 0) {
        $message = "<ul>";

        for ($i = 0 ; $i < count($erreurs) ; $i++) {
            $message .= "<li>";
            $message .= $erreurs[$i];
            $message .= "</li>";
        }

        $message .= "</ul>";

        echo $message;
        include "frmRegistration.php";
    } else {
        //Injection en BDD
        $res = new Queries();
        $password = sha1($password);
        $token = uniqid(sha1(date('Y-m-d|H:m:s')), false);


        $sql = "INSERT INTO t_users(usenom, useprenom, usemail, usepassword, usetoken, id_groupes) 
          VALUES ('$name','$firstName','$mail','$password','$token',  '3')";
        $res->insert($sql);

        $message = "<h1>Wunderbar !!</h1>";
        $message .= "<p>Vous etes inscrit !</p>";
        $message .= "<p>Merci de cliquer sur le lien pour valider</p>";
        $message .= "<p><a href='http://localhost/CESI/Blog_AP17/index.php?";
        $message .= "page=validationInscription&amp;token=";
        $message .= $token;
        $message .= "' target='_blank'>Lien</a>";

        mail($mail, "Confirmation compte", $message);
        echo "<p>Inscription reussie !</p>";
    }

}

else {
    include "frmRegistration.php";
}