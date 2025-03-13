import zxcvbn from 'zxcvbn';

document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.querySelector("#password");
    const togglePassword = document.querySelector("#toggle-password");
    const eyeIcon = document.querySelector("#eye-icon");
    const strengthText = document.querySelector("#password-strength");

    // ✅ Password Strength Meter
    passwordInput.addEventListener("input", function () {
        if (!passwordInput.value) {
            strengthText.textContent = "";
            return;
        }

        const strength = zxcvbn(passwordInput.value).score;
        const messages = ["Very Weak", "Weak", "Fair", "Strong", "Very Strong"];
        const colors = ["text-red-500", "text-orange-500", "text-yellow-500", "text-green-500", "text-blue-500"];

        strengthText.textContent = `Password Strength: ${messages[strength]}`;
        strengthText.className = `mt-1 text-sm ${colors[strength]}`;
    });

    // ✅ Password Visibility Toggle
    if (togglePassword) {
        togglePassword.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash"); // Show hidden eye
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye"); // Show visible eye
            }
        });
    }
});
