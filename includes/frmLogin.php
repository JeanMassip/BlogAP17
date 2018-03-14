<form action="#" method="post">
    <div>
        <label for="name">Email : </label>
        <input type="text" id="mail" name="mail" value="<?php if(isset($email)) echo $name;?>" />
    </div>
    <div>
        <label for="password">Mot de passe : </label>
        <input type="password" id="password" name="password" />
    </div>
    <div>
        <input type="reset" value="Effacer" />
        <input type="submit" value="Envoyer" name="frmLogin" />
    </div>
</form>