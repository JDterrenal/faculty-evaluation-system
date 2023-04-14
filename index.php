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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Sign In | Faculty Evaluation System</title>
    <link rel="icon" type="image/png" href="/images/systems-plus-computer-college-logo.png">
</head>

<body>
    <form action=index.php method=post>
        <div class="login-container">
            <div class="login-left">
                <p class="login-title">Systems Plus Computer College Caloocan</p>
                <p class="login-quote">A leading and globally competitive institution of learning through service and innovation.</p>
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
                        <div class="login-type marg-b">
                            <label for="usertype">Sign In as</label>
                            <select name="usertype" id="usertype">
                                <option value="Student">Student</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <a class="add-main" id="add-button">Activate your account</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--------popup add student ------------>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <div class="popup-background" id="popup-background">
            <div class="popup-users">
                <div class="popup-add-top">
                    <p class="popup-add-title"><i class="fas fa-plus"></i> ACTIVATE YOUR ACCOUNT</p>
                    <i class="fas fa-times ex" id="ex-add"></i>
                </div>
                <div class="popup-users-middle">
                    <div class="boxx">
                        <p class="P">Student Picture</p>
                        <div class="userscon">
                            <img src="./images/uploads/standard.png" alt="" class="profile-side-pop">
                        </div>
                        <div class="userscon">
                            <input type="file" id="photo" name="photo">
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Student Name</p>
                        <div class="userscon">
                            <input type="text" name="firstname" placeholder="First Name" required>
                            <input type="text" name="lastname" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Gender</p>
                        <div class="userscon1">
                            <input type="radio" id="add_male" name="gender" value="Male" required><label for="add_male">Male</label>
                            <input type="radio" id="add_female" name="gender" value="Female"><label for="add_female">Female</label>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Address</p>
                        <div class="userscon">
                            <input type="text" name="address" placeholder="Address" required>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Contact Number</p>
                        <div class="userscon">
                            <input type="number" name="contact_no" placeholder="Contact Number" required>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Email</p>
                        <div class="userscon">
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Year Level</p>
                        <div class="userscon">
                            <select name="yearlevel" required>
                                <option value="Grade 1">Grade 1</option>
                                <option value="Grade 2">Grade 2</option>
                                <option value="Grade 3">Grade 3</option>
                                <option value="Grade 4">Grade 4</option>
                                <option value="Grade 5">Grade 5</option>
                                <option value="Grade 6">Grade 6</option>
                                <option value="Grade 7">Grade 7</option>
                                <option value="Grade 8">Grade 8</option>
                                <option value="Grade 9">Grade 9</option>
                                <option value="Grade 10">Grade 10</option>
                                <option value="Grade 11">Grade 11</option>
                                <option value="Grade 12">Grade 12</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Course</p>
                        <div class="userscon">
                            <select name="course_id" required>
                                <?php cbCourse() ?>
                            </select>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Section</p>
                        <div class="userscon">
                            <select name="section_id" required>
                                <?php cbSection() ?>
                            </select>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Status</p>
                        <div class="userscon">
                            <select name="status" required>
                                <option value="Enrolled">Enrolled</option>
                                <option value="Not Enrolled">Not Enrolled</option>
                            </select>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Registration Code</p>
                        <div class="userscon">
                            <input type="text" name="reg_code" placeholder="Registration Code" required>
                        </div>
                    </div>
                    <?php addStudentWCode() ?>
                    <div class="userscon">
                        <button type="submit" name="addstudent" class="addbtn"><i class="fas fa-plus"></i> Activate Account</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $("#add-button").click(function() {
            const addBackground = document.getElementById('popup-background');
            addBackground.style.display = "flex";
            $("#popup-background").show();
        });
        $("#ex-add").click(function() {
            $("#popup-background").hide();
        });
    </script>
</body>

</html>