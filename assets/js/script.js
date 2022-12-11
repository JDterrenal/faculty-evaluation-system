const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar-nav"),
    toggle = body.querySelector(".toggle");
const toggleHeader = body.querySelector(".toggleHeader");
const logoutpop = document.getElementById('popup');

const addBackground = document.getElementById('popup-background');
const addButton = document.getElementById('add-button');
const editBackground = document.getElementById('edit-popup-background');
const editButton = document.getElementById('edit-button');
const ex = document.getElementById('ex-add');
const exedit = document.getElementById('ex-edit');


toggleHeader.addEventListener("click", () => {
    sidebar.classList.toggle("close");
})

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
})

$(document).ready(function () {
    document.onclick = function (div) {
        if (div.target.id !== 'popup' && div.target.id !== 'popup-btn') {
            logoutpop.style.display = "none";
        }
    }

    // Add
    $("#add-button").click(function () {
        addBackground.style.display = "flex";
        $("#popup-background").show();
    });
    $("#ex-add").click(function () {
        $("#popup-background").hide();
    });

    /* === Specific Edit === */
    //Section Relation
    $(".edit.edit-secrel").on('click', function () {
        let currentRow = $(this).closest("tr");
        let col1 = currentRow.find("td:eq(0)").text();
        let col2 = currentRow.find("td:eq(1)").text();
        let col3 = currentRow.find("td:eq(4)").text();
        $("#edit_id").val(col1);
        $("#edit_subject_code").val(col2).change();
        $("#edit_faculty_id").val(col3).change();

        editBackground.style.display = "flex";
        $("#edit-popup-background").show();
    });

    // Question
    $(".edit.edit-question-func").on('click', function () {
        let currentRow = $(this).closest("tr");
        let col1 = currentRow.find("td:eq(0)").text();
        let col2 = currentRow.find("td:eq(1)").text();
        $("#edit_id").val(col1);
        $("#edit_question").val(col2);

        editBackground.style.display = "flex";
        $("#edit-popup-background").show();
    });

    // Exit Edit
    $("#ex-edit").click(function () {
        $("#edit-popup-background").hide();
    });
});

function LogOutFunction() {
    if (logoutpop.style.display === "block") {
        logoutpop.style.display = "none";
    } else {
        logoutpop.style.display = "block";
    }
}

// === Edit and View Student ===
function editStudent(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    let col4 = currentRow.find("td:eq(3)").text();
    let col5 = currentRow.find("td:eq(4)").text();
    let col6 = currentRow.find("td:eq(5)").text();
    let col7 = currentRow.find("td:eq(6)").text();
    let col8 = currentRow.find("td:eq(7)").text();
    let col9 = currentRow.find("td:eq(8)").text();
    let col10 = currentRow.find("td:eq(9)").text();
    let col11 = currentRow.find("td:eq(10)").text();
    let col12 = currentRow.find("td:eq(11)").text();
    $("#edit_id").val(col1);
    $("#edit_firstname").val(col2);
    $("#edit_lastname").val(col3);
    $("#edit_email").val(col4);
    $("#" + col5).prop('checked', true)
    $("#edit_yearlevel").val(col6).change();
    $("#edit_contact_no").val(col7);
    $("#edit_address").val(col8);
    $("#edit_status").val(col9).change();
    $("#edit_course_id").val(col11).change();
    $("#edit_section_id").val(col12).change();
    $("#edit_photo_output").prop("src", "./images/uploads/" + col10);

    editBackground.style.display = "flex";
    $("#edit-popup-background").show();
}

function viewStudent(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    let col6 = currentRow.find("td:eq(5)").text();
    let col10 = currentRow.find("td:eq(9)").text();
    let col11 = currentRow.find("td:eq(10)").text();
    let col12 = currentRow.find("td:eq(11)").text();
    $("[data-label='Photo Info']").html("<img src='./images/uploads/" + col10 + "' alt='' class='profile-side-pop'>");
    $("[data-label='ID Info']").html(col1);
    $("[data-label='Full Name Info']").html(col2 + " " + col3);
    $("[data-label='Year Level Info']").html(col6);
    $("[data-label='Course ID Info']").html(col11);
    $("[data-label='Section ID Info']").html(col12);
}

