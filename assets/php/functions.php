<?php
session_start();

//Logout
if (isset($_GET['logout'])) {
    unset($_SESSION['login_id']);
    unset($_SESSION['password']);
    header('location: index.php');
    if (isset($_COOKIE['FacultyEvaluationID'])) {
        unset($_COOKIE['FacultyEvaluationID']);
        setcookie("FacultyEvaluationID", null, 1, "/", "facultyevaluation.elementfx.com");
    }
    if (isset($_COOKIE['FacultyEvaluationPassword'])) {
        unset($_COOKIE['FacultyEvaluationPassword']);
        setcookie("FacultyEvaluationPassword", null, 1, "/", "facultyevaluation.elementfx.com");
    }
    session_destroy();
    return true;
}

//Do nothing
function relax()
{;
}

//Prevents going back on an expired session.
function preventBack()
{
    if (!isset($_SESSION['login_id'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}

//Auto Login if there is an existing session.
function autoLogin()
{
    if (isset($_SESSION['login_id'])) {
        header("Location: dashboard.php");
        exit();
    }
}

//This enables the login functionality for the system.
function login()
{
    include 'connection.php';
    $_SESSION['usertype'] = $_POST['usertype'];
    $usertype = $_SESSION['usertype'];
    if (isset($_POST['login'])) {
        if ($usertype == "Admin") {
            $login_id = $_POST['login_id'];
            $password = $_POST['password'];
            $sql = "SELECT login_id, password, usertype FROM tb_login WHERE login_id='$login_id' AND password='$password' limit 1";
            $result = mysqli_query($conn, $sql) or die("Connection error!");
            //Login Validation
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['login_id'] = $_POST['login_id'];
                $_SESSION['password'] = $_POST['password'];
                $iden = "SELECT login_id, usertype FROM tb_login WHERE login_id='$login_id'";
                $result = mysqli_query($conn, $iden);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $login_id = $row["login_id"];
                    $usertype = $row["usertype"];
                }
                loginSession($login_id, $usertype);
            } else {
                echo 'Your ID or Password is incorrect!';
            }
        } else if ($usertype == "Student") {
            $login_id = $_POST['login_id'];
            $password = $_POST['password'];
            $sql = "SELECT student_id, password, usertype FROM tb_login WHERE student_id='$login_id' AND password='$password' limit 1";
            $result = mysqli_query($conn, $sql) or die("Connection error!");
            //Login Validation
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['login_id'] = $_POST['login_id'];
                $_SESSION['password'] = $_POST['password'];
                $iden = "SELECT login_id, student_id, usertype FROM tb_login WHERE student_id='$login_id'";
                $result = mysqli_query($conn, $iden);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $login_id = $row["student_id"];
                    $usertype = $row["usertype"];
                }
                loginSession($login_id, $usertype);
            } else {
                echo 'Your ID or Password is incorrect!';
            }
        } else if ($usertype == "Faculty") {
            $login_id = $_POST['login_id'];
            $password = $_POST['password'];
            $sql = "SELECT faculty_id, password, usertype FROM tb_login WHERE faculty_id='$login_id' AND password='$password' limit 1";
            $result = mysqli_query($conn, $sql) or die("Connection error!");
            //Login Validation
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['login_id'] = $_POST['login_id'];
                $_SESSION['password'] = $_POST['password'];
                $iden = "SELECT login_id, faculty_id, usertype FROM tb_login WHERE faculty_id='$login_id'";
                $result = mysqli_query($conn, $iden);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $login_id = $row["faculty_id"];
                    $usertype = $row["usertype"];
                }
                loginSession($login_id, $usertype);
            } else {
                echo 'Your ID or Password is incorrect!';
            }
        }
        mysqli_close($conn);
    }
}

//Processes all the sessions and cookies upon login.
function loginSession($login_id, $usertype)
{
    $_SESSION['login_id'] = $login_id;
    $_SESSION['usertype'] = $usertype;
    fetchUserInfo($login_id, $usertype);
    header("Location: dashboard.php");
    setcookie("FacultyEvaluationID", $_SESSION['login_id'], time() + 86400, "/", "facultyevaluation.elementfx.com");
    setcookie("FacultyEvaluationPassword", $_SESSION['password'], time() + 86400, "/", "facultyevaluation.elementfx.com");
}

