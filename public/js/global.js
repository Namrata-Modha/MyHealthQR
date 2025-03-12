$(document).ready(function () {
    
    let privacySettings = loadPrivacySettings();
    console.log("Loaded Privacy Settings on Page Load:", privacySettings);

    //  Set correct visibility icons on page load
    $(".toggle-visibility").each(function () {
        let field = $(this).data("field");
        let visibilityState = privacySettings[field] || "visible"; // Default to visible

        console.log(`Setting initial icon state for ${field}: ${visibilityState}`);
        setInitialIconState(field, visibilityState);
    });

    // Click event for toggling visibility
    $(".toggle-visibility").on("click", function () {
        let field = $(this).data("field");
        console.log(`Toggling visibility for ${field}`);
        toggleVisibility(field);
    });
});

/**
 * Loads privacy settings from a hidden input field with the ID "privacy_settings".
 * Parses the JSON string from the input value and returns it as an object.
 * If parsing fails, logs an error and returns an empty object.
 *
 * @returns {Object} The parsed privacy settings object.
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

    console.log("Loaded Settings from Hidden Input:", settings);
    return settings;
}

/**
 * Sets the initial icon state for a given field based on its visibility state.
 *
 * @param {string} field - The name of the field for which the icon state is being set.
 * @param {string} visibilityState - The visibility state of the field, either "visible" or "invisible".
 */
function setInitialIconState(field, visibilityState) {
    let iconElement = $(`.toggle-visibility[data-field="${field}"]`);
    
    console.log(`Setting icon for ${field} - Visibility State: ${visibilityState}`);

    // 🔥 FIX: Remove BOTH classes first to ensure no incorrect classes remain
    iconElement.removeClass("fa-eye fa-eye-slash");

    if (visibilityState === "invisible") {
        iconElement.addClass("fa-eye-slash");
    } else {
        iconElement.addClass("fa-eye");
    }

    console.log(`Updated icon class for ${field}: ${iconElement.attr("class")}`);
}


/**
 * Toggles the visibility state of a specified field in the privacy settings.
 *
 * @param {string} field - The field whose visibility state is to be toggled.
 *
 * The function retrieves the current privacy settings from a hidden input field,
 * toggles the visibility state of the specified field, updates the hidden input
 * with the new settings, and ensures the eye icon reflects the new state.
 */
function toggleVisibility(field) {
    let privacySettings = JSON.parse($("#privacy_settings").val() || "{}");

    console.log("Privacy Settings before toggle:", privacySettings);

    let currentState = privacySettings[field] || "visible";
    let newState = currentState === "visible" ? "invisible" : "visible";

    console.log(`Toggling ${field} | Current State: ${currentState} -> New State: ${newState}`);

    privacySettings[field] = newState;

    updateHiddenInput(privacySettings);

    // ✅ Fix: Ensure eye icon updates correctly
    setInitialIconState(field, newState);
}

/**
 * Updates the hidden input field with the new privacy settings.
 *
 * This function takes an object containing updated settings and merges it with the current settings
 * stored in a hidden input field. It ensures that only the changed fields are updated, preserving
 * the other existing settings.
 *
 * @param {Object} updatedSettings - An object containing the updated settings to be merged.
 */
function updateHiddenInput(updatedSettings) {
    let currentSettings = JSON.parse($("#privacy_settings").val() || "{}");

    console.log("Before Update - Current Settings:", currentSettings);
    console.log("Incoming Updates (should only contain the toggled field):", updatedSettings);

    // ✅ Only update the changed field, preserving others
    Object.assign(currentSettings, updatedSettings);

    console.log("After Update - Final Settings (should match expected values):", currentSettings);

    $("#privacy_settings").val(JSON.stringify(currentSettings)).trigger("change");
}
