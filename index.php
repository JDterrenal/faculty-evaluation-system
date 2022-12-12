<?php
include './assets/php/functions.php';
autoLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Sign In | Faculty Evaluation System</title>
    <link rel="icon" type="image/png" href="/images/systems-plus-computer-college-logo.png">
</head>

<body>
    <form action=index.php method=post>
        <div class="login-container">
            <div class="login-left">
                <p class="login-title">Harvard College</p>
                <p class="login-quote">Education is the passport to the future, for tomorrow belongs to those who prepare for it today</p>
            </div>

            <div class="login-right">
                <div class="login-box">
                    <div class="login-content">
                        <div class="login-header">
                            <h2>Sign In</h2>
                        </div>
                        <div class="login-items">
                            <label for="login_id">User ID</label>
                            <input type="number" placeholder="Enter ID" name="login_id">
                        </div>
                        <div class="login-items marg-b">
                            <label for="password">Password</label>
                            <input type="password" placeholder="Enter Password" name="password">
                            <?php login() ?>
                        </div>
                        <div class="login-items marg-b">
                            <button type="submit" name="login" value="Login">Sign In</button>
                        </div>
                        <div class="login-type">
                            <label for="usertype">Sign In as</label>
                            <select name="usertype" id="usertype">
                                <option value="Student">Student</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>