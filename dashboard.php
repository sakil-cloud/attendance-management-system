
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, <?php session_start(); echo $_SESSION['username']; ?></h1>
        <nav>
            <ul>
                
                <li><a href="add_course.php"style="text-decoration:none">Add Subject</a></li>
                <li><a href="add_student.php"style="text-decoration:none">Add Student</a></li>
                <li><a href="enroll_student.php"style="text-decoration:none">Enroll Student</a></li>
                <li><a href="mark_attendance.php"style="text-decoration:none">Mark Attendance</a></li>
                <li><a href="view_reports.php"style="text-decoration:none">View Reports</a></li> <!-- New link -->
                <li><a href="logout.php" class="button"style="text-decoration:none">Logout</a></li> <!-- Logout link -->
            </ul>
        </nav>
    </div>
<script>
// Disable back and forward navigation from the login page
(function() {
  window.history.pushState(null, '', window.location.href);
  window.onpopstate = function() {
    window.history.pushState(null, '', window.location.href);
  };
})();
</script>     
</body>

</html>


