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

window.onload = function () {
    document.onclick = function (div) {
        if (div.target.id !== 'popup' && div.target.id !== 'popup-btn') {
            logoutpop.style.display = "none";
        }
    }
}

$(document).ready(function () {
    // Add
    $("#add-button").click(function () {
        addBackground.style.display = "flex";
        $("#popup-background").show();
    });
    $("#ex-add").click(function () {
        $("#popup-background").hide();
    });

    // Specific Edit
    $(".edit.edit-course").on('click',function () {
        let currentRow = $(this).closest("tr");

        let col1 = currentRow.find("td:eq(0)").text();
        let col2 = currentRow.find("td:eq(1)").text();
        $("#edit_id").val(col1);
        $("#edit_course_name").val(col2);

        editBackground.style.display = "flex";
        $("#edit-popup-background").show();
    });

    // Exit edit
    $("#ex-edit").click(function () {
        $("#edit-popup-background").hide();
    });

    // Specific View
    $(".view.view-course").on('click',function () {
        let currentRow = $(this).closest("tr");

        let col1 = currentRow.find("td:eq(0)").text();
        let col2 = currentRow.find("td:eq(1)").text();
        $("[data-label='ID Info']").html(col1);
        $("[data-label='Course Info']").html(col2);
    });
});

function LogOutFunction() {
    if (logoutpop.style.display === "block") {
        logoutpop.style.display = "none";
    } else {
        logoutpop.style.display = "block";
    }
}