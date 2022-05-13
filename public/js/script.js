// Navigation
const courseDropdownParent = document.getElementById("course-dropdown-parent")
const courseDropdownList = document.getElementById("course-dropdown-list")
const courseDropdownNavItems = document.querySelectorAll(".dropdown-nav-item");
// Listeners
courseDropdownParent.addEventListener("mouseover", (e) => {
    courseDropdownList.style.display = "initial";
})
courseDropdownParent.addEventListener("focus", (e) => {
    courseDropdownList.style.display = "initial";
})
courseDropdownNavItems[courseDropdownNavItems.length - 1].addEventListener("blur", (e) => {
    courseDropdownList.style.display = "none";
})
courseDropdownList.addEventListener("mouseleave", (e) => {
    // Dropdown disappears after mouse had left the box
    e.target.style.display = "none";
})
