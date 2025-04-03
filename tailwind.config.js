import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // Enables manual toggling with the 'dark' class

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                brandGreen: {
                    DEFAULT: "#3CB371", // #3CB371 #007848Standard brand green
                    hover: "#2E8B57",  // #2E8B57 Darker green on hover
                },
                brandBlue: {
                    DEFAULT: "#4D8DD8",  // Standard blue for links
                    hover: "#1E40AF",  // Darker blue on hover
                },
                brandGrayLight: "#D1D5DB", //  Light gray for text
                brandGrayMedium: "#111827", //  #6B7280 Medium gray for subtext
                brandGrayDark: "#1F2937",  //  #1F2937 Dark gray for better contrast
                brandBorder: "#4B5563",  //  Improved border color for inputs/buttons
                
                // Dark Mode Colors (default)
                dark: {
                    bg: "#141414", //  #141414 #111827 Dark background
                    text: "#ffffff", // Light text in dark mode
                    border: "#374151",
                },
                // Light Mode Colors
                light: {
                    bg: "#ffffff", // Light background
                    text: "#1f2937", // Dark text in light mode
                    border: "#d1d5db",
                },
            },
        },
    },
    plugins: [],
};