// === Edit and View Faculty ===
function editFaculty(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    let col4 = currentRow.find("td:eq(3)").text();
    let col5 = currentRow.find("td:eq(4)").text();
    let col6 = currentRow.find("td:eq(5)").text();
    let col7 = currentRow.find("td:eq(6)").text();
    let col8 = currentRow.find("td:eq(7)").text();
    $("#edit_id").val(col1);
    $("#edit_firstname").val(col2);
    $("#edit_lastname").val(col3);
    $("#edit_email").val(col4);
    $("#" + col5).prop('checked', true)
    $("#edit_contact_no").val(col6);
    $("#edit_address").val(col7);
    $("#edit_photo_output").prop("src", "./images/uploads/" + col8);

    editBackground.style.display = "flex";
    $("#edit-popup-background").show();
}

function viewFaculty(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    let col4 = currentRow.find("td:eq(3)").text();
    let col5 = currentRow.find("td:eq(7)").text();
    $("[data-label='Photo Info']").html("<img src='./images/uploads/" + col5 + "' alt='' class='profile-side-pop'>");
    $("[data-label='ID Info']").html(col1);
    $("[data-label='Full Name Info']").html(col2 + " " + col3);
    $("[data-label='Email Info']").html(col4);
    $("[data-label='Operation Info']").html("<a href='eval_report_list.php?faculty_id=" + col1 + "' class='add-main'><i class='fas fa-eye'></i> Evaluation Reports</a>");
}

// === Edit and View Account ===
function editAccount(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(3)").text();
    $("#edit_id").val(col1);
    $("#edit_password").val(col2);

    editBackground.style.display = "flex";
    $("#edit-popup-background").show();
}

function viewAccount(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    let col4 = currentRow.find("td:eq(3)").text();
    let col5 = currentRow.find("td:eq(4)").text();
    $("[data-label='Login ID Info']").html(col1);
    $("[data-label='User ID Info']").html(col2);
    $("[data-label='Full Name Info']").html(col3);
    $("[data-label='Password Info']").html(col4);
    $("[data-label='User Type Info']").html(col5);
}

// === Edit and View Course ===
function editCourse(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    $("#edit_id").val(col1);
    $("#edit_course_name").val(col2);

    editBackground.style.display = "flex";
    $("#edit-popup-background").show();
}

function viewCourse(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    $("[data-label='ID Info']").html(col1);
    $("[data-label='Course Info']").html(col2);
    $("[data-label='Students Count']").html(col3);
}

// === Edit and View Subject ===
function editSubject(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    let col4 = currentRow.find("td:eq(3)").text();
    $("#edit_id").val(col1);
    $("#edit_subject_code").val(col2);
    $("#edit_subject_name").val(col3);
    $("#edit_units").val(col4);

    editBackground.style.display = "flex";
    $("#edit-popup-background").show();
}

function viewSubject(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    let col4 = currentRow.find("td:eq(3)").text();
    $("[data-label='ID Info']").html(col1);
    $("[data-label='Subject Code Info']").html(col2);
    $("[data-label='Subject Info']").html(col3);
    $("[data-label='Units Info']").html(col4);
}

// === Edit and View Section ===
function editSection(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    $("#edit_id").val(col1);
    $("#edit_section_name").val(col2);

    editBackground.style.display = "flex";
    $("#edit-popup-background").show();
}

function viewSection(anchor) {
    let currentRow = $(anchor).closest("tr");
    let col1 = currentRow.find("td:eq(0)").text();
    let col2 = currentRow.find("td:eq(1)").text();
    let col3 = currentRow.find("td:eq(2)").text();
    $("[data-label='ID Info']").html(col1);
    $("[data-label='Section Info']").html(col2);
    $("[data-label='Students Count']").html(col3);
    $("[data-label='Operation Info']").html("<a href='section_subjects.php?section_id=" + col1 + "' class='add-main'><i class='fas fa-eye'></i> Manage Subjects</a>");
}