function fetchUserInfo($login_id, $usertype)
{
    include "connection.php";
    if ($usertype == "Admin") {
        $_SESSION['username'] = "Admin";
        $_SESSION['photo'] = "admin.jpg";
    } else if ($usertype == "Student") {
        $sql = "SELECT firstname, lastname, photo FROM tb_students WHERE student_id='$login_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $photo = $row["photo"];
        }
        $_SESSION['username'] = "$firstname $lastname";
        $_SESSION['photo'] = "$photo";
        mysqli_close($conn);
    } else if ($usertype == "Faculty") {
        $sql = "SELECT firstname, lastname, photo FROM tb_faculty WHERE faculty_id='$login_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $photo = $row["photo"];
        }
        $_SESSION['username'] = "$firstname $lastname";
        $_SESSION['photo'] = "$photo";
        mysqli_close($conn);
    }
}

//This shows all of the items in the side menu of the website.
function sidebarIdentify()
{
    if ($_SESSION['usertype'] == 'Admin') {
        echo '
        <li><a href="dashboard.php"><i class="fas fa-desktop i"></i><span>Dashboard</span></a></li>
        <li><a href="courses.php"><i class="fas fa-book i"></i><span>Courses</span></a></li>
        <li><a href="subjects.php"><i class="fas fa-book-open i"></i><span>Subjects</span></a></li>
        <li><a href="sections.php"><i class="fas fa-table i"></i><span>Sections</span></a></li>
        <li><a href="students.php"><i class="fas fa-user i"></i><span>Students</span></a></li>
        <li><a href="faculty.php"><i class="fas fa-chalkboard-teacher i"></i><span>Faculty</span></a></li>
        <li><a href="accounts.php"><i class="fas fa-users i"></i><span>Accounts</span></a></li>
        <li><a href="evaluations.php"><i class="fas fa-calendar-check i"></i><span>Evaluations</span></a></li>
        <li><a href="about.php"><i class="fas fa-info-circle i"></i><span>About</span></a></li>
        ';
    } else if ($_SESSION['usertype'] == 'Student') {
        echo '
        <li><a href="dashboard.php"><i class="fas fa-desktop i"></i><span>Dashboard</span></a></li>
        <li><a href="student_profile.php"><i class="fas fa-user i"></i><span>Profile</span></a></li>
        <li><a href="student_subjects.php"><i class="fas fa-book-open i"></i><span>Subjects</span></a></li>
        <li><a href="student_faculty.php"><i class="fas fa-chalkboard-teacher i"></i><span>Faculty</span></a></li>
        <li><a href="about.php"><i class="fas fa-info-circle i"></i><span>About</span></a></li>
        ';
    } else if ($_SESSION['usertype'] == 'Faculty') {
        echo '
        <li><a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a></li>
        <li><a href="faculty_profile.php"><i class="fas fa-user i"></i><span>Profile</span></a></li>
        <li><a href="faculty_sections.php"><i class="fas fa-table i"></i><span>Sections</span></a></li>
        <li><a href="faculty_subjects.php"><i class="fas fa-book-open i"></i><span>Subjects</span></a></li>
        <li><a href="faculty_students.php"><i class="fas fa-users i"></i><span>Students</span></a></li>
        <li><a href="about.php"><i class="fas fa-info-circle i"></i><span>About</span></a></li>
        ';
    }
}

