<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/10/2014
 * Time: 12:34 AM
 */

if($_POST) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if( isset($user) || isset($pass) ) {
        if (empty($user)) {
            die ("ERROR: Please enter username!");
        }
        if (empty($pass)) {
            die ("ERROR: Please enter password!");
        }

        require('../Business/Account.php');
        $requestedAccount = Account::getAccount($user);

        if ($user == $requestedAccount->getUserName() && password_verify($pass, $requestedAccount->getPassword())) {
            session_start();
            $_SESSION['authenticated'] = true;
            $_SESSION['accountName'] = $requestedAccount->getUserName();
            header("Location: searchRecords.php");
        } else {
            die("ERROR: Incorrect username or password!");
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Account Login</title>
</head>

<body>
<h1>
    Account Login
</h1>
<h2>Log into an account to use the Shopping Cart!</h2>

<form action="loginAccount.php" method="post">
    <label for="">Username</label><br/>
    <input type="text" maxlength="20" required name="user"/><br/><br/>
    <label for="">Password</label><br/>
    <input type="password" required name="pass"/><br/><br/>
    <button type="submit">Login!</button>
</form>

</body>

</html>