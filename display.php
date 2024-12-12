<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class='container my-5'>

<?php
        session_start();
        if($_SESSION['matric']){
                // database
            $host = 'localhost';
            $db = 'lab_5b';
            $user = 'root';
            $password = '';

            try{
                $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM users";
                $stmt = $pdo->prepare($sql);

                $stmt = $pdo->prepare($sql);

                $stmt->execute();

                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);


                
            }catch(PDOException $e){
                echo "Database Error: " . $e->getMessage();
            }
        }else{
            header("Location: login.php");
        }
    ?>

    <div class='d-flex justify-content-end m-2'>
        <a href="logout.php" class='btn btn-danger'>Logout</a>
    </div>

    <table class="table table-bordered table-light text-center align-middle">
        <thead class='table-info'>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>

        <?php
            foreach($users as $user){
                echo "<tr>";
                    echo "<td>" . $user['matric'] . '</td>';
                    echo "<td class='text-start'>" . $user['name'] . '</td>';
                    echo "<td>" . $user['role'] . '</td>';
                    echo "<td>" . 
                    
                        '<a class="btn m-1 btn-warning" href="update.php?matric=' . urlencode($user['matric']) . '">Update</a>' .
                    '<a class="btn m-1 btn-outline-danger" href="delete.php?matric=' . urlencode($user['matric']) . '">Delete</a>'
                    
                    . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
</body>
</html>