import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
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
                            DEFAULT: "#3CB371",  // Standard brand green
                            hover: "#2E8B57",  // Darker green on hover
                        },
                        brandBlue: {
                            DEFAULT: "#2D79D1",  // Standard blue for links
                            hover: "#1E40AF",  // Darker blue on hover
                        },
                        brandGrayLight: "#D1D5DB", // #D1D5DB Light gray for subtext
                        brandGrayMedium: "#1F2937",  // #6B7280 #4B5563 Medium gray for text
                        brandGrayDark: "#0F172A",  // #374151 #1F2937  #111827 #0F172A Dark gray for better contrast
                        brandBorder: "#4B5563",  // #4B5563 Improved border color for inputs/buttons
                    },
                },
            },


    plugins: [],
};
