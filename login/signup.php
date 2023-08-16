

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <!-- link css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <h1>Signup Page</h1><br><br>
        <form method="POST" action="signup.php">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <br><br>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <br>
            <?php
            // Database connection details
            $host = 'localhost';
            $db   = 'project_portal';
            $user = 'root';
            $pass = '';

            // Connect to the database
            $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

            // Function to check if username already exists
            function usernameExists($username, $conn) {
                $query = "SELECT username FROM users WHERE username = :username";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return ($result !== false);
            }

            // Process the form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve form data
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $email = $_POST['email'];

                // Check if username already exists
                if (usernameExists($username, $conn)) {
                    echo "Username already exists!";
                    echo "<br>";
                } else {
                    // Insert the new user into the database
                    $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    header('location:login.php');
                }
            }
            ?>
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <p>Already have an account? <a href="login.php">Log In</a></p>
            <br>
            <center><button type="submit">Sign Up</button></center>
        </form>
        </div>
</body>
</html>