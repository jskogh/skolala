<?php
use app\models\User;

require_once 'app/start.php';


$user = new User();


if ( isset($_POST['user_registration']) ) {
    $input = [];
    $input['email'] = strtolower($_POST['email']);
    $input['f_name'] = strtolower($_POST['f_name']);
    $input['l_name'] = strtolower($_POST['l_name']);
    $input['adress'] = strtolower($_POST['adress']);
    $input['postal_code'] = $_POST['postal_code'];
    $input['postal_adress'] = strtolower($_POST['postal_adress']);
    if ($_POST['re-password'] == $_POST['password'] ) {
        $input['password'] = $_POST['password'];
    }
    $input['phone'] = $_POST['phone'];
    $input['newsletter'] = isset($_POST['newletter']) ? 1 : 0;

    $user->create($input);

    try {
        $user->save();
        $intendedUrl = $_SESSION["targetUrl"];
        $user->login($_POST['email'],$_POST['password']);
        header('location: '.$intendedUrl);
    }
    catch (Exception $e) {

        echo $e;
    }
}

if ( isset($_POST['user_login']) ) {
    $user->login($_POST['email'], $_POST['password']);
    $intendedUrl = $_SESSION["targetUrl"];
    header('location: '.$intendedUrl);
}


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
                    <input name="re-password" type="text"/>
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
                    <input name="newsletter" type="checkbox" value="on" checked/> <small>Jag vill se hur jag gör skillnad</small>
                </div>

                <input name="user_registration" type="submit" value="registrera"/>
            </form>
        </div>
    </div>
    
<?php include("incl/footer.php") ; ?>