<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class='container my-5'>

    <h1 class='text-center'>Login</h1>
    
    <form action="login.php" method="POST">
        <div class='my-2'>
            <label class='form-label' for="matric">Matric</label>
            <input class='form-control' type="text" name='matric' id='matric' required>
        </div>

        <div class='my-2'>
            <label class='form-label' for="password">Password</label>
            <input class='form-control' type="password" name='password' id='password' required>
        </div>

        <button type='submit' class='btn btn-primary'>Submit</button>
    </form>

    <a href="register.php">Register</a>

    <?php
        session_start();

        // database
        $host = 'localhost';
        $db = 'lab_5b';
        $user = 'root';
        $password = '';

        try{
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $matric = $_POST['matric'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM users WHERE matric = :matric";
                
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':matric', $matric);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if($user){
                    if($user['password'] == $password){
                        $_SESSION['matric'] = $user['matric'];
                        $_SESSION['name'] = $user['name'];
                        $_SESSION['role'] = $user['role'];

                        echo "Login successful.";
                        header("Location: display.php");
                    }else{
                        echo "Incorrect password.";
                        header('Location: invalidLogin.php');
                    }
                }else{
                    echo "User not found.";
                    header("Location: invalidLogin.php");
                }
                
            }
        }catch(PDOException $e){
            echo "Database Error: " . $e->getMessage();
        }
    ?>

</body>
</html>