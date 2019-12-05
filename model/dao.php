<?php
class Dao
{
    const HOST = "localhost";
    const USER = "root";
    const PASS = "";
    const DB = "hospital";

    //const HOST = "localhost";
    //const USER = "id11822336_admin";
    //const PASS = "Abc@1234";
    //const DB = "id11822336_hospital	";

    
    function conecta()
    {
        $pdo = null;
        try {
            $pdo = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB, self::USER, self::PASS);
            //$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $pdo;
    }
}
