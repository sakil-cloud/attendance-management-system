<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <form action="mark_attendance.php" method="post">
            <h2>Mark Attendance</h2>
            <label for="course">Course:</label>
            <select name="course_id" id="course_id" required>
                <option value="">Select Subject</option>
                <?php
                include('db.php');
                $result = $conn->query("SELECT id, name FROM courses");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>

            <label for="student">Student:</label>
            <select name="student_id" id="student_id" required>
                <option value="">Select Student</option>
            </select>

            <label for="date">Date:</label>
            <input type="date" name="date" required>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="">Select Status</option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>

            <button type="submit">Mark Attendance</button>
            <a href="dashboard.php">Dashboard</a>


        </form>
        <?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    // Check if the student is already enrolled in the course
    $check_enrollment = $conn->prepare("SELECT * FROM enrollment WHERE student_id = ? AND course_id = ?");
    $check_enrollment->bind_param('ii', $student_id, $course_id);
    $check_enrollment->execute();
    $result = $check_enrollment->get_result();

    if ($result->num_rows == 0) {
        echo "Error: The student is not enrolled in the selected course.";
    } else {
        $sql = "INSERT INTO attendance (student_id, course_id, date, status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiss', $student_id, $course_id, $date, $status);

        if ($stmt->execute() === TRUE) {
            echo "Attendance marked successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#course_id').change(function() {
                var course_id = $(this).val();
                if (course_id) {
                    $.ajax({
                        type: 'POST',
                        url: 'get_students.php',
                        data: {course_id: course_id},
                        success: function(response) {
                            var students = JSON.parse(response);
                            var studentSelect = $('#student_id');
                            studentSelect.empty();
                            studentSelect.append('<option value="">Select Student</option>');
                            $.each(students, function(index, student) {
                                studentSelect.append('<option value="' + student.id + '">' + student.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#student_id').empty().append('<option value="">Select Student</option>');
                }
            }).change();
        });
    </script>
</body>
</html>
