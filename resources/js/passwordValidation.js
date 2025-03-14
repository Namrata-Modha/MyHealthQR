import zxcvbn from 'zxcvbn';

document.addEventListener("DOMContentLoaded", function () {
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("password_confirmation");
    const passwordMatchMessage = document.getElementById("password-match-message");
    const strengthText = document.querySelector("#password-strength");

    const togglePassword = document.getElementById("toggle-password");
    const toggleConfirmPassword = document.getElementById("toggle-confirm-password");
    const eyeIconPassword = document.getElementById("eye-icon");
    const eyeIconConfirmPassword = document.getElementById("eye-icon-confirm");

    // ✅ Function to toggle password visibility
    function toggleVisibility(inputField, eyeIcon) {
        if (inputField.type === "password") {
            inputField.type = "text";
            eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            inputField.type = "password";
            eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
        }
    }

    // ✅ Event listeners for toggling password visibility
    if (togglePassword) {
        togglePassword.addEventListener("click", function () {
            toggleVisibility(passwordField, eyeIconPassword);
        });
    }

    if (toggleConfirmPassword) {
        toggleConfirmPassword.addEventListener("click", function () {
            toggleVisibility(confirmPasswordField, eyeIconConfirmPassword);
        });
    }

    // ✅ Function to check password strength (Using zxcvbn)
    if (passwordField) {
        passwordField.addEventListener("input", function () {
            if (!passwordField.value) {
                strengthText.textContent = "";
                return;
            }
            const strength = zxcvbn(passwordField.value).score;
            const messages = ["Very Weak", "Weak", "Fair", "Strong", "Very Strong"];
            const colors = ["text-red-500", "text-orange-500", "text-yellow-500", "text-green-500", "text-blue-500"];

            strengthText.textContent = `Password Strength: ${messages[strength]}`;
            strengthText.className = `mt-1 text-sm ${colors[strength]}`;
        });
    }

    // ✅ Function to check if passwords match
    function checkPasswordMatch() {
        if (confirmPasswordField.value !== "" && confirmPasswordField.value !== passwordField.value) {
            passwordMatchMessage.classList.remove("hidden");
            passwordMatchMessage.textContent = "Passwords do not match!";
        } else {
            passwordMatchMessage.classList.add("hidden");
        }
    }

    // ✅ Listen for input changes
    if (passwordField && confirmPasswordField) {
        passwordField.addEventListener("input", checkPasswordMatch);
        confirmPasswordField.addEventListener("input", checkPasswordMatch);
    }
});
