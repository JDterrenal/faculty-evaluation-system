<?php
include './assets/php/connection.php';
include './assets/php/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login | Faculty Evaluation System</title>
</head>

<body>
    <form action=index.php method=post>
        <div class="login-container">
            <div class="login-box">
                <div class="login-content">
                    <div class="login-header">
                        <h2>Login</h2>
                    </div>
                    <div class="login-items">
                        <label for="login_id">User ID</label>
                        <input type="number" placeholder="Enter ID" name="login_id" required>
                    </div>
                    <div class="login-items marg-b">
                        <label for="password">Password</label>
                        <input type="password" placeholder="Enter Password" name="password" required>
                        <?php login() ?>
                    </div>
                    <div class="login-items marg-b">
                        <button type="submit" name="login" value="Login">Login</button>
                    </div>
                    <div class="login-type">
                        <label for="usertype">Login As</label>
                        <select name="usertype" id="usertype">
                            <option value="Student">Student</option>
                            <option value="Faculty">Faculty</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>