//------------------------------ Adding Records ------------------------------
//Adds a new student in the record.
function addStudent()
{
    if (isset($_POST['addstudent'])) {
        include 'connection.php';
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $yearlevel = $_POST['yearlevel'];
        $contact_no = $_POST['contact_no'];
        $address = $_POST['address'];
        $status = $_POST['status'];
        $course = $_POST['course_id'];
        $section = $_POST['section_id'];
        
        if ($_FILES['photo'] == UPLOAD_ERR_NO_FILE) {
            $photo = 'standard.png';
        } else {
            include './assets/php/uploadPhoto_add.php';
        }

        //Add Student
        $sql = "INSERT INTO tb_students (student_id, firstname, lastname, email, gender, yearlevel, contact_no, address, status, photo, course_id, section_id) VALUES (null, '$firstname', '$lastname', '$email', '$gender', '$yearlevel', $contact_no, '$address', '$status', '$photo', '$course', '$section')";
        if (mysqli_query($conn, $sql)) {
            $sql2 = "SELECT student_id FROM tb_students ORDER BY student_id DESC LIMIT 1;";
            $result = mysqli_query($conn, $sql2);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $sid_value = $row["student_id"];
            }
            $sql3 = "INSERT INTO tb_login (login_id, student_id, faculty_id, password, usertype) VALUES (null, $sid_value, null, '$lastname$contact_no', 'Student')";
            if (mysqli_query($conn, $sql3)) {
                ?><script src="/assets/js/addAlert.js"></script><?php
            } else {
                ?><script src="/assets/js/errorAlert.js"></script><?php
            }
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//Adds a new faculty member in the record.
function addFaculty()
{
    if (isset($_POST['addfaculty'])) {
        include 'connection.php';
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $contact_no = $_POST['contact_no'];
        $address = $_POST['address'];

        if ($_FILES['photo'] == UPLOAD_ERR_NO_FILE) {
            $photo = 'standard.png';
        } else {
            include './assets/php/uploadPhoto_add.php';
        }

        //Add Faculty
        $sql = "INSERT INTO tb_faculty (faculty_id, firstname, lastname, email, gender, contact_no, address, photo) VALUES (null, '$firstname', '$lastname', '$email', '$gender', $contact_no, '$address', '$photo')";
        if (mysqli_query($conn, $sql)) {
            $sql2 = "SELECT faculty_id FROM tb_faculty ORDER BY faculty_id DESC LIMIT 1;";
            $result = mysqli_query($conn, $sql2);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $fid_value = $row["faculty_id"];
            }
            $sql3 = "INSERT INTO tb_login (login_id, student_id, faculty_id, password, usertype) VALUES (null, null, $fid_value, '$lastname$contact_no', 'Faculty')";
            if (mysqli_query($conn, $sql3)) {
                ?><script src="/assets/js/addAlert.js"></script><?php
            } else {
                ?><script src="/assets/js/errorAlert.js"></script><?php
            }
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//Adds a new evaluation in the record.
function addEvaluation()
{
    if (isset($_POST['addevaluation'])) {
        include 'connection.php';
        $schoolyear = $_POST['schoolyear'];
        $semester = $_POST['semester'];
        $status = $_POST['status'];
        $section_id = $_POST['section_id'];

        //Add Evaluation
        $sql = "INSERT INTO tb_evaluations (evaluation_id, schoolyear, semester, status, section_id) VALUES (null, '$schoolyear', '$semester', '$status', '$section_id')";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/addAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//Adds a new course in the record.
function addCourse()
{
    if (isset($_POST['addcourse'])) {
        include 'connection.php';
        $course_name = $_POST['course_name'];

        //Add Course
        $sql = "INSERT INTO tb_courses (course_id, course_name) VALUES (null, '$course_name')";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/addAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//Adds a new subject in the record.
function addSubject()
{
    if (isset($_POST['addsubject'])) {
        include 'connection.php';
        $subject_code = $_POST['subject_code'];
        $subject_name = $_POST['subject_name'];
        $units = $_POST['units'];

        //Add Subject
        $sql = "INSERT INTO tb_subjects (subject_id, subject_code, subject_name, units) VALUES (null, '$subject_code', '$subject_name', '$units')";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/addAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//Adds a new section in the record.
function addSection()
{
    if (isset($_POST['addsection'])) {
        include 'connection.php';
        $section_name = $_POST['section_name'];

        //Add Section
        $sql = "INSERT INTO tb_sections (section_id, section_name) VALUES (null, '$section_name')";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/addAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//Adds a new section relation in the record.
function addSecrel()
{
    if (isset($_POST['addsecrel'])) {
        include 'connection.php';
        $section_id = $_GET['section_id'];
        $subject_code = $_POST['subject_code'];
        $faculty_id = $_POST['faculty_id'];

        $fetch_subject_id = "SELECT subject_id FROM tb_subjects WHERE subject_code = '$subject_code'";
        $result = mysqli_query($conn, $fetch_subject_id);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $subject_id = $row["subject_id"];
        }

        //Add Subject to Sections
        $sql = "INSERT INTO tb_sectionsRelation (secrel_id, section_id, subject_id, faculty_id) VALUES (null, $section_id, $subject_id, $faculty_id)";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/addAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//Adds a new question in the record.
function addQuestion()
{
    if (isset($_POST['addquestion'])) {
        include 'connection.php';
        $question = $_POST['question'];

        //Add Subject
        $sql = "INSERT INTO tb_questions (question_id, question) VALUES (null, '$question')";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/addAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//------------------------------ Editing Records ------------------------------
//Student Edit and Confirmation
function editStudent()
{
    if (isset($_POST['editstudent'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_firstname = $_POST['edit_firstname'];
        $edit_lastname = $_POST['edit_lastname'];
        $edit_email = $_POST['edit_email'];
        $edit_gender = $_POST['edit_gender'];
        $edit_yearlevel = $_POST['edit_yearlevel'];
        $edit_contact_no = $_POST['edit_contact_no'];
        $edit_address = $_POST['edit_address'];
        $edit_status = $_POST['edit_status'];
        $edit_course_id = $_POST['edit_course_id'];
        $edit_section_id = $_POST['edit_section_id'];
        $edit_photo = null;

        if ($_FILES['edit_photo'] == UPLOAD_ERR_NO_FILE) {
            $sql = "UPDATE tb_students SET firstname='$edit_firstname', lastname='$edit_lastname', email='$edit_email', gender='$edit_gender', yearlevel='$edit_yearlevel', contact_no='$edit_contact_no', address='$edit_address', status='$edit_status', course_id='$edit_course_id', section_id='$edit_section_id' WHERE student_id='$edit_id'";
        } else {
            include './assets/php/uploadPhoto_edit_student.php';
            $sql = "UPDATE tb_students SET firstname='$edit_firstname', lastname='$edit_lastname', email='$edit_email', gender='$edit_gender', yearlevel='$edit_yearlevel', contact_no='$edit_contact_no', address='$edit_address', status='$edit_status', photo='$edit_photo', course_id='$edit_course_id', section_id='$edit_section_id' WHERE student_id='$edit_id'";
        }
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//Faculty Edit and Confirmation
function editFaculty()
{  
    if (isset($_POST['editfaculty'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_firstname = $_POST['edit_firstname'];
        $edit_lastname = $_POST['edit_lastname'];
        $edit_email = $_POST['edit_email'];
        $edit_gender = $_POST['edit_gender'];
        $edit_contact_no = $_POST['edit_contact_no'];
        $edit_address = $_POST['edit_address'];
        $edit_photo = null;
        
        if ($_FILES['edit_photo'] == UPLOAD_ERR_NO_FILE) {
            $sql = "UPDATE tb_faculty SET firstname='$edit_firstname', lastname='$edit_lastname', email='$edit_email', gender='$edit_gender', contact_no='$edit_contact_no', address='$edit_address' WHERE faculty_id='$edit_id'";
        } else {
            include './assets/php/uploadPhoto_edit_faculty.php';
            $sql = "UPDATE tb_faculty SET firstname='$edit_firstname', lastname='$edit_lastname', email='$edit_email', gender='$edit_gender', contact_no='$edit_contact_no', address='$edit_address', photo='$edit_photo' WHERE faculty_id='$edit_id'";
        }
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

function editAccount()
{
    if (isset($_POST['editaccount'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_password = $_POST['edit_password'];
        $sql = "UPDATE tb_login SET password='$edit_password' WHERE login_id='$edit_id'";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

function editCourse()
{
    if (isset($_POST['editcourse'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_course_name = $_POST['edit_course_name'];
        $sql = "UPDATE tb_courses SET course_name='$edit_course_name' WHERE course_id='$edit_id'";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

// Edit confirmation for subject
function editSubject()
{
    if (isset($_POST['editsubject'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_subject_code = $_POST['edit_subject_code'];
        $edit_subject_name = $_POST['edit_subject_name'];
        $edit_units = $_POST['edit_units'];
        
        $sql = "UPDATE tb_subjects SET subject_code='$edit_subject_code', subject_name='$edit_subject_name', units='$edit_units' WHERE subject_id='$edit_id'";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

// Edit confirmation for section
function editSection()
{
    if (isset($_POST['editsection'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_section_name = $_POST['edit_section_name'];
        $sql = "UPDATE tb_sections SET section_name='$edit_section_name' WHERE section_id='$edit_id'";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

function editSecrel()
{
    if (isset($_POST['editsecrel'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_subject_code = $_POST['edit_subject_code'];
        $edit_faculty_id = $_POST['edit_faculty_id'];

        $fetch_subject_id = "SELECT subject_id FROM tb_subjects WHERE subject_code = '$edit_subject_code'";
        $result = mysqli_query($conn, $fetch_subject_id);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $subject_id = $row["subject_id"];
        }

        //Add Subject to Sections
        $sql = "UPDATE tb_sectionsRelation SET subject_id='$subject_id', faculty_id='$edit_faculty_id' WHERE secrel_id='$edit_id'";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//------------------------------ Deleting Records ------------------------------
function enableDelete_students()
{
    include 'connection.php';
    //Delete Students
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM tb_students WHERE student_id='$delete_id'";
        $sql2 = "DELETE FROM tb_login WHERE student_id='$delete_id'";
        mysqli_query($conn, $sql) or die("Connection error!");
        mysqli_query($conn, $sql2) or die("Connection error!");
        header('location: students.php');
    }
}

function enableDelete_faculty()
{
    include 'connection.php';
    //Delete Faculty
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM tb_faculty WHERE faculty_id='$delete_id'";
        $sql2 = "DELETE FROM tb_login WHERE faculty_id='$delete_id'";
        mysqli_query($conn, $sql) or die("Connection error!");
        mysqli_query($conn, $sql2) or die("Connection error!");
        header('location: faculty.php');
    }
}

function enableDelete_subjects()
{
    include 'connection.php';
    //Delete Subject
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM tb_subjects WHERE subject_id='$delete_id'";

        mysqli_query($conn, $sql) or die("Connection error!");
        header('location: subjects.php');
    }
}

function enableDelete_sections()
{
    include 'connection.php';
    //Delete Section
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM tb_sections WHERE section_id='$delete_id'";
        mysqli_query($conn, $sql) or die("Connection error!");
        header('location: sections.php');
    }
}

function enableDelete_courses()
{
    include 'connection.php';
    //Delete Courses
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM tb_courses WHERE course_id='$delete_id'";
        mysqli_query($conn, $sql) or die("Connection error!");
        header('Location: courses.php');
    }
}

function enableDelete_evaluations()
{
    include 'connection.php';
    //Delete Evaluation
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM tb_evaluations WHERE evaluation_id='$delete_id'";
        mysqli_query($conn, $sql) or die("Connection error!");
        header('location: evaluations.php');
    }
}

function enableDelete_secrel()
{
    include 'connection.php';
    //Delete Sections Relation
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        $sql_section_id = "SELECT section_id FROM tb_sectionsRelation WHERE secrel_id = $delete_id";
        $result = mysqli_query($conn, $sql_section_id);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $section_id = $row["section_id"];
        }
        
        $sql = "DELETE FROM tb_sectionsRelation WHERE secrel_id='$delete_id'";
        mysqli_query($conn, $sql) or die("Connection error!");
        header("location: section_subjects.php?section_id=$section_id");
    }
}

function enableDelete_questions()
{
    include 'connection.php';
    //Delete Question
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM tb_questions WHERE question_id='$delete_id'";
        mysqli_query($conn, $sql) or die("Connection error!");
        header('location: edit_questions.php');
    }
}

//------------------------------ Showing Records ------------------------------
//This shows all the subjects that are available in a table format.
function showSubjects()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT subject_id, subject_code, subject_name, units FROM tb_subjects ORDER BY subject_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["subject_id"];
        $subject_code = $row["subject_code"];
        $subject_name = $row["subject_name"];
        $units = $row["units"];

        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='Subject Code'>$subject_code</td>
        <td data-label='Subject'>$subject_name</td>
        <td data-label='Units'>$units</td>
        <td data-label='Operation'>
        <a href='#view-info' class='view view-subject'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit edit-subject'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    mysqli_close($conn);
}

//This shows all the sections that are available in a table format.
function showSections()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT section_id, section_name FROM tb_sections ORDER BY section_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["section_id"];
        $section_name = $row["section_name"];
        $sql2 = "SELECT student_id FROM tb_students WHERE section_id = $primary_id";
        $result2 = mysqli_query($conn, $sql2);
        $students = mysqli_num_rows($result2);
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='Section'>$section_name</td>
        <td data-label='Students'>$students</td>
        <td data-label='Operation'>
        <a href='#view-info' class='view view-section'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit edit-section'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    mysqli_close($conn);
}

//This shows all the evaluations that are available in a table format.
function showEvaluations()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT evaluation_id, schoolyear, semester, status, section_id FROM tb_evaluations ORDER BY evaluation_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $evaluation_id = $row["evaluation_id"];
        $schoolyear = $row["schoolyear"];
        $semester = $row["semester"];
        $status = $row["status"];
        $section_id = $row["section_id"];
        echo "
        <tr>
        <td data-label='ID'>$evaluation_id</td>
        <td data-label='School Year'>$schoolyear</td>
        <td data-label='Semester'>$semester</td>
        <td data-label='Status'>$status</td>
        <td data-label='Section ID'>$section_id</td>
        <td data-label='Operation'><a class='edit' id='editevaluation' onclick='EditFunction()'><i class='fas fa-edit'></i> <span>Edit</span></a></td>
        <td data-label='Operation'><a href='evaluations.php?delete_evaluation_id=$evaluation_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a></td>
        </tr>
        ";
    }
    mysqli_close($conn);
}

//This shows all the feedbacks of the students in a table format.
function showFeedback()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT feedback_id, question1, comment, rating, login_id FROM tb_feedback WHERE student_id = $student_id ORDER BY feedback_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $feedback_id = $row["feedback_id"];
        $answer = $row["answer"];
        $question_id = $row["question_id"];
        $student_id = $row["student_id"];
        $faculty_id = $row["faculty_id"];
        echo "
        <tr>
        <th data-title='Feedback ID'>$feedback_id</th>
        <th data-title='Answer'>$answer</th>
        <th data-title='Question'>$question_id</th>
        <th data-title='Student ID'>$student_id</th>
        <th data-title='Faculty ID'>$faculty_id</th>
        <th data-title='Edit'><a href='feedback.php?edit_feedback_id=$feedback_id' class='btn'> <span>Edit</span></a></th>
        <th data-title='Delete'><a onclick='javascript:confirmationDelete($(this));return false;' href='feedback.php?delete_feedback_id=$feedback_id' class='btn'> <span>Delete</span></a></th>
        </tr>
        ";
    }
    mysqli_close($conn);
}

//This shows all the courses that are available in a table format.
function showCourses()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT course_id, course_name FROM tb_courses ORDER BY course_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["course_id"];
        $course_name = $row["course_name"];
        $sql2 = "SELECT student_id FROM tb_students WHERE course_id = $primary_id";
        $result2 = mysqli_query($conn, $sql2);
        $students = mysqli_num_rows($result2);
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='Course'>$course_name</td>
        <td data-label='Students'>$students</td>
        <td data-label='Operation'>
        <a href='#view-info' class='view view-course'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit edit-course'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    mysqli_close($conn);
}

//This shows all the faculty staff in a table format.
function showFaculty()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT faculty_id, firstname, lastname, email, gender, contact_no, address, photo FROM tb_faculty ORDER BY faculty_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["faculty_id"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $email = $row["email"];
        $gender = $row["gender"];
        $contact_no = $row["contact_no"];
        $address = $row["address"];
        $photo = $row["photo"];
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='FIRST NAME'>$firstname</td>
        <td data-label='LAST NAME'>$lastname</td>
        <td data-label='EMAIL'>$email</td>
        <td data-label='GENDER'>$gender</td>
        <td data-label='CONTACT NO.'>$contact_no</td>
        <td data-label='ADDRESS'>$address</td>
        <td data-label='PHOTO'><img src='/images/uploads/$photo' width=50px height=50px><span style='display: none;'>$photo</span></td>
        <td data-label='Operation'>
        <a href='#view-info' class='view view-faculty'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit edit-faculty'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    mysqli_close($conn);
}

//This shows all the students in a table format.
function showStudents()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT student_id, firstname, lastname, email, gender, yearlevel, contact_no, address, status, photo, course_id, section_id FROM tb_students ORDER BY student_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["student_id"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $email = $row["email"];
        $gender = $row["gender"];
        $yearlevel = $row["yearlevel"];
        $contact_no = $row["contact_no"];
        $address = $row["address"];
        $status = $row["status"];
        $photo = $row["photo"];
        $course_id = $row["course_id"];
        $section_id = $row["section_id"];
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='FIRST NAME'>$firstname</td>
        <td data-label='LAST NAME'>$lastname</td>
        <td data-label='EMAIL'>$email</td>
        <td data-label='GENDER'>$gender</td>
        <td data-label='YEAR LEVEL'>$yearlevel</td>
        <td data-label='CONTACT NO.'>$contact_no</td>
        <td data-label='ADDRESS'>$address</td>
        <td data-label='STATUS'>$status</td>
        <td data-label='PHOTO'><img src='/images/uploads/$photo' alt='' width=50px height=50px><span style='display: none;'>$photo</span></td>
        <td data-label='COURSE ID'>$course_id</td>
        <td data-label='SECTION ID'>$section_id</td>
        <td data-label='Operation'>
        <a href='#view-info' class='view view-student'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit edit-student'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    mysqli_close($conn);
}

//This shows all the accounts in the database.
function showAccounts()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT login_id, student_id, faculty_id, password, usertype FROM tb_login ORDER BY usertype";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["login_id"];
        $student_id = $row["student_id"];
        $faculty_id = $row["faculty_id"];
        $password = $row["password"];
        $usertype = $row["usertype"];
        if ($usertype == "Student") {
            $sql2 = "SELECT firstname, lastname FROM tb_students WHERE student_id = $student_id";
            $result2 = mysqli_query($conn, $sql2);
            while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
            }
            echo "
            <tr>
            <td data-label='Login ID'>$primary_id</td>
            <td data-label='User ID'>$student_id</td>
            <td data-label='Full Name'>$firstname $lastname</td>
            <td data-label='Password'>$password</td>
            <td data-label='User Type'>$usertype</td>
            <td data-label='Operation'>
            <a href='#view-info' class='view view-account'><i class='fas fa-eye'></i> <span>View</span></a>
            <a class='edit edit-account'><i class='fas fa-edit'></i> <span>Edit</span></a>
            </td>
            </tr>
            ";
        } else if ($usertype == "Faculty") {
            $sql2 = "SELECT firstname, lastname FROM tb_faculty WHERE faculty_id = $faculty_id";
            $result2 = mysqli_query($conn, $sql2);
            while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
            }
            echo "
            <tr>
            <td data-label='Login ID'>$primary_id</td>
            <td data-label='User ID'>$faculty_id</td>
            <td data-label='Full Name'>$firstname $lastname</td>
            <td data-label='Password'>$password</td>
            <td data-label='User Type'>$usertype</td>
            <td data-label='Operation'>
            <a href='#view-info' class='view view-account'><i class='fas fa-eye'></i><span> View</span></a>
            <a class='edit edit-account'><i class='fas fa-edit'></i><span> Edit</span></a>
            </td>
            </tr>
            ";
        } 
    }
    mysqli_close($conn);
}

//This shows the Sections relation in a table format.
function showSectionsRelation($section_id)
{
    include 'connection.php';
    global $count;
    $sql = "SELECT secrel_id, subject_id, faculty_id FROM tb_sectionsRelation WHERE section_id = $section_id ORDER BY secrel_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["secrel_id"];
        $subject_id = $row["subject_id"];
        $faculty_id = $row["faculty_id"];
        //Get Subject Name
        $sql_subject = "SELECT subject_code, subject_name FROM tb_subjects WHERE subject_id = $subject_id";
        $result_subject = mysqli_query($conn, $sql_subject);
        while ($row = mysqli_fetch_array($result_subject, MYSQLI_ASSOC)) {
            $subject_code = $row["subject_code"];
            $subject_name = $row["subject_name"];
        }
        //Get Faculty Name
        $sql_faculty = "SELECT firstname, lastname FROM tb_faculty WHERE faculty_id = $faculty_id";
        $result_faculty = mysqli_query($conn, $sql_faculty);
        while ($row = mysqli_fetch_array($result_faculty, MYSQLI_ASSOC)) {
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
        }
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='Subject Code'>$subject_code</td>
        <td data-label='Subject'>$subject_name</td>
        <td data-label='Faculty'>$firstname $lastname</td>
        <td data-label='Faculty ID'>$faculty_id</td>
        <td data-label='Operation'>
        <a class='edit edit-secrel'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    mysqli_close($conn);
}

// Load Manage Data
function loadSectionsRelation($section_id)
{
    include 'connection.php';
    global $count;
    $sql = "SELECT section_name FROM tb_sections WHERE section_id = $section_id ORDER BY section_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $section_name = $row["section_name"];
        $sql2 = "SELECT student_id FROM tb_students WHERE section_id = $section_id";
        $result2 = mysqli_query($conn, $sql2);
        $students = mysqli_num_rows($result2);
        echo "
        <table class='user-table'>
        <tbody>
            <tr>
                <th>ID Info</th>
                <td data-label='ID Info'>$section_id</td>
            </tr>
            <tr>
                <th>Section Info</th>
                <td data-label='Section Info'>$section_name</td>
            </tr>
            <tr>
                <th>Students Count</th>
                <td data-label='Students Count'>$students</td>
            </tr>
        <tbody>
        </table>
        ";
    }
    mysqli_close($conn);
}

//This shows all the courses that are available in a table format.
function showEditQuestions()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT question_id, question FROM tb_questions ORDER BY question_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["question_id"];
        $question = $row["question"];
        echo "
        <tr>
            <td>$question</td>
            <td data-label='Stongly Disagree'><input type='radio' name='question$primary_id' value='1'></td>
            <td data-label='Disagree'><input type='radio' name='question$primary_id' value='2'></td>
            <td data-label='Uncertain'><input type='radio' name='question$primary_id' value='3'></td>
            <td data-label='Agree'><input type='radio' name='question$primary_id' value='4'></td>
            <td data-label='Strongly Agree'><input type='radio' name='question$primary_id' value='5'></td>
            <td data-label='Operation'>
            <a class='edit edit-question-func'><i class='fas fa-edit'></i> <span>Edit</span></a>
            <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
            </td>
        <tr>
        ";
    }
    mysqli_close($conn);
}

//------------------------------ Searching Records ------------------------------
//Search courses functionality
function searchCourses()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT course_id, course_name FROM tb_courses ORDER BY course_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $course_id = $row["course_id"];
        $course_name = $row["course_name"];
        echo "
        <tr>
        <th data-title='Course ID'>$course_id</th>
        <th data-title='Course Name'>$course_name</th>
        <th data-title='Edit'><a href='courses.php?edit_course_id=$course_id' class='btn'>Edit</a></th>
        <th data-title='Delete'><a onclick='javascript:confirmationDelete($(this));return false;' href='courses.php?delete_course_id=$course_id' class='btn'>Delete</a></th>
        </tr>
        ";
    }
    mysqli_close($conn);
}

//------------------------------ Combo Box Content ------------------------------
//Courses Combo Box
function cbCourse()
{
    include 'connection.php';
    $sql = "SELECT course_id, course_name FROM tb_courses";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $course_id = $row["course_id"];
        $course_name = $row["course_name"];
        echo "<option value='$course_id'>$course_name</option>";
    }
    mysqli_close($conn);
}

//Sections Combo Box
function cbSection()
{
    include 'connection.php';
    $sql = "SELECT section_id, section_name FROM tb_sections";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $section_id = $row["section_id"];
        $section_name = $row["section_name"];
        echo "<option value='$section_id'>$section_name</option>";
    }
    mysqli_close($conn);
}

//Subjects Combo Box
function cbSubject()
{
    include 'connection.php';
    $sql = "SELECT subject_code, subject_name FROM tb_subjects";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $subject_code = $row["subject_code"];
        $subject_name = $row["subject_name"];
        echo "<option value='$subject_code'>$subject_name</option>";
    }
    mysqli_close($conn);
}

//Faculty Combo Box
function cbFaculty()
{
    include 'connection.php';
    $sql = "SELECT faculty_id, firstname, lastname FROM tb_faculty";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $faculty_id = $row["faculty_id"]; 
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        echo "<option value='$faculty_id'>$firstname $lastname</option>";
    }
    mysqli_close($conn);
}

//------------------------------ Dashboard Statistics ------------------------------
//Subject Count
function subjectCount()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT subject_id, subject_code, subject_name, units FROM tb_subjects";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Section Count
function sectionCount()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT section_id, section_name FROM tb_sections";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Evaluation Count
function evaluationCount()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT evaluation_id, schoolyear, semester, status, section_id FROM tb_evaluations";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Feedback Count
function feedbackCount()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT feedback_id, question1, comment, rating, login_id FROM tb_feedback WHERE student_id = $student_id ORDER BY feedback_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Course Count
function courseCount()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT course_id, course_name FROM tb_courses ORDER BY course_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Faculty Count
function facultyCount()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT faculty_id, firstname, lastname, email, gender, contact_no, address, photo FROM tb_faculty ORDER BY faculty_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Student Count
function studentCount()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT student_id, firstname, lastname, email, gender, yearlevel, contact_no, address, status, photo, course_id, section_id FROM tb_students ORDER BY student_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Accounts Count
function accountsCount()
{
    include 'connection.php';
    global $count;
    $sql = "SELECT login_id, student_id, faculty_id, password, usertype FROM tb_login ORDER BY login_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result) - 1;
    echo "$count";
    mysqli_close($conn);
}
