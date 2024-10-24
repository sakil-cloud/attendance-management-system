

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <form action="add_student.php" method="post">
            <h2>Add Student</h2>
            <input type="text" name="name" placeholder="Student Name" required>
            <select name="course_id" required>
            <option value="">Select Subject</option>
                <?php
                include('db.php');
                $result = $conn->query("SELECT * FROM courses");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
            <button type="submit">Add Student</button>
            <a href="dashboard.php">Dashboard</a>
        </form>
        <?php
        include('session.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('db.php');
    $name = $_POST['name'];
    $course_id = $_POST['course_id'];

    $sql = "INSERT INTO students (name, course_id) VALUES ('$name', $course_id)";
    if ($conn->query($sql) === TRUE) {
        echo "Student added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>  
    </div>
</body>
</html>
