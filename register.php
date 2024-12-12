<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class='container my-5'>

    <h1 class='text-center'>Register</h1>

    <form action="register.php" method="POST">
        <div class='my-2'>
            <label class='form-label' for="matric">Matric</label>
            <input class='form-control' type="text" name='matric' id='matric' required>
        </div>

        <div class='my-2'>
            <label class='form-label' for="name">Name</label>
            <input class='form-control' type="text" name='name' id='name' required>
        </div>

        <div class='my-2'>
            <label class='form-label' for="password">Password</label>
            <input class='form-control' type="password" name='password' id='password' required>
        </div>

        <div class='my-2'>
            <label class='form-label' for="role">Role</label>
            <select name="role" id="role" class='form-control' required>
                <option value="Student">Student</option>
                <option value="Lecturer">Lecturer</option>
            </select>
        </div>

        <button type='submit' class='btn btn-primary'>Submit</button>
    </form>

    <a href="login.php">Login</a>

    <?php
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
                $name = $_POST['name'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $sql = "INSERT INTO users (matric, name, password, role) VALUES (:matric, :name, :password, :role)";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':matric', $matric);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':role', $role);

                $stmt->execute();

                echo "Registered successfully.";
                header('Location: login.php');
            }
        }catch(PDOException $e){
            echo "Database Error: " . $e->getMessage();
        }
    ?>

</body>
</html>