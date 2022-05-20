// Navigation
const courseDropdownParent = document.getElementById("course-dropdown-parent")
const courseDropdownList = document.getElementById("course-dropdown-list")
const courseDropdownNavItems = document.querySelectorAll(".dropdown-nav-item");
// Listeners
if (courseDropdownParent) {
    courseDropdownParent.addEventListener("mouseover", (e) => {
        courseDropdownList.style.display = "initial";
    })
    courseDropdownParent.addEventListener("focus", (e) => {
        courseDropdownList.style.display = "initial";
    })
    if (courseDropdownNavItems && courseDropdownList) {
        courseDropdownNavItems[courseDropdownNavItems.length - 1].addEventListener("blur", (e) => {
            courseDropdownList.style.display = "none";
        })
        courseDropdownList.addEventListener("mouseleave", (e) => {
            // Dropdown disappears after mouse had left the box
            e.target.style.display = "none";
        })
    }
}


// Error message box
const errorDiv = document.getElementById("error-box");
const errorMsg = document.getElementById("error-msg");
// Get input fields
const telephoneNumberInput = document.getElementById("telephoneNo");

const displayError = (msg) => {
    errorDiv.style.display = "block";
    errorMsg.textContent = msg;
}

// Fields validation
const validateTelephoneNumber = (number) => {
    if (number.length !== 11) {
        displayError("Telephone number has to have 11 digits.")
        return false;
    }
    return true;
}

const onlyCharacters = (value) => {
    const re = /^[a-zA-Z\s]+$/;
    return re.test(value);
}

const onlyNumbers = (value) => {
    console.log("fun");
    const re = /^[0-9]+$/;
    return re.test(value);
}

// Login form validation
const loginForm = document.getElementById("login-form");
if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
        const id = e.target.studentId.value
        const password = e.target.password.value;
        if (!onlyNumbers(id)) {
            displayError("ID number can only contain digits and cannot be empty");
            e.preventDefault();
            return;
        }
        if (password.length <= 0) {
            displayError("Password cannot be empty!");
            e.preventDefault();
            return;
        }
    })
}


// Sign Up form Validation
const signUpForm = document.getElementById("signup-form");

if (signUpForm) {
    signUpForm.addEventListener("submit", (e) => {
        const name = e.target.name.value;
        const surname = e.target.surname.value;
        const email = e.target.email.value;
        const phoneNumber = e.target.phoneNumber.value;
        const address = e.target.address.value;
        const dateOfBirth = e.target.dateOfBirth.value;
        const password = e.target.password.value;
        const confirmPassword = e.target.retypePassword.value;
        if (name.length <= 0) {
            displayError("Name cannot be empty!");
            e.preventDefault();
            return;
        }
        if (surname.length <= 0) {
            displayError("Surname cannot be empty!");
            e.preventDefault();
            return;
        }
        if (email.length <= 0) {
            displayError("Email cannot be empty!");
            e.preventDefault();
            return;
        }
        if (phoneNumber.length <= 0 || phoneNumber.length !== 11) {
            displayError("Phone number has to contain 11 digits and cannot be empty!");
            e.preventDefault();
            return;
        }
        if (address.length <= 0) {
            displayError("Address cannot be empty!");
            e.preventDefault();
            return;
        }
        if (dateOfBirth.length <= 0) {
            displayError("Date of birth is required! ");
            e.preventDefault();
            return;
        }
        const ageDifMs = Date.now() - new Date(dateOfBirth);
        const ageDate = new Date(ageDifMs);
        if(Math.abs(ageDate.getUTCFullYear() - 1970)< 18){
            displayError("You have to be at least 18 years old!");
            e.preventDefault();
            return;
        }
        if (password.length <= 0) {
            displayError("Password cannot be empty!");
            e.preventDefault();
            return;
        }
        if (confirmPassword.length <= 0 || confirmPassword.length != password.length || confirmPassword != password) {
            displayError("Passwords has to match and cannot be empty!");
            e.preventDefault();
            return;
        }
    })
}