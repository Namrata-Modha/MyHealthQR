import './bootstrap';
import $ from 'jquery';
import 'jquery-validation';

window.$ = $;
window.jQuery = $;

document.addEventListener("DOMContentLoaded", function () {
    const dateOfBirthInput = document.getElementById("date_of_birth");
    const guardianConsentField = document.getElementById("guardianConsentField");
    const guardianConsentCheckbox = document.getElementById("guardian_consent");
    const signupBtn = document.getElementById("signup-btn");
    const signupForm = document.getElementById("signupForm");

    // Ensure form submission only happens if validation passes
    if (signupBtn && signupForm) {
        signupForm.addEventListener("submit", function (e) {
            if (typeof $ !== "undefined" && $("#signupForm").length > 0 && !$("#signupForm").valid()) {
                e.preventDefault(); // Stop submission if validation fails
                return;
            }
            signupBtn.disabled = true; 
            signupBtn.classList.add("opacity-50", "cursor-not-allowed"); 
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const lightIcon = document.getElementById('theme-toggle-light');
    const darkIcon = document.getElementById('theme-toggle-dark');

    // Ensure elements exist before accessing classList
    if (!themeToggle || !lightIcon || !darkIcon) {
        console.warn("Theme toggle elements not found. Skipping theme script.");
        return; // Exit script if elements are missing
    }

    // Check user preference from localStorage
    if (localStorage.getItem('theme') === 'light') {
        document.documentElement.classList.remove('dark');
        lightIcon.classList.remove('hidden');
        darkIcon.classList.add('hidden');
    } else {
        document.documentElement.classList.add('dark');
        darkIcon.classList.remove('hidden');
        lightIcon.classList.add('hidden');
    }

    // Toggle theme on button click
    themeToggle.addEventListener('click', () => {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
            lightIcon.classList.remove('hidden');
            darkIcon.classList.add('hidden');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const loginBtn = document.getElementById("login-btn");
    const loginForm = document.getElementById("loginForm");

    if (loginBtn && loginForm) {
        loginForm.addEventListener("submit", function (e) {
            // If using jQuery validation, ensure the form is valid before submitting
            if (typeof $ !== "undefined" && $("#loginForm").length && !$("#loginForm").valid()) {
                e.preventDefault();
                return;
            }

            loginBtn.disabled = true;
            loginBtn.classList.add("opacity-50", "cursor-not-allowed");
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const navToggle = document.getElementById("nav-toggle");
    const navMenu = document.getElementById("mobile-menu");

    if (navToggle) {
        console.log("nav-toggle.js loaded");

        navToggle.addEventListener("click", function () {
            navMenu.classList.toggle("hidden");
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const backToTop = document.getElementById('backToTop');
    if (!backToTop) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            backToTop.classList.remove('opacity-0', 'invisible');
        } else {
            backToTop.classList.add('opacity-0', 'invisible');
        }
    });

    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
