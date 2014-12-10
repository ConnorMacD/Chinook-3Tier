<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/9/2014
 * Time: 11:39 PM
 */

require_once '../Data/aDataAccess.php';

class Account {

    private $m_userName;
    private $m_password;


    public function __construct($username, $password) {
        $this->m_userName = $username;
        $this->m_password = $password;
    }


    public function getPassword() {
        return $this->m_password;
    }

    public function getUserName() {
        return $this->m_userName;
    }

    public static function getAccount($username) {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectAccountByUserName($username);

        while($row = $myDataAccess->fetchAccount())
        {
            $currentAccount= new self($myDataAccess->fetchUsername($row), $myDataAccess->fetchPassword($row));
            $accountObject = $currentAccount;
        }

        $myDataAccess->closeDB();

        return $accountObject;
    }

    public function saveAccount() {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->insertAccount($this->m_userName, $this->m_password);

        $myDataAccess->closeDB();
    }


    //This function uses the function password_hash() which uses BCRYPT as the current default.
    //This is a standard hashing algorithm based on Blowfish, and in fact is more recommended
    //than using MD5, SHA1, and SHA256. The key here is its 'cost', the amount of iterations.
    //It is given a randomly generated salt per password and hashed to (2^cost).
    //http://php.net/manual/en/faq.passwords.php
    public static function createAccount($user, $pass) {
        $options = [
            //4096 iterations!
            'cost' => 12
        ];
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT, $options);
        $account = new self($user, $hashedPassword);

        return $account;
    }



}