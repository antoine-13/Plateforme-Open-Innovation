<?php
    require 'info_bdd.php';

    $pdoReqArg1 = "mysql:host=". $host .";dbname=". $dbname .";";
    $pdoReqArg2 = $dbuser;
    $pdoReqArg3 = $dbpw;

    try {

        $db = new PDO($pdoReqArg1, $pdoReqArg2, $pdoReqArg3);
        $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
        $_SESSION['connect'] = 'connected';

    } catch(PDOException $e) {
        
        $_SESSION['connect'] = 'not connected';
        $errorMessage = $e->getMessage();
        //echo $errorMessage;
    }
    global $db;
?>