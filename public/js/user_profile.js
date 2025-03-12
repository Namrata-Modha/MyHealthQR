$(document).ready(function () {
    
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return this.optional(element) || regexpr.test(value);
    }, "Enter a valid phone number.");

    $("#userProfileForm").validate({
        rules: {
            first_name: { required: true, minlength: 2 },
            last_name: { required: true, minlength: 2 },
            contact_phone: {
                required: false,
                regex: /^(\+?\d{1,3}[-. ]?)?(\(?\d{3}\)?[-. ]?)?\d{3}[-. ]?\d{4}$/
            },
            emergency_contact_name: { minlength: 3 },
            emergency_contact_phone: {
                required: function () {
                    return $("input[name='emergency_contact_name']").val().length > 0;
                },
                regex: /^(\+?\d{1,3}[-. ]?)?(\(?\d{3}\)?[-. ]?)?\d{3}[-. ]?\d{4}$/
            }
        },
        messages: {
            first_name: "First Name is required.",
            last_name: "Last Name is required.",
            contact_phone: "Enter a valid phone number.",
            emergency_contact_name: "Emergency Contact Name must be at least 3 characters.",
            emergency_contact_phone: "Enter a valid Emergency Contact Phone number."
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            if (element.parent(".input-group").length) {
                error.addClass("text-danger").insertAfter(element.parent());
            } else {
                error.addClass("text-danger").insertAfter(element);
            }
        }
    });
});
