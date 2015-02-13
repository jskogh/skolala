<?php
    // Login screen

    require_once('functions.php');
    if (isset($_POST['submit_login'])) {
        $result = adminlogin($_POST['password']);
        if ($result) {
            header("location:administration.php");
        }
        else {
            $errorMsg = "N&aring;t gick fel";
        }
    }

?>
<html>
<head>
    <title>EcoShoes - Admin</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="wrapper">
        <div id="loginbox">
            <h1>Logga In:</h1>
            <form method="post">
                <table>
                    <tr>
                        <td>E-mail:</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td>L&ouml;senord:</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="password"></td>
                    </tr>
                </table>
                <input type="submit" name="submit_login" value="Logga in">
            </form>
            <p><?php if(isset($errorMsg)) echo $errorMsg ?></p>
        </div>
    </div>
</body>
</html>