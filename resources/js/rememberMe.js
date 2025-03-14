// Login Page Remember Me check box

document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const rememberCheckbox = document.querySelector("input[name='remember']");

    // Load saved username from localStorage (if available)
    if (localStorage.getItem("savedUsername")) {
        emailInput.value = localStorage.getItem("savedUsername");  
        rememberCheckbox.checked = true;  // Keep checkbox checked
    }

    // Save or remove username when checkbox is checked/unchecked
    rememberCheckbox.addEventListener("change", function () {
        if (this.checked) {
            localStorage.setItem("savedUsername", emailInput.value);
        } else {
            localStorage.removeItem("savedUsername");
        }
    });

    // Ensure username updates in localStorage when typing
    emailInput.addEventListener("input", function () {
        if (rememberCheckbox.checked) {
            localStorage.setItem("savedUsername", emailInput.value);
        }
    });
});
