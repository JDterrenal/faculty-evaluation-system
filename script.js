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
    /* add faculty */
    $("#addfaculty").click(function() {
        $("#popupbackgroundfaculty").show();
    });
    $("#exfaculty").click(function() {
        $("#popupbackgroundfaculty").hide();
    });

    /* edit faculty */
    $("#editfaculty").click(function() {
        $("#facultypopupbackground").show();
    });
    $("#exeditfaculty").click(function() {
        $("#facultypopupbackground").hide();
    });
    /* add student */
    $("#addstudent").click(function() {
        $("#popupbackgroundstudent").show();
    });
    $("#exstudent").click(function() {
        $("#popupbackgroundstudent").hide();
    });

    /* edit student */
    $("#editstudent").click(function() {
        $("#studentpopupbackground").show();
    });
    $("#exeditstudent").click(function() {
        $("#studentpopupbackground").hide();
    });
    /* add section */
    $("#addsection").click(function() {
        $("#popupbackgroundsection").show();
    });
    $("#exsection").click(function() {
        $("#popupbackgroundsection").hide();
    });

    /* edit section */
    $("#editsection").click(function() {
        $("#sectionpopupbackground").show();
    });
    $("#exeditsection").click(function() {
        $("#sectionpopupbackground").hide();
    });
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
}

function AddSectionFunction() {
    if (addSectionback.style.display === "flex") {
        addSectionback.style.display = "none";
    } else {
        addSectionback.style.display = "flex";
    }
}

function EditSectionFunction() {
    if (editSectionback.style.display === "flex") {
        editSectionback.style.display = "none";
    } else {
        editSectionback.style.display = "flex";
    }
}

function AddStudentFunction() {
    if (addStudentback.style.display === "flex") {
        addStudentback.style.display = "none";
    } else {
        addStudentback.style.display = "flex";
    }
}

function EditStudentFunction() {
    if (editStudentback.style.display === "flex") {
        editStudentback.style.display = "none";
    } else {
        editStudentback.style.display = "flex";
    }
}

function AddFacultyFunction() {
    if (addFacultyback.style.display === "flex") {
        addFacultyback.style.display = "none";
    } else {
        addFacultyback.style.display = "flex";
    }
}

function EditFacultyFunction() {
    if (editFacultyback.style.display === "flex") {
        editFacultyback.style.display = "none";
    } else {
        editFacultyback.style.display = "flex";
    }
};
