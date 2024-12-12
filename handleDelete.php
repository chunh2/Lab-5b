<?php
    session_start();

    if($_SESSION['matric']){

        $host = 'localhost';
        $db = 'lab_5b';
        $user = 'root';
        $password = '';
    
        try{
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $matric = $_POST['matric'];
    
            if($matric){
                $sql = "DELETE FROM users WHERE matric = :matric";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':matric', $matric);
                $stmt->execute();

                header('Location: display.php');
            }
            
        }catch(PDOException $e){
            echo "Database Error: " . $e->getMessage();
        }
    }else{
        header("Location: login.php");
    }
?>