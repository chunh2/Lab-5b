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

            $newName = $_POST['name'];
            $newRole = $_POST['role'];
    
            $matric = $_POST['matric'];
    
            if($matric){
                $sql = "UPDATE users SET name = :name , role = :role WHERE matric = :matric";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $newName);
                $stmt->bindParam(':role', $newRole);
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