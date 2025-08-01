<?php
date_default_timezone_set("Africa/Lagos");
    // class Dbh{
    //     protected function connectdb(){
    //         try {
    //             $username = "dortxpbw_onostarmedia";
    //             $password = "yMcmb@her0123!";
    //             $dbh = new PDO('mysql:host=localhost; dbname=dortxpbw_jude', $username, $password);
    //             $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    //             $dbh->exec("SET time_zone = '+01:00'");
    //             return $dbh;
    //         } catch (PDOException $e) {
    //             print "Error!". $e->getMessage().
    //             "<br>";
    //             die();
    //         }
    //     }
    // }
    
  class Dbh {
    private static $conn = null; // Static variable to hold a single instance

    protected function connectdb() {
        try {
            if (self::$conn === null) {  // create only one connection per request
                $username = "onostarmedia";
                $password = "yMcmb@her0123!";
                $dsn = "mysql:host=localhost;dbname=lis;charset=utf8mb4";

                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_PERSISTENT => false, // revents keeping connections open
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+01:00';"
                ];

                self::$conn = new PDO($dsn, $username, $password, $options);
            }

            // Auto-close connection when script execution ends
            register_shutdown_function(function () {
                if (self::$conn) {
                    self::$conn = null;
                }
            });
            
            return self::$conn;

        } catch (PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage()); //  Logs error for security
            die("Database connection failed. Please try again later.");
        }
    }
}