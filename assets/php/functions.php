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
        $sql = "SELECT firstname, lastname, photo, section_id FROM tb_students WHERE student_id='$login_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $photo = $row["photo"];
            $section_id = $row["section_id"];
        }
        $_SESSION['username'] = "$firstname $lastname";
        $_SESSION['section_id'] = "$section_id";
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
        <li><a href="evaluation_status.php"><i class="fas fa-calendar-check i"></i><span>Evaluations</span></a></li>
        <li><a href="sentiment_terms.php"><i class="fas fa-comment i"></i><span>Sentiment Terms</span></a></li>
        ';
    } else if ($_SESSION['usertype'] == 'Student') {
        echo '
        <li><a href="dashboard.php"><i class="fas fa-desktop i"></i><span>Dashboard</span></a></li>
        <li><a href="student_profile.php"><i class="fas fa-user i"></i><span>Profile</span></a></li>
        ';
    } else if ($_SESSION['usertype'] == 'Faculty') {
        echo '
        <li><a href="dashboard.php"><i class="fas fa-desktop i"></i><span>Dashboard</span></a></li>
        <li><a href="faculty_profile.php"><i class="fas fa-user i"></i><span>Profile</span></a></li>
        ';
    }
}

//------------------------------ Adding Records ------------------------------
//Adds a new student in the record.
function addStudent()
{
    if (isset($_POST['addstudent'])) {
        include 'connection.php';
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $yearlevel = $_POST['yearlevel'];
        $contact_no = $_POST['contact_no'];
        $address = mysqli_real_escape_string($conn, $_POST['address']);
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
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $contact_no = $_POST['contact_no'];
        $address = mysqli_real_escape_string($conn, $_POST['address']);

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

//Adds a new course in the record.
function addCourse()
{
    if (isset($_POST['addcourse'])) {
        include 'connection.php';
        $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);

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
        $subject_name = mysqli_real_escape_string($conn, $_POST['subject_name']);
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
        $sql = "INSERT INTO tb_sections_relation (secrel_id, section_id, subject_id, faculty_id) VALUES (null, $section_id, $subject_id, $faculty_id)";
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
        $question = mysqli_real_escape_string($conn, $_POST['question']);

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

function evaluationValidationDelete($student_id, $faculty_id, $subject_id) {
    include 'connection.php';
    $del = "DELETE FROM tb_feedback WHERE student_id = $student_id AND faculty_id = $faculty_id AND subject_id = $subject_id AND date = CURDATE()";
    if (mysqli_query($conn, $del)) {
    } else {
        ?><script src="/assets/js/errorAlert.js"></script><?php
    }
    $del2 = "DELETE FROM tb_evaluation WHERE student_id = $student_id AND faculty_id = $faculty_id AND subject_id = $subject_id AND date = CURDATE()";
    if (mysqli_query($conn, $del2)) {
    } else {
        ?><script src="/assets/js/errorAlert.js"></script><?php
    }
    mysqli_close($conn);
}

//Submits the student evaluation.
function submitEvaluation($student_id, $faculty_id, $subject_id)
{
    if (isset($_POST['submitevaluation'])) {
        include 'connection.php';
        $question_count = "SELECT question_id, question FROM tb_questions ORDER BY question_id";
        $result = mysqli_query($conn, $question_count);
        $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $question_id = $row["question_id"];
            $answer = $_POST["question$question_id"];
            //Submit individual answers for each question
            $sql = "INSERT INTO tb_feedback (feedback_id, answer, date, question_id, student_id, faculty_id, subject_id, evaluation_id) VALUES (null, '$answer', CURDATE(), $question_id, $student_id, $faculty_id, $subject_id, 0)";
            if (mysqli_query($conn, $sql)) {
            } else {
                evaluationValidationDelete($student_id, $faculty_id, $subject_id);
                ?><script src="/assets/js/errorAlert.js"></script><?php
            }
        }
        //Fetch current school year and semester
        $sql_sysem = "SELECT schoolyear, semester FROM tb_active_eval WHERE active_id='1'";
        $sysemres = mysqli_query($conn, $sql_sysem);
        while ($row = mysqli_fetch_array($sysemres, MYSQLI_ASSOC)) {
            $schoolyear = $row["schoolyear"];
            $semester = $row["semester"];
        }
        //Calculate average rating
        $sql_avg = "SELECT ROUND(AVG(answer),1) AS rating_avg FROM tb_feedback WHERE student_id = $student_id AND faculty_id = $faculty_id AND subject_id = $subject_id AND date = CURDATE()";
        $avgres = mysqli_query($conn, $sql_avg);
        while ($row = mysqli_fetch_array($avgres, MYSQLI_ASSOC)) {
            $rating_avg = $row["rating_avg"];
        }
        //Submit the whole evaluation data
        $sql2 = "INSERT INTO tb_evaluations (evaluation_id, rating_avg, comment, date, schoolyear, semester, student_id, faculty_id, subject_id) VALUES (null, '$rating_avg', '$comment', CURDATE(), '$schoolyear', '$semester', $student_id, $faculty_id, $subject_id)";
        if (mysqli_query($conn, $sql2)) {
            //Get ID and comment of latest inserted evaluation
            $sql_latest_eval = "SELECT evaluation_id, comment FROM tb_evaluations ORDER BY evaluation_id DESC LIMIT 1";
            $evalres = mysqli_query($conn, $sql_latest_eval);
            while ($row = mysqli_fetch_array($evalres, MYSQLI_ASSOC)) {
                $evaluation_id = $row["evaluation_id"];
                $comment = $row["comment"];
            }
            //Set the latest evaluation ID to feedback
            $update_feedback = "UPDATE tb_feedback SET evaluation_id='$evaluation_id' WHERE student_id = $student_id AND faculty_id = $faculty_id AND subject_id = $subject_id AND date = CURDATE()";
            if (mysqli_query($conn, $update_feedback)) {
                insertTerms($comment);
                $sql_sentiment = "INSERT INTO tb_sentiment (positive_count, negative_count, sentiment_score, analysis, evaluation_id) VALUES (0, 0, 0, 'Neutral', $evaluation_id)";
                if (mysqli_query($conn, $sql_sentiment)) {
                    getSentiment($comment, $evaluation_id);
                    ?><script src="/assets/js/evaluationSuccess.js"></script><?php
                } else {
                    evaluationValidationDelete($student_id, $faculty_id, $subject_id);
                    ?><script src="/assets/js/errorAlert.js"></script><?php
                }
            } else {
                evaluationValidationDelete($student_id, $faculty_id, $subject_id);
                ?><script src="/assets/js/errorAlert.js"></script><?php
            }
        } else {
            evaluationValidationDelete($student_id, $faculty_id, $subject_id);
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

//------------------------------ Editing Records ------------------------------
// Student Edit
function editStudent()
{
    if (isset($_POST['editstudent'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_firstname = mysqli_real_escape_string($conn, $_POST['edit_firstname']);
        $edit_lastname = mysqli_real_escape_string($conn, $_POST['edit_lastname']);
        $edit_email = $_POST['edit_email'];
        $edit_gender = $_POST['edit_gender'];
        $edit_yearlevel = $_POST['edit_yearlevel'];
        $edit_contact_no = $_POST['edit_contact_no'];
        $edit_address = mysqli_real_escape_string($conn, $_POST['edit_address']);
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

// Faculty Edit
function editFaculty()
{  
    if (isset($_POST['editfaculty'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_firstname = mysqli_real_escape_string($conn, $_POST['edit_firstname']);
        $edit_lastname = mysqli_real_escape_string($conn, $_POST['edit_lastname']);
        $edit_email = $_POST['edit_email'];
        $edit_gender = $_POST['edit_gender'];
        $edit_contact_no = $_POST['edit_contact_no'];
        $edit_address = mysqli_real_escape_string($conn, $_POST['edit_address']);
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

// Password Edit
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

// Course Edit
function editCourse()
{
    if (isset($_POST['editcourse'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_course_name = mysqli_real_escape_string($conn, $_POST['edit_course_name']);
        $sql = "UPDATE tb_courses SET course_name='$edit_course_name' WHERE course_id='$edit_id'";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

// Subject Edit
function editSubject()
{
    if (isset($_POST['editsubject'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_subject_code = $_POST['edit_subject_code'];
        $edit_subject_name = mysqli_real_escape_string($conn, $_POST['edit_subject_name']);
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

// Section Edit
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

// Section Relation Edit
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
        $sql = "UPDATE tb_sections_relation SET subject_id='$subject_id', faculty_id='$edit_faculty_id' WHERE secrel_id='$edit_id'";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

// Question Edit
function editQuestion()
{
    if (isset($_POST['editquestion'])) {
        include 'connection.php';
        $edit_id = $_POST['edit_id'];
        $edit_question = mysqli_real_escape_string($conn, $_POST['edit_question']);
        $sql = "UPDATE tb_questions SET question='$edit_question' WHERE question_id='$edit_id'";
        if (mysqli_query($conn, $sql)) {
            ?><script src="/assets/js/editAlert.js"></script><?php
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        mysqli_close($conn);
    }
}

// Evaluation Edit
function editEvaluation()
{
    if (isset($_POST['editevaluation'])) {
        include 'connection.php';
        $yearstart = (int)$_POST['yearstart'];
        $yearend = $yearstart+1;
        $semester = $_POST['semester'];
        $status = $_POST['status'];
        
        $sql = "UPDATE tb_active_eval SET schoolyear='$yearstart-$yearend', semester='$semester', status='$status' WHERE active_id='1'";
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
        if (mysqli_query($conn, $sql)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        if (mysqli_query($conn, $sql2)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
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
        if (mysqli_query($conn, $sql)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        if (mysqli_query($conn, $sql2)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
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
        if (mysqli_query($conn, $sql)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
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
        if (mysqli_query($conn, $sql)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
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
        if (mysqli_query($conn, $sql)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
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
        if (mysqli_query($conn, $sql)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        header('location: evaluations.php');
    }
}

function enableDelete_secrel()
{
    include 'connection.php';
    //Delete Sections Relation
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        $sql_section_id = "SELECT section_id FROM tb_sections_relation WHERE secrel_id = $delete_id";
        $result = mysqli_query($conn, $sql_section_id);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $section_id = $row["section_id"];
        }
        
        $sql = "DELETE FROM tb_sections_relation WHERE secrel_id='$delete_id'";
        if (mysqli_query($conn, $sql)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
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
        if (mysqli_query($conn, $sql)) {
        } else {
            ?><script src="/assets/js/errorAlert.js"></script><?php
        }
        header('location: edit_questions.php');
    }
}

//------------------------------ Showing Records ------------------------------
//This shows the Sections relation in a table format.
function showSectionsRelation($section_id)
{
    include 'connection.php';
    global $count;
    $sql = "SELECT secrel_id, subject_id, faculty_id FROM tb_sections_relation WHERE section_id = $section_id ORDER BY secrel_id";
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

//Loads the selected section information to section subjects relationship page
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

//Loads the faculty and subject information for the student evaluation page
function loadFaculty($faculty_id, $subject_id)
{
    include 'connection.php';
    global $count;
    $sql = "SELECT firstname, lastname, photo FROM tb_faculty WHERE faculty_id = $faculty_id ORDER BY faculty_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $photo = $row["photo"];
        //Get Subject Name
        $sql_subject = "SELECT subject_code, subject_name FROM tb_subjects WHERE subject_id = $subject_id";
        $result_subject = mysqli_query($conn, $sql_subject);
        while ($row = mysqli_fetch_array($result_subject, MYSQLI_ASSOC)) {
            $subject_code = $row["subject_code"];
            $subject_name = $row["subject_name"];
        }
        echo "
        <div class='form-middle-faculty'>
            <div class='left-side'>
                <img src='./images/uploads/$photo' alt='' class='evaluation-faculty-picture'>
            </div>
            <div class='right-side'>
                <p class='label-question'>Faculty Name</p>
                <p>$firstname $lastname</p>
                <p class='label-question'>Subject Code</p>
                <p>$subject_code</p>
                <p class='label-question'>Description</p>
                <p>$subject_name</p>
            </div>
        </div>
        ";
    }
    mysqli_close($conn);
}

//This shows all the questions.
function showQuestions()
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
        <td>$primary_id</td>
        <td>$question</td>
        <td data-label='Stongly Disagree'><input type='radio' name='question$primary_id' value='1' required></td>
        <td data-label='Disagree'><input type='radio' name='question$primary_id' value='2'></td>
        <td data-label='Uncertain'><input type='radio' name='question$primary_id' value='3'></td>
        <td data-label='Agree'><input type='radio' name='question$primary_id' value='4'></td>
        <td data-label='Strongly Agree'><input type='radio' name='question$primary_id' value='5'></td>
        <tr>
        ";
    }
    mysqli_close($conn);
}

//This shows all the editable questions.
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
        <td>$primary_id</td>
        <td>$question</td>
        <td data-label='Stongly Disagree'><input type='radio' name='question$primary_id' value='1'></td>
        <td data-label='Disagree'><input type='radio' name='question$primary_id' value='2'></td>
        <td data-label='Uncertain'><input type='radio' name='question$primary_id' value='3'></td>
        <td data-label='Agree'><input type='radio' name='question$primary_id' value='4'></td>
        <td data-label='Strongly Agree'><input type='radio' name='question$primary_id' value='5'></td>
        <td data-label='Operation'>
        <a class='edit edit-question-func'><i class='fas fa-edit'></i></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i></a>
        </td>
        <tr>
        ";
    }
    mysqli_close($conn);
}

function showActiveEvaluation($usertype)
{
    include 'connection.php';
    global $count;
    $sql = "SELECT schoolyear, semester, status FROM tb_active_eval WHERE active_id='1'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $schoolyear = $row["schoolyear"];
        $semester = $row["semester"];
        $status = $row["status"];
        if ($usertype == "Student" & $status == "In Progress") {
            echo "
            <div class='anouncement'>
            <p class='acad-year'>Academic Year: $schoolyear $semester Semester</p>
            <p class='eval-status'>Evaluation Status: $status</p>
            <a href='./evaluation_list.php'>Start Evaluation</a>
            </div>
            ";
        } else {
            echo "
            <div class='anouncement'>
            <p class='acad-year'>Academic Year: $schoolyear $semester Semester</p>
            <p class='eval-status'>Evaluation Status: $status</p>
            </div>
            ";
        }
    }
    mysqli_close($conn);
}

function academicYear()
{
    include 'connection.php';
    $sql_sysem = "SELECT schoolyear, semester FROM tb_active_eval WHERE active_id='1'";
    $res = mysqli_query($conn, $sql_sysem);
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $schoolyear = $row["schoolyear"];
        $semester = $row["semester"];
        echo "$schoolyear $semester Semester";
    }
}

//This shows all the available evaluations for the students.
function availableEvaluations($section_id, $student_id)
{
    include 'connection.php';
    $sql = "SELECT secrel_id, subject_id, faculty_id FROM tb_sections_relation WHERE section_id = $section_id ORDER BY secrel_id";
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
        $sql_feedback = "SELECT feedback_id, answer, question_id, student_id, faculty_id, subject_id FROM tb_feedback WHERE faculty_id = $faculty_id AND subject_id = $subject_id AND student_id = $student_id";
        $result_feedback = mysqli_query($conn, $sql_feedback);
        $count_feedback = mysqli_num_rows($result_feedback);
        if ($count_feedback == 0) {
            echo "
            <tr>
            <td data-label='ID'>$primary_id</td>
            <td data-label='Subject Code'>$subject_code</td>
            <td data-label='Subject'>$subject_name</td>
            <td data-label='Faculty'>$firstname $lastname</td>
            <td data-label='Operation'>
            <a href='student_evaluation.php?faculty_id=$faculty_id&subject_id=$subject_id' class='add-main'>Evaluate</a>
            </td>
            </tr>
            ";
        } else {
            $finished_evaluations++;
        }
    }
    if (($count-$finished_evaluations) == 0) {
        echo "
        <tr>
        <td colspan='5'>There are no evaluations available.</td>
        </tr>
        ";
    }
    
    mysqli_close($conn);
}

//This shows all the evaluation reports for the facuklty.
function facultyEvaluationReports($faculty_id)
{
    include 'connection.php';
    $sql = "SELECT evaluation_id, rating_avg, date, schoolyear, semester, subject_id FROM tb_evaluations WHERE faculty_id = $faculty_id ORDER BY date DESC";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count != 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $primary_id = $row["evaluation_id"];
            $rating_avg = $row["rating_avg"];
            $date = $row["date"];
            $schoolyear = $row["schoolyear"];
            $semester = $row["semester"];
            $subject_id = $row["subject_id"];
            //Get Subject Name
            $sql_subject = "SELECT subject_name FROM tb_subjects WHERE subject_id = $subject_id";
            $result_subject = mysqli_query($conn, $sql_subject);
            while ($row = mysqli_fetch_array($result_subject, MYSQLI_ASSOC)) {
                $subject_name = $row["subject_name"];
            }
            echo "
            <tr>
            <td data-label='ID'>$primary_id</td>
            <td data-label='Subject'>$subject_name</td>
            <td data-label='School Year'>$schoolyear</td>
            <td data-label='Semester'>$semester</td>
            <td data-label='Rating'>$rating_avg</td>
            <td data-label='Date'>$date</td>
            <td data-label='Operation'>
            <a href='evaluation_report.php?evaluation_id=$primary_id' class='view'><i class='fas fa-eye'></i><span> View</span></a>
            </td>
            </tr>
            ";
        }
    } else {
        echo "
        <tr>
        <td colspan='7'>There are no evaluation reports.</td>
        </tr>
        ";
    }

    mysqli_close($conn);
}

//------------------------ Show Evaluation Report Data --------------------------
//This shows the questions and answers in evaluation report.
function showQuestions_ER($evaluation_id)
{
    include 'connection.php';
    $sql = "SELECT question_id, question FROM tb_questions ORDER BY question_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["question_id"];
        $question = $row["question"];
        $sql_answer = "SELECT answer FROM tb_feedback WHERE question_id = $primary_id AND evaluation_id = $evaluation_id";
        $result_answer = mysqli_query($conn, $sql_answer);
        while ($row_answer = mysqli_fetch_array($result_answer, MYSQLI_ASSOC)) {
            $answer = $row_answer["answer"];
        }
        echo "
        <tr>
        <td>$primary_id</td>
        <td>$question</td>
        <td data-label='Answer'>$answer</td>
        </tr>
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

//--------------------Sentiment Analysis Functionality---------------------
// Fetch Sentiment
function getSentiment($comment, $evaluation_id)
{
    include 'connection.php';

    // Format the comment
    $comment = preg_replace('/[^a-zA-Z0-9_ -]/s','',$comment);
    $comment = strtolower($comment);

    // Load a list of positive and negative words using database
    $positive_words = array();
    $negative_words = array();
    $sql_positive = "SELECT term FROM tb_terms WHERE term_type = 'positive'";
    $result_positive = mysqli_query($conn, $sql_positive);
    while ($row = mysqli_fetch_array($result_positive, MYSQLI_ASSOC)) {
        $positive_words[] = $row['term'];
    }
    $sql_negative = "SELECT term FROM tb_terms WHERE term_type = 'negative'";
    $result_negative = mysqli_query($conn, $sql_negative);
    while ($row = mysqli_fetch_array($result_negative, MYSQLI_ASSOC)) {
        $negative_words[] = $row['term'];
    }

    // Split the comment into an array of words
    $words = explode(' ', $comment);

    // Count the number of positive and negative words
    $positive_count = 0;
    $negative_count = 0;
    foreach ($words as $word) {
        if (in_array($word, $positive_words)) {
            $positive_count++;
        }
        if (in_array($word, $negative_words)) {
            $negative_count++;
        }
    }
    $sentiment_score = $positive_count - $negative_count;

    // Calculate the overall sentiment
    if ($positive_count > $negative_count) {
        $analysis = "Positive";
    } else if ($positive_count < $negative_count) {
        $analysis = "Negative";
    } else {
        $analysis = "Neutral";
    }

    // Update Sentiment Data
    $update_sentiment = "UPDATE tb_sentiment SET positive_count=$positive_count, negative_count=$negative_count, sentiment_score=$sentiment_score, analysis='$analysis' WHERE evaluation_id = $evaluation_id";
    mysqli_query($conn, $update_sentiment);
    mysqli_close($conn);
}

//This shows all the sections that are available in a table format.
function printSentiment($evaluation_id)
{
    include 'connection.php';
    $sql = "SELECT comment, date FROM tb_evaluations WHERE evaluation_id = $evaluation_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $comment = $row["comment"];
        $date = $row["date"];
        $sql_sentiment = "SELECT positive_count, negative_count, sentiment_score, analysis FROM tb_sentiment WHERE evaluation_id = $evaluation_id";
        $result_sentiment = mysqli_query($conn, $sql_sentiment);
        while ($row = mysqli_fetch_array($result_sentiment, MYSQLI_ASSOC)) {
            $positive_count = $row["positive_count"];
            $negative_count = $row["negative_count"];
            $sentiment_score = $row["sentiment_score"];
            $analysis = $row["analysis"];
        }

        echo "
        <div class='sentiment-analysis'>
            <div class='comment-box'>
                <p class='main-search-add-title'><i class='fas fa-search'></i> Terminologies!</p>
                <p><b>Positive Words</b></p>
                "; positiveTags($comment); echo "
                <p><b>Negative Words</b></p>
                "; negativeTags($comment); echo "
                <p><b>Neutral Words</b></p>
                "; neutralTags($comment); echo "
            </div>
            <div class='SentimentAnalyzed'>
                <p class='main-search-add-title'><i class='fas fa-search'></i> Sentiment!</p>
                <div class='comment-box-right'>
                    <div class='comment'>$comment</div>
                </div>
                <div class='container-sentiment-table'>
                    <table class='sentiment-table'>
                        <tbody>
                            <tr>
                                <th>Positive</th>
                                <td data-label='Positive'>$positive_count</td>
                            </tr>
                            <tr>
                                <th>Negative</th>
                                <td data-label='Negative'>$negative_count</td>
                            </tr>
                            <tr>
                                <th>Sentiment</th>
                                <td data-label='Sentiment'>$sentiment_score</td>
                            </tr>
                            <tr>
                                <th>Analysis</th>
                                <td data-label='Analysis'>$analysis</td>
                            </tr>
                        <tbody>
                    </table>
                </div>                    
            </div>
        </div>
        ";
    }
}

// Insert comment words into database
function insertTerms($comment)
{
    include 'connection.php';

    // Format the comment and separate each word
    $comment = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $comment);
    $comment = strtolower($comment);
    $words = explode(' ', $comment);

    foreach ($words as $word) {
        $sql = "INSERT INTO tb_terms (term, value, term_type) VALUES ('$word', 0, 'neutral')";
        mysqli_query($conn, $sql);
    }
}

//Adds sentiment terms.
function addSentiment()
{
    if (isset($_POST['addsentiment'])) {
        include 'connection.php';
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);

        // Format the comment and separate each word
        $comment = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $comment);
        $comment = strtolower($comment);
        $words = explode(' ', $comment);

        foreach ($words as $word) {
            $sql = "INSERT INTO tb_terms (term, value, term_type) VALUES ('$word', 0, 'neutral')";
            if (mysqli_query($conn, $sql)) {
            } else {
                ?><script src="/assets/js/errorAlert.js"></script><?php
            }
        }
    }
}

function positiveTags($comment)
{
    include 'connection.php';
    $senti_comment = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $comment);
    $senti_comment = strtolower($senti_comment);

    $positive_words = array();
    $sql_positive = "SELECT term FROM tb_terms WHERE term_type = 'positive'";
    $result_positive = mysqli_query($conn, $sql_positive);
    while ($row = mysqli_fetch_array($result_positive, MYSQLI_ASSOC)) {
        $positive_words[] = $row['term'];
    }

    $words = explode(' ', $senti_comment);
    foreach ($words as $word) {
        if (in_array($word, $positive_words)) {
            echo "<span style='
            background-color: green;
            color: white;
            border-radius: 1em;
            margin: 0.3em;
            padding: 0.5em;
            display: inline-block;
            width: auto;
            '>
            $word
            </span>";
        }
    }
}

function negativeTags($comment)
{
    include 'connection.php';
    $senti_comment = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $comment);
    $senti_comment = strtolower($senti_comment);

    $negative_words = array();
    $sql_negative = "SELECT term FROM tb_terms WHERE term_type = 'negative'";
    $result_negative = mysqli_query($conn, $sql_negative);
    while ($row = mysqli_fetch_array($result_negative, MYSQLI_ASSOC)) {
        $negative_words[] = $row['term'];
    }

    $words = explode(' ', $senti_comment);
    foreach ($words as $word) {
        if (in_array($word, $negative_words)) {
            echo "<span style='
            background-color: red;
            color: white;
            border-radius: 1em;
            margin: 0.3em;
            padding: 0.5em;
            display: inline-block;
            width: auto;
            '>
            $word
            </span>";
        }
    }
}

function neutralTags($comment)
{
    include 'connection.php';
    $senti_comment = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $comment);
    $senti_comment = strtolower($senti_comment);

    $neutral_words = array();
    $sql_neutral = "SELECT term FROM tb_terms WHERE term_type = 'neutral'";
    $result_neutral = mysqli_query($conn, $sql_neutral);
    while ($row = mysqli_fetch_array($result_neutral, MYSQLI_ASSOC)) {
        $neutral_words[] = $row['term'];
    }

    $words = explode(' ', $senti_comment);
    foreach ($words as $word) {
        if (in_array($word, $neutral_words)) {
            echo "<span style='
            background-color: gray;
            color: white;
            border-radius: 1em;
            margin: 0.3em;
            padding: 0.5em;
            display: inline-block;
            width: auto;
            '>
            $word
            </span>";
        }
    }
}

//------------------ Profile Functionalities ----------------------
//This shows the student information in their profile.
function showStudentProfile($student_id)
{
    include 'connection.php';
    $sql = "SELECT student_id, firstname, lastname, email, gender, yearlevel, contact_no, address, status, photo, course_id, section_id FROM tb_students WHERE student_id = $student_id";
    $result = mysqli_query($conn, $sql);
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
        //Get Course Name
        $sql_course = "SELECT course_name FROM tb_courses WHERE course_id = $course_id";
        $result_course = mysqli_query($conn, $sql_course);
        while ($row = mysqli_fetch_array($result_course, MYSQLI_ASSOC)) {
            $course_name = $row["course_name"];
        }
        //Get Section Name
        $sql_section = "SELECT section_name FROM tb_sections WHERE section_id = $section_id";
        $result_section = mysqli_query($conn, $sql_section);
        while ($row = mysqli_fetch_array($result_section, MYSQLI_ASSOC)) {
            $section_name = $row["section_name"];
        }
        echo "
        <tbody>
            <tr>
                <td rowspan='10' scope='row' style='text-align: center; padding-left: 5px;'><img src='./images/uploads/$photo' class='student-picture'></td>
                <th>Full Name</th>
                <td data-label='Full Name'>$firstname $lastname</td>
            </tr>
            <tr>
                <th>Student ID</th>
                <td data-label='Student ID'>$primary_id</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td data-label='Gender'>$gender</td>
            </tr>
            <tr>
                <th>Email</th>
                <td data-label='Email'>$email</td>
            </tr>
            <tr>
                <th>Contact No.</th>
                <td data-label='Contact No.'>$contact_no</td>
            </tr>
            <tr>
                <th>Year Level</th>
                <td data-label='Year Level'>$yearlevel</td>
            </tr>
            <tr>
                <th>Address</th>
                <td data-label='Address'>$address</td>
            </tr>
            <tr>
                <th>Status</th>
                <td data-label='Status'>$status</td>
            </tr>
            <tr>
                <th>Course</th>
                <td data-label='Course'>$course_name</td>
            </tr>
            <tr>
                <th>Section</th>
                <td data-label='Section'>$section_name</td>
            </tr>
        <tbody>
        ";
    }
    mysqli_close($conn);
}

//This shows the subjects that the student is currently enrolled.
function studentSubjects($student_id) {
    include 'connection.php';
    //Get Section ID
    $sql_student = "SELECT section_id FROM tb_students WHERE student_id = $student_id";
    $result_student = mysqli_query($conn, $sql_student);
    while ($row = mysqli_fetch_array($result_student, MYSQLI_ASSOC)) {
        $section_id = $row["section_id"];
    }
    $sql = "SELECT secrel_id, subject_id, faculty_id FROM tb_sections_relation WHERE section_id = $section_id ORDER BY secrel_id";
    $result = mysqli_query($conn, $sql);
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
        </tr>
        ";
    }
    mysqli_close($conn);
}

//This shows the student information in their profile.
function showFacultyProfile($faculty_id)
{
    include 'connection.php';
    $sql = "SELECT faculty_id, firstname, lastname, email, gender, contact_no, address, photo FROM tb_faculty WHERE faculty_id = $faculty_id";
    $result = mysqli_query($conn, $sql);
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
        <tbody>
            <tr>
                <td rowspan='10' scope='row' style='text-align: center; padding-left: 5px;'><img src='./images/uploads/$photo' class='student-picture'></td>
                <th>Full Name</th>
                <td data-label='Full Name'>$firstname $lastname</td>
            </tr>
            <tr>
                <th>Faculty ID</th>
                <td data-label='Faculty ID'>$primary_id</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td data-label='Gender'>$gender</td>
            </tr>
            <tr>
                <th>Email</th>
                <td data-label='Email'>$email</td>
            </tr>
            <tr>
                <th>Contact No.</th>
                <td data-label='Contact No.'>$contact_no</td>
            </tr>
            <tr>
                <th>Address</th>
                <td data-label='Address'>$address</td>
            </tr>
        <tbody>
        ";
    }
    mysqli_close($conn);
}