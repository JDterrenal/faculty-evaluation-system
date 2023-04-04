<?php
include './assets/php/functions.php';
include './assets/php/validationAdmin.php';
preventBack();
enableDelete_students();
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students | Faculty Evaluation</title>
    <link rel="icon" type="image/png" href="/images/systems-plus-computer-college-logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!------ navigation and side bar ------->
    <?php include './assets/php/navigation.php' ?>

    <!-------- main content ---------->
    <div class="main-container">
        <main>
            <div class="container-main">
                <div class="page-container">
                    <h1><i class="fas fa-user" id="view-info"> Students</i></h1>
                    <hr>
                    <div class="user-info">
                        <div class="user-content">
                            <div class="user-info-title">
                                <p class="user-title"><i class="fas fa-user"></i> Information!</p>
                                <hr>
                            </div>
                        </div>
                        <div class="user-nfo-content">
                            <table class="user-table">
                                <tbody>
                                    <tr>
                                        <th>Photo Info</th>
                                        <td data-label="Photo Info"></td>
                                    </tr>
                                    <tr>
                                        <th>ID Info</th>
                                        <td data-label="ID Info"></td>
                                    </tr>
                                    <tr>
                                        <th>Full Name Info</th>
                                        <td data-label="Full Name Info"></td>
                                    </tr>
                                    <tr>
                                        <th>Year Level Info</th>
                                        <td data-label="Year Level Info"></td>
                                    </tr>
                                    <tr>
                                        <th>Course ID Info</th>
                                        <td data-label="Course ID Info"></td>
                                    </tr>
                                    <tr>
                                        <th>Section ID Info</th>
                                        <td data-label="Section ID Info"></td>
                                    </tr>
                                <tbody>
                            </table>
                        </div>
                    </div>

                    <div class="main-content">
                        <div class="main-search-add">
                            <div class="main-search-add-top">
                                <p class="main-search-add-title"><i class="fas fa-search"></i> Search and add here!</p>
                                <hr>
                            </div>
                        </div>
                        <div class="main-search1">
                            <a><i class="fas fa-search"></i></a>
                            <input type="text" id="search_records" placeholder="Search" class="main-search">
                        </div>
                        <div class="main-add">
                            <a class="add-main" id="add-button">Add Student</a>
                        </div>
                        <div class="student-table-container">
                            <table class="student-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Year Level</th>
                                        <th>Contact Number</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Photo</th>
                                        <th>Course ID</th>
                                        <th>Section ID</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody id="search_results">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-------- footer ---------->
        <?php include './assets/php/footer.php' ?>
    </div>

    <!--================= popups ===================-->
    <!-------- popup logout ---------->
    <?php include './assets/php/popupLogout.php' ?>

    <!--------popup add student ------------>
    <form action="students.php" method="post" enctype="multipart/form-data">
        <div class="popup-background" id="popup-background">
            <div class="popup-users">
                <div class="popup-add-top">
                    <p class="popup-add-title"><i class="fas fa-plus"></i> ADD STUDENT</p>
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
                    <?php addStudent() ?>
                    <div class="userscon">
                        <button type="submit" name="addstudent" class="addbtn"><i class="fas fa-plus"></i> Add Student</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--------popup edit student ------------>
    <form action="students.php" method="post" enctype="multipart/form-data">
        <div class="popup-background-edit" id="edit-popup-background">
            <div class="popup-users">
                <div class="popup-add-top">
                    <p class="popup-add-title"><i class="fas fa-edit"></i> EDIT STUDENT</p>
                    <i class="fas fa-times ex" id="ex-edit"></i>
                </div>
                <div class="popup-users-middle">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="boxx">
                        <p class="P">Student Picture</p>
                        <div class="userscon">
                            <img id="edit_photo_output" src="./images/uploads/standard.png" alt="" class="profile-side-pop">
                        </div>
                        <div class="userscon">
                            <input type="file" id="edit_photo" name="edit_photo">
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Student Name</p>
                        <div class="userscon">
                            <input type="text" id="edit_firstname" name="edit_firstname" placeholder="First name" required>
                            <input type="text" id="edit_lastname" name="edit_lastname" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Gender</p>
                        <div class="userscon1">
                            <input type="radio" id="Male" name="edit_gender" value="Male" required><label for="Male">Male</label>
                            <input type="radio" id="Female" name="edit_gender" value="Female"><label for="Female">Female</label>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Address</p>
                        <div class="userscon">
                            <input type="text" id="edit_address" name="edit_address" placeholder="Address" required>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Contact Number</p>
                        <div class="userscon">
                            <input type="number" id="edit_contact_no" name="edit_contact_no" placeholder="Contact Number" required>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Email</p>
                        <div class="userscon">
                            <input type="email" id="edit_email" name="edit_email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Year Level</p>
                        <div class="userscon">
                            <select id="edit_yearlevel" name="edit_yearlevel" required>
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
                            <select id="edit_course_id" name="edit_course_id" required>
                                <?php cbCourse() ?>
                            </select>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Section</p>
                        <div class="userscon">
                            <select id="edit_section_id" name="edit_section_id" required>
                                <?php cbSection() ?>
                            </select>
                        </div>
                    </div>
                    <div class="boxx">
                        <p class="P">Status</p>
                        <div class="userscon">
                            <select id="edit_status" name="edit_status" required>
                                <option value="Enrolled">Enrolled</option>
                                <option value="Not Enrolled">Not Enrolled</option>
                            </select>
                        </div>
                    </div>
                    <?php editStudent() ?>
                    <div class="userscon">
                        <button type="submit" name="editstudent" class="editbtn"><i class="fas fa-edit"></i> Edit Student</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Loads the data and enables search functionality
        $(document).ready(function() {
            $("#search_records").keyup(function() {
                const input = $(this).val();
                $.ajax({
                    url: "./assets/php/searchStudent.php",
                    method: "POST",
                    data: {
                        input: input
                    },

                    success: function(data) {
                        $("#search_results").html(data);
                    }
                });
            });
            const input = $(this).val();
            $.ajax({
                url: "./assets/php/searchStudent.php",
                method: "POST",
                data: {
                    input: input
                },

                success: function(data) {
                    $("#search_results").html(data);
                }
            });
        });
    </script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/deleteConfirmation.js"></script>
</body>

</html>