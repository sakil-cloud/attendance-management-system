<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <form action="enroll_student.php" method="post">
            <h2>Enroll Student in Course</h2>
            <label for="student">Student:</label>
            <select name="student_id" required>
                <option value="">Select Student</option>
                <?php
                include('db.php');
                $students_result = $conn->query("SELECT id, name FROM students");
                while ($row = $students_result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>

            <label for="course">Course:</label>
            <select name="course_id" required>
            <option value="">Select Student</option>
                <?php
                $courses_result = $conn->query("SELECT id, name FROM courses");
                while ($row = $courses_result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
           
           
            <button type="submit">Enroll</button>
            <a href="dashboard.php">Dashboard</a>
            </form>
            <?php
           
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('db.php');
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    
   

    $sql = "INSERT INTO enrollment (student_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $student_id, $course_id);

    if ($stmt->execute() === TRUE) {
        echo "Student enrolled successfully";
    } else {
        echo "Cannot Enroll A student in same Subject.";
    }
    
} 
?>
    </div>
    
   
</body>
</html>    
