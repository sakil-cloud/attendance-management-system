

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <form action="add_course.php" method="post">
            <h2>Add Subject</h2>
            <input type="text" name="name" placeholder="Subject Name" required>
            <button type="submit">Add Subject</button>
            <a href="dashboard.php">Dashboard</a>
            <?php
include('session.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('db.php');
    $name = $_POST['name'];

    $sql = "INSERT INTO courses (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        echo "Subject added successfully";
    } else {
        echo "Same Subject Cannot be added.";
    }
}
?>
        </form>
    </div>
</body>

</html>
