document.addEventListener("DOMContentLoaded", function () {
    const courseBtn = document.getElementById("dropdownCourseBtn");
    const courseMenu = document.getElementById("dropdownCourseMenu");

    const tutorBtn = document.getElementById("dropdownTutorBtn");
    const tutorMenu = document.getElementById("dropdownTutorMenu");

    courseBtn.addEventListener("click", function () {
        courseMenu.classList.toggle("hidden");
    });

    tutorBtn.addEventListener("click", function () {
        tutorMenu.classList.toggle("hidden");
    });
});
