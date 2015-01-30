<?php

require_once 'app/start.php';


?>

<?php include("incl/header.php"); ?>

    <div class="login-page">
        <div class="login-form">
            <h5>log in</h5>
            <form method="post" action="">
                <label>email</label>
                <input name="email" type="email"/>

                <label>lösenord</label>
                <input name="password" type="password"/>

                <input name="user_login" type="submit" value="logga in"/>
            </form>
        </div>


        <div class="register-form">
            <h5>Register</h5>
            <form method="post" action="">
                <div>
                    <label>förnamn</label>
                    <input name="f_name" type="text"/>

                    <label>efternamn</label>
                    <input name="l_name" type="text"/>

                    <label>email</label>
                    <input name="email" type="email"/>

                    <label>lösenord</label>
                    <input name="password" type="password"/>

                    <label>lösenord (igen)</label>
                    <input name="password" type="text"/>
                </div>
                <div>
                    <label>adress</label>
                    <input name="adress" type="text"/>

                    <label>postadress</label>
                    <input name="postal_adress" type="text"/>

                    <label>postnummer</label>
                    <input name="postal_code" type="text"/>

                    <label>mobil (SMS avi)</label>
                    <input name="phone" type="text"/>

                    <label>nyhetsbrev</label>
                    <input name="newsletter" type="checkbox" checked/> <small>Jag vill se hur jag gör skillnad</small>
                </div>

                <input name="user_registration" type="submit" value="registrera"/>
            </form>
        </div>
    </div>
    
<?php include("incl/footer.php") ; ?>