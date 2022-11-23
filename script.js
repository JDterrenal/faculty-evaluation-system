const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar-nav"),
    toggle = body.querySelector(".toggle");
const toggleHeader = body.querySelector(".toggleHeader")
const logoutpop = document.getElementById('popup');

const addBackground = document.getElementById('popup-background');
const addButton = document.getElementById('add-button');
const editBackground = document.getElementById('edit-popup-background');
const editButton = document.getElementById('edit-button');
const ex = document.getElementById('ex-add');
const exedit = document.getElementById('ex-edit')

const addsubjectbtn = document.getElementById('addsubject');
const editsubjectback = document.getElementById('subjectpopupbackground');
const editsubjectbtn = document.getElementById('editsubject');
const exsubject = document.getElementById('exsubject');
const exeditsubject = document.getElementById('exeditsubject');

const addSectionback = document.getElementById('popupbackgroundsection');
const addSectionbtn = document.getElementById('addsection');
const editSectionback = document.getElementById('sectionpopupbackground');
const editSectiontbtn = document.getElementById('editsection');
const exsection = document.getElementById('exsection');
const exeditsection = document.getElementById('exeditsection');

const addStudentback = document.getElementById('popupbackgroundstudent');
const addStudentbtn = document.getElementById('addstudent');
const editStudentback = document.getElementById('studentpopupbackground');
const editStudentbtn = document.getElementById('editstudent');
const exstudent = document.getElementById('exstudent');
const exeditstudent = document.getElementById('exeditstudent');

const addFacultyback = document.getElementById('popupbackgroundfaculty');
const addFacultybtn = document.getElementById('addfaculty');
const editFacultyback = document.getElementById('facultypopupbackground');
const editFacultybtn = document.getElementById('editfaculty');
const exfaculty = document.getElementById('exfaculty');
const exeditfaculty = document.getElementById('exeditfaculty');

toggleHeader.addEventListener("click", () => {
    sidebar.classList.toggle("close");
})

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
})

window.onload = function () {
    document.onclick = function (div) {
        if (div.target.id !== 'popup' && div.target.id !== 'popup-btn') {
            logoutpop.style.display = "none";
        }
    }
}

$(document).ready(function() {
    /* add  */
    $("#add-button").click(function() {
        $("#popup-background").show();
    });
    $("#ex-add").click(function() {
        $("#popup-background").hide();
    });

    /* edit  */
    $("#ex-edit").click(function() {
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

function AddFunction() {
    if (addBackground.style.display === "flex") {
        addBackground.style.display = "none";
    } else {
        addBackground.style.display = "flex";
    }
}


function EditFunction() {
    if (editBackground.style.display === "flex") {
        editBackground.style.display = "none";
    } else {
        editBackground.style.display = "flex";
    }
};
