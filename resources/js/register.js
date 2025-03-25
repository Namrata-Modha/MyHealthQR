$(document).ready(function () {

    console.log("🚀 jQuery is running!");

    // Custom validation method for Email regex
    $.validator.addMethod("validEmail", function(value, element) {
        console.log("📧 Email validation: ", value);
        return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|edu|gov|ca|uk|in|info|io|co)$/i.test(value);
    }, "Please enter a valid email with a proper domain (e.g., .com, .net, .org).");
    
    // Custom validation method for password regex
    $.validator.addMethod("strongPassword", function(value, element) {
        return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
    }, "Password must contain at least 1 uppercase, 1 lowercase, 1 number, and 1 special character.");

    $("#signupForm").validate({
        rules: {
            first_name: { required: true, minlength: 2 },
            last_name: { required: true, minlength: 2 },
            email: { required: true, email: true, validEmail: true },
            password: {
                required: true,
                minlength: 8,
                strongPassword: true // Applying the regex validation
            },
            date_of_birth: { required: true, date: true },
            security_agreement_signed: { required: true },
            pipeda_consent: { required: true }
        },
        messages: {
            first_name: { required: "First name is required.", minlength: "At least 2 characters." },
            last_name: { required: "Last name is required.", minlength: "At least 2 characters." },
            email: {
                required: "Email is required.",
                email: "Enter a valid email address.",
                validEmail: "Please enter a valid email with a proper domain (e.g., .com, .net, .org)."
            },
            password: {
                required: "Password is required.",
                minlength: "Must be at least 8 characters.",
                strongPassword: "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (!@#$%^&*)."
            },
            date_of_birth: { required: "Date of birth is required.", date: "Enter a valid date." },
            security_agreement_signed: { required: "You must agree to the Terms & Privacy Policy." },
            pipeda_consent: { required: "You must agree to PIPEDA compliance." }
        },
        errorPlacement: function (error, element) {
            element.addClass("is-invalid"); // Apply Bootstrap's error class

            // Remove existing error message if already present
            element.next(".invalid-feedback").remove();

            // Insert error message right after the element
            element.after('<div class="invalid-feedback">' + error.text() + '</div>');
        },
        success: function (label, element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
            $(element).next(".invalid-feedback").remove(); // Remove error message when valid
        },
        submitHandler: function (form, event) {
            if (!$("#signupForm").valid()) {
                console.log("❌ Form Validation Failed!");
                return;
            }
            console.log("✅ Validation Passed - Submitting...");
        
            $('#submit').attr('disabled', 'disabled'); // Disable submit button
            form.submit();
        
            // Capture Laravel session error messages
            setTimeout(() => {
                console.log("⚠️ Laravel Validation Error: ", $("#error-message").text());
            }, 500);
        }
        
    });

    // Guardian Consent Logic
    $('#date_of_birth').on('change', function () {
        console.log('Date of birth changed');
        const dob = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if (age < 18) {
            $("#guardianConsentField").show();
            $("#guardian_consent").rules("add", {
                required: true,
                messages: { required: "Guardian consent is required for users under 18." }
            });
        } else {
            $("#guardianConsentField").hide();
            $("#guardian_consent").rules("remove");
        }
    });
});

