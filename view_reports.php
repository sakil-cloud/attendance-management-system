<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>View Attendance Reports</h2>
        <form action="view_reports.php" method="get">
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
            <button type="submit">View Report</button>
            <a href="dashboard.php">Dashboard</a>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['course_id'])) {
            $course_id = $_GET['course_id'];
            $sql = "SELECT students.name, attendance.date, attendance.status 
                    FROM attendance 
                    JOIN students ON attendance.student_id = students.id 
                    WHERE attendance.course_id = $course_id 
                    ORDER BY attendance.date";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Student Name</th><th>Date</th><th>Status</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['status']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No records found.";
            }
        }
        ?>
    </div>
</body>

</html>
