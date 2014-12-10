<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/9/2014
 * Time: 11:30 PM
 */

if(isset($_SESSION['authenticated'])){
    if($_SESSION['authenticated'] != true) {
        header("Location: login.php");
    }
} else {
    header("Location: searchRecords.php");
}