<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/10/2014
 * Time: 12:10 AM
 */

if($_POST) {
    if (isset($_POST['user']) || isset($_POST['pass'])) {
        if (empty($_POST['user'])) {
            die ("ERROR: Please enter a username!");
        }
        if (empty($_POST['pass'])) {
            die ("ERROR: Please enter a password!");
        }

        require("../Business/Account.php");
        $newAccount = Account::createAccount($_POST['user'], $_POST['pass']);
        $newAccount->saveAccount();
        header("Location: loginAccount.php");
    }
}

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Account Creation</title>
    </head>

    <body>
        <h1>
            Account Creation
        </h1>
        <h2>Create an account to use the Shopping Cart!</h2>

        <form action="createAccount.php" method="post">
            <label for="">Username</label><br/>
            <input type="text" maxlength="20" required name="user"/><br/><br/>
            <label for="">Password</label><br/>
            <input type="password" required name="pass"/><br/><br/>
            <button type="submit">Register!</button>
        </form>

    </body>

</html>