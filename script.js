const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar-nav"),
    toggle = body.querySelector(".toggle");
const toggleHeader = body.querySelector(".toggleHeader")
const logoutpop = document.getElementById('popup');
const addcoureback = document.getElementById('popupbackground');
const addcoursebtn = document.getElementById('addcourse');
const editcoureback = document.getElementById('editpopupbackground');
const editcoursebtn = document.getElementById('editcourse');
const ex = document.getElementById('ex');
const exedit = document.getElementById('exedit')

const addsubjectback = document.getElementById('popupbackgroundsubject');
const addsubjectbtn = document.getElementById('addsubject');
const editsubjectback = document.getElementById('subjectpopupbackground');
const editsubjectbtn = document.getElementById('editsubject');
const exsubject = document.getElementById('exsubject');
const exeditsubject = document.getElementById('exeditsubject');

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
    /* add subject */
    $("#addsubject").click(function() {
        $("#popupbackgroundsubject").show();
    });
    $("#exsubject").click(function() {
        $("#popupbackgroundsubject").hide();
    });

    /* edit subject */
    $("#editsubject").click(function() {
        $("#subjectpopupbackground").show();
    });
    $("#exeditsubject").click(function() {
        $("#subjectpopupbackground").hide();
    });

    /* add course */
    $("#addcourse").click(function() {
        $("#popupbackground").show();
    });
    $("#ex").click(function() {
        $("#popupbackground").hide();
    });

    /* edit course */
    $("#editcourse").click(function() {
        $("#editpopupbackground").show();
    });
    $("#exedit").click(function() {
        $("#editpopupbackground").hide();
    });
});

function AddCourseFunction() {
    if (addcoureback.style.display === "flex") {
        addcoureback.style.display = "none";
    } else {
        addcoureback.style.display = "flex";
    }
}

function LogOutFunction() {
    if (logoutpop.style.display === "block") {
        logoutpop.style.display = "none";
    } else {
        logoutpop.style.display = "block";
    }
}

function EditCourseFunction() {
    if (editcoureback.style.display === "flex") {
        editcoureback.style.display = "none";
    } else {
        editcoureback.style.display = "flex";
    }
}

function AddSubjectFunction() {
    if (addsubjectback.style.display === "flex") {
        addsubjectback.style.display = "none";
    } else {
        addsubjectback.style.display = "flex";
    }
}

function EditSubjectFunction() {
    if (editsubjectback.style.display === "flex") {
        editsubjectback.style.display = "none";
    } else {
        editsubjectback.style.display = "flex";
    }
};
