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

    /**
     * Loads the user's privacy settings.
     * 
     * @returns {Object} An object containing the user's privacy settings.
     */
    let privacySettings = loadPrivacySettings();

    $(".toggle-visibility").each(function () {
        let field = $(this).data("field");
        setInitialIconState($(this), privacySettings[field]);
    });

    $(".toggle-visibility").on("click", function () {
        let field = $(this).data("field");
        toggleVisibility(field);
    });

    updateHiddenInput();
});

// Global Default Privacy Settings
const defaultSettings = {
    contact_phone: "visible",
    emergency_contact_name: "visible",
    emergency_contact_phone: "visible"
};


/**
 * Loads and parses the privacy settings from the DOM element with id "privacy_settings".
 * If the settings are not valid JSON, it logs an error and uses an empty object.
 * Ensures that any missing keys in the settings are filled with default values.
 *
 * @returns {Object} The parsed and validated privacy settings.
 */
function loadPrivacySettings() {
    let rawSettings = $("#privacy_settings").val();

    let settings;
    try {
        settings = JSON.parse(rawSettings) || {};
    } catch (error) {
        console.error("Error Parsing Privacy Settings:", error);
        settings = {};
    }

    // Ensure missing keys get default values (without overriding existing settings)
    for (let key in defaultSettings) {
        if (!(key in settings)) {
            settings[key] = defaultSettings[key];
        }
    }

    return settings;
}


/**
 * Updates the icon element to show or hide based on the visibility status.
 *
 * @param {jQuery} iconElement - The jQuery object representing the icon element to be updated.
 * @param {boolean} isVisible - A boolean indicating whether the icon should be visible or not.
 */
function updateIcon(iconElement, isVisible) {

    if (isVisible) {
        iconElement.removeClass("fa-eye-slash").addClass("fa-eye");
    } else {
        iconElement.removeClass("fa-eye").addClass("fa-eye-slash");
    }
}

/**
 * Sets the initial state of an icon element based on the visibility state.
 *
 * @param {jQuery} iconElement - The jQuery object representing the icon element.
 * @param {string} visibilityState - The visibility state of the icon, either "invisible" or "visible".
 *                                   If "invisible", the icon will be set to a closed eye (fa-eye-slash).
 *                                   If "visible", the icon will be set to an open eye (fa-eye).
 */
function setInitialIconState(iconElement, visibilityState) {

    if (visibilityState === "invisible") {
        iconElement.removeClass("fa-eye").addClass("fa-eye-slash"); // Closed eye for hidden
    } else {
        iconElement.removeClass("fa-eye-slash").addClass("fa-eye"); // Open eye for visible
    }
}


/**
 * Toggles the visibility state of a specified field in the privacy settings.
 *
 * This function reads the current privacy settings from a hidden input field,
 * toggles the visibility state of the specified field between "visible" and "invisible",
 * updates the corresponding icon to reflect the new state, and updates the hidden input field
 * with the new privacy settings.
 *
 * @param {string} field - The name of the field whose visibility state is to be toggled.
 */
function toggleVisibility(field) {
    let privacySettings = JSON.parse($("#privacy_settings").val() || "{}");

    // Debug current raw settings

    // Get current visibility state
    let currentState = privacySettings[field] || "visible"; // Default is "visible"

    // Toggle logic
    let newState = currentState === "visible" ? "invisible" : "visible";
    privacySettings[field] = newState;


    // Update the eye icon based on new state
    let icon = $(`.toggle-visibility[data-field="${field}"]`);
    if (newState === "visible") {
        icon.removeClass("fa-eye-slash").addClass("fa-eye"); // Show open eye for visible
    } else {
        icon.removeClass("fa-eye").addClass("fa-eye-slash"); // Show closed eye for invisible
    }

    // Update the hidden input field
    updateHiddenInput(privacySettings);
}

/**
 * Updates the hidden input field with new privacy settings.
 *
 * This function merges the provided updated settings with the current settings
 * stored in the hidden input field. If a setting already exists in the current
 * settings, it will not be overwritten by the updated settings.
 *
 * @param {Object} [updatedSettings={}] - An object containing the updated privacy settings.
 */
function updateHiddenInput(updatedSettings = {}) {
    let currentSettings = JSON.parse($("#privacy_settings").val() || "{}");

    // **Merge updated fields, but keep database values unchanged if already set**
    let finalSettings = { ...currentSettings, ...updatedSettings };

    $("#privacy_settings").val(JSON.stringify(finalSettings)).trigger("change");
}
