

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post">
            <h2>Faculty Login</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        

         <?php
            session_start();
            include('db.php');


         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $username = $_POST['username'];
             $password = $_POST['password'];

             $sql = "SELECT * FROM faculty WHERE username = '$username' AND password = '$password'";
             $result = $conn->query($sql);

            if ($result->num_rows > 0) {
             $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            } 
            else {
             echo "Invalid username or password";
             }
            }
        ?>
        </form>
        <a href="view_reports1.php">View attendance</a>
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
