<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/9/2014
 * Time: 11:05 PM
 */

    //reset the session
    session_start();
    session_destroy();
    header("Location: ../ShoppingCart.php");