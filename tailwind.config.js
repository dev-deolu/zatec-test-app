const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            colors: {
                black: "#000000",
                dark: "#121212",
                textGrey: "#D6D6D6",
                text: "rgba(5, 0, 56, 0.7)",
                theme: "#185BA6",
            },
            borderColor: {
                grey: "#D6D6D6",
            },
            boxShadow: {
                custom1: "0px 3px 20px rgba(0, 0, 0, 0.16)"
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
