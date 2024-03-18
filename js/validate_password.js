password_element = document.getElementById("password");

function validatePassword() {
    const password = password_element.value;
    const passwordRegex = /(?=.*\d)(?=.*[!@#$%^&])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/

    if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one special character.");
        return false;
    }
    return true;
}


