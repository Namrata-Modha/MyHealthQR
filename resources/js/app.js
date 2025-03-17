import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    const dateOfBirthInput = document.getElementById("date_of_birth");
    const guardianConsentField = document.getElementById("guardianConsentField");
    const guardianConsentCheckbox = document.getElementById("guardian_consent");
    const signupBtn = document.getElementById("signup-btn");
    const signupForm = document.getElementById("signupForm");

    if (signupBtn && signupForm) {
        signupForm.addEventListener("submit", function () {
            signupBtn.disabled = true; // ✅ Disable button after clicking
            signupBtn.classList.add("opacity-50", "cursor-not-allowed"); // ✅ Add visual feedback
        });
    }
    if (dateOfBirthInput) {
        // ✅ Restrict date picker to prevent future dates
        const today = new Date().toISOString().split("T")[0];
        dateOfBirthInput.setAttribute("max", today);
    }

    function checkAge() {
        if (!dateOfBirthInput.value) return; // ✅ Prevents error when field is empty
    
        const birthDate = new Date(dateOfBirthInput.value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
    
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
    
        // ✅ Show Guardian Consent only if under 18
        if (age < 18) {
            guardianConsentField.classList.remove("hidden");
        } else {
            guardianConsentField.classList.add("hidden");
            guardianConsentCheckbox.checked = false; // ✅ Ensure it's unchecked if hidden
        }
    }
    

    if (dateOfBirthInput) {
        dateOfBirthInput.addEventListener("change", checkAge);
    }

    // ✅ Ensure error stays visible after submission if unchecked
    if (guardianConsentCheckbox && guardianConsentCheckbox.hasAttribute("required")) {
        guardianConsentField.classList.remove("hidden");
    }

    // ✅ Run check on page load
    checkAge();
});
