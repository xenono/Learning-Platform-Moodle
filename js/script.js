// Navigation
const courseDropdownParent = document.getElementById("course-dropdown-parent")
const courseDropdownList = document.getElementById("course-dropdown-list")

// Listeners
courseDropdownParent.addEventListener("mouseover", (e) => {
    courseDropdownList.style.display = "initial";
})
courseDropdownList.addEventListener("mouseleave", (e) => {
    // Dropdown disappears after mouse had left the box
    e.target.style.display = "none";
})
