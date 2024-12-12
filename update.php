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

        $matric = $_GET['matric'];

        if($matric){
            $sql = "SELECT * FROM users WHERE matric = :matric";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':matric', $matric);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
        }
        
    }catch(PDOException $e){
        echo "Database Error: " . $e->getMessage();
    }
}else{
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class='container my-5'>
    
    <h1 class='text-center'>Update</h1>

    <form action="handleUpdate.php" method="POST">
        <div class='my-2'>
            <label class='form-label' for="matric">Matric</label>
            <input class='form-control' type="text" name='matric' id='matric' value="<?php echo $user['matric'] ?>" disabled>
            <input class='form-control' type="hidden" name='matric' id='matric' value="<?php echo $user['matric'] ?>">
        </div>

        <div class='my-2'>
            <label class='form-label' for="name">Name</label>
            <input class='form-control' type="text" name='name' id='name' value="<?php echo $user['name'] ?>" required>
        </div>  

        <div class='my-2'>
            <label class='form-label' for="role">Role</label>
            <select name="role" id="role" class='form-control' required>
                <option value="Student" <?php echo ($user['role'] == "Student")? 'selected': ''; ?>>Student</option>
                <option value="Lecturer" <?php echo ($user['role'] == "Lecturer")? 'selected': ''; ?>>Lecturer</option>
            </select>
        </div>

        <button class='btn btn-primary' type='submit'>Submit</button>
        <a href="back.php" class='btn btn-outline-secondary'>Cancel</a>
    </form>


</body>
</